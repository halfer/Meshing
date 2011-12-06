<?php

/**
 * Description of List
 *
 * @author jon
 */
class Meshing_Console_Command_Schema_List extends Meshing_Console_Base implements Meshing_Console_Interface
{
	public function getDescription()
	{
		return 'Lists the currently registered schemas';
	}

	public function getOpts()
	{
		return array();
	}

	public function preRunCheck()
	{
		
	}

	public function run()
	{
		Meshing_Utils::initialiseDb();

		$outFormat = '%-15s';
		$this->ruleOff($lineLength = 15);
		echo sprintf($outFormat, 'Name', 'Schema', 'Connection') . "\n";
		$this->ruleOff($lineLength);

		/* @var $schema MeshingSchema */
		foreach (MeshingSchemaPeer::doSelect(new Criteria()) as $schema)
		{
			echo sprintf(
				$outFormat,
				$schema->getName()
			) . "\n";
		}
	}
}