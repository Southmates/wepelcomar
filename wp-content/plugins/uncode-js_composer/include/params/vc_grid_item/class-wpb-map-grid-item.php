<?php
/**
 * Basic class for 'vc_grid_item' mapping.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Class WpbMap_Grid_Item
 */
class WpbMap_Grid_Item extends WPBMap {
	/**
	 * Check user.
	 *
	 * @var array
	 */
	protected static $gitem_user_sc = false;
	/**
	 * List of user categories.
	 *
	 * @var array
	 */
	protected static $gitem_user_categories = false;
	/**
	 * User sorted shortcodes list.
	 *
	 * @var array
	 */
	protected static $gitem_user_sorted_sc = false;

	/**
	 * Generates list of shortcodes only for Grid element.
	 *
	 * This method parses the list of mapped shortcodes and creates categories list for users.
	 * Also, it checks is 'is_grid_item_element' attribute true.
	 *
	 * @static
	 *
	 * @param bool $force - force data generation even data already generated.
	 * @throws \Exception
	 */
	protected static function generateGitemUserData( $force = false ) {
		if ( ! $force && false !== self::$gitem_user_sc && false !== self::$gitem_user_categories ) {
			return;
		}
		self::$gitem_user_sc = self::$gitem_user_categories = self::$gitem_user_sorted_sc = [];
		$deprecated = 'deprecated';
		$add_deprecated = false;
		if ( is_array( self::$sc ) && ! empty( self::$sc ) ) {
			foreach ( self::$sc as $name => $values ) {
				if ( isset( $values['post_type'] ) && Vc_Grid_Item_Editor::postType() === $values['post_type'] && vc_user_access_check_shortcode_all( $name ) ) {
					if ( ! isset( $values['content_element'] ) || true === $values['content_element'] ) {
						$categories = isset( $values['category'] ) ? $values['category'] : '_other_category_';
						$values['_category_ids'] = [];
						if ( isset( $values['deprecated'] ) && false !== $values['deprecated'] ) {
							$add_deprecated = true;
							$values['_category_ids'][] = $deprecated;
						} else {
							if ( is_array( $categories ) && ! empty( $categories ) ) {
								foreach ( $categories as $c ) {
									if ( false === array_search( $c, self::$gitem_user_categories, true ) ) {
										self::$gitem_user_categories[] = $c;
									}
									$values['_category_ids'][] = md5( $c );
								}
							} else {
								if ( false === array_search( $categories, self::$gitem_user_categories, true ) ) {
									self::$gitem_user_categories[] = $categories;
								}
								$values['_category_ids'][] = md5( $categories );
							}
						}
					}
					self::$gitem_user_sc[ $name ] = $values;
					self::$gitem_user_sorted_sc[] = $values;
				}
			}
		}
		if ( $add_deprecated ) {
			self::$gitem_user_categories[] = $deprecated;
		}

		$sort = new Vc_Sort( self::$gitem_user_sorted_sc );
		self::$gitem_user_sorted_sc = $sort->sortByKey();
	}

	/**
	 * Get sorted list of mapped shortcode settings grid element
	 *
	 * Sorting depends on the weight attribute and mapping order.
	 *
	 * @static
	 * @return bool
	 * @throws \Exception
	 */
	public static function getSortedGitemUserShortCodes() {
		self::generateGitemUserData();

		return self::$gitem_user_sorted_sc;
	}

	/**
	 * Get list of mapped shortcode settings for current user.
	 *
	 * @static
	 * @return bool - associated array of shortcodes settings with tag as the key.
	 * @throws \Exception
	 */
	public static function getGitemUserShortCodes() {
		self::generateGitemUserData();

		return self::$gitem_user_sc;
	}

	/**
	 * Get all categories for current user.
	 *
	 * Category is added to the list when at least one shortcode of this category is allowed for current user
	 * by Vc access rules.
	 *
	 * @static
	 * @return bool
	 * @throws \Exception
	 */
	public static function getGitemUserCategories() {
		self::generateGitemUserData();

		return self::$gitem_user_categories;
	}
}
