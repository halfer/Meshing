<?php

/**
 * Description of Start
 *
 * @author jon
 */
class P2P_Console_Command_Node_Start extends P2P_Console_Stub implements P2P_Console_Interface
{
	public function getDescription()
	{
		return 'Permits the node to send and receive updates with trusted nodes';
	}

	public function getOpts()
	{
		return array();
	}

	public function preRunCheck()
	{
		// @todo Connect with this node's connection, and ensure there are rows in known_nodes
		
		// @todo Need to test whether this node trusts other nodes
		throw new Zend_Console_Getopt_Exception(
			'A node needs to trust other nodes before it can be started'
		);
	}

	public function run()
	{
		echo "This command presently does nothing.\n";
	}
}