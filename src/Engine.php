<?php

namespace OwpCore;

require_once dirname( __DIR__ ) . '/vendor/autoload.php';

use Aura\Di\ContainerBuilder;
use Aura\Di\Container;
use Aura\Di\Exception\ServiceNotFound;
use Aura\Di\Exception\SetterMethodNotFound;
use OwpCore\Contract\EngineInterface;
use OwpCore\DI\Config\Common;

class Engine implements EngineInterface {
	private ContainerBuilder $container_builder;

	private Container $container;

	/**
	 * @throws SetterMethodNotFound
	 */
	public function __construct() {
		$this->container_builder = new ContainerBuilder();
		$this->container         = $this->container_builder->newConfiguredInstance( [
			Common::class,
		] );
	}

	/**
	 * @return ContainerBuilder
	 */
	public function get_container_builder(): ContainerBuilder {
		return $this->container_builder;
	}

	/**
	 * @return Container
	 */
	public function get_container(): Container {
		return $this->container;
	}

	/**
	 * @throws ServiceNotFound
	 */
	public static function resolve( string $name ): mixed {
		$engine = new Engine();

		return $engine->get_container()->get( $name );
	}
}