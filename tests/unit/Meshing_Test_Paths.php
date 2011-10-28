<?php

/**
 * Overrides the standard generated file locations, for testing purposes
 *
 * @author jon
 */
class Meshing_Test_Paths extends Meshing_Paths
{
	protected function getGeneratedPath($path)
	{
		return '/tests' . $path;
	}
}
