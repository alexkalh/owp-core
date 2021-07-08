<?php

namespace OwpCore\I18n;

use OwpCore\Contract\I18n\DictionaryInterface;
use OwpCore\Contract\I18n\TranslatorInterface;
use OwpCore\Pattern\Singleton;

class Translator implements TranslatorInterface {
	use Singleton;

	private DictionaryInterface $dictionary;

	public function __construct() {
		$this->dictionary = Dictionary::get_instance();
	}

	public function i18n( string $key, bool $echo = false, bool $is_attr = true ): string {
		$content = $this->dictionary->get( $key );

		if ( $echo ) {
			echo $content;
		}

		return $content;
	}
}