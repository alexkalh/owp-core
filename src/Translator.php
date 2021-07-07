<?php

namespace OwpCore;

use OwpCore\Contract\TranslatorInterface;

class Translator implements TranslatorInterface {
	public function esc_attr__( string $key ): string {
		return '';
	}

	public function esc_html__( string $key ): string {
		return '';
	}
}