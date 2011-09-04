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
}
