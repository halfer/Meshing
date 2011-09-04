<?php

$projectPath = realpath(
	dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'
);
set_include_path(
	get_include_path() . PATH_SEPARATOR .
	$projectPath . '/vendor/propel-1.6/generator/lib' . PATH_SEPARATOR .
	$projectPath . '/vendor/phing-2.4/classes'
);

require_once 'phing/Phing.php';
require_once 'phing/Project.php';
require_once 'phing/types/FileSet.php';
require_once 'phing/types/Mapper.php';
require_once 'phing/system/io/PhingFile.php';
require_once 'phing/system/util/Properties.php';
require_once 'task/AbstractPropelDataModelTask.php';
require_once 'task/PropelSQLTask.php';

// Set db type, schema and output folder here
$targetDb = 'pgsql';
$schemaFolder = $projectPath . '/database/system';
$schemas = "schema.xml";
$outputFolder = $projectPath . "/database/sql/system";
$propertiesFile = $projectPath . '/vendor/propel-1.6/generator/default.properties';

// Set custom props here
$customProps = array(
	'propel.database' => $targetDb,                // Required for ${} replacements
);

echo "Target db: \t\t$targetDb\n";
echo "Schema(s): \t\t$schemas\n";
echo "Output folder: \t\t$outputFolder\n";
echo "Properties folder:\t$propertiesFile\n";

Phing::startup();
$project = new Project();

// Read in default properties file, and add custom values
$properties = new Properties();
$properties->load(new PhingFile($propertiesFile));
foreach( $customProps as $key => $value ) {
	$properties->put($key, $value);
}

// Then swap out placeholder values
foreach ( $properties->getProperties() as $key => $value )
{
	$value = ProjectConfigurator::replaceProperties($project, $value, $properties->getProperties());
	$project->setProperty($key, $value);
}

$SQLTask = new PropelSQLTask();
$SQLTask->setProject($project);
$fileSet = new FileSet();
$fileSet->setDir($schemaFolder);
$fileSet->setIncludes($schemas);
$SQLTask->addSchemaFileset($fileSet);

// This affects the source name I think, not the output name
$mapper = $SQLTask->createMapper();
$mapper->setType('identity');

// This generates a file of the same name as the schema...
$SQLTask->setOutputDirectory(new PhingFile($outputFolder));
$SQLTask->main();

// ...so let's rename it
rename(
	$outputFolder . DIRECTORY_SEPARATOR . $schemas,
	$outputFolder . DIRECTORY_SEPARATOR . 'schema.sql'
);