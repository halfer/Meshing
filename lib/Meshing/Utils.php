<?php

/**
 * Utility class for system initialisation and configuration
 *
 * @author jon
 */
class Meshing_Utils
{
	const SYSTEM_CONNECTION = 'p2p';

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
	public static function initialiseDb()
	{
		$projectRoot = self::getProjectRoot();
		
		// Include system models
		set_include_path(
			$projectRoot . self::getPaths()->getPathModelsSystem() . PATH_SEPARATOR .
			get_include_path()
		);

		require_once $projectRoot . self::getPaths()->getFilePropelRuntime();
		Propel::init($projectRoot . self::getPaths()->getPathConnsSystem() . '/database-conf.php');
	}

	/**
	 * Sets up autoload paths for the named schema(s)
	 * 
	 * @param mixed $schemas An array of schema names, or a string schema name
	 */
	public static function initialiseNodeDbs($schemaNames)
	{
		$loader = PropelAutoloader::getInstance();
		
		if (!is_array($schemaNames))
		{
			$schemaNames = array($schemaNames);
		}

		$projectRoot = self::getProjectRoot();
		foreach ($schemaNames as $schemaName)
		{
			$path = $projectRoot . self::getPaths()->getPathConnsNodes() . '/' .
				$schemaName . '/classmap-database-conf.php';
			$map = include($path);
			$loader->addClassPaths($map);
		}
		
		// Propel needs to autoload our custom base classes too
		$loader->addClassPath(
			'MeshingBaseObject',
			$projectRoot . self::getPaths()->getPathCustomBases() . '/MeshingBaseObject.php'
		);
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
