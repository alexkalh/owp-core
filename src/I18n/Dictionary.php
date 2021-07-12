<?php

namespace OwpCore\I18n;

use OwpCore\Constant\FilterHook\I18n;
use OwpCore\Constant\I18n\Slug;
use OwpCore\Contract\I18n\DictionaryInterface;
use OwpCore\Pattern\Singleton;

class Dictionary implements DictionaryInterface {
	use Singleton;

	private array $book;

	public function __construct() {
		$mapping = array();

		$mapping[ Slug::ALL ]                                         = 'All';
		$mapping[ Slug::AND ]                                         = 'And';
		$mapping[ Slug::CATEGORIES ]                                  = 'Categories';
		$mapping[ Slug::COMBINE_CONDITION_BY_TAGS_CATEGORIES_FORMAT ] = 'Combine condition by Tags, Categories, and Format';
		$mapping[ Slug::FORMAT ]                                      = 'Format';
		$mapping[ Slug::IN ]                                          = 'In';
		$mapping[ Slug::IS_INCLUDE_CATEGORIES_CHILDREN ]              = 'Is include categories children';
		$mapping[ Slug::LATEST_NEWS ]                                 = 'Latest news';
		$mapping[ Slug::MONTH ]                                       = 'Month';
		$mapping[ Slug::MONTHS ]                                      = 'Months';
		$mapping[ Slug::MOST_COMMENTS ]                               = 'Most comments';
		$mapping[ Slug::NUMBER_OF_POSTS ]                             = 'Number of posts';
		$mapping[ Slug::OR ]                                          = 'Or';
		$mapping[ Slug::ORDER_BY ]                                    = 'Order by';
		$mapping[ Slug::RANDOM ]                                      = 'Random';
		$mapping[ Slug::REQUIRED_WORDPRESS_GREATER_THAN_3_DOT_7 ]     = 'Required wordpress >= 3.7+';
		$mapping[ Slug::TAGS ]                                        = 'Tags';
		$mapping[ Slug::TITLE ]                                       = 'Title';
		$mapping[ Slug::WEEK ]                                        = 'Week';
		$mapping[ Slug::WEEKS ]                                       = 'Weeks';
		$mapping[ Slug::YEAR ]                                        = 'Year';
		$mapping[ Slug::YEARS ]                                       = 'Years';

		$this->book = apply_filters( I18n::SET_DICTIONARY, $mapping );
	}

	public function get( string $key ): string {
		return $this->book[ $key ] ?? '';
	}
}