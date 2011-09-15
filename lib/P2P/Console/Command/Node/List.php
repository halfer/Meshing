<?php

/**
 * Description of List
 *
 * @author jon
 */
class P2P_Console_Command_Node_List extends P2P_Console_Base implements P2P_Console_Interface
{
	public function getDescription()
	{
		return 'Lists the currently registered nodes';
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

		$outFormat = '%-15s%-15s%-15s';
		$this->ruleOff($lineLength = 15 + 15 + 15);
		echo sprintf($outFormat, 'Name', 'Schema', 'Connection') . "\n";
		$this->ruleOff($lineLength);

		/* @var $ownNode P2POwnNode */
		foreach (P2POwnNodePeer::doSelect(new Criteria()) as $ownNode)
		{
			echo sprintf(
				$outFormat,
				$ownNode->getName(),
				$ownNode->getP2PSchema()->getName(),
				$ownNode->getP2PConnection()->getName()
			) . "\n";
		}
	}
}