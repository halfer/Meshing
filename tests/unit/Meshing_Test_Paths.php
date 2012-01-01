<?php

/**
 * Overrides the standard generated file locations, for testing purposes
 *
 * @author jon
 */
class Meshing_Test_Paths extends Meshing_Paths
{
	protected $hashProvider;

	/**
	 * Returns the test model config folder
	 * 
	 * Renamed from 'system' as that name implies it is only for schemas that do not
	 * go through the fixup process. In our test systems, we use this to test both
	 * fixed and unmodified schemas.
	 * 
	 * @return string
	 */
	public function getPathDbConfig()
	{
		return $this->getGeneratedPath('/database/config');		
	}

	public function getTestLogPath()
	{
		return $this->getPathSystemTests() . '/database/log';
	}

	protected function getGeneratedPath($path)
	{
		return '/tests' . $path;
	}

	/**
	 * Gets the hash provider for test purposes
	 * 
	 * @param PropelPDO $con
	 * @return Meshing_Hash_Strategy_Basic
	 */
	public function getHashProvider(PropelPDO $con = null)
	{
		return $this->hashProvider ? $this->hashProvider : parent::getHashProvider($con);
	}

	/**
	 * Useful to set an alternative hash provider for testing
	 * 
	 * @todo Maybe use an interface rather than hardwiring to Meshing_Hash_Strategy_Basic?
	 * 
	 * @param Meshing_Hash_Strategy_Basic $hashProvider 
	 */
	public function setHashProvider(Meshing_Hash_Strategy_Basic $hashProvider)
	{
		$this->hashProvider = $hashProvider;
	}

	/**
	 * Share node connections across all schemas
	 */
	public function getPathConnsNodes($schema)
	{
		return $this->getGeneratedPath('/database/connections');
	}
}
