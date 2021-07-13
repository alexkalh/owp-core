<?php

namespace OwpCore\Helper;

use OwpCore\Contract\CssPreprocessor;

class BEM implements CssPreprocessor {
	private string $_block;
	private string $_name;
	private string $_modifier;
	private string $_prefix;
	private string $_affix;
	private array $_cache;

	public function __construct( string $name, string $modifier = '', string $affix = '', string $prefix = 'owp-' ) {
		$this->_name     = $name;
		$this->_modifier = $modifier;
		$this->_prefix   = $prefix;
		$this->_affix    = $affix;
		$this->_combine();
	}

	public function to_string(): string {
		return $this->_block;
	}

	public function child( string $element ): CssPreprocessor {
		if ( $this->_affix ) {
			$element = $this->_affix . '__' . $element;
		}

		if ( ! $this->_is_cached( $element ) ) {
			$bem = new BEM( $this->_name, $this->_modifier, $element, $this->_prefix );
			$this->_cache( $element, $bem );
		}

		return $this->_cache[ $element ];
	}

	public function children( array $elements ): array {
		$children = array();

		foreach ( $elements as $element ) {
			array_push( $children, $this->child( $element ) );
		}

		return $children;
	}

	private function _combine(): void {
		$this->_block = $this->_prefix . $this->_name;

		if ( $this->_modifier ) {
			$this->_block .= '--' . $this->_modifier;
		}

		if ( $this->_affix ) {
			$this->_block .= '__' . $this->_affix;
		}
	}

	private function _is_cached( string $element ): bool {
		return isset( $this->_cache[ $element ] );
	}

	private function _cache( string $element, CssPreprocessor $bem ) {
		$this->_cache[ $element ] = $bem;
	}

	public static function parse( array $objects ): string {
		$classes = [];

		foreach ( $objects as $object ) {
			/** @var CssPreprocessor $object */
			array_push( $classes, $object->to_string() );
		}

		return implode( ' ', $classes );
	}

	public static function state( string $state ): string {
		return sprintf( 'is-%s', $state );
	}

	public static function echo( string $name, string $modifier = '', string $affix = '', string $prefix = 'owp-' ): string {
		return ( new BEM( $name, $modifier, $affix, $prefix ) )->to_string();
	}
}
