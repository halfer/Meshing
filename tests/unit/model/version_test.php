<?php

// Set up project
$projectRoot = realpath(dirname(__FILE__) . '/../../..');
require_once $projectRoot . '/lib/Meshing/Paths.php';
require_once $projectRoot . '/lib/Meshing/Utils.php';
Meshing_Utils::initialise(new Meshing_Paths());

// Init simpletest
require_once 'simpletest/autorun.php';

class ModelVersioningTestCase extends Meshing_Test_ModelTestCase
{
	public function setUp()
	{
		Meshing_Utils::initialiseDb();
		
		// @todo We need to generate this from scratch
		Meshing_Utils::initialiseNodeDbs('jobs');
		
		parent::setUp();
	}

	public function testVersioning()
	{
		// Object creation
		$role = new JobsRole();
		$this->assertTrue($role instanceof JobsRole);

		
	}
}