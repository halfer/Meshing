<?php

/**
 * Database utilities not specific to Propel building
 *
 * @author jon
 */
class Meshing_Database_Utils
{
	// Fixture column names with special meaning
	const COL_DECLARE_TOKEN = '_declare_token';		// Give a new mode row a name
	const COL_VERSION_TOKEN = '_version_token';		// Create a new version of this row
	const COL_FOREIGN_CLASS = '_foreign_class';		// Specify a foreign Propel relation...
	const COL_FOREIGN_TOKEN = '_foreign_token';		// ... and the object to set it to.

	// Set up cache for tokened rows
	protected $objects = array();

	/**
	 * Saves data in a versioned way, using a specific array format
	 * 
	 * @param array $versions
	 * @param *KnownNode $node
	 * @param PDO $con
	 */
	public function writeVersionableData(array $versions, $node, PDO $con = null)
	{
		// Check the node is a known node
		$nodeClass = get_class($node);
		$typeOk = false !== strpos($nodeClass, 'KnownNode', strlen($nodeClass) - strlen('KnownNode'));
		if (!$typeOk)
		{
			throw new Exception(
				"Cannot accept class of type '" . $nodeClass . "' as a KnownNode"
			);
		}

		/* @var $object TestVersionTestEvent */
		$ok = true;
		foreach ($versions as $versionNo => $versionData)
		{
			foreach ( $versionData as $class => $data )
			{
				// See if we're creating a new version...
				if (array_key_exists(self::COL_VERSION_TOKEN, $data))
				{
					$lookupToken = $data[self::COL_VERSION_TOKEN];
					$object = $this->objects[$lookupToken];
				}
				else
				// ... or a brand new row.
				{
					$object = new $class();
					$object->setCreatorNodeId($node->getPrimaryKey());
				}

				$token = null;
				foreach ($data as $column => $value)
				{
					switch ($column)
					{
						case self::COL_DECLARE_TOKEN:
							$token = $value;
						case self::COL_VERSION_TOKEN:
						case self::COL_FOREIGN_CLASS:
							continue 2; // Skip iteration of for, not switch
					}

					if ($column == self::COL_FOREIGN_TOKEN)
					{
						// Ensure the foreign class key exists
						if (!array_key_exists(self::COL_FOREIGN_CLASS, $data))
						{
							throw new Exception(
								'Cannot have a foreign token without a foreign class'
							);
						}

						// Pokes the appropriate class in as a foreign reference
						$method = 'set' . $data[self::COL_FOREIGN_CLASS];
						$foreignObj = $this->objects[$value];
						$object->$method($foreignObj);
					}
					else
					{
						// Set standard column
						$object->setByName($column, $value, BasePeer::TYPE_FIELDNAME);
					}
				}

				// Set metadata that should be handled outside the model layer
				$time = time();
				$object->setVersionMetadata(
					$timeEdited = $time, $timeReceived = null, $timeApplied = $time
				);

				// Save and store a reference
				$ok = $ok && $object->save($con);
				if ($token)
				{
					$this->objects[$token] = $object;
				}
			}
		}

		return $ok;
	}

	public function getCachedObject($token)
	{
		return $this->objects[$token];
	}
}
