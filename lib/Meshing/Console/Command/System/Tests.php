<?php

/**
 * Description of Tests
 *
 * @author jon
 */
class Meshing_Console_Command_System_Tests extends Meshing_Console_Base implements Meshing_Console_Interface
{
	public function getDescription()
	{
		return 'Runs the specified unit tests for Meshing';
	}

	public function getOpts()
	{
	}

	public function preRunCheck()
	{
		if (array_key_exists(0, $this->argv))
		{
			$path = '/' . $this->argv[0];
		}
		else
		{
			$path = '';
		}

		// Add the path to the standard test directory location
		$this->testDir = Meshing_Utils::getProjectRoot() .
			Meshing_Utils::getPaths()->getPathSystemTests() . $path;

		if (!is_dir($this->testDir) && !is_file($this->testDir))
		{
			throw new Meshing_Console_RunException(
				'That location does not resolve to a test or a test folder'
			);
		}
	}

	/**
	 * Tests either a single file or a directory full of 'em
	 */
	public function run()
	{
		if (is_file($this->testDir))
		{
			require_once $this->testDir;
		}
		else
		{
			$this->testAll($this->testDir);
		}
	}

	public function testAll($testDir)
	{
		// Iterate across this dir for files matching *_test.php
		$directory = new RecursiveDirectoryIterator($testDir);
		$iterator = new RecursiveIteratorIterator($directory);
		$regex = new RegexIterator(
			$iterator, '/^.+_test\.php$/i',
			RecursiveRegexIterator::GET_MATCH
		);
		$regex->next();

		$i++;
		while ($regex->valid())
		{
			$item = $regex->current();
			require_once $item[0];

			$regex->next();
		}
	}

	public function isHiddenCommand()
	{
		return true;
	}
}
