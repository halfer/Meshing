<?php

/**
 * Used to set up a database test
 *
 * @author jon
 */
class Meshing_Test_DatabaseTestCase extends UnitTestCase
{
	protected function deleteFolderContents($folder, $purpose)
	{
		if (file_exists($folder))
		{
			// Preserve these, they are part of the folder structure
			$preserve = array('.ignore');
			
			// Delete contents of specified folder
			$directory = new RecursiveDirectoryIterator($folder);
			$iterator = new RecursiveIteratorIterator(
				$directory,
				RecursiveIteratorIterator::CHILD_FIRST
			);
			
			$success = true;
			foreach ($iterator as $path)
			{
				$name = $path->__toString();
				if (!in_array($name, $preserve))
				{
					$success = ($path->isDir() ? @rmdir($name) : @unlink($name)) && $success;
				}
			}

			if (!$success)
			{
				trigger_error(
					"Failed to delete contents of $purpose folder",
					E_USER_WARNING
				);
			}
		}
	}
}
