<?php

/**
 * Overrides the standard generated file locations, for testing purposes
 *
 * @author jon
 */
class Meshing_Test_Paths extends Meshing_Paths
{
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

	protected function getGeneratedPath($path)
	{
		return '/tests' . $path;
	}
}
