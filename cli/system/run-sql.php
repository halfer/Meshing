<?php

$projectPath = realpath(
	dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'
);
require_once $projectPath . '/lib/P2P/Utils.php';
P2P_Utils::initialise();

$sqlDir = $projectPath . '/database/sql/system';
$mapFile = $projectPath . '/database/system/sqldb.map';
$extraPropsFile = $projectPath . '/database/system/build.properties';

$task = new P2P_Propel_SqlRunner();

$task->setSqlDir($sqlDir);
$task->setMapFile($mapFile);
$task->addPropertiesFile($extraPropsFile);

$task->run();
