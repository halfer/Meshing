<?php

// Set up project
$projectRoot = realpath(dirname(__FILE__) . '/../..');
require_once $projectRoot . '/lib/Meshing/Utils.php';
Meshing_Utils::initialise();

// Init simpletest
require_once 'simpletest/autorun.php';

class ConsoleHelpTestCase extends UnitTestCase
{
	public function testCreation()
	{
		$this->assertTrue(true);
	}
}