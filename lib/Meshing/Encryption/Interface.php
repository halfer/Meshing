<?php

/**
 * Provides a basic set of methods that encryption systems must support
 *
 * @author jon
 */
interface Meshing_Encryption_Interface
{
	// @todo All these methods are just requirements guesses at the moment!

	// Create a key pair for the caller to store (in a db or a file)
	public function createKeyPair(&$publicKey, &$privateKey);

	// We sign an outgoing message with our local private key,
	// and we verify an incoming message with the remote node's public key
	public function sign($data, $privateKey = null);
	public function verify($data, $publicKey = null);

	// If we're using (optional) encryption then:
	// we encrypt an outgoing message with the remote's public key
	// and we decrypt an incoming message with our local private key
	public function encrypt($data, $publicKey = null);
	public function decrypt($data, $privateKey = null);

	// Set remote public and local private keys for the above methods to use
	public function setPublicKey($publicKey);
	public function setPrivateKey($privateKey);
}
