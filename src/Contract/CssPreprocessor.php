<?php

namespace OwpCore\Contract;

interface CssPreprocessor {
	public function __construct( string $name, string $modifier = '', string $affix = '', string $prefix = 'owp-' );

	public function to_string(): string;

	public function child( string $element ): CssPreprocessor;

	public function children( array $elements ): array;

	public static function parse( array $objects ): string;

	public static function state( string $state ): string;

	public static function echo( string $name, string $modifier = '', string $affix = '', string $prefix = 'owp-' ): string;
}