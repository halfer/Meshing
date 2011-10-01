<?php



/**
 * Skeleton subclass for performing query and update operations on the 'meshing_trust_local' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.system
 */
class MeshingTrustLocalPeer extends BaseMeshingTrustLocalPeer
{
	const DIRECTION_FORWARD = 'f';
	const DIRECTION_REVERSE = 'r';
	const DIRECTION_DEFAULT = self::DIRECTION_FORWARD;

	const TYPE_READ = 'read';
	const TYPE_WRITE_AUDIT = 'write_audit';
	const TYPE_WRITE_DELAY = 'write_delay';
	const TYPE_WRITE_FULL = 'write_full';
	const TYPE_DEFAULT = self::TYPE_READ;
}
