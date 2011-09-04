<?php

/**
 * Description of Help
 *
 * @author jon
 */
class P2P_Console_Help implements P2P_Console_Interface
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

	public function preRunCheck()
	{
	}

	public function run()
	{
		// @todo The camel-cased versions can be derived
		$commands = array(
			'system:build' => 'System_Build',
			'help' => 'Help',
		);

		// Print a hint for all commands
		foreach ($commands as $command => $camelCased)
		{
			$classname = 'P2P_Console_' . $camelCased;
			$class = new $classname();
			$desc = $class->getDescription();
			echo $command . str_repeat(' ', 16 - strlen($command)) . $desc . "\n";
		}
	}
}
