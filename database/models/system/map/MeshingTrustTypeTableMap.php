<?php



/**
 * This class defines the structure of the 'meshing_trust_type' table.
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
class MeshingTrustTypeTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'system.map.MeshingTrustTypeTableMap';

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
		$this->setName('meshing_trust_type');
		$this->setPhpName('MeshingTrustType');
		$this->setClassname('MeshingTrustType');
		$this->setPackage('system');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('meshing_trust_type_id_seq');
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 20, null);
		$this->addColumn('PREFERRED_AUTH', 'PreferredAuth', 'VARCHAR', true, 100, 'openssl,gpg,ip');
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('MeshingTrustLocal', 'MeshingTrustLocal', RelationMap::ONE_TO_MANY, array('id' => 'type', ), null, null);
		$this->addRelation('MeshingTrustRemote', 'MeshingTrustRemote', RelationMap::ONE_TO_MANY, array('id' => 'trust_type_id', ), null, null);
	} // buildRelations()

} // MeshingTrustTypeTableMap
