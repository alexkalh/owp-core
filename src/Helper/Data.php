<?php

namespace OwpCore\Helper;

use OwpCore\Pattern\Singleton;

class Data {
	use Singleton;

	private $_allowed_tags;

	public function __construct() {
		$this->_set_allowed_tags();
	}

	private function _set_allowed_tags() {
		$tags = wp_kses_allowed_html( 'post' );

		$tags['iframe']['src']             = array();
		$tags['iframe']['height']          = array();
		$tags['iframe']['width']           = array();
		$tags['iframe']['frameborder']     = array();
		$tags['iframe']['allowfullscreen'] = array();

		$tags['input']['class']   = array();
		$tags['input']['id']      = array();
		$tags['input']['name']    = array();
		$tags['input']['value']   = array();
		$tags['input']['type']    = array();
		$tags['input']['checked'] = array();

		$tags['select']['class'] = array();
		$tags['select']['id']    = array();
		$tags['select']['name']  = array();
		$tags['select']['value'] = array();
		$tags['select']['type']  = array();

		$tags['option']['selected'] = array();

		$tags['style']['types'] = array();

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