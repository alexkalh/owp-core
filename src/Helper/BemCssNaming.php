<?php

namespace OwpCore\Helper;

use Aura\Di\Exception\ServiceNotFound;
use OwpCore\Contract\CssNamingInterface;
use OwpCore\Engine;

class BemCssNaming implements CssNamingInterface {
	private string $class;
	private string $block;
	private string $modifier;
	private string $element;
	private string $prefix;
	private array $cache;

	public function init( string $block, string $modifier = '', string $element = '', string $prefix = 'owp-' ): CssNamingInterface {
		$this->set_block( $block );
		$this->set_modifier( $modifier );
		$this->set_element( $element );
		$this->set_prefix( $prefix );

		return $this->build();
	}

	public function build(): CssNamingInterface {
		$this->class = $this->get_prefix() . $this->get_block();

		if ( $modifier = $this->get_modifier() ) {
			$this->class .= '--' . $modifier;
		}

		if ( $element = $this->get_element() ) {
			$this->class .= '__' . $element;
		}

		return $this;
	}

	public function get_class(): string {
		return $this->class;
	}

	/**
	 * @throws ServiceNotFound
	 */
	public function child( string $child ): CssNamingInterface {
		$slug = ( $element = $this->get_element() ) ? $element . '__' . $child : $child;

		if ( ! $this->is_cached( $slug ) ) {
			/** @var CssNamingInterface $css_naming */
			$css_naming = Engine::resolve( CssNamingInterface::class );
			$css_naming->init(
				$this->get_block(),
				$this->get_modifier(),
				$slug,
				$this->get_prefix()
			);

			return $this->set_cache( $slug, $css_naming );
		}

		return $this->get_cache( $slug );
	}

	public function children( array $elements ): array {
		// TODO: Implement children() method.
		return [];
	}

	public function set_block( string $block ): CssNamingInterface {
		$this->block = $block;

		return $this;
	}

	public function get_block(): string {
		return $this->block;
	}

	public function set_modifier( string $modifier ): CssNamingInterface {
		$this->modifier = $modifier;

		return $this;
	}

	public function get_modifier(): string {
		return $this->modifier;
	}

	public function set_element( string $element ): CssNamingInterface {
		$this->element = $element;

		return $this;
	}

	public function get_element(): string {
		return $this->element;
	}

	public function set_prefix( string $prefix ): CssNamingInterface {
		$this->prefix = $prefix;

		return $this;
	}

	public function get_prefix(): string {
		return $this->prefix;
	}

	public function is_cached( string $slug ): bool {
		return isset( $this->cache[ $slug ] );
	}

	public function set_cache( string $slug, CssNamingInterface $css_naming ): CssNamingInterface {
		$this->cache[ $slug ] = $css_naming;

		return $css_naming;
	}

	public function get_cache( string $slug ): CssNamingInterface|bool {
		return $this->cache[ $slug ] ?? false;
	}

	public static function is( string $state ): string {
		return sprintf( 'is-%s', $state );
	}
}