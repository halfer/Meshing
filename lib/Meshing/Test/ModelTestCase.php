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
		$this->doFixup();
		$this->_testClassBuilder('TestModel', $runTests = false);
		$this->_testSqlBuilder($runTests);
		$this->_testConfBuilder($runTests);
		$this->_testSqlRunner($runTests);

		// Init the database connections
		Meshing_Utils::initialiseDb();
		$this->con = Propel::getConnection('test');

		// Create an entry to satisfy later constraints
		$this->node = $this->createKnownNode($this->con);
	}
}
