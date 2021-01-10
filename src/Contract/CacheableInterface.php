<?php

namespace OwpCore\Contract;

interface CacheableInterface {
	function is_use_cache(): bool;

	function get_cache_duration(): int;

	function get_cache_id(): string;
}