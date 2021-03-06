<?php

/**
 * Description of Add
 *
 * @author jon
 */
class Meshing_Console_Command_Trust_Add extends Meshing_Console_Base implements Meshing_Console_Interface
{
	protected $localFromNode;
	protected $localToNode;

	public function getDescription()
	{
		return 'Sets up trust between two specified nodes';
	}

	/**
	 * Set up the Zend Console options array
	 * 
	 * @todo When force|f was added, the local-from alias of 'f' needed to be changed. So for
	 * local-from and local-to, I've just used 'x' and 'y'. I will probably remove them
	 * totally later on, but at the time of writing removing the pipe upsets the help parser :(
	 * 
	 * @return type 
	 */
	public function getOpts()
	{
		return
			array(
				'local-from|x=s' => 'The name of the local node',
				'local-to|y=s' => 'The name of the local to node',
				'remote-to|r=s' => 'The internet address of the remote node',
				'trust-type|t=s' => 'The type of trust (one of: read, write_audit, write_delay, write_full; defaults to read)',
				'auth-types|a=s' => 'The types of authentication as a csv list (a full list would be "openssl,gpg,ip,none")',
				'force|f' => 'Overwrite if the (from,to) pair already exists',
			) +
			$this->optQuiet();
	}

	public function preRunCheck()
	{
		// Used to track bad combos e.g. local-to AND remote-to
		$hasToLocal = $hasToRemote = false;

		$localFromName = $this->opts->{'local-from'};
		if (!$localFromName)
		{
			throw new Zend_Console_Getopt_Exception('A local node must be specified (use --local-from)');
		}

		if ($localToName = $this->opts->{'local-to'})
		{
			$hasToLocal = true;
		}

		// @todo Not implemented yet
		if ($remoteToName = $this->opts->{'remote-to'})
		{
			throw new Zend_Console_Getopt_Exception('Remote nodes are not currently supported');
			//$hasToRemote = true;
		}

		// Check for bad combinations
		if ($localToName && $remoteToName)
		{
			throw new Zend_Console_Getopt_Exception('You cannot have a local-to AND a remote-to node');
		}
		if (!$localToName && !$remoteToName)
		{
			throw new Zend_Console_Getopt_Exception('You must have one \'to\' node (use --local-to or --remote-to)');
		}

		// Check that the local from actually exists
		Meshing_Utils::initialiseDb();
		$this->localFromNode = P2POwnNodeQuery::create()->findOneByName($localFromName);
		if (!$this->localFromNode)
		{
			throw new Zend_Console_Getopt_Exception('A local node of that (from) name is not registered');
		}

		if ($localToName)
		{
			$this->localToNode = P2POwnNodeQuery::create()->findOneByName($localToName);
			if (!$this->localToNode)
			{
				throw new Zend_Console_Getopt_Exception('A local node of that (to) name is not registered');
			}
		}

		// We cannot trust ourselves, so to speak ;-)
		if ($localFromName == $localToName)
		{
			throw new Zend_Console_Getopt_Exception('There is no point in setting a node to trust itself');
		}
	}

	public function run()
	{
		if ($this->localToNode)
		{
			$this->runLocal($this->localFromNode, $this->localToNode);
		}
		else
		{
			// @todo Sanity check on remote URL first :)
			$this->runRemote($this->localFromNode, '');
		}
	}

	/**
	 * Adds trust between the two local nodes i.e. FROM trusts TO
	 * 
	 * @param P2POwnNode $from
	 * @param P2POwnNode $to
	 */
	protected function runLocal(P2POwnNode $from, P2POwnNode $to)
	{
		// Look up the trust type, using default if necessary
		$typeName = $this->opts->{'trust-type'};
		$typeName = $typeName ? $typeName : MeshingTrustLocalPeer::TYPE_DEFAULT;
		$trustType = MeshingTrustTypeQuery::create()->findOneByName(strtolower($typeName));
		if (!$trustType)
		{
			throw new Meshing_Console_RunException(
				'The specified trust type is not found'
			);
		}

		// If a trust already exists, require force else an exception is thrown
		$trust = MeshingTrustLocalPeer::retrieveByPK($from->getId(), $to->getId());
		if ($trust)
		{
			if ($this->opts->force)
			{
				$trust->delete();
			}
			else
			{
				throw new Meshing_Console_RunException(
					'A trust relationship already exists between this node pair (use --force to overwrite)'
				);
			}
		}
		
		$trust = new MeshingTrustLocal();
		$trust->setFromOwnNode($from);
		$trust->setToOwnNode($to);
		$trust->setMeshingTrustType($trustType);
		$trust->save();

		if (!$this->opts->quiet)
		{
			echo "trust:add -> set up trust '{$typeName}' by node '{$from->getName()}' to '{$to->getName()}'.\n";
		}
	}

	/**
	 * Adds trust between the local node and the specified remote URI
	 * 
	 * @param P2POwnNode $from
	 * @param type $to 
	 */
	protected function runRemote(P2POwnNode $from, $to)
	{
	}
}