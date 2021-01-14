<?php

namespace OwpCore\Helper;

use OwpCore\Constant\HTML\Attribute;
use OwpCore\Pattern\Singleton;
use OwpCore\Constant\HTML\Tag;

class Data {
	use Singleton;

	private $_allowed_tags;

	public function __construct() {
		$this->_set_allowed_tags();
	}

	private function _set_allowed_tags() {
		$tags = wp_kses_allowed_html( 'post' );

		$tags[ Tag::IFRAME ]['src']             = array();
		$tags[ Tag::IFRAME ]['height']          = array();
		$tags[ Tag::IFRAME ]['width']           = array();
		$tags[ Tag::IFRAME ]['frameborder']     = array();
		$tags[ Tag::IFRAME ]['allowfullscreen'] = array();

		$tags[ Tag::INPUT ][ Attribute::CLASSES ] = array();
		$tags[ Tag::INPUT ]['id']                 = array();
		$tags[ Tag::INPUT ]['name']               = array();
		$tags[ Tag::INPUT ]['value']              = array();
		$tags[ Tag::INPUT ]['type']               = array();
		$tags[ Tag::INPUT ]['checked']            = array();

		$tags[ Tag::SELECT ][ Attribute::CLASSES ] = array();
		$tags[ Tag::SELECT ]['id']                 = array();
		$tags[ Tag::SELECT ]['name']               = array();
		$tags[ Tag::SELECT ]['value']              = array();
		$tags[ Tag::SELECT ]['type']               = array();

		$tags[ Tag::OPTION ]['selected'] = array();

		$tags[ Tag::STYLE ]['types'] = array();

		$microdata_tags = array( 'div', 'section', 'article', 'a', 'span', 'img', 'time', 'figure' );

		foreach ( $microdata_tags as $tag ) {
			$tags[ $tag ]['itemscope'] = array();
			$tags[ $tag ]['itemtype']  = array();
			$tags[ $tag ]['itemprop']  = array();
		}

		$this->_allowed_tags = apply_filters( 'medmag/data/set_allowed_tags', $tags );
	}

	public function get_allowed_tags() {
		return $this->_allowed_tags;
	}
}