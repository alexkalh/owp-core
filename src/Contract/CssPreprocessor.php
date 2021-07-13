<?php

namespace OwpCore\Contract;

interface CssPreprocessor {
	public function __construct( string $name, string $modifier = '', string $prefix = 'owp-' );

	public function to_string(): string;

	public function child( string $element ): CssPreprocessor;

	public function children( array $elements ): array;

	public static function parse( array $objects ): string;
}