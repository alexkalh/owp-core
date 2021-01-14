<?php

namespace OwpCore\Helper;

use OwpCore\Constant\FilterHook\Data as DataFilter;
use OwpCore\Constant\HTML\Attribute;
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

		$tags[ Tag::IFRAME ][ Attribute::SRC ]              = array();
		$tags[ Tag::IFRAME ][ Attribute::HEIGHT ]           = array();
		$tags[ Tag::IFRAME ][ Attribute::WIDTH ]            = array();
		$tags[ Tag::IFRAME ][ Attribute::FRAME_BORDER ]     = array();
		$tags[ Tag::IFRAME ][ Attribute::ALLOW_FULLSCREEN ] = array();

		$tags[ Tag::INPUT ][ Attribute::CLASSES ] = array();
		$tags[ Tag::INPUT ][ Attribute::ID ]      = array();
		$tags[ Tag::INPUT ][ Attribute::NAME ]    = array();
		$tags[ Tag::INPUT ][ Attribute::VALUE ]   = array();
		$tags[ Tag::INPUT ][ Attribute::TYPE ]    = array();
		$tags[ Tag::INPUT ][ Attribute::CHECKED ] = array();

		$tags[ Tag::SELECT ][ Attribute::CLASSES ] = array();
		$tags[ Tag::SELECT ][ Attribute::ID ]      = array();
		$tags[ Tag::SELECT ][ Attribute::NAME ]    = array();
		$tags[ Tag::SELECT ][ Attribute::VALUE ]   = array();
		$tags[ Tag::SELECT ][ Attribute::TYPE ]    = array();

		$tags[ Tag::OPTION ][ Attribute::SELECTED ] = array();

		$tags[ Tag::STYLE ][ Attribute::TYPE ] = array();

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

		foreach ( $microdata_tags as $tag ) {
			$tags[ $tag ][ Attribute::ITEM_SCOPE ] = array();
			$tags[ $tag ][ Attribute::ITEM_TYPE ]  = array();
			$tags[ $tag ][ Attribute::ITEM_PROP ]  = array();
		}

		$this->_allowed_tags = apply_filters( DataFilter::SET_ALLOWED_TAGS, $tags );
	}

	public function get_allowed_tags(): array {
		return $this->_allowed_tags;
	}
}