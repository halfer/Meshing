<?php

/**
 * Hashing provider that includes the previous version's hash
 * 
 * This is a "branching hash" i.e. the result differs if the history is different.
 * 
 * Locking: this hashing strategy requires a table lock between getting a hash and saving it.
 * A race condition otherwise might exist where a save from another process inserts another row
 * at the same time, which would invalidate the previous version's hash added to the hashing
 * list. Since the table is locked anyway to protect the correctness of the MAX() function, we
 * should be OK.
 *
 * @author jon
 */
class Meshing_Hash_Strategy_WithVersion extends Meshing_Hash_Strategy_Base
{
	protected function preHash(MeshingBaseObject $object, array $values)
	{
		// Get previous hash to add into the current hashing process
		$values[] = $object->getHash($this->con);

		return $values;
	}

}
