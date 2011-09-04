<?php

// System initialisation
$projectPath = realpath(
	dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '..'
);
require_once $projectPath . '/lib/P2P/Utils.php';
P2P_Utils::initialise();

// Pop off the script name, grab the command, pop again
array_shift($argv);
$command = array_key_exists(0, $argv) ? $argv[0] : null;
array_shift($argv);

if ($command)
{
	$filter = new Zend_Filter_Word_UnderscoreToCamelCase();

	// Create an implementor class using a camel-cased copy of the command
	$commandParts = explode(':', $command);
	foreach ($commandParts as $i => $part)
	{
		$commandParts[$i] = $filter->filter($part);
	}
	$className = 'P2P_Console_' . implode('_', $commandParts);
}
else
{
	$className = 'P2P_Console_Help';
}

// Run the implementation
try
{
	$console = new $className($argv);
	$console->preRunCheck();
	$ok = $console->run();
}
catch (Zend_Console_Getopt_Exception $e)
{
	echo $e->getMessage() . "\n";
	exit(1);
}
