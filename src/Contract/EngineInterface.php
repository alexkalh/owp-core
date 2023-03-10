<?php

namespace OwpCore\Contract;

use Aura\Di\Container;
use Aura\Di\ContainerBuilder;

interface EngineInterface {
	public function get_container_builder(): ContainerBuilder;

	public function get_container(): Container;

	public static function resolve( string $name ): mixed;
}