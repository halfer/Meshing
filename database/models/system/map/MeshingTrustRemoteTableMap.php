<?php



/**
 * This class defines the structure of the 'meshing_trust_remote' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.system.map
 */
class MeshingTrustRemoteTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'system.map.MeshingTrustRemoteTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
		// attributes
		$this->setName('meshing_trust_remote');
		$this->setPhpName('MeshingTrustRemote');
		$this->setClassname('MeshingTrustRemote');
		$this->setPackage('system');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('FROM_OWN_NODE_ID', 'FromOwnNodeId', 'INTEGER' , 'p2p_own_node', 'ID', true, null, null);
		$this->addForeignPrimaryKey('IN_OWN_NODE_ID', 'InOwnNodeId', 'INTEGER' , 'p2p_own_node', 'ID', true, null, null);
		$this->addPrimaryKey('KNOWN_NODE_ID', 'KnownNodeId', 'INTEGER', true, null, null);
		$this->addColumn('DIRECTION', 'Direction', 'VARCHAR', true, 1, null);
		$this->addForeignKey('TYPE', 'Type', 'INTEGER', 'meshing_trust_type', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('FromOwnNode', 'P2POwnNode', RelationMap::MANY_TO_ONE, array('from_own_node_id' => 'id', ), null, null);
		$this->addRelation('P2POwnNodeRelatedByInOwnNodeId', 'P2POwnNode', RelationMap::MANY_TO_ONE, array('in_own_node_id' => 'id', ), null, null);
		$this->addRelation('MeshingTrustType', 'MeshingTrustType', RelationMap::MANY_TO_ONE, array('type' => 'id', ), null, null);
	} // buildRelations()

} // MeshingTrustRemoteTableMap
