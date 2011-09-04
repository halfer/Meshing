<?php

/**
 * Standard methods for console classes
 */
class P2P_Console_Base
{
	private $argv;

	public function __construct($argv = array())
	{
		$this->argv = $argv;
	}
}
