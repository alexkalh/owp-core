<?php

namespace OwpCore\Contract;

interface CssNamingInterface {
	public function init( string $block, string $modifier = '', string $element = '', string $prefix = 'owp-' ): CssNamingInterface;

	public function build(): CssNamingInterface;

	public function get_class(): string;

	public function child( string $child ): CssNamingInterface;

	public function children( array $children ): array;

	public function set_block( string $block ): CssNamingInterface;

	public function get_block(): string;

	public function set_modifier( string $modifier ): CssNamingInterface;

	public function get_modifier(): string;

	public function set_element( string $element ): CssNamingInterface;

	public function get_element(): string;

	public function set_prefix( string $prefix ): CssNamingInterface;

	public function get_prefix(): string;

	public function is_cached( string $slug ): bool;

	public function set_cache( string $slug, CssNamingInterface $css_naming ): CssNamingInterface;

	public function get_cache( string $slug ): CssNamingInterface|bool;

	public static function is( string $state ): string;
}