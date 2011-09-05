<?php

/**
 * Standard methods for console classes
 */
class P2P_Console_Base
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
}
