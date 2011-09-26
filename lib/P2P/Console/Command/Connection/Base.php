<?php

/**
 * Description of Base
 *
 * @author jon
 */
class Meshing_Console_Command_Connection_Base extends Meshing_Console_Base
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
		
		Meshing_Console_Utils::runCommand('Meshing_Console_Command_Connection_Regen', $opts);
	}
}
