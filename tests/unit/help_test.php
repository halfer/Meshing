<?php

// Set up project
$projectRoot = realpath(dirname(__FILE__) . '/../..');
require_once $projectRoot . '/lib/Meshing/Paths.php';
require_once $projectRoot . '/lib/Meshing/Utils.php';
Meshing_Utils::initialise(new Meshing_Paths());

// Init simpletest
require_once 'simpletest/autorun.php';

class ConsoleHelpTestCase extends UnitTestCase
{
	public function testHelp()
	{
		// Test the bare command
		$out = $this->runCommand('');
		$this->assertPattern('/Meshing is Free software/', $out);
		
		// Test a few commands from the syntax list
		$out = $this->runCommand('commands');
		$this->assertPattern('/node:add/', $out);
		$this->assertPattern('/schema:add/', $out);
		$this->assertPattern('/trust:add/', $out);

		$out = $this->runCommand('help connection:add');
		// @todo Not enough in here to constitute a test!
		$this->assertPattern('/Syntax.+--name.+--user/', $out);
	}

	protected function runCommand($command)
	{
		$projectRoot = Meshing_Utils::getProjectRoot();

		$command = $projectRoot . '/meshing ' . $command;
		$output = array();
		exec($command, $output);

		return implode("\n", $output);
	}
}