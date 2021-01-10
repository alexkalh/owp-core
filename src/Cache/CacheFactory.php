<?php

namespace OwpCore\Cache;

use OwpCore\Contract\CacheFactoryInterface;
use OwpCore\Contract\CacheInterface;

class CacheFactory implements CacheFactoryInterface {
	/**
	 * @var CacheInterface|mixed
	 */
	private static CacheInterface $_producer;

	/**
	 * @return CacheInterface
	 */
	private static function getProducer(): CacheInterface {
		if ( empty( $_producer ) ) {
			$classname = get_theme_mod( \OwpCore\Constant\FilterHook\Cache::CACHE_TYPE, TransientCache::class );
			if ( is_subclass_of( $classname, CacheInterface::class ) ) {
				self::$_producer = new $classname;
			} else {
				self::$_producer = new TransientCache();
			}
		}

		return self::$_producer;
	}

	/**
	 * @param string $key
	 * @param string $value
	 * @param int $exp
	 */
	public static function set( string $key, string $value, int $exp = - 1 ): void {
		self::getProducer()->set( $key, $value, $exp );
	}

	/**
	 * @param string $key
	 *
	 * @return string
	 */
	public static function get( string $key ): string {
		return self::getProducer()->get( $key );
	}

	/**
	 * @param string $key
	 *
	 * @return bool
	 */
	public static function remove( string $key ): bool {
		return self::getProducer()->remove( $key );
	}
}