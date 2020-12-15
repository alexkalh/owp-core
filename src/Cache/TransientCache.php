<?php

namespace OWP\Cache;

use OWP\Contract\CacheInterface;
use OWP\Pattern\Singleton;

class TransientCache implements CacheInterface {
	use Singleton;

	/**
	 * @param string $key
	 * @param string $value
	 * @param int $exp
	 */
	public function set( string $key, string $value, int $exp = - 1 ): void {
		set_transient( $key, $value, $exp );
	}

	/**
	 * @param string $key
	 *
	 * @return string
	 */
	public function get( string $key ): string {
		return get_transient( $key );
	}

	/**
	 * @param string $key
	 *
	 * @return bool
	 */
	public function remove( string $key ): bool {
		return delete_transient( $key );
	}
}