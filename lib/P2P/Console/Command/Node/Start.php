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
		return array(
			'name|n=s' => 'The name of the node to start',
		);
	}

	public function preRunCheck()
	{
		if (!$this->opts->name)
		{
			throw new Zend_Console_Getopt_Exception('Which node would you like to start? (use --name)');
		}

		P2P_Utils::initialiseDb();
		$node = P2POwnNodeQuery::create()->findOneByName($this->opts->name);
		if (!$node)
		{
			throw new Zend_Console_Getopt_Exception('A node of that name is not registered');
		}
		
		// Connect with this node's connection, and ensure there are rows in known_nodes
		$conn = Propel::getConnection($node->getP2PConnection()->getName());
		
		// @todo Obtain the name of the KnownNode class for this schema i.e.
		// camel(schemaName + '_known_node') => 'JobsKnownNode'
		$schema = P2PSchemaPeer::getSchemaForNode($node);
		$underscored = $node->getName() . '_known_node';
		$knownNodeRow = false;

		// If there are no trust rows, we cannot start
		if (!$knownNodeRow)
		{
			throw new Zend_Console_Getopt_Exception(
				'A node needs to trust other nodes before it can be started'
			);
		}
	}

	public function run()
	{
		echo "This command presently does nothing.\n";
	}
}