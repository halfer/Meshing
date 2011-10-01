<?php



/**
 * This class defines the structure of the 'meshing_trust_local' table.
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
class MeshingTrustLocalTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'system.map.MeshingTrustLocalTableMap';

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
		$this->setName('meshing_trust_local');
		$this->setPhpName('MeshingTrustLocal');
		$this->setClassname('MeshingTrustLocal');
		$this->setPackage('system');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('FROM_OWN_NODE_ID', 'FromOwnNodeId', 'INTEGER' , 'p2p_own_node', 'ID', true, null, null);
		$this->addForeignPrimaryKey('TO_OWN_NODE_ID', 'ToOwnNodeId', 'INTEGER' , 'p2p_own_node', 'ID', true, null, null);
		$this->addForeignKey('TYPE', 'Type', 'INTEGER', 'meshing_trust_type', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('FromOwnNode', 'P2POwnNode', RelationMap::MANY_TO_ONE, array('from_own_node_id' => 'id', ), null, null);
		$this->addRelation('ToOwnNode', 'P2POwnNode', RelationMap::MANY_TO_ONE, array('to_own_node_id' => 'id', ), null, null);
		$this->addRelation('MeshingTrustType', 'MeshingTrustType', RelationMap::MANY_TO_ONE, array('type' => 'id', ), null, null);
	} // buildRelations()

} // MeshingTrustLocalTableMap
