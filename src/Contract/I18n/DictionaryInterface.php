<?php

namespace OwpCore\Contract\I18n;

interface DictionaryInterface {
	public function get( string $key ): string;
}