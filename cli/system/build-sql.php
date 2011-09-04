<?php

// System initialisation
$projectPath = realpath(
	dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'
);
require_once $projectPath . '/lib/P2P/Utils.php';
P2P_Utils::initialise();

// Set db type, schema and output folder here
$targetDb = 'pgsql';
$schemaDir = $projectPath . '/database/system';
$schemas = "schema.xml";
$outputFolder = $projectPath . "/database/sql/system";
$propertiesFile = $projectPath . '/vendor/propel-1.6/generator/default.properties';

// Create task, configure, then run
$task = new P2P_Propel_SqlBuilder();

$task->setDatabaseType($targetDb);
$task->setPropertiesFile($propertiesFile);
$task->setSchemaDir($schemaDir);
$task->setSchemas($schemas);
$task->setOutputDir($outputFolder);

$task->run();
