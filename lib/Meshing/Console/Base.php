<?php

/**
 * Standard methods for console classes
 */
class Meshing_Console_Base
{
	protected $argv;
	protected $opts;

	public function __construct($argv = array())
	{
		$this->argv = $argv;
	}

	public function parseOpts()
	{
		$this->opts = new Zend_Console_Getopt($this->getOpts(), $this->argv);
		$this->opts->parse();		
	}

	/* Handy func to help draw a table */
	protected function ruleOff($length)
	{
		echo str_repeat('-', $length) . "\n";		
	}

	/**
	 * Returns the config for the commonly-used quiet option
	 */
	protected function optQuiet()
	{
		return array('quiet|q' => 'Suppress console output');
	}

	/**
	 * Determines whether the command should be shown in standard help
	 * 
	 * @return boolean
	 */
	public function isHiddenCommand()
	{
		return false;
	}
}
