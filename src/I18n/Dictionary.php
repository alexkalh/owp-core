<?php

namespace OwpCore\I18n;

use OwpCore\Constant\FilterHook\I18n;
use OwpCore\Contract\I18n\DictionaryInterface;
use OwpCore\Pattern\Singleton;

class Dictionary implements DictionaryInterface {
	use Singleton;

	private array $book;

	public function __construct() {
		$mapping = array();

		$mapping[ self::ALL ]                                         = 'All';
		$mapping[ self::CONDITIONAL_AND ]                             = 'And';
		$mapping[ self::CATEGORIES ]                                  = 'Categories';
		$mapping[ self::COMBINE_CONDITION_BY_TAGS_CATEGORIES_FORMAT ] = 'Combine condition by Tags, Categories, and Format';
		$mapping[ self::FORMAT ]                                      = 'Format';
		$mapping[ self::IN ]                                          = 'In';
		$mapping[ self::IS_INCLUDE_CATEGORIES_CHILDREN ]              = 'Is include categories children';
		$mapping[ self::LATEST_NEWS ]                                 = 'Latest news';
		$mapping[ self::MONTH ]                                       = 'Month';
		$mapping[ self::MONTHS ]                                      = 'Months';
		$mapping[ self::MOST_COMMENTS ]                               = 'Most comments';
		$mapping[ self::NUMBER_OF_POSTS ]                             = 'Number of posts';
		$mapping[ self::CONDITIONAL_OR ]                              = 'Or';
		$mapping[ self::ORDER_BY ]                                    = 'Order by';
		$mapping[ self::RANDOM ]                                      = 'Random';
		$mapping[ self::REQUIRED_WORDPRESS_GREATER_THAN_3_DOT_7 ]     = 'Required wordpress >= 3.7+';
		$mapping[ self::TAGS ]                                        = 'Tags';
		$mapping[ self::TITLE ]                                       = 'Title';
		$mapping[ self::WEEK ]                                        = 'Week';
		$mapping[ self::WEEKS ]                                       = 'Weeks';
		$mapping[ self::YEAR ]                                        = 'Year';
		$mapping[ self::YEARS ]                                       = 'Years';

		$this->book = apply_filters( I18n::SET_DICTIONARY, $mapping );
	}

	public function get( string $key ): string {
		return $this->book[ $key ] ?? '';
	}
}