<?php

// Set up project
$projectRoot = realpath(dirname(__FILE__) . '/../../..');
require_once $projectRoot . '/lib/Meshing/Paths.php';
require_once $projectRoot . '/tests/unit/Meshing_Test_Paths.php';
require_once $projectRoot . '/lib/Meshing/Utils.php';
Meshing_Utils::reinitialise(new Meshing_Test_Paths());

// Init simpletest
require_once 'simpletest/autorun.php';

class PropelVersionTestCase extends Meshing_Test_ModelTestCase
{
	public function __construct($label = false)
	{
		// Same package name as test 2
		parent::__construct('test_model', $label);

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
		$ok = $this->writeVersionableData($versions, $this->node, $this->con);
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
		$this->assertEqual($count, 1, 'Checking counts of version rows are OK');
	
		$count = MeshingBasePeer::countOldVersions(
			$organiser->getPrimaryKey(),
			$this->con,
			'TestModelTestOrganiser'
		);
		$this->assertEqual($count, 2, 'Checking counts of version rows are OK');

		// Check all versions have a timestamp
		$count1 = TestModelTestEventVersionableQuery::create()->
			filterByTimeApplied(null, Criteria::ISNULL)->
			count($this->con);
		$count2 = TestModelTestOrganiserVersionableQuery::create()->
			filterByTimeApplied(null, Criteria::ISNULL)->
			count($this->con);			
		$this->assertTrue(
			($count1 == 0) && ($count2 == 0),
			'Checking all versions have a timestamp'
		);

		// Check that the event has a non-null hash
		$this->assertNotNull($event->getHash($this->con), 'Check row hash is not null');

		// @todo Check that some previous versions have the correct old values

		// @todo Check that deleting a row results in a soft delete
	}

	/**
	 * Saves data in a versioned way, using a specific array format
	 * 
	 * @param array $versions 
	 */
	protected function writeVersionableData($versions, TestModelKnownNode $node, PDO $con = null)
	{
		/* @var $object TestModelTestEvent */
		$ok = true;
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

				// Set metadata that should be handled outside the model layer
				$time = time();
				$object->setVersionMetadata(
					$timeEdited = $time, $timeReceived = null, $timeApplied = $time
				);

				// Save and store a reference
				$ok = $ok && $object->save($con);
				$this->objects[$class] = $object;
			}
		}

		return $ok;
	}
}