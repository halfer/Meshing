<?php

class Meshing_Console_Stub extends Meshing_Console_Base implements Meshing_Console_Interface
{
	public function getDescription()
	{
		return 'No description for this command yet';
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
		echo "This command presently does nothing.\n";
	}
}
