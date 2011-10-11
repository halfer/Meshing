<?php

/**
 * Location of various things relative to project root
 *
 * @author jon
 */
class Meshing_Paths
{
	public function getPathZend()
	{
		return $this->getLibraryPath('/vendor/zend-1.11');
	}

	public function getPathPropelGenerator()
	{
		return $this->getLibraryPath('/vendor/propel-1.6/generator/lib');
	}

	public function getPathPhing()
	{
		return $this->getLibraryPath('/vendor/phing-2.4/classes');
	}

	public function getPathSimpleTest()
	{
		return $this->getLibraryPath('/vendor');
	}

	public function getFilePropelRuntime()
	{
		return $this->getLibraryPath('/vendor/propel-1.6/runtime/lib/Propel.php');
	}

	public function getPathMeshing()
	{
		return $this->getLibraryPath('/lib');
	}

	public function getPathMeshingCommands()
	{
		return $this->getLibraryPath('/lib/Meshing/Console/Command');
	}

	public function getPathModelsSystem()
	{
		return $this->getGeneratedPath('/database/models');
	}

	public function getPathModelsNodes()
	{
		return $this->getGeneratedPath('/database/models');		
	}

	public function getPathSchemasNodes()
	{
		return $this->getGeneratedPath('/database/schemas');
	}

	public function getPathSqlSystem()
	{
		return $this->getGeneratedPath('/database/sql/system');
	}

	public function getPathSqlNodes()
	{
		return $this->getGeneratedPath('/database/sql');
	}

	public function getPathConnsSystem()
	{
		return $this->getGeneratedPath('/database/connections');
	}

	public function getPathConnsNodes()
	{
		return $this->getGeneratedPath('/database/connections');
	}

	public function getPathDbConfig()
	{
		return $this->getGeneratedPath('/database/system');
	}

	public function getPathSystemFixtures()
	{
		return $this->getGeneratedPath('/database/system');
	}

	public function getPathSystemSnippets()
	{
		return $this->getGeneratedPath('/database/system/snippets');
	}

	public function getPathSystemTests()
	{
		return $this->getGeneratedPath('/tests');
	}

	public function getPathCustomBases()
	{
		return $this->getGeneratedPath('/database/system/models/customisations');
	}

	/**
	 * Permits child classes to modify all library locations
	 * 
	 * @param string $path
	 * @return string
	 */
	protected function getLibraryPath($path)
	{
		return $path;
	}

	/**
	 * Permits child classes to modify all generated file locations
	 * 
	 * @param string $path
	 * @return string
	 */
	protected function getGeneratedPath($path)
	{
		return $path;
	}
}
