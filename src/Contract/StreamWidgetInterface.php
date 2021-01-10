<?php

namespace OwpCore\Contract;

/**
 * Interface StreamWidgetInterface
 * @package OwpCore\Contract
 */
interface StreamWidgetInterface {

	/**
	 * @param array $instance
	 * @param array $args_extra
	 *
	 * @return array
	 */
	function get_query( array $instance, array $args_extra = array() ): array;
}
