<?php

namespace P2PT/System\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'connection' table.
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
class ConnectionTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'system.map.ConnectionTableMap';

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
		$this->setName('connection');
		$this->setPhpName('Connection');
		$this->setClassname('P2PT/System\\Connection');
		$this->setPackage('system');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('connection_id_seq');
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('HOST', 'Host', 'VARCHAR', true, 100, null);
		$this->addColumn('USER', 'User', 'VARCHAR', false, 100, null);
		$this->addColumn('PASSWORD', 'Password', 'VARCHAR', false, 100, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('OwnNode', 'P2PT/System\\OwnNode', RelationMap::ONE_TO_MANY, array('id' => 'connection_id', ), null, null);
	} // buildRelations()

} // ConnectionTableMap
