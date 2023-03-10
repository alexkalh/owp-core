<?php

namespace OwpCore\Contract;

/**
 * Interface CacheInterface
 * @package OwpCore\Contract
 */
interface CacheFactoryInterface {
	/**
	 * @param string $key
	 * @param string $value
	 * @param int $exp
	 */
	public static function set( string $key, string $value, int $exp = - 1 ): void;

	/**
	 * @param string $key
	 *
	 * @return string
	 */
	public static function get( string $key ): string;

	/**
	 * @param string $key
	 *
	 * @return bool
	 */
	public static function remove( string $key ): bool;
}