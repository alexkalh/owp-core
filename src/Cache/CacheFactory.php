<?php

namespace OwpCore\Cache;

use OwpCore\Constant\FilterHook\Cache;
use OwpCore\Contract\CacheInterface;

/**
 * Class CacheFactory
 * @package OwpCore\Cache
 */
final class CacheFactory {
	/**
	 * @var CacheInterface|mixed
	 */
	private CacheInterface $_producer;

	/**
	 * CacheFactory constructor.
	 */
	public function __construct() {
		$classname = get_theme_mod( Cache::CACHE_TYPE, TransientCache::class );
		if (is_subclass_of($classname, CacheInterface::class)) {
			$this->_producer = new $classname;
		}
	}

	/**
	 * @return CacheInterface
	 */
	public function getProducer(): CacheInterface {
		return $this->_producer;
	}
}