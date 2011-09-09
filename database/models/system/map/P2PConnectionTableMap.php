<?php



/**
 * This class defines the structure of the 'p2p_connection' table.
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
class P2PConnectionTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'system.map.P2PConnectionTableMap';

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
		$this->setName('p2p_connection');
		$this->setPhpName('P2PConnection');
		$this->setClassname('P2PConnection');
		$this->setPackage('system');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('p2p_connection_id_seq');
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 100, null);
		$this->addColumn('ADAPTOR', 'Adaptor', 'VARCHAR', true, 20, null);
		$this->addColumn('HOST', 'Host', 'VARCHAR', true, 100, null);
		$this->addColumn('DATABASE', 'Database', 'VARCHAR', false, 100, null);
		$this->addColumn('USER', 'User', 'VARCHAR', false, 100, null);
		$this->addColumn('PASSWORD', 'Password', 'VARCHAR', false, 100, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('P2POwnNode', 'P2POwnNode', RelationMap::ONE_TO_MANY, array('id' => 'connection_id', ), null, null);
	} // buildRelations()

} // P2PConnectionTableMap
