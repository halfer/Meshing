<?php

/**
 * Description of List
 *
 * @author jon
 */
class P2P_Console_Command_Connection_List extends P2P_Console_Stub implements P2P_Console_Interface
{
	public function getDescription()
	{
		return 'Lists the currently registered database connections';
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
		
		$outFormat = '%-15s%-15s%-40s';
		$this->ruleOff();
		echo sprintf($outFormat, 'Name', 'User', 'Host') . "\n";
		$this->ruleOff();
		
		$connections = P2PConnectionPeer::doSelect(new Criteria());
		/* @var $connection P2PConnection */
		foreach ($connections as $connection)
		{
			echo sprintf(
				$outFormat,
				$connection->getName(),
				$connection->getUser() ? $connection->getUser() : 'n/a',
				$connection->getHost()
			);
			echo "\n";
		}
	}

	protected function ruleOff()
	{
		echo str_repeat('-', 15 + 15 + 40) . "\n";		
	}
}