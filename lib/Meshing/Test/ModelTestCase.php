<?php

/**
 * Used to set up a model test
 *
 * @author jon
 */
abstract class Meshing_Test_ModelTestCase extends Meshing_Test_DatabaseTestCase
{
	public function __construct($package, $label = false)
	{
		parent::__construct($package, $label);

		// Clear db away from previous tests
		$this->doFixup($package, 'test_model');
		$this->_testClassBuilder('TestModel', $runTests = false);
		$this->_testSqlBuilder($runTests);
		$this->_testConfBuilder($runTests);
		$this->_testSqlRunner($runTests);

		// Init the database connections
		$this->initConnections();
	}

	/**
	 * Clears and repopulates the DatabaseMap with new TableMap classes
	 * 
	 * @param type $name
	 * @param type $tableMapClassNames 
	 */
	protected function resetDatabaseMap($name, array $tableMapClassNames)
	{
		$dbMap = new DatabaseMap($name);
		foreach ($tableMapClassNames as $tableMapClassName)
		{
			$dbMap->addTableFromMapClass($tableMapClassName);
		}
		Propel::setDatabaseMap($name, $dbMap);
	}
}
