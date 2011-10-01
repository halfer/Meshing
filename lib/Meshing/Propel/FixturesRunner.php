<?php

/**
 * Simple class to add fixtures from a PHP array file
 *
 * @author jon
 */
class Meshing_Propel_FixturesRunner
{
	protected $fixturesFile;

	public function __construct($fixturesFile)
	{
		$this->fixturesFile = $fixturesFile;
		
		Meshing_Utils::initialiseDb();
	}

	public function run()
	{
		$fixtures = include($this->fixturesFile);

		foreach ($fixtures as $className => $tableInserts)
		{
			if (!class_exists($className))
			{
				throw new Exception("Class '$className' not recognised");
			}
			
			foreach ($tableInserts as $index => $rowInserts)
			{
				$class = new $className();
				foreach ($rowInserts as $columnName => $value)
				{
					$class->setByName($columnName, $value, BasePeer::TYPE_FIELDNAME);
				}
				$class->save();
			}
		}
		
		$a = new MeshingTrustLocal();
	}
}
