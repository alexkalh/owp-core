<?php

namespace OwpCore\Pattern;

/**
 * Trait Singleton
 * @package OwpCore\Pattern
 */
trait Singleton {
	private static object $_instance;

	/**
	 * @return object
	 */
	public static function get_instance(): object {
		$class = __CLASS__;

		if ( ! self::$_instance instanceof $class ) {
			self::$_instance = new $class();
		}

		return self::$_instance;
	}
}
