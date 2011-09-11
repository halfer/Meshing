<?php



/**
 * This class defines the structure of the 'p2p_schema' table.
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
class P2PSchemaTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'system.map.P2PSchemaTableMap';

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
		$this->setName('p2p_schema');
		$this->setPhpName('P2PSchema');
		$this->setClassname('P2PSchema');
		$this->setPackage('system');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('p2p_schema_id_seq');
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 100, null);
		$this->addColumn('DESCRIPTION', 'Description', 'VARCHAR', false, 255, null);
		$this->addColumn('AUTHOR', 'Author', 'VARCHAR', false, 100, null);
		$this->addColumn('CONTACT', 'Contact', 'VARCHAR', false, 200, null);
		$this->addColumn('URL', 'Url', 'VARCHAR', false, 100, null);
		$this->addColumn('DATE_RELEASE', 'DateRelease', 'DATE', false, null, null);
		$this->addColumn('SCHEMA_VERSION', 'SchemaVersion', 'REAL', false, null, null);
		$this->addColumn('SOFTWARE_VERSION', 'SoftwareVersion', 'REAL', false, null, null);
		$this->addColumn('HISTORY', 'History', 'LONGVARCHAR', false, null, null);
		$this->addColumn('INSTALLED_AT', 'InstalledAt', 'TIMESTAMP', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('P2POwnNode', 'P2POwnNode', RelationMap::ONE_TO_MANY, array('id' => 'schema_id', ), null, null);
		$this->addRelation('P2PSchemaTable', 'P2PSchemaTable', RelationMap::ONE_TO_MANY, array('id' => 'schema_id', ), null, null);
	} // buildRelations()

} // P2PSchemaTableMap
