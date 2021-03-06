<?php

class Meshing_Console_Utils
{
	public static function getCommands($incHidden = false)
	{
		return self::readCommands($incHidden);
	}

	public static function getCommandClass($command)
	{
		$commands = self::readCommands(true);
		
		return array_search($command, $commands);
	}

	protected static function readCommands($incHidden = false)
	{
		static $commands = array();
		static $hidden = array();
		
		if (!$commands)
		{
			$projectRoot = Meshing_Utils::getProjectRoot();
			$consoleRoot = $projectRoot . Meshing_Utils::getPaths()->getPathMeshingCommands();

			$directory = new RecursiveDirectoryIterator($consoleRoot);
			$iterator = new RecursiveIteratorIterator($directory);
			$regex = new RegexIterator($iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);
			
			$regex->next();
			
			$i++;
			while ($regex->valid())
			{
				// For safety!
				if ( $i > 50 )
				{
					break;
				}

				// Get the full pathname of the class
				$item = $regex->current();
				$item = $item[0];
				
				// Strip out the full path bit, and generally tidy
				$item = str_replace($consoleRoot . DIRECTORY_SEPARATOR, '', $item);
				$item = str_replace('.php', '', $item);
				$className = 'Meshing_Console_Command_' . str_replace(DIRECTORY_SEPARATOR, '_', $item);
				$item = strtolower(
					str_replace(DIRECTORY_SEPARATOR, ':', $item)
				);
				
				// Classes without this method are not commands at all
				$realCommand = method_exists($className, 'getDescription');

				// We consult a special method to determine whether to show the command
				if ($realCommand)
				{
					$cmdClass = new $className;
					$commands[$className] = $item;
					if ($cmdClass->isHiddenCommand())
					{
						$hidden[] = $className;
					}
				}
				$regex->next();
			}

			// Preserve the keys when sorting
			asort($commands);
		}

		// Strip out hidden commands
		if (!$incHidden)
		{
			foreach ($hidden as $removeClass)
			{
				unset($commands[$removeClass]);
			}
		}
		
		return $commands;
	}

	public static function runCommand($className, $argv = array())
	{
		$console = new $className($argv);
		$console->parseOpts();
		$console->preRunCheck();

		return $console->run();		
	}
}