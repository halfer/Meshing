<?php

/**
 * Description of P2PUtils
 *
 * @author jon
 */
class Meshing_Utils
{
	const SYSTEM_CONNECTION = 'p2p';
	
	public static function getProjectRoot()
	{
		return realpath(
			dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'
		);
	}

	public static function initialise()
	{
		$projectRoot = self::getProjectRoot();

		// Hardwired, as need this to look up paths to set up autoloader ;)
		require_once $projectRoot . '/lib/Meshing/Paths.php';

		// Set up model & class search paths
		set_include_path(
			$projectRoot . Meshing_Paths::PATH_ZEND . PATH_SEPARATOR .
			$projectRoot . Meshing_Paths::PATH_PROPEL_GENERATOR . PATH_SEPARATOR .
			$projectRoot . Meshing_Paths::PATH_PHING . PATH_SEPARATOR .
			$projectRoot . Meshing_Paths::PATH_MESHING . PATH_SEPARATOR .
			$projectRoot . Meshing_Paths::PATH_SIMPLETEST . PATH_SEPARATOR .
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
	 * 
	 * @todo Only offers system database connectivity at the moment. What would be the best way
	 * to load the connection(s) and class mapping(s) required?
	 */
	public static function initialiseDb()
	{
		$projectRoot = self::getProjectRoot();
		
		// Include system models
		set_include_path(
			$projectRoot . Meshing_Paths::PATH_MODELS_SYSTEM . PATH_SEPARATOR .
			get_include_path()
		);

		require_once $projectRoot . Meshing_Paths::INC_PROPEL_RUNTIME;
		Propel::init($projectRoot . Meshing_Paths::PATH_CONNS_SYSTEM . '/database-conf.php');
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
			$path = $projectRoot . Meshing_Paths::PATH_CONNS_NODES . '/' .
				$schemaName . '/classmap-database-conf.php';
			$map = include($path);
			$loader->addClassPaths($map);
		}
		
		// Propel needs to autoload our custom base classes too
		$loader->addClassPath(
			'MeshingBaseObject',
			$projectRoot . Meshing_Paths::PATH_CUSTOM_BASES . '/MeshingBaseObject.php'
		);
	}
}
