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
	 * @param boolean $quiet 
	 */
	protected function buildConnections($quiet)
	{
		$opts = array();
		if ($quiet)
		{
			$opts[] = '--quiet';
		}
		
		P2P_Console_Utils::runCommand('P2P_Console_Command_Connection_Regen', $opts);
	}
}
