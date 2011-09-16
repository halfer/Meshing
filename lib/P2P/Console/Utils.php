<?php

class P2P_Console_Utils
{
	public static function getCommands()
	{
		return self::readCommands();
	}

	public static function getCommandClass($command)
	{
		$commands = self::readCommands();
		
		return array_search($command, $commands);
	}

	protected static function readCommands()
	{
		static $commands = array();
		
		if (!$commands)
		{
			$projectRoot = P2P_Utils::getProjectRoot();
			$consoleRoot = $projectRoot . '/lib/P2P/Console/Command';

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
				$className = 'P2P_Console_Command_' . str_replace(DIRECTORY_SEPARATOR, '_', $item);
				$item = strtolower(
					str_replace(DIRECTORY_SEPARATOR, ':', $item)
				);
				
				// Classes without this method are not commands at all
				$realCommand = method_exists($className, 'getDescription');

				// If description is offered, empty means hidden
				if ($realCommand)
				{
					$cmdClass = new $className;
					if ($cmdClass->getDescription() != '')
					{
						$commands[$className] = $item;
					}
				}
				$regex->next();
			}
		}
		
		// Preserve the keys when sorting
		asort($commands);
		
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