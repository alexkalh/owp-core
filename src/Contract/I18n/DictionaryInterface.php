<?php

namespace OwpCore\Contract\I18n;

use OwpCore\Constant\I18n\Slug;

interface DictionaryInterface extends Slug {
	public function get( string $key ): string;
}