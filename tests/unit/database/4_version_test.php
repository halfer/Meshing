<?php

// Set up project
$projectRoot = realpath(dirname(__FILE__) . '/../../..');
require_once $projectRoot . '/lib/Meshing/Paths.php';
require_once $projectRoot . '/tests/unit/Meshing_Test_Paths.php';
require_once $projectRoot . '/lib/Meshing/Utils.php';
Meshing_Utils::reinitialise(new Meshing_Test_Paths());

// Init simpletest
require_once 'simpletest/autorun.php';

/**
 * Note: we make use of a custom base object in order to open protected methods
 * up to unit testing. We cannot re-use classes of the old prefix (TestModel) since
 * they have already been loaded into memory and cannot be unloaded or redefined.
 * 
 * We also cannot just add the new models to the map in the normal way (by loading
 * the peer) as they refer to the same tables as the old ones. We therefore have to
 * clear out the old map and rebuild it manually.
 */
class PropelVersionTestCase extends Meshing_Test_ModelTestCase
{
	public function __construct($label = false)
	{
		// Different package name to test 2
		parent::__construct('test_version', $label);

		// Clear out old table map, create us a new one
		$this->resetDatabaseMap(
			BaseTestVersionTestOrganiserPeer::DATABASE_NAME,
			array(
				'TestVersionTestOrganiserTableMap',
				'TestVersionTestEventTableMap',
				'TestVersionKnownNodeTableMap',
			)
		);

		$this->node = $this->createKnownNode(new TestVersionKnownNode(), $this->conNode);

		// I've witnessed incorrect caching on 27 Nov 2011, might be due to my messing about
		// with Propel internals too much. Disabling pooling for tests :-0
		Propel::disableInstancePooling();
	}

	public function testVersionableRowCreation()
	{
		// Create two records with a number of versions each
		$ok = $this->createNRows($v1 = 5, 'record 1');
		$ok = $this->createNRows($v2 = 8, 'record 2');
		
		// Make sure there are the expected number of current records
		$rows = TestVersionTestOrganiserQuery::create()->orderById()->find($this->conNode);
		$this->assertEqual(count($rows), 2);

		// Check the versions on each
		$record1 = $rows[0];
		$vsnRow = $record1->callCreateVersionableRow($this->conNode);
		$this->assertEqual($vsnRow->getVersion(), $v1 + 1);

		$record2 = $rows[1];
		$vsnRow = $record2->callCreateVersionableRow($this->conNode);
		$this->assertEqual($vsnRow->getVersion(), $v2 + 1);
	}

	/**
	 * Specify a non-standard parent class for the model generation
	 * 
	 * @return string
	 */
	protected function getBaseClass()
	{
		return 'TestMeshingBaseObject2';
	}

	protected function createNRows($n, $suffix)
	{
		$versions = array();
		for ($i = 1; $i <= $n; $i++)
		{
			$cols = array(
				'name' => 'Name #' . rand(1, 1000) . ' (' . $suffix . ')',
				'email' => 'email@example' . rand(1,9999) . '.co.uk',
				Meshing_Database_Utils::COL_DECLARE_TOKEN => 'organiser',
			);
			
			// We can't reversion on the first pass, of course
			if ($i > 1)
			{
				$cols[Meshing_Database_Utils::COL_VERSION_TOKEN] = 'organiser';
			}
			
			$versions[$i] = array('TestVersionTestOrganiser' => $cols,);
		}
		$dbUtils = new Meshing_Database_Utils();
		$ok = $dbUtils->writeVersionableData($versions, $this->node, $this->conNode);		

		return $ok;
	}

	public function testSaveVersions()
	{
		$versions = array(
			// Initialisation
			array(
				'TestVersionTestOrganiser' => array(
					'name' => 'Mr. Badger',
					Meshing_Database_Utils::COL_DECLARE_TOKEN => 'mr_badger',
				),
				'TestVersionTestEvent' => array(
					'name' => 'Expert Tunnelling In The Built Environment',
					'description' => 'A fascinating presentation on how the modern badger can use human methods of construction for a long-lasting sett',
					'location' => 'Birmingham Town Hall', 'nearest_city' => 'Birmingham, UK',
					'start_time' => '2011-11-02 19:30:00', 'duration_mins' => 60,
					Meshing_Database_Utils::COL_FOREIGN_CLASS => 'TestVersionTestOrganiser',
					Meshing_Database_Utils::COL_FOREIGN_TOKEN => 'mr_badger',
					Meshing_Database_Utils::COL_DECLARE_TOKEN => 'daft_event',
				),
			),
			
			// Change the email address for the organiser
			array(
				'TestVersionTestOrganiser' => array(
					'email' => 'mr_badger@dontpokebadgerswithspoons.com',
					Meshing_Database_Utils::COL_VERSION_TOKEN => 'mr_badger',
				),
			),
			
			// Sadly Mr. Badger has had to drop out, but we have a new speaker
			array(
				'TestVersionTestOrganiser' => array(
					'name' => 'Mr. Brian Furry',
					'email' => 'brian.furry@wwf.org',
					Meshing_Database_Utils::COL_VERSION_TOKEN => 'mr_badger',
				),
			),
		);

		// Write this block of data
		$dbUtils = new Meshing_Database_Utils();
		$ok = $dbUtils->writeVersionableData($versions, $this->node, $this->conNode);
		$this->assertTrue($ok, 'Write versionable data to the database');

		/*
		 * @var $organiser TestVersionTestOrganiser
		 * @var $event TestVersionTestEvent
		 */
		$organiser = $dbUtils->getCachedObject('mr_badger');
		$event = $dbUtils->getCachedObject('daft_event');

		// Check the expected number of versions
		$this->assertEqual($event->countVersions($this->conNode), 1);
		$this->assertEqual($organiser->countVersions($this->conNode), 3);

		// Do some new/old counts from the peer
		$count = MeshingBasePeer::countNewVersions(
			$event->getPrimaryKey(),
			$this->conNode,
			'TestVersionTestEvent'
		);
		$this->assertEqual($count, 1, 'Checking counts of version rows are OK');
	
		$count = MeshingBasePeer::countOldVersions(
			$organiser->getPrimaryKey(),
			$this->conNode,
			'TestVersionTestOrganiser'
		);
		$this->assertEqual($count, 2, 'Checking counts of version rows are OK');

		// Check all versions have a timestamp
		$count1 = TestVersionTestEventVersionableQuery::create()->
			filterByTimeApplied(null, Criteria::ISNULL)->
			count($this->conNode);
		$count2 = TestVersionTestOrganiserVersionableQuery::create()->
			filterByTimeApplied(null, Criteria::ISNULL)->
			count($this->conNode);			
		$this->assertTrue(
			($count1 == 0) && ($count2 == 0),
			'Checking all versions have a timestamp'
		);

		// Check that the event has a non-null hash
		$this->assertNotNull($event->getHash($this->conNode), 'Check row hash is not null');

		// Check that some previous versions have the correct old values
		$this->assertEqual($organiser->getNumberedVersion(1, $this->conNode)->getName(), 'Mr. Badger');
		$this->assertEqual($organiser->getNumberedVersion(2, $this->conNode)->getName(), 'Mr. Badger');
		$this->assertEqual(
			$organiser->getNumberedVersion(3, $this->conNode)->getEmail(),
			'brian.furry@wwf.org'
		);
		$this->assertEqual(
			$organiser->getNumberedVersion(2, $this->conNode)->getEmail(),
			'mr_badger@dontpokebadgerswithspoons.com'
		);
	}

	public function testBadVersionNumbers()
	{
		// Retrieve the previously set up organiser row
		/* @var $organiser TestVersionTestOrganiser */
		$organiser = TestVersionTestOrganiserQuery::create()->findOne($this->conNode);

		$error = false;
		try
		{
			$organiser->getHash($this->conNode, 0);
		}
		catch (Exception $e)
		{
			$error = true;
		}
		$this->assertTrue($error, 'Checking that zero is a bad version number');

		// Count number of versions; ensure v is a good number...
		$count = $organiser->countVersions($this->conNode);
		$error = false;
		try
		{
			$organiser->getHash($this->conNode, $count);
		}
		catch (Exception $e)
		{
			$error = true;
		}
		$this->assertFalse($error, 'Checking that the last version is a good version number');

		// ... and ensure v + 1 is a bad number
		$error = false;
		try
		{
			$organiser->getHash($this->conNode, $count + 1);
		}
		catch (Exception $e)
		{
			$error = true;
		}
		$this->assertTrue($error, 'Checking that max(version) + 1 is a bad version number');
	}

	/**
	 * Check that hard-deleting a current row results in a soft version delete
	 */
	public function testDeleteRow()
	{
		// Create an organiser record
		$organiser = new TestVersionTestOrganiser();
		$organiser->setCreatorNodeId($this->node->getId());
		$organiser->setName('Mr. Froggy');
		$organiser->setEmail('buy-our-beefy@lovely-beefy.co.uk');
		$organiser->save($this->conNode);

		// Create an extra version, just for fun
		$organiser->setName('Mr. Beefy');
		$organiser->save($this->conNode);

		// Get version count
		$count = TestVersionTestOrganiserVersionableQuery::create()->count($this->conNode);

		// OK, now delete it
		$organiser->setVersionMetadata(null, null, null, $timeDeleted = time());
		$organiser->delete($this->conNode);

		// A deletion must increase the version count by one
		$newCount = TestVersionTestOrganiserVersionableQuery::create()->count($this->conNode);
		$this->assertEqual($newCount, $count + 1, 'Checking a delete creates a new version');

		// Check that old records are still readable
		$this->assertEqual(
			$organiser->getNumberedVersion(1, $this->conNode)->getName(),
			'Mr. Froggy'
		);
		$this->assertEqual(
			$organiser->getNumberedVersion(2, $this->conNode)->getEmail(),
			'buy-our-beefy@lovely-beefy.co.uk'
		);

		// Check that version 3 is deleted
		$this->assertNotNull(
			$organiser->getNumberedVersion(3, $this->conNode)->getTimeDeleted(),
			'Check that a deleted version has a deleted timestamp'
		);

		// Check that the deleted version's data is correct
		$this->assertTrue(
			($organiser->getName() == 'Mr. Beefy') &&
				($organiser->getEmail() == 'buy-our-beefy@lovely-beefy.co.uk'),
			"Check a deleted version's data is correct"
		);

		// Check that this throws an exception
		$ok = false;
		try
		{
			$organiser->getNumberedVersion(0, $this->conNode);
		}
		catch (Exception $e)
		{
			$ok = true;
		}
		$this->assertTrue($ok, 'Check that a low version number fails');

		// Test that this throws an exception
		$ok = false;
		try
		{
			$organiser->getNumberedVersion(4, $this->conNode);
		}
		catch (Exception $e)
		{
			$ok = true;
		}
		$this->assertTrue($ok, 'Check that a high version number fails');
	}
}