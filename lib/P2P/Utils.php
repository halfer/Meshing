<?php

/**
 * Description of P2PUtils
 *
 * @author jon
 */
class P2P_Utils
{
	public static function getProjectRoot()
	{
		return realpath(
			dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'
		);
	}

	public static function initialise()
	{
		$projectRoot = self::getProjectRoot();

		// Set up model & class search paths
		set_include_path(
			$projectRoot . '/vendor/zend-1.11' . PATH_SEPARATOR .
			$projectRoot . '/vendor/propel-1.6/generator/lib' . PATH_SEPARATOR .
			$projectRoot . '/vendor/phing-2.4/classes' . PATH_SEPARATOR .
			$projectRoot . '/lib' . PATH_SEPARATOR .
			get_include_path()
		);
		
		// Set up the Zend autoloader
		require_once 'Zend/Loader/Autoloader.php';
		$loader = Zend_Loader_Autoloader::getInstance();

		// Autoload our own classes
		$loader->registerNamespace('P2P_');
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
			$projectRoot . '/database/models' . PATH_SEPARATOR .
			get_include_path()
		);

		require_once $projectRoot . '/vendor/propel-1.6/runtime/lib/Propel.php';
		Propel::init($projectRoot . '/database/connections/database-conf.php');
	}
}
