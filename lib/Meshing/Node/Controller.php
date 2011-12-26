<?php

/**
 * Carries out business logic of a node, and interfaces with its model counterpart 'P2POwnNode'
 *
 * @author jon
 * 
 * @todo Offer choice of priority strategy: nodes-then-tables, or tables-then-nodes?
 */
class Meshing_Node_Controller
{
	public function sendUpdatesForNodes()
	{
		$ownNodes = P2POwnNodeQuery::create()->find();
		foreach ($ownNodes as $ownNode)
		{
			$this->sendUpdatesToNode($ownNode);
		}
	}

	/**
	 * Called by node:send <node-name>
	 * 
	 * @param P2POwnNode $node 
	 */
	public function sendUpdatesForNode(P2POwnNode $node)
	{
		// Get nodes that we trust
		$nodes = $this->getLocalAndRemoteReceiverNodes($node);

		//for knownnodes as knownnode
		//		if registered to receive updates
		//			sendupdatesfortable
		//		end if
		//endfor
	}

	/**
	 * Gets mixed array of MeshingOwnNode and *KnownNode objects to send to
	 */
	protected function getLocalAndRemoteReceiverNodes(P2POwnNode $node)
	{
		// Rewrite the above from the perspective of the local 'to' node
		$localNodes = P2POwnNodeQuery::create()->
			joinMeshingTrustLocalRelatedByToOwnNodeId('TrustLocal')->
			useQuery('TrustLocal')->
				joinMeshingTrustType()->
			endUse()->
			where('TrustLocal.FromOwnNodeId = ?', $node->getId())->
			where('MeshingTrustType.Name LIKE ?', 'write%')->
			find()
		;

		// Get array of node ids in remote database (we can't join between system and node dbs)
		$remoteNodeIds = MeshingTrustRemoteQuery::create()->
			joinMeshingTrustType()->
			where('MeshingTrustRemote.FromOwnNodeId = ?', $node->getId())->
			where('MeshingTrustType.Name LIKE ?', 'write%')->
			select('MeshingTrustRemote.KnownNodeId')->
			find()->
			getArrayCopy()
		;

		// Initialise remote node models
		$schemaName = $node->getMeshingSchema()->getName();
		Meshing_Utils::initialiseNodeDbs($schemaName);
		$con = Meshing_Node_Utils::getConnectionForNode($node);

		// Do select in node database for remote node ids
		$className = Meshing_Node_Utils::getNodeClassName($schemaName, 'KnownNodeQuery');
		/* @var $query JobsKnownNodeQuery */
		// (This is just an example - can be of any *KnownNodeQuery class)
		$query = call_user_func(array($className, 'create'), 'KnownNode');
		$remoteNodes = $query->where('KnownNode.Id IN ?', $remoteNodeIds)->find($con);

		/* @var $localNodes PropelObjectCollection */
		/* @var $remoteNodes PropelObjectCollection */
		return array_merge($localNodes->getArrayCopy(), $remoteNodes->getArrayCopy());
	}

	public function sendUpdatesToNode()
	{
		$schema = $node->getMeshingSchema();
		foreach ($schema->getMeshingSchemaTables() as $table)
		{
			$this->sendUpdatesForTable($node, $table);
		}
	}

	public function sendUpdatesForTable(P2POwnNode $node, MeshingSchemaTable $table)
	{
		// Do search for rows with update timestamp > X, order by timestamp ascending
		// loop through rows
		//		sendUpdatesForRow($table, $pks)
		// endloop
	}

	public function sendUpdatesForRow(P2POwnNode $node, MeshingSchemaTable $table, array $pks)
	{
		// Strategy 
	}
}
