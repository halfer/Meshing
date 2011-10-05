<?php

/**
 * Location of various things relative to project root
 *
 * @author jon
 */
class Meshing_Paths
{
	// Libraries
	const PATH_ZEND =				'/vendor/zend-1.11';
	const PATH_PROPEL_GENERATOR =	'/vendor/propel-1.6/generator/lib';
	const PATH_PHING =				'/vendor/phing-2.4/classes';
	const PATH_SIMPLETEST =			'/vendor';
	const INC_PROPEL_RUNTIME =		'/vendor/propel-1.6/runtime/lib/Propel.php';

	// Meshing locations
	const PATH_MESHING =			'/lib';
	const PATH_MESHING_COMMANDS =	'/lib/Meshing/Console/Command';

	// Folder locations
	const PATH_MODELS_SYSTEM =		'/database/models';
	const PATH_MODELS_NODES =		'/database/models';
	const PATH_SCHEMAS_NODES =		'/database/schemas';
	const PATH_SQL_SYSTEM =			'/database/sql/system';
	const PATH_SQL_NODES =			'/database/sql';
	const PATH_CONNS_SYSTEM =		'/database/connections';
	const PATH_CONNS_NODES =		'/database/connections';
	const PATH_DB_CONFIG =			'/database/system';
	const PATH_SYSTEM_FIXTURES =	'/database/system';
	const PATH_SYSTEM_SNIPPETS =	'/database/system/snippets';

	// Custom Propel base classes
	const PATH_CUSTOM_BASES =		'/database/system/models/customisations';
}
