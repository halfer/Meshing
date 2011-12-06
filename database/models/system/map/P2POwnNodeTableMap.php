<?php



/**
 * This class defines the structure of the 'p2p_own_node' table.
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
class P2POwnNodeTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'system.map.P2POwnNodeTableMap';

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
		$this->setName('p2p_own_node');
		$this->setPhpName('P2POwnNode');
		$this->setClassname('P2POwnNode');
		$this->setPackage('system');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('p2p_own_node_id_seq');
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('SCHEMA_ID', 'SchemaId', 'INTEGER', 'meshing_schema', 'ID', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 30, null);
		$this->addForeignKey('CONNECTION_ID', 'ConnectionId', 'INTEGER', 'p2p_connection', 'ID', true, null, null);
		$this->addColumn('IS_ENABLED', 'IsEnabled', 'BOOLEAN', true, null, false);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('MeshingSchema', 'MeshingSchema', RelationMap::MANY_TO_ONE, array('schema_id' => 'id', ), null, null);
		$this->addRelation('P2PConnection', 'P2PConnection', RelationMap::MANY_TO_ONE, array('connection_id' => 'id', ), null, null);
		$this->addRelation('MeshingTrustLocalRelatedByFromOwnNodeId', 'MeshingTrustLocal', RelationMap::ONE_TO_MANY, array('id' => 'from_own_node_id', ), null, null);
		$this->addRelation('MeshingTrustLocalRelatedByToOwnNodeId', 'MeshingTrustLocal', RelationMap::ONE_TO_MANY, array('id' => 'to_own_node_id', ), null, null);
		$this->addRelation('MeshingTrustRemoteRelatedByFromOwnNodeId', 'MeshingTrustRemote', RelationMap::ONE_TO_MANY, array('id' => 'from_own_node_id', ), null, null);
		$this->addRelation('MeshingTrustRemoteRelatedByInOwnNodeId', 'MeshingTrustRemote', RelationMap::ONE_TO_MANY, array('id' => 'in_own_node_id', ), null, null);
	} // buildRelations()

} // P2POwnNodeTableMap
