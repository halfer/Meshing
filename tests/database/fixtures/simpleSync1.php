<?php

$data = array();

// We have to have an organiser (mandatory for events)
$data[] = array(
	'TestModelTestOrganiser' => array(
		'name' => 'Mr. Cat',
		 Meshing_Database_Utils::COL_DECLARE_TOKEN => 'organiser',
	),
);

// Let's have a few events
for ($part = 1; $part < 4; $part++)
{
	$data[] = array(
		'TestModelTestEvent' => array(
			'name' => "Oil drilling for household felines (part $part)",
			'description' => 'A practical guide on how to get away with it',
			'location' => 'The sofa',
			'nearest_city' => 'Birmingham',
			Meshing_Database_Utils::COL_FOREIGN_TOKEN => 'organiser',
			Meshing_Database_Utils::COL_FOREIGN_CLASS => 'TestModelTestOrganiser',
		),
	);
}

return $data;
