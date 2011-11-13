<?php

// Set up project
$projectRoot = realpath(dirname(__FILE__) . '/../../..');
require_once $projectRoot . '/lib/Meshing/Paths.php';
require_once $projectRoot . '/tests/unit/Meshing_Test_Paths.php';
require_once $projectRoot . '/lib/Meshing/Utils.php';
Meshing_Utils::reinitialise(new Meshing_Test_Paths());

// Init simpletest
require_once 'simpletest/autorun.php';

class RowHashingTestCase extends Meshing_Test_ModelTestCase
{
	public function __construct($label = false)
	{
		// Same package name as test 2
		parent::__construct('test_model', $label);
	}

	/**
	 * Use Basic strategy to generate hashes
	 */
	protected function useBasicStrategy()
	{
		$paths = Meshing_Utils::getPaths();
		$paths->setHashProvider(new Meshing_Hash_Strategy_Basic($this->con));		
	}

	public function testSimpleSha1()
	{
		$this->useBasicStrategy();
		
		// Create a record
		$organiser = new TestModelTestOrganiser();
		$organiser->setCreatorNodeId($this->node->getId());
		$organiser->setName('Organiser');
		$organiser->setEmail('email@example.com');
		$organiser->save($this->con);

		// Calc the hash and see if it is okay
		$expectedHash = sha1(
			$organiser->getId() .
			$organiser->getName() .
			$organiser->getEmail() .
			$organiser->getTestModelKnownNode($this->con)->getFqdn()
		);
		$this->assertEqual(
			$expectedHash,
			$organiser->getHash($this->con),
			'Checking simple SHA1 works'
		);
	}

	public function testNoHashOnNewRows()
	{
		// This should throw an exception
		$event = new TestModelTestEvent();
		$error = false;
		try
		{
			$version = $event->getHash($this->con);
		}
		catch (Exception $e)
		{
			$error = true;
		}

		// Check that an error was thrown
		$this->assertTrue(
			$error,
			'Check that getting a hash on an unsaved row throws an exception'
		);
	}

	public function testBadVersionNumbers()
	{
		// Retrieve the previously set up organiser row
		/* @var $organiser TestModelTestOrganiser */
		$organiser = TestModelTestOrganiserQuery::create()->findOne($this->con);

		$error = false;
		try
		{
			$organiser->getHash($this->con, 0);
		}
		catch (Exception $e)
		{
			$error = true;
		}
		$this->assertTrue($error, 'Checking that zero is a bad version number');

		// Count number of versions; ensure v is a good number...
		$count = $organiser->countVersions($this->con);
		$error = false;
		try
		{
			$organiser->getHash($this->con, $count);
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
			$organiser->getHash($this->con, $count + 1);
		}
		catch (Exception $e)
		{
			$error = true;
		}
		$this->assertTrue($error, 'Checking that max(version) + 1 is a bad version number');
	}
}
