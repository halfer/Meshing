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
	$className = P2P_Console_Utils::getCommandClass($command);
	if ($className === false)
	{
		echo "Unrecognised command.\n";
		exit(1);
	}
}
else
{
	$className = 'P2P_Console_Command_Help';
}

// Run the implementation
try
{
	$console = new $className($argv);
	$console->parseOpts();
	$console->preRunCheck();
	$ok = $console->run();
}
catch (Zend_Console_Getopt_Exception $e)
{
	echo $e->getMessage() . "\n";
	exit(1);
}
