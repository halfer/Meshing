<?php

return array(
	'MeshingTrustType' => array(
		array(
			'name' => MeshingTrustLocalPeer::TYPE_READ,
		),
		array(
			'name' => MeshingTrustLocalPeer::TYPE_WRITE_AUDIT,
		),
		array(
			'name' => MeshingTrustLocalPeer::TYPE_WRITE_DELAY,
		),
		array(
			'name' => MeshingTrustLocalPeer::TYPE_WRITE_FULL,
		),
	),
);