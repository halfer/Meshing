<?php

// Set up project
$projectRoot = realpath(dirname(__FILE__) . '/../../..');
require_once $projectRoot . '/lib/Meshing/Paths.php';
require_once $projectRoot . '/tests/unit/Meshing_Test_Paths.php';
require_once $projectRoot . '/lib/Meshing/Utils.php';
Meshing_Utils::reinitialise(new Meshing_Test_Paths());

define('CHILD_TOKEN', 'meshing_test');
define('LOCKING_TEST_LOG', 'log.log');

// If we're running the child here, we'll pass an token
global $argv;
$token = array_key_exists(1, $argv) ? $argv[1] : null;

if ($token == CHILD_TOKEN)
{
	// Initialise database (normally done by DatabaseTestCase)
	Meshing_Utils::initialiseDb($testMode = true);
	Meshing_Utils::initialiseNodeDbs('test_model', $testMode);

	// Run child test
	new LockingTestCaseChild($argv[2]);
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
		$this->node = $this->createKnownNode(new TestModelKnownNode(), $this->conNode);

		// Create/empty the log
		$logDir = Meshing_Utils::getProjectRoot() . Meshing_Utils::getPaths()->getTestLogPath();
		$this->logFile = $logDir . '/' . LOCKING_TEST_LOG;
		file_put_contents($this->logFile, '');

		// Create test row
		$organiser = new TestModelTestOrganiser();
		$organiser->setCreatorNodeId($this->node->getPrimaryKey());
		$organiser->setName('Mr. Toad');
		$organiser->save($this->conNode);
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
			user_error("Can't currently test locking on the Windows platform", E_USER_WARNING);
			return;
		}

		// Append errors to this log file
		$logDir = Meshing_Utils::getProjectRoot() . Meshing_Utils::getPaths()->getTestLogPath();

		$childCount = 10;
		for ($id = 0; $id < $childCount; $id++)
		{
			$command = 'php "' . __FILE__ . '" ' . CHILD_TOKEN . ' ' . $id;
			$background = '>> ' . $logDir . '/' . LOCKING_TEST_LOG . ' 2>&1 &';
			$return = null;
			$output = system($command . ' ' . $background, $return);
			
			// @todo Need to find a way to detect if the process launch failed
			// (no $output is returned even if errors are output to stdout)
			if ($output === false)
			{
				user_error('There was a problem executing a background task', E_USER_WARNING);
				break;
			}
		}

		// Wait for all children to finish
		$iter = 0;
		$okCount = null;
		do
		{
			sleep(1);
			$iter++;
			
			$completed = $this->allChildrenFinished($childCount, $okCount);

			// Time limit
			if (($iter > 20) && !$completed)
			{
				user_error("Time limit expired, but only $okCount of $childCount children finished", E_USER_WARNING);
				break;
			}

		} while (!$completed);

		$this->assertEqual(
			$okCount,
			$childCount,
			'Check that all inserts have completed without race condition problems'
		);
	}

	protected function allChildrenFinished($childCount, &$okCount)
	{
		$okCount = 0;
		if (!file_exists($this->logFile))
		{
			return false;
		}

		$logData = file_get_contents($this->logFile);

		$matches = array();
		$count = preg_match_all('/Child #\d+ {([^}]+)}/s', $logData, $matches);

		$innerMatches = $matches[1];
		foreach ($innerMatches as $innerMatch)
		{
			if (trim($innerMatch) == 'ok') {
				$okCount++;
			}
		}

		return ($count == $childCount);
	}
}

class LockingTestCaseChild
{
	public function __construct($id)
	{
		// Get connection to operate from
		$con = Propel::getConnection(Meshing_Utils::CONN_NODE_TEST_1);

		$log = '';
		try
		{
			// Create lots of versions simultaneously
			$organiser = TestModelTestOrganiserPeer::retrieveByPK(1, 1, $con);
			$organiser->setName('Random name #' . rand(1, 999999));
			$organiser->save($con);
			$log = "ok\n";
		}
		catch (Exception $e)
		{
			$log = "error\n" . $e->getMessage() . "\n";
		}

		echo "Child #$id {\n{$log}}\n";
	}
}


