<?php

// Set up project
$projectRoot = realpath(dirname(__FILE__) . '/../../..');
require_once $projectRoot . '/lib/Meshing/Paths.php';
require_once $projectRoot . '/tests/unit/Meshing_Test_Paths.php';
require_once $projectRoot . '/lib/Meshing/Utils.php';
Meshing_Utils::reinitialise(new Meshing_Test_Paths());

define('CHILD_TOKEN', 'meshing_test');

// If we're running the child here, we'll pass an token
global $argv;
$token = array_key_exists(1, $argv) ? $argv[1] : null;

if ($token == CHILD_TOKEN)
{
	// Initialise database (normally done by DatabaseTestCase)
	Meshing_Utils::initialiseDb();
	
	// Run child test
	new LockingTestCaseChild($projectRoot, $argv[2]);
	exit();
}
else
{
	// Init simpletest
	require_once 'simpletest/autorun.php';	
}

class LockingTestCase extends Meshing_Test_ModelTestCase
{
	public function __construct($label = false)
	{
		// Same package name as test 2
		parent::__construct('test_model', $label);

		// Create test row
		$organiser = new TestModelTestOrganiser();
		$organiser->setCreatorNodeId($this->node->getPrimaryKey());
		$organiser->setName('Mr. Toad');
		$organiser->save($this->con);
	}

	/**
	 * Customised version of the custom class, with testing-specific stuff in it
	 * 
	 * @return string
	 */
	protected function getBaseClass()
	{
		return 'TestMeshingBaseObject';
	}

	public function testMaxContention()
	{
		// If Windows, we can't test
		if (substr(PHP_OS, 0, 3) == 'WIN')
		{
			user_error("Can't currently test locking on the Windows platform", E_USER_NOTICE);
		}

		// Get test path
		global $argv;
		$testsDir = $this->projectRoot . $this->paths->getPathSystemTests();
		$script = $testsDir . '/' . (array_key_exists(0, $argv) ? $argv[0] : null);

		for ($id = 0; $id < 10; $id++)
		{
			$command = 'php "' . $script . '" ' . CHILD_TOKEN . ' ' . $id;
			$background = '> /dev/null 2>&1 &';
			$return = null;
			$output = system($command . ' ' . $background, $return);
			
			// @todo Need to find a way to detect if the process launch failed
			// (no $output is returned even if errors are output to stdout)
			if ($output === false)
			{
				$this->fail('There was a problem executing a background task');
				break;
			}
		}

		// @todo Wait for all children to finish
	}
}

class LockingTestCaseChild
{
	public function __construct($projectRoot, $id)
	{
		// Get connection to operate from
		$con = Propel::getConnection('test');

		$log = '';
		try
		{
			// Create lots of versions simultaneously
			$organiser = TestModelTestOrganiserPeer::retrieveByPK(1, 1, $con);
			$organiser->setName('Random name #' . rand(1, 999999));
			$organiser->save($con);
			$ok = true;
			$log = "ok\n";
		}
		catch (Exception $e)
		{
			$ok = false;
			$log = "error\n" . $e->getMessage() . "\n";
		}

		file_put_contents(
			$projectRoot . '/log.log',
			"Child #$id {\n{$log}}\n",
			FILE_APPEND
		);
	}
}


