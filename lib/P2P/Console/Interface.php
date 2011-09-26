<?php

/**
 *
 * @author jon
 */
interface Meshing_Console_Interface {
	public function getDescription();
	public function getOpts();
	public function parseOpts();
	public function preRunCheck();
	public function run();
}
