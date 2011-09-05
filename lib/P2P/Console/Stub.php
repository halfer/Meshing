<?php

class P2P_Console_Stub extends P2P_Console_Base implements P2P_Console_Interface
{
	public function getDescription()
	{
		return 'No description for this command yet';
	}

	public function getOpts()
	{
		return array();
	}

	public function parseOpts()
	{
	}

	public function preRunCheck()
	{
		
	}

	public function run()
	{
		echo "This command presently does nothing.\n";
	}
}
