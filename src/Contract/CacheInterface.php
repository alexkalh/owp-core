<?php

namespace OwpCore\Contract;

/**
 * Interface CacheInterface
 * @package OwpCore\Contract
 */
interface CacheInterface {
	/**
	 * @param string $key
	 * @param string $value
	 * @param int $exp
	 */
	public function set( string $key, string $value, int $exp = - 1 ): void;

	/**
	 * @param string $key
	 *
	 * @return string
	 */
	public function get( string $key ): string;

	/**
	 * @param string $key
	 *
	 * @return bool
	 */
	public function remove( string $key ): bool;
}