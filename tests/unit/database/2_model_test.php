<?php

// Set up project
$projectRoot = realpath(dirname(__FILE__) . '/../../..');
require_once $projectRoot . '/lib/Meshing/Paths.php';
require_once $projectRoot . '/tests/unit/Meshing_Test_Paths.php';
require_once $projectRoot . '/lib/Meshing/Utils.php';
Meshing_Utils::reinitialise(new Meshing_Test_Paths());

// Init simpletest
require_once 'simpletest/autorun.php';

class PropelModelTestCase extends Meshing_Test_DatabaseTestCase
{
	/**
	 * Tests the building of node model class files
	 */
	public function testClassBuilder()
	{
		$package = 'test_model';
		$this->setPackage($package);

		// Convert schema to node format (no class prefix)
		$fixup = new Meshing_Schema_Fixup(
			$this->schemaDir . '/' . $this->schemas,
			$this->outputSchemaDir . '/' . $this->paths->getLeafStandardSchema()
		);
		$fixup->fixup($package);

		// Do generation of classes and all checking
		$this->_testClassBuilder($package, 'TestModel');
	}

	/**
	 * This is an extended list of expected classes
	 * 
	 * @return array
	 */
	protected function expectedClasses()
	{
		return parent::expectedClasses() +
			array(
				'KnownNode', 'MeshingIdentity',
				'MeshingTestEventVersionable', 'MeshingTestOrganiserVersionable'
			);
	}

	/**
	 * Tests the building of generated SQL
	 */
	public function testSqlBuilder()
	{
		$this->_testSqlBuilder();
	}

	/**
	 * Runs generated SQL against the configured db
	 */
	public function testSqlRunner()
	{
		$this->_testSqlRunner();
	}

	public function testConfBuilder()
	{
		$this->_testConfBuilder();
	}

	public function testModels()
	{
	}
}