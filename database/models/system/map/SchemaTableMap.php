<?php

namespace P2PT/System\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'schema' table.
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
class SchemaTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'system.map.SchemaTableMap';

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
		$this->setName('schema');
		$this->setPhpName('Schema');
		$this->setClassname('P2PT/System\\Schema');
		$this->setPackage('system');
		$this->setUseIdGenerator(true);
		$this->setPrimaryKeyMethodInfo('schema_id_seq');
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('XML', 'Xml', 'LONGVARCHAR', true, null, null);
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
		$this->addRelation('OwnNode', 'P2PT/System\\OwnNode', RelationMap::ONE_TO_MANY, array('id' => 'schema_id', ), null, null);
		$this->addRelation('SchemaTable', 'P2PT/System\\SchemaTable', RelationMap::ONE_TO_MANY, array('id' => 'schema_id', ), null, null);
	} // buildRelations()

} // SchemaTableMap
