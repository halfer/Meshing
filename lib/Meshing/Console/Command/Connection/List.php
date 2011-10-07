<?php

/**
 * Description of List
 *
 * @author jon
 */
class Meshing_Console_Command_Connection_List extends Meshing_Console_Base implements Meshing_Console_Interface
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
		Meshing_Utils::initialiseDb();

		$outFormat = '%-15s%-12s%-15s%-40s';
		$this->ruleOff($lineLength = 15 + 12 + 15 + 40);
		echo sprintf($outFormat, 'Name', 'Adaptor', 'User', 'Host') . "\n";
		$this->ruleOff($lineLength);
		
		$connections = P2PConnectionPeer::doSelect(new Criteria());
		/* @var $connection P2PConnection */
		foreach ($connections as $connection)
		{
			echo sprintf(
				$outFormat,
				$connection->getName(),
				$connection->getAdaptor(),
				$connection->getUsername() ? $connection->getUsername() : 'n/a',
				$connection->getHost()
			);
			echo "\n";
		}
	}
}