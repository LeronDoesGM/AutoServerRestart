<?php

/*
 * This file is the callbacktask class of AutoServerRestart.
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

use pocketmine\scheduler\Task;

class CallbackTask extends Task{

	/** @var callable */
	protected $callable;

	/** @var array */
	protected $args;

	/**
	 * @param callable $callable
	 * @param array    $args
	 */
	public function __construct(callable $callable, array $args = array()){
		$this->callable = $callable;
		$this->args = $args;
		$this->args[] = $this;
	}

	/**
	 * @return callable
	 */
	public function getCallable(){
		return $this->callable;
	}

	public function onRun($currentTicks){
		call_user_func_array($this->callable, $this->args);
	}

}