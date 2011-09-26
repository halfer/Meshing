<?php

// System initialisation
$projectPath = realpath(
	dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '..'
);
require_once $projectPath . '/lib/Meshing/Utils.php';
Meshing_Utils::initialise();

// Pop off the script name, grab the command, pop again
array_shift($argv);
$command = array_key_exists(0, $argv) ? $argv[0] : null;
array_shift($argv);

if ($command)
{
	$className = Meshing_Console_Utils::getCommandClass($command);
	if ($className === false)
	{
		echo "Unrecognised command.\n";
		exit(1);
	}
}
else
{
	$className = 'Meshing_Console_Command_Help';
}

// Run the implementation
try
{
	$ok = Meshing_Console_Utils::runCommand($className, $argv);
}
// This is for parsing/preparation exceptions
catch (Zend_Console_Getopt_Exception $e)
{
	echo $e->getMessage() . "\n";
	exit(1);
}
// This is for execution exceptions
catch (Meshing_Console_RunException $e)
{
	echo $e->getMessage() . "\n";
	exit(2);
}
