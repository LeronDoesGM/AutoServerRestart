<?php

/*
 * This file is the commands class of AutoServerRestart.
 * Copyright (C) 2017 Ztech Network
 *
 * AutoServerRestart is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * AutoServerRestart is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with AutoServerRestart. If not, see <http://www.gnu.org/licenses/>.
 */

namespace ZtechNetwork\Minecraft\AutoServerRestart;

use pocketmine\Player;
use pocketmine\IPlayer;

use pocketmine\command\Command;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\utils\TextFormat;

class Commands implements CommandExecutor{

	public function __construct(Loader $plugin){
		$this->plugin = $plugin;
	}
	
	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		switch(strtolower($command->getName())){
		
			case "asr":
				if(isset($args[0])){
					if(!is_numeric($args[0])){
						$sender->sendMessage("[ASR] Only Numbers is prohibited.");
						return;
					}
					if($args[0] > 60){
						$sender->sendMessage("[ASR] It's not advised the value would be more than 60. If you want to increase it, edit the config.yml instead as this plugin won't allow you to set the value more than the said value because it's not prescribed.");
						$sender->sendMessage("[ASR] Only Numbers is prohibited.");
						return;
					}
					$this->plugin->setValueTimer($args[0]);
					$sender->sendMessage("[ASR] You have set the timer to " . $args[0] . " min/s. The changes will apply after the next server restart.");
				}else{
					$sender->sendMessage("Usage: /asr <value>");
				}
			break;
		
			case "asrtime":
				$time = $this->plugin->getTimer();
				$sender->sendMessage("[ASR] The server will restart in $time");
			break;
		}
		
	}

}