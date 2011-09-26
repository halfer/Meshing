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
		$commands = Meshing_Console_Utils::getCommands();

		if (array_key_exists(0, $this->argv))
		{
			$command = $this->argv[0];
			$className = array_search($command, $commands);
			if ($className)
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
						$parts = explode('|', $key);
						$longForm = $parts[0];
						$optional = $type = false;
						$syntax[$longForm] = $help;
						if (array_key_exists(1, $parts))
						{
							$optional = substr($parts[1], 1, 1) == '-';
							$type = $this->convertType(
								substr($parts[1], 2, 1)
							);
							$type = $type ? '<' . $type . '>' : '';
						}
						else
						{
							$optional = true;
						}

						// Add a --flag=<type> line
						echo $optional ? '[' : '';
						echo '--' . $longForm;
						echo $type ? '=' . $type : '';
						echo ' ';
						echo $optional ? ']' : '';
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
			else
			{
				throw new Zend_Console_Getopt_Exception(
					'Command not recognised (use no arguments to see list)'
				);
			}
		}
		else
		{
			$this->listCommands($commands);
		}
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

	protected function listCommands($commands)
	{
		// Print a hint for all commands
		foreach ($commands as $className => $command)
		{
			$class = new $className();
			$desc = $class->getDescription();

			$count = 20 - strlen($command);
			$count = $count > 0 ? $count : 1;
			echo $command . str_repeat(' ', $count) . $desc . "\n";
		}
	}
}
