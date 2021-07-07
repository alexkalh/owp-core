<?php

namespace OwpCore\Contract;

interface TranslatorInterface {
	public function esc_attr__( string $key ): string;

	public function esc_html__( string $key ): string;
}