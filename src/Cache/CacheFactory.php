<?php

namespace OWP\Cache;

use OWP\Constant\Hook;
use OWP\Contract\CacheInterface;
use OWP\Pattern\Singleton;

/**
 * Class CacheFactory
 * @package OWP\Cache
 */
final class CacheFactory {
	use Singleton;

	/**
	 * @var CacheInterface|mixed
	 */
	public CacheInterface $producer;

	/**
	 * CacheFactory constructor.
	 */
	private function __construct() {
		$producer = get_theme_mod( Hook::CACHE_BY, TransientCache::class );
		if ( is_subclass_of( $producer, CacheInterface::class ) ) {
			$this->producer = call_user_func( $producer, '::get_instance' );
		}
	}
}