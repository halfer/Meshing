<?php

// Set up project
$projectRoot = realpath(dirname(__FILE__) . '/../../..');
require_once $projectRoot . '/lib/Meshing/Paths.php';
require_once $projectRoot . '/tests/unit/Meshing_Test_Paths.php';
require_once $projectRoot . '/lib/Meshing/Utils.php';
Meshing_Utils::reinitialise(new Meshing_Test_Paths());

// Init simpletest
require_once 'simpletest/autorun.php';

class PropelVersionTestCase extends Meshing_Test_DatabaseTestCase
{
	public function __construct($label = false)
	{
		// Same package name as test 2
		parent::__construct('test_model', $label);
		
		// Clear db away from previous tests
		$this->doFixup();
		$this->_testClassBuilder('TestModel', $runTests = false);
		$this->_testSqlBuilder($runTests);
		$this->_testConfBuilder($runTests);
		$this->_testSqlRunner($runTests);

		// Init the database connections
		Meshing_Utils::initialiseDb();
		$this->con = Propel::getConnection('test');

		// Create an entry to satisfy later constraints
		$this->node = $this->createKnownNode($this->con);

		// Create a cache for rows we write
		$this->objects = array();
	}

	public function testSaveVersions()
	{		
		$versions = array(
			// Initialisation
			1 => array(
				'TestModelTestOrganiser' => array(
					'name' => 'Mr. Badger',
				),
				'TestModelTestEvent' => array(
					'name' => 'Expert Tunnelling In The Built Environment',
					'description' => 'A fascinating presentation on how the modern badger can use human methods of construction for a long-lasting sett',
					'location' => 'Birmingham Town Hall', 'nearest_city' => 'Birmingham, UK',
					'start_time' => '2011-11-02 19:30:00', 'duration_mins' => 60,
					'TestModelTestOrganiser' => 'FOREIGN_KEY',
				),
			),
			
			// Change the email address for the organiser
			2 => array(
				'TestModelTestOrganiser' => array(
					'email' => 'mr_badger@dontpokebadgerswithspoons.com',
				),
			),
			
			// Sadly Mr. Badger has had to drop out, but we have a new speaker
			3 => array(
				'TestModelTestOrganiser' => array(
					'name' => 'Mr. Brian Furry',
					'email' => 'brian.furry@wwf.org',
				),
			),
		);

		// Write this block of data
		$ok = $this->writeDataCatchErrors($versions, $this->node, $this->con);
		$this->assertTrue($ok, 'Write versionable data to the database');

		/*
		 * @var $organiser TestModelTestOrganiser
		 * @var $event TestModelTestEvent
		 */
		$organiser = $this->objects['TestModelTestOrganiser'];
		$event = $this->objects['TestModelTestEvent'];

		// Check the expected number of versions
		$this->assertEqual($event->countVersions($this->con), 1);
		$this->assertEqual($organiser->countVersions($this->con), 3);

		// Do some new/old counts from the peer
		$count = MeshingBasePeer::countNewVersions(
			$event->getPrimaryKey(),
			$this->con,
			'TestModelTestEvent'
		);
		$this->assertEqual($count, 1);
	
		$count = MeshingBasePeer::countOldVersions(
			$organiser->getPrimaryKey(),
			$this->con,
			'TestModelTestOrganiser'
		);
		$this->assertEqual($count, 2);
	}

	protected function writeDataCatchErrors($versions, TestModelKnownNode $node, PDO $con = null)
	{
		try
		{
			$this->writeVersionableData($versions, $node, $con);
			$ok = true;
		}
		catch (Exception $e)
		{
			$ok = false;
		}

		return $ok;
	}

	/**
	 * Saves data in a versioned way, using a specific array format
	 * 
	 * @param array $versions 
	 */
	protected function writeVersionableData($versions, TestModelKnownNode $node, PDO $con = null)
	{
		foreach ($versions as $versionNo => $versionData)
		{
			foreach ( $versionData as $class => $data )
			{
				// Use existing row, or create a new instance
				if (array_key_exists($class, $this->objects))
				{
					$object = $this->objects[$class];
				}
				else
				{
					$object = new $class();
					$object->setCreatorNodeId($node->getPrimaryKey());
				}
				
				foreach ($data as $column => $value)
				{
					if ($value == 'FOREIGN_KEY')
					{
						// Pokes the appropriate class in as a foreign reference
						$method = 'set' . $column;
						$foreignObj = $this->objects[$column];
						$object->$method($foreignObj);
					}
					else
					{
						// Set standard column
						$object->setByName($column, $value, BasePeer::TYPE_FIELDNAME);
					}
				}

				// Save and store a reference
				$object->save($con);
				$this->objects[$class] = $object;
			}
		}
	}
}