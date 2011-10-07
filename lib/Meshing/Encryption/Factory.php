<?php

/**
 * Factory class to create an encryption class (openssl or gpg)
 *
 * @author jon
 */
class Meshing_Encryption_Factory
{
	const TYPE_OPENSSL = 'OpenSSL';
	const TYPE_GPG = 'GPG';
	const TYPE_DEFAULT = self::TYPE_OPENSSL;

	public static function getEncrypter($type = self::TYPE_DEFAULT)
	{
		// @todo
	}
}
