<?php

$projectPath = realpath(
	dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'
);
set_include_path(
	get_include_path() . PATH_SEPARATOR .
	$projectPath . '/lib/propel-1.6/generator/lib' . PATH_SEPARATOR .
	$projectPath . '/lib/phing-2.4/classes'
);

require_once 'phing/Phing.php';
require_once 'phing/Project.php';
require_once 'phing/types/FileSet.php';
require_once 'phing/types/Mapper.php';
require_once 'phing/system/io/PhingFile.php';
require_once 'phing/system/util/Properties.php';
require_once 'task/PropelSQLExec.php';
require_once 'config/GeneratorConfig.php';

// Set db type, schema and output folder here
$targetDb = 'pgsql';
$sqlFolder = $projectPath . '/database/sql/system';
$mapFile = $projectPath . '/database/system/sqldb.map';
$files = "schema.sql";
$propertiesFile = $projectPath . '/lib/propel-1.6/generator/default.properties';

// Set custom props here
$customProps = array(
	'propel.database' => $targetDb,                // Required for ${} replacements
);

echo "Target db: \t\t$targetDb\n";
echo "File(s): \t\t$files\n";
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

$SQLTask = new PropelSQLExec();
$SQLTask->setProject($project);
$SQLTask->setSrcDir(new PhingFile($sqlFolder));

$SQLTask->setOnerror('continue');

// The map file specifies what sql files should use which connection
$SQLTask->setSqlDbMap(new PhingFile($mapFile));

$SQLTask->setUrl('pgsql:host=localhost dbname=p2p2 user=jon password=');
$SQLTask->setUserid('jon');
$SQLTask->setPassword('');
$SQLTask->setAutoCommit(true);

// OK, run the task...
$SQLTask->main();
