<?php

/**
 * Description of Help
 *
 * @author jon
 */
class Meshing_Console_Command_Help extends Meshing_Console_Base implements Meshing_Console_Interface
{
	public function getDescription()
	{
		return 'Provides some help for console commands';
	}

	/**
	 * @todo Permit detailed help to be requested for one command only
	 */
	public function getOpts()
	{
		return array();
	}

	public function preRunCheck()
	{
	}

	/**
	 * Provides either a command listing or specific command help
	 * 
	 * @todo Expand internal help format to specify whether a boolean switch is mandatory
	 */
	public function run()
	{
		// Reads the commands dynamically from the file system
		$commands = Meshing_Console_Utils::getCommands(true);

		if (array_key_exists(0, $this->argv))
		{
			$command = $this->argv[0];
			if ($className = array_search($command, $commands))
			{
				$this->commandHelp($className);
			}
			else
			{
				throw new Zend_Console_Getopt_Exception(
					'Command not recognised (use no arguments to see list)'
				);
			}
		}
		else
		{
			$this->generalHelp();
		}
	}

	protected function commandHelp($className)
	{
		$class = new $className;
		$opts = $class->getOpts();
		echo "Syntax: ./meshing $command ";
		if ($opts)
		{
			$syntax = array();

			// The key is in the form --name|n=s (mandatory param) or --name|n-s (optional)
			foreach ($opts as $key => $help)
			{
				list($names, $optional, $type) = $this->splitDefinition($key);
				$longForm = $names[0];
				$syntax[$longForm] = $help;

				// Add a --flag=<type> line
				echo $optional ? '[' : '';
				echo '--' . $longForm;
				echo $type ? '=' . $type : '';
				echo $optional ? ']' : '';
				echo ' ';
			}
			echo "\nwhere:\n";

			// Print detailed help, line by line
			foreach ($syntax as $switch => $help)
			{
				echo "  --" . $switch . str_repeat(' ', 16 - strlen($switch)) . $help . "\n";
			}
		}
		else
		{
			echo "\n";
		}
	}

	/**
	 * Splits a command definition (e.g. "--name|n=s") into name/optional/type parts
	 * 
	 * Strategy:
	 * 
	 * If the parameter requires a value, it will end with "=x" (where x is i/s)
	 * If the parameter may take a value, it will end with "-x" (ditto)
	 * If the ending has none of these, then it doesn't accept a value
	 * Note that the name part may contain alternates e.g. "adaptor|adapter|a"
	 * Some commands may only have a long form i.e. no bar symbol
	 * Some commands may contain a dash e.g. "local-from"
	 * Hence we may NOT have a command called "add-s" with no values (not that we would...)
	 * 
	 * @param string $definition 
	 */
	protected function splitDefinition($definition)
	{
		// Default values
		$isOptional = $type = null;

		// Get optional/mandatory indicator
		$optionalChar = substr($definition, -2, 1);
		if (($optionalChar == '-') || ($optionalChar == '='))
		{
			$isOptional = ($optionalChar == '-');
			
			// Get the type of the command
			$type = $this->convertType(substr($definition, -1, 1));
			
			// Trim the final characters off
			$definition = substr($definition, 0, strlen($definition) - 2);
		}

		// Now we just have the pipes to deal with
		$names = explode('|', $definition);

		return array($names, $isOptional, $type);
	}

	protected function convertType($typeCode)
	{
		switch ($typeCode)
		{
			case 'i': return 'integer';
			case 's': return 'string';
		}

		return null;
	}

	/**
	 * Prints out the general help message
	 */
	protected function generalHelp()
	{
		echo <<<GENERAL_HELP
Meshing is Free software designed to share structured databases over the
internet in a decentralised way. Consult http://blog.jondh.me.uk/meshing
for more details.

Type `meshing commands` to see a command list.

GENERAL_HELP;
		// ^ A blank line is required to add a CR at the end
	}
}
