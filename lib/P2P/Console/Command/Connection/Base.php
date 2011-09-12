<?php

/**
 * Description of Base
 *
 * @author jon
 */
class P2P_Console_Command_Connection_Base extends P2P_Console_Base
{
	/**
	 * Converts the known connections to XML and converts to a Propel-friendly conf file
	 * 
	 * @param boolean $system
	 * @param boolean $nonSystem
	 * @param boolean $quiet 
	 */
	protected function buildConnections($system, $nonSystem, $quiet)
	{
		$opts = array();
		if ($system)
		{
			$opts[] = '--system';
		}
		if ($nonSystem)
		{
			$opts[] = '--non-system';
		}
		if ($quiet)
		{
			$opts[] = '--quiet';
		}
		
		P2P_Console_Utils::runCommand('P2P_Console_Command_Connection_Regen', $opts);
	}
}
