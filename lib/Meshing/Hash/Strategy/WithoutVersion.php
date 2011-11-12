<?php

/**
 * Simple hashing strategy
 * 
 * Locking: this strategy does not in itself require a table lock between getting a hash
 * and saving it.
 *
 * @author jon
 */
class Meshing_Hash_Strategy_WithoutVersion extends Meshing_Hash_Strategy_Base
{
}
