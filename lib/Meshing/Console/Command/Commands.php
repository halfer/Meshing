<?php

/**
 * Description of Commands
 *
 * @author jon
 */
class Meshing_Console_Command_Commands extends Meshing_Console_Base implements Meshing_Console_Interface
{
	public function getDescription()
	{
	}

	public function getOpts()
	{
		return array(
			'hidden|h' => 'Include system commands that are normally hidden'
		);
	}

	public function preRunCheck()
	{
	}

	public function run()
	{
		$commands = Meshing_Console_Utils::getCommands($this->opts->hidden);
		$this->listCommands($commands);
	}

	protected function listCommands($commands)
	{
		// Print a hint for all commands
		foreach ($commands as $className => $command)
		{
			$class = new $className();
			$desc = $class->getDescription();

			$count = 20 - strlen($command);
			$count = $count > 0 ? $count : 1;
			echo $command . str_repeat(' ', $count) . $desc . "\n";
		}
	}
}
