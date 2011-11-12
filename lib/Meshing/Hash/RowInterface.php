<?php

/**
 * Specifies method/visibility requirements for Propel row classes
 */
interface Meshing_Hash_RowInterface
{
	// Implementation of Propel methods is a given :)

	// Custom requirements
	public function countVersions();
	public function getSelectAllVersionsCriteria();
	public function getVersionablePeerName();
	public function getMapName();
	public function getVersionableMapName();
}
