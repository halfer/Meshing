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
		$strategy = new Meshing_Hash_Strategy_Basic($this->con);
		$paths->setHashProvider($strategy);
		$this->clearProviderCache();

		return $strategy;
	}

	protected function useVersionStrategy()
	{
		$paths = Meshing_Utils::getPaths();
		$strategy = new Meshing_Hash_Strategy_Version($this->con);
		$paths->setHashProvider($strategy);
		$this->clearProviderCache();

		return $strategy;
	}

	/**
	 * Clears the static object variables used to cache a provider per connection
	 */
	protected function clearProviderCache()
	{
		$o = new MeshingBaseObject();
		$o->clearHashProviders();
	}

	public function testBasicHash()
	{
		$strategy = $this->useBasicStrategy();

		// Create a record
		$organiser = new TestModelTestOrganiser();
		$organiser->setCreatorNodeId($this->node->getId());
		$organiser->setName('Organiser');
		$organiser->setEmail('email@example.com');
		$organiser->save($this->con);

		// Calc the hash and see if it is okay (interleaved 1s = "preceding value not null")
		$values = array(
			$organiser->getId(),
			$organiser->getName(),
			$organiser->getEmail(),
			$organiser->getTestModelKnownNode($this->con)->getFqdn(),
		);
		$out = '';
		foreach ($values as $value)
		{
			$out .= $value . $strategy->getValueTerminator($value);
		}
		$expectedHash = sha1($out);
		$this->assertEqual(
			$expectedHash,
			$organiser->getHash($this->con),
			'Checking simple SHA1 works'
		);
	}

	public function testNullHashOnNewRows()
	{
		// This should throw an exception
		$event = new TestModelTestEvent();
		$this->assertNull(
			$event->getHash($this->con),
			'Check that getting a hash on an unsaved row returns null'
		);
	}

	/**
	 * Since null and empty string cast to the same string, check their hashes are different
	 */
	public function testNullVersusEmptyStringHashing()
	{
		// Do initial save with an empty, non-null value
		$organiser = TestModelTestOrganiserQuery::create()->findOne($this->con);
		$organiser->setEmail('');
		$organiser->save($this->con);

		// Get the hash of the current record
		$hash = $organiser->getHash($this->con);

		// Now do a save with a null value
		$organiser->setEmail(null);
		$organiser->save($this->con);

		// Compare the hash values - they should be different
		$this->assertNotEqual(
			$hash,
			$organiser->getHash($this->con),
			'Check that empty string and null hash to different values'
		);
	}

	/**
	 * Checks that the version hash is working
	 */
	public function testVersionHash()
	{
		$strategy = $this->useVersionStrategy();

		// Get an organiser record
		$organiser = TestModelTestOrganiserQuery::create()->findOne($this->con);

		// Create a record
		$event = new TestModelTestEvent();
		$event->setCreatorNodeId($this->node->getId());
		$event->setName('Small-Scale Oil Drilling For Cats');
		$event->setTestModelTestOrganiser($organiser);
		$event->save($this->con);

		// @todo ...
	}
}
