<?php

/**
 * Description of List
 *
 * @author jon
 */
class P2P_Console_Command_Schema_List extends P2P_Console_Base implements P2P_Console_Interface
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
		P2P_Utils::initialiseDb();

		$outFormat = '%-15s';
		$this->ruleOff($lineLength = 15);
		echo sprintf($outFormat, 'Name', 'Schema', 'Connection') . "\n";
		$this->ruleOff($lineLength);

		/* @var $schema P2PSchema */
		foreach (P2PSchemaPeer::doSelect(new Criteria()) as $schema)
		{
			echo sprintf(
				$outFormat,
				$schema->getName()
			) . "\n";
		}
	}
}