<?php

// Set up project
$projectRoot = realpath(dirname(__FILE__) . '/../../..');
require_once $projectRoot . '/lib/Meshing/Paths.php';
require_once $projectRoot . '/tests/unit/Meshing_Test_Paths.php';
require_once $projectRoot . '/lib/Meshing/Utils.php';
Meshing_Utils::reinitialise(new Meshing_Test_Paths());

// Init simpletest
require_once 'simpletest/autorun.php';

/**
 * Tests the signing/encryption classes
 *
 * @author jon
 */
class EncryptionTest extends UnitTestCase
{
	/* @var $encrypter Meshing_Encryption_OpenSSL */
	protected $encrypter;

	public function __construct($label = false)
	{
		parent::__construct($label);

		$this->encrypter = Meshing_Encryption_Factory::getEncrypter(
			Meshing_Encryption_Factory::TYPE_OPENSSL
		);
	}

	/**
	 * Gets the encrypter we created in the constructor
	 * 
	 * Included mainly so we can have auto-complete in the IDE :)
	 * 
	 * @return Meshing_Encryption_OpenSSL
	 */
	protected function getEncrypter()
	{
		return $this->encrypter;
	}

	public function testSslEncryption()
	{
		$publicKey = $privateKey = null;
		$this->getEncrypter()->createKeyPair($publicKey, $privateKey);

		// Check that the string keys have ascii armour
		$this->assertTrue(
			false !== strpos($publicKey, 'BEGIN PUBLIC KEY'),
			'Check the public key contains ascii armour'
		);
		$this->assertTrue(
			false !== strpos($privateKey, 'BEGIN PRIVATE KEY'),
			'Check the private key contains ascii armour'
		);

		// Check encryption
		$testData = 'This is a string to sign or encrypt';
		$cipherText = $this->getEncrypter()->encrypt($testData, $publicKey);
		$this->assertNotEqual(
			$testData,
			$cipherText,
			'Checking ciphertext is different to plaintext when encrypting'
		);

		// Can we decrypt?
		$originalTestData = $this->getEncrypter()->decrypt($cipherText, $privateKey);
		$this->assertEqual(
			$originalTestData,
			$testData,
			'Checking decrypted ciphertext equals original message'
		);

		// Add in public and private keys, so we no longer need to specify them
		$this->getEncrypter()->setPublicKey($publicKey);
		$this->getEncrypter()->setPrivateKey($privateKey);
	}

	/**
	 * Tests sign/verify routines
	 */
	public function testSslSigning()
	{
		$testData = 'This is some text to sign or verify :)';
		$sig = $this->getEncrypter()->sign($testData);
		$this->assertNotNull($sig, 'Check that the signature contains something');

		$ok = $this->getEncrypter()->verify($testData, $sig);
		$this->assertTrue($ok, 'Check that signature verification works');
	}
}
