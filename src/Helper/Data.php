<?php

namespace OwpCore\Helper;

use OwpCore\Constant\FilterHook\Data as DataFilterHook;
use OwpCore\Constant\HTML\Attribute;
use OwpCore\Contract\DataInterface;
use OwpCore\Pattern\Singleton;
use OwpCore\Constant\HTML\Tag;

class Data implements DataInterface {
	use Singleton;

	private array $_allowed_tags;

	public function __construct() {
		$this->_set_allowed_tags();
	}

	private function _set_allowed_tags() {
		$tags = wp_kses_allowed_html( 'post' );

		// Iframe.
		$iframe = [
			Attribute::SRC              => 1,
			Attribute::HEIGHT           => 1,
			Attribute::WIDTH            => 1,
			Attribute::FRAME_BORDER     => 1,
			Attribute::ALLOW_FULLSCREEN => 1
		];

		$tags[ Tag::IFRAME ] = array_merge( $iframe, $tags[ Tag::IFRAME ] ?? [] );

		// Input.
		$input              = [
			Attribute::CLASSES => 1,
			Attribute::ID      => 1,
			Attribute::NAME    => 1,
			Attribute::VALUE   => 1,
			Attribute::TYPE    => 1,
			Attribute::CHECKED => 1
		];
		$tags[ Tag::INPUT ] = array_merge( $input, $tags[ Tag::INPUT ] ?? [] );

		// Select.
		$select              = [
			Attribute::CLASSES => 1,
			Attribute::ID      => 1,
			Attribute::NAME    => 1,
			Attribute::VALUE   => 1,
			Attribute::TYPE    => 1,
		];
		$tags[ Tag::SELECT ] = array_merge( $select, $tags[ Tag::SELECT ] ?? [] );

		$tags[ Tag::OPTION ][ Attribute::SELECTED ] = 1;
		$tags[ Tag::STYLE ][ Attribute::TYPE ]      = 1;

		$microdata_tags = array(
			Tag::DIV,
			Tag::SECTION,
			Tag::ARTICLE,
			Tag::A,
			Tag::SPAN,
			Tag::IMG,
			Tag::TIME,
			Tag::FIGURE
		);

		$microdata_common = [
			Attribute::ITEM_SCOPE => 1,
			Attribute::ITEM_TYPE  => 1,
			Attribute::ITEM_PROP  => 1
		];
		foreach ( $microdata_tags as $tag ) {
			$tags[ $tag ] = array_merge( $microdata_common, $tags[ $tag ] ?? [] );
		}

		$this->_allowed_tags = apply_filters( DataFilterHook::SET_ALLOWED_TAGS, $tags );
	}

	public function get_allowed_tags(): array {
		return $this->_allowed_tags;
	}
}