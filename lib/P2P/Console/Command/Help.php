<?php

/**
 * Description of Help
 *
 * @author jon
 */
class P2P_Console_Command_Help implements P2P_Console_Interface
{
	private $argv;

	public function __construct($argv = array())
	{
		$this->argv = $argv;
	}

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

	public function parseOpts()
	{
	}

	public function preRunCheck()
	{
	}

	public function run()
	{
		// Reads the commands dynamically from the file system
		$commands = P2P_Console_Utils::getCommands();

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
