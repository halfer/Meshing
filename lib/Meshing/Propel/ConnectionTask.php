<?php

/**
 * Abstract task used by SqlBuilder, ConfBuilder, SqlRunner
 *
 * @author jon
 */
abstract class Meshing_Propel_ConnectionTask extends Meshing_Propel_Task
{
	protected function setDatabaseCredentials($adaptor, $url, $user, $password)
	{
		$this->addProperty('propel.database', $adaptor);
		$this->addProperty('propel.database.url', $url);
		$this->addProperty('propel.database.user', $user);
		$this->addProperty('propel.database.password', $password);
	}

	/**
	 * Specify which connection on which to carry out the schema task
	 * 
	 * @param strings $connName Optional connection name (defaults to system connection)
	 */
	public function setPropelConnection($connName = Meshing_Utils::SYSTEM_CONNECTION)
	{
		// Grab the db details directly out of the Propel config file
		$xmlPath = Meshing_Utils::getProjectRoot() . Meshing_Utils::getPaths()->getFileRuntimeXml();
		$conf = simplexml_load_file($xmlPath);
		/* @var $conf SimpleXMLElement */
		$entry = $conf->xpath('/config/propel/datasources/datasource[@id="' . $connName . '"]');

		// If an element doesn't exist here, we've probably got the connection name wrong
		if (!array_key_exists(0, $entry))
		{
			throw new Exception("Connection name '$connName' not found");
		}

		$entry = $entry[0];
		$this->setDatabaseCredentials(
			(string) $entry->adapter,
			(string) $entry->connection->dsn,
			(string) $entry->connection->user,
			(string) $entry->connection->password
		);
	}
}