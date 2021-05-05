<?php

namespace OwpCore\Widget;

use OwpCore\Cache\CacheFactory;
use OwpCore\Constant\Duration;
use OwpCore\Constant\FilterHook\Cache;
use OwpCore\Contract\CacheableInterface;
use WP_Widget;

/**
 * Class Widget
 * @package OwpCore\Contract
 */
abstract class Widget extends WP_Widget implements WidgetInterface, CacheableInterface {
	private bool $_is_use_cache;

	/**
	 * @inheritDoc
	 */
	public function __construct( string $id_base, string $name, $widget_options = array(), $control_options = array() ) {
		$this->_is_use_cache = get_theme_mod( Cache::IS_USE_IN_WIDGET, true );
		parent::__construct( $id_base, $name, $widget_options, $control_options );
	}

	/**
	 * @inheritDoc
	 */
	function widget( $args, $instance ) {
		if ( $this->is_use_cache() ) {
			$data = CacheFactory::get( $this->get_cache_id() );
			if ( ! $data ) {
				ob_start();
				$this->get_widget_content( $args, $instance );
				$data = preg_replace( '/>\s+</m', '><', ob_get_clean() );
				CacheFactory::set( $this->id, $data, $this->get_cache_duration() );
			}
			echo $data;
		} else {
			$this->get_widget_content( $args, $instance );
		}
	}

	/**
	 * @inheritDoc
	 */
	public function update( $new_instance, $old_instance ) {
		if ( $this->is_use_cache() ) {
			CacheFactory::remove( $this->get_cache_id() );
		}

		return parent::update( $new_instance, $old_instance );
	}

	public function is_use_cache(): bool {
		return $this->_is_use_cache;
	}

	public function get_cache_duration(): int {
		return Duration::ZERO;
	}

	public function get_cache_id(): string {
		return $this->id;
	}
}