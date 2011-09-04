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
		// @todo The camel-cased versions can be derived from each command
		// @todo Better yet, these can be read from the filing system!
		$commands = array(
			'system:build'		=> 'System_Build',
			'system:config'		=> 'System_Config',
			'help'				=> 'Help',
			'connection:add'	=> 'Connection_Add',
			'connection:list'	=> 'Connection_List',
			'connection:config'	=> 'Connection_Config',
			'connection:delete'	=> 'Connection_Delete',
			'node:add'			=> 'Node_Add',
			'node:list'			=> 'Node_List',
			'node:config'		=> 'Node_Config',
			'node:delete'		=> 'Node_Delete',
			'trust:add'			=> 'Trust_Add',
			'trust:delete'		=> 'Trust_Delete',
		);

		// Print a hint for all commands
		foreach ($commands as $command => $camelCased)
		{
			$classname = 'P2P_Console_' . $camelCased;
			$class = new $classname();
			$desc = $class->getDescription();

			$count = 20 - strlen($command);
			$count = $count > 0 ? $count : 1;
			echo $command . str_repeat(' ', $count) . $desc . "\n";
		}
	}
}
