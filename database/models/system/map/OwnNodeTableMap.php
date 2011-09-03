<?php

namespace P2PT/System\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'own_node' table.
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
class OwnNodeTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'system.map.OwnNodeTableMap';

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
		$this->setName('own_node');
		$this->setPhpName('OwnNode');
		$this->setClassname('P2PT/System\\OwnNode');
		$this->setPackage('system');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('own_node_id_seq');
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('SCHEMA_ID', 'SchemaId', 'INTEGER', 'schema', 'ID', true, null, null);
		$this->addColumn('SHORT_NAME', 'ShortName', 'VARCHAR', true, 30, null);
		$this->addForeignKey('CONNECTION_ID', 'ConnectionId', 'INTEGER', 'connection', 'ID', true, null, null);
		$this->addColumn('IS_ENABLED', 'IsEnabled', 'BOOLEAN', true, null, false);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Schema', 'P2PT/System\\Schema', RelationMap::MANY_TO_ONE, array('schema_id' => 'id', ), null, null);
		$this->addRelation('Connection', 'P2PT/System\\Connection', RelationMap::MANY_TO_ONE, array('connection_id' => 'id', ), null, null);
	} // buildRelations()

} // OwnNodeTableMap
