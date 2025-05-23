<?php
/**
 * Base class for 'gutenberg' param type.
 */

if ( ! defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

/**
 * Class Vc_Gutenberg_Param
 */
class Vc_Gutenberg_Param {
	/**
	 * The slug used for the custom post type associated with Gutenberg parameters.
	 *
	 * @var string
	 */
	protected $postTypeSlug = 'wpb_gutenberg_param';

	/**
	 * Vc_Gutenberg_Param constructor.
	 */
	public function __construct() {
		add_action( 'init', [
			$this,
			'initialize',
		] );
	}

	/**
	 * Initialize the class.
	 */
	public function initialize() {
		global $pagenow, $wp_version;
		if ( version_compare( $wp_version, '4.9.8', '>' ) && 'post-new.php' === $pagenow && vc_user_access()->wpAll( 'edit_posts' )->get() && vc_request_param( 'post_type' ) === $this->postTypeSlug ) {
			$this->registerGutenbergAttributeType();
			add_filter( 'use_block_editor_for_post_type', '__return_true', 11, 2 );
			// @see Vc_Gutenberg_Param::removeAdminUi
			add_action( 'admin_enqueue_scripts', [
				$this,
				'removeAdminUI',
			] );
		}
	}

	/**
	 * Removes the WordPress admin UI elements on the Gutenberg editor page.
	 */
	public function removeAdminUi() {
		$style = '
            #adminmenumain, #wpadminbar {
                display: none;
            }

            html.wp-toolbar {
                padding: 0 !important;
            }

            .wp-toolbar #wpcontent {
                margin: 0;
            }

            .wp-toolbar #wpbody {
                padding-top: 0;
            }

            .gutenberg .gutenberg__editor .edit-post-layout .edit-post-header, html .block-editor-page .edit-post-header {
                top: 0;
                left: 0;
            }

            .gutenberg .gutenberg__editor .edit-post-layout.is-sidebar-opened .edit-post-layout__content, html .block-editor-page .edit-post-layout.is-sidebar-opened .edit-post-layout__content {
                margin-right: 0;
            }

            .gutenberg .gutenberg__editor .edit-post-layout .editor-post-publish-panel, html .block-editor-page .edit-post-layout .editor-post-publish-panel, html .block-editor-page .edit-post-header__settings {
                display: none;
            }
            .editor-post-title {
                display: none !important;
            }
';
		wp_add_inline_style( 'wp-edit-blocks', $style );
	}

	/**
	 * Registers the custom post type for Gutenberg attributes.
	 */
	protected function registerGutenbergAttributeType() {
		$labels = [
			'name' => _x( 'Gutenberg attrs', 'Post type general name', 'js_composer' ),
			'singular_name' => _x( 'Gutenberg attr', 'Post type singular name', 'js_composer' ),
			'menu_name' => _x( 'Gutenberg attrs', 'Admin Menu text', 'js_composer' ),
			'name_admin_bar' => _x( 'Gutenberg attr', 'Add New on Toolbar', 'js_composer' ),
			'add_new' => esc_html__( 'Add New', 'js_composer' ),
			'add_new_item' => esc_html__( 'Add New Gutenberg attr', 'js_composer' ),
			'new_item' => esc_html__( 'New Gutenberg attr', 'js_composer' ),
			'edit_item' => esc_html__( 'Edit Gutenberg attr', 'js_composer' ),
			'view_item' => esc_html__( 'View Gutenberg attr', 'js_composer' ),
			'all_items' => esc_html__( 'All Gutenberg attrs', 'js_composer' ),
			'search_items' => esc_html__( 'Search Gutenberg attrs', 'js_composer' ),
			'parent_item_colon' => esc_html__( 'Parent Gutenberg attrs:', 'js_composer' ),
			'not_found' => esc_html__( 'No Gutenberg attrs found.', 'js_composer' ),
			'not_found_in_trash' => esc_html__( 'No Gutenberg attrs found in Trash.', 'js_composer' ),
			'featured_image' => _x( 'Gutenberg attr Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'js_composer' ),
			'set_featured_image' => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'js_composer' ),
			'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'js_composer' ),
			'use_featured_image' => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'js_composer' ),
			'archives' => _x( 'Gutenberg attr archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'js_composer' ),
			'insert_into_item' => _x( 'Add into Gutenberg attr', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'js_composer' ),
			'uploaded_to_this_item' => _x( 'Uploaded to this Gutenberg attr', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'js_composer' ),
			'filter_items_list' => _x( 'Filter Gutenberg attrs list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'js_composer' ),
			'items_list_navigation' => _x( 'Gutenberg attrs list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'js_composer' ),
			'items_list' => _x( 'Gutenberg attrs list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'js_composer' ),
		];
		$args = [
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => false,
			'query_var' => false,
			'capability_type' => 'page',
			'has_archive' => false,
			'hierarchical' => false,
			'menu_position' => null,
			'show_in_rest' => true,
			'supports' => [ 'editor' ],
		];
		register_post_type( $this->postTypeSlug, $args );
	}
}
