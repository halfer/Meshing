<?php

class Meshing_Console_Command_Node_Send extends Meshing_Console_Base implements Meshing_Console_Interface
{
	public function getDescription()
	{
		return 'Send some updates out to known nodes';
	}

	public function getOpts()
	{
		return array(
			'name|n=s' => 'The name of the new node',
		);
	}

	public function preRunCheck()
	{
		if (!$this->opts->name)
		{
			throw new Zend_Console_Getopt_Exception('Which node would you like have send updates? (use --name)');
		}

		Meshing_Utils::initialiseDb();
		$this->node = P2POwnNodeQuery::create()->findOneByName($this->opts->name);
		if (!$this->node)
		{
			throw new Zend_Console_Getopt_Exception('A node of that name is not registered');
		}
	}

	public function run()
	{
		$controller = new Meshing_Node_Controller();
		$controller->sendUpdatesForNode($this->node);
	}
}
