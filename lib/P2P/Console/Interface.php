<?php

/**
 *
 * @author jon
 */
interface P2P_Console_Interface {
	public function getOpts();
	public function preRunCheck();
	public function run();
}
