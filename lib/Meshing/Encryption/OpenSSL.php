<?php

/**
 * The preferred PKE mechanism for signing messages in Meshing
 *
 * @author jon
 */
class Meshing_Encryption_OpenSSL implements Meshing_Encryption_Interface
{
	protected $privateKeyText;
	protected $publicKeyText;

	/**
	 * Create a random key pair for the caller to store (in a db or a file)
	 * 
	 * Note this hasn't been verified for correctness of usage, so if you need it
	 * in high security applications, check it yourself, or get it vetted by an
	 * expert!
	 *
	 * @param string $publicKeyText Passed by reference
	 * @param string $privateKeyText Passed by reference
	 */
	public function createKeyPair(&$publicKeyText, &$privateKeyText)
	{
		// Generate and return the private key
		$privHandle = openssl_pkey_new(
			array(
				'private_key_bits' => 1024,
				'private_key_type' => OPENSSL_KEYTYPE_RSA,
			)
		);
		openssl_pkey_export($privHandle, $privateKeyText);

		// Get the public key as well
		$pubHandle = openssl_pkey_get_details($privHandle);
		$publicKeyText = $pubHandle['key'];
	}

	public function encrypt($data, $publicKeyText = null)
	{
		// Get the public key if necessary
		if (is_null($publicKeyText))
		{
			$publicKeyText = $this->publicKeyText;
		}

		$pubHandle = openssl_pkey_get_public($publicKeyText);
		$cipherText = null;
		$ok = openssl_public_encrypt($data, $cipherText, $pubHandle);
		openssl_free_key($pubHandle);

		return $cipherText;
	}

	public function decrypt($data, $privateKeyText = null)
	{
		if (is_null($privateKeyText))
		{
			$privateKeyText = $this->privateKeyText;
		}

		$privHandle = openssl_pkey_get_private($privateKeyText);
		$plainText = null;
		$ok = openssl_private_decrypt($data, $plainText, $privHandle);
		openssl_free_key($privHandle);

		return $plainText;
	}

	public function sign($data, $privateKeyText = null)
	{
		if (is_null($privateKeyText))
		{
			$privateKeyText = $this->privateKeyText;
		}

		$signature = null;
		$ok = openssl_sign($data, $signature, $privateKeyText);

		if (!$ok)
		{
			throw new Exception('Signing process failed');
		}

		return $signature;
	}

	public function verify($data, $signature, $publicKeyText = null)
	{
		if (is_null($publicKeyText))
		{
			$publicKeyText = $this->publicKeyText;
		}

		$result = openssl_verify($data, $signature, $publicKeyText);

		return (1 === $result);
	}

	public function setPublicKey($publicKeyText)
	{
		$this->publicKeyText = $publicKeyText;
	}

	public function setPrivateKey($privateKeyText)
	{
		$this->privateKeyText = $privateKeyText;
	}
}
