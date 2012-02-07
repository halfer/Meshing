<?php

/**
 * Utility class for system initialisation and configuration
 *
 * @author jon
 */
class Meshing_Utils
{
	const SYSTEM_CONNECTION = 'p2p';
	const CONN_SYSTEM_TEST = 'test_system';
	const CONN_NODE_TEST_1 = 'test_node_1';
	const CONN_NODE_TEST_2 = 'test_node_2';

	protected static $paths;
	protected static $oldIncludes;
	protected static $isMeshingInitialised = false;
	
	public static function getProjectRoot()
	{
		return realpath(
			dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'
		);
	}

	public static function initialise(Meshing_Paths $paths)
	{
		// Ignore repeated calls
		if (self::$isMeshingInitialised)
		{
			return;
		}
		self::$isMeshingInitialised = true;

		// Store static copy of paths config
		self::$paths = $paths;

		$projectRoot = self::getProjectRoot();

		// Set up model & class search paths
		self::$oldIncludes = set_include_path(
			$projectRoot . self::getPaths()->getPathZend() . PATH_SEPARATOR .
			$projectRoot . self::getPaths()->getPathPropelGenerator() . PATH_SEPARATOR .
			$projectRoot . self::getPaths()->getPathPhing() . PATH_SEPARATOR .
			$projectRoot . self::getPaths()->getPathMeshing() . PATH_SEPARATOR .
			$projectRoot . self::getPaths()->getPathSimpleTest() . PATH_SEPARATOR .
			get_include_path()
		);
		
		// Set up the Zend autoloader
		require_once 'Zend/Loader/Autoloader.php';
		$loader = Zend_Loader_Autoloader::getInstance();

		// Autoload our own classes
		$loader->registerNamespace('Meshing_');
	}

	/**
	 * Initialise the database (we don't always want this, so it's offered separately)
	 */
	public static function initialiseDb($testMode = false)
	{
		$projectRoot = self::getProjectRoot();
		
		// Include system models
		set_include_path(
			$projectRoot . self::getPaths()->getPathModelsSystem() . PATH_SEPARATOR .
			get_include_path()
		);

		require_once $projectRoot . self::getPaths()->getFilePropelRuntime();
		Propel::init($projectRoot . self::getPaths()->getPathConnsSystem() . '/database-conf.php');

		// If we're in test mode, autoload the non-test system models
		if ($testMode)
		{
			$path = $projectRoot . self::getPaths()->getPathConnsSystem(false) .
				'/classmap-database-conf.php';
			$map = include($path);
			$loader = PropelAutoloader::getInstance();
			$loader->addClassPaths($map);
		}

		// Not normally needed, but the tests use this connection approach even for node schemas
		self::autoloadMeshingClasses($testMode);
	}

	/**
	 * Sets up autoload paths for the named schema(s)
	 * 
	 * @param mixed $schemas An array of schema names, or a string schema name
	 */
	public static function initialiseNodeDbs($schemaNames, $testMode = false)
	{
		$loader = PropelAutoloader::getInstance();
		
		if (!is_array($schemaNames))
		{
			$schemaNames = array($schemaNames);
		}

		// Add include path for node models (all includes are relative to this)
		$projectRoot = self::getProjectRoot();
		set_include_path(
			$projectRoot . self::getPaths()->getPathModelsNodes() . PATH_SEPARATOR .
			get_include_path()
		);

		foreach ($schemaNames as $schemaName)
		{
			$path = $projectRoot . self::getPaths()->getPathConnsNodes($schemaName) . '/' .
				'/classmap-database-conf.php';
			$map = include($path);
			$loader->addClassPaths($map);
		}

		self::autoloadMeshingClasses($testMode);
	}

	protected static function autoloadMeshingClasses($testMode = false)
	{
		// Propel needs to autoload our custom base classes too
		$projectRoot = self::getProjectRoot();
		$loader = PropelAutoloader::getInstance();
		$path = $projectRoot . self::getPaths()->getPathCustomBases();
		$loader->addClassPath('MeshingBaseObject', $path . '/MeshingBaseObject.php');
		$loader->addClassPath('MeshingBasePeer', $path . '/MeshingBasePeer.php');

		// Optionally add in test classes
		if ($testMode)
		{
			$loader->addClassPaths(
				array(
					'TestMeshingBaseObject'		=> $path . '/TestMeshingBaseObject.php',
					'TestMeshingBaseObject2'	=> $path . '/TestMeshingBaseObject2.php',
				)
			);
		}
	}

	/**
	 * Gets path config class
	 * 
	 * @return Meshing_Paths
	 */
	public static function getPaths()
	{
		return self::$paths;
	}

	/**
	 * Useful when testing and wishing to reset the paths class
	 * 
	 * @param Meshing_Paths $paths 
	 */
	public static function reinitialise(Meshing_Paths $paths)
	{
		if (self::$isMeshingInitialised)
		{
			self::$isMeshingInitialised = false;
			set_include_path(self::$oldIncludes);
			self::$oldIncludes = null;
		}

		self::initialise($paths);
	}
}
