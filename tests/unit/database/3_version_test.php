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
	}

	public function testVersion()
	{
		Meshing_Utils::initialiseDb();
		$con = Propel::getConnection('test');

		// Create an entry to satisfy later constraints
		$node = $this->createKnownNode($con);
		
		$versions = array(
			// Initialisation
			1 => array(
				'TestModelTestOrganiser' => array(
					'name' => 'Mr. Badger',
				),
				'TestModelTestEvent' => array(
					'name' => 'Expert Tunnelling In The Built Environment',
					'description' => 'A fascinating presentation on how the modern badger can use human method of construction for a long-lasting sett',
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

		try
		{
			$this->writeVersionableData($versions, $node, $con);
			$ok = true;
		}
		catch (Exception $e)
		{
			echo $e->getMessage() . "\n";
			$ok = false;
		}
		
		// Did we write the data ok?
		$this->assertTrue($ok, 'Write versionable data to the database');
		
		// @todo Add some versioning tests here
	}

	/**
	 * Writes version data from a specific array format
	 * 
	 * @param array $versions 
	 */
	protected function writeVersionableData($versions, TestModelKnownNode $node, PDO $con = null)
	{
		// Init an objects list for this class
		$objects = array();

		foreach ($versions as $versionNo => $versionData)
		{
			foreach ( $versionData as $class => $data )
			{
				// Use existing row, or create a new instance
				if (array_key_exists($class, $objects))
				{
					$object = $objects[$class];
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
						$foreignObj = $objects[$column];
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
				$objects[$class] = $object;
			}
		}
	}
}