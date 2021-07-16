<?php

namespace OwpCore\DI\Config;

use Aura\Di\{Container, ContainerConfig};
use Aura\Di\Exception\{ContainerLocked, ServiceNotObject};
use OwpCore\Contract\I18n\{DictionaryInterface, TranslatorInterface};
use OwpCore\I18n\{Dictionary, Translator};
use OwpCore\Contract\DataInterface;
use OwpCore\Helper\Data;


class Common extends ContainerConfig {
	/**
	 * @throws ServiceNotObject
	 * @throws ContainerLocked
	 */
	public function define( Container $di ): void {
		$di->set( DataInterface::class, $di->lazyNew( Data::class ) );
		$di->set( DictionaryInterface::class, $di->lazyNew( Dictionary::class ) );

		$di->params[ Translator::class ]['dictionary'] = $di->lazyGet( DictionaryInterface::class );
		$di->set( TranslatorInterface::class, $di->lazyNew( Translator::class ) );
	}

	public function modify( Container $di ): void {
		// TODO: modify some thing.
	}
}