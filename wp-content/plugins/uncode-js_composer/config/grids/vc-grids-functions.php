<?php
/**
 * Lib of functions related grid shortcodes elements.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Get taxonomies types for autocomplete.
 *
 * @param mixed $term
 *
 * @return array|bool
 * @since 4.5.2
 */
function vc_autocomplete_taxonomies_field_render( $term ) {
	$vc_taxonomies_types = vc_taxonomies_types();
	// phpcs:ignore
	$terms = get_terms( array_keys( $vc_taxonomies_types ), array(
		'include' => [ $term['value'] ],
		'hide_empty' => false,
	) );
	$data = false;
	if ( is_array( $terms ) && 1 === count( $terms ) ) {
		$term = $terms[0];
		$data = vc_get_term_object( $term );
	}

	return $data;
}

/**
 * Get taxonomies search fields for autocomplete.
 *
 * @param string $search_string
 *
 * @return array|bool
 * @since 4.5.2
 */
function vc_autocomplete_taxonomies_field_search( $search_string ) {
	$data = [];
	$vc_filter_by = vc_post_param( 'vc_filter_by', '' );
	$vc_filter_by_post_type = vc_post_param( 'vc_filter_post_type', '' );
	$vc_taxonomies_types = strlen( $vc_filter_by ) > 0 ? [ $vc_filter_by ] : array_keys( vc_taxonomies_types( $vc_filter_by_post_type ) );
	if ( empty( $vc_taxonomies_types ) ) {
		return [];
	}
	// phpcs:ignore
	$vc_taxonomies = get_terms( $vc_taxonomies_types, array(
		'hide_empty' => false,
		'search' => $search_string,
	) );
	if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
		foreach ( $vc_taxonomies as $t ) {
			if ( is_object( $t ) ) {
				$data[] = vc_get_term_object( $t );
			}
		}
	}

	return $data;
}

/**
 * Add search by title to search query.
 *
 * @param string $search
 * @param WP_Query $wp_query
 *
 * @return string
 */
function vc_search_by_title_only( $search, $wp_query ) {
	global $wpdb;
	if ( empty( $search ) ) {
		return $search;
	}
	// skip processing - no search term in query.
	$q = $wp_query->query_vars;
	if ( isset( $q['vc_search_by_title_only'] ) && $q['vc_search_by_title_only'] ) {
		$n = ! empty( $q['exact'] ) ? '' : '%';
		$search = '';
		$searchand = '';
		foreach ( (array) $q['search_terms'] as $term ) {
			$term = $wpdb->esc_like( $term );
			$like = $n . $term . $n;
			$search .= $searchand . $wpdb->prepare( "($wpdb->posts.post_title LIKE %s)", $like );
			$searchand = ' AND ';
		}
		if ( ! empty( $search ) ) {
			$search = " AND ({$search}) ";
			if ( ! is_user_logged_in() ) {
				$search .= " AND ($wpdb->posts.post_password = '') ";
			}
		}
	}

	return $search;
}

/**
 * Include search field to search query.
 *
 * @param string $search_string
 *
 * @return array
 */
function vc_include_field_search( $search_string ) {
	$query = $search_string;
	$data = [];
	$args = [
		's' => $query,
		'post_type' => 'any',
	];
	$args['vc_search_by_title_only'] = true;
	$args['numberposts'] = - 1;
	if ( 0 === strlen( $args['s'] ) ) {
		unset( $args['s'] );
	}
	add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
	$posts = get_posts( $args );
	if ( is_array( $posts ) && ! empty( $posts ) ) {
		foreach ( $posts as $post ) {
			$data[] = [
				'value' => $post->ID,
				'label' => $post->post_title,
				'group' => $post->post_type,
			];
		}
	}

	return $data;
}

/**
 * Include render field.
 *
 * @param array $value
 *
 * @return array|bool
 */
function vc_include_field_render( $value ) {
	$post = get_post( $value['value'] );

	return is_null( $post ) ? false : [
		'label' => $post->post_title,
		'value' => $post->ID,
		'group' => $post->post_type,
	];
}

/**
 * Exclude search field from search query.
 *
 * @param array $data_arr
 *
 * @return array
 */
function vc_exclude_field_search( $data_arr ) {
	$query = isset( $data_arr['query'] ) ? $data_arr['query'] : null;
	$term = isset( $data_arr['term'] ) ? $data_arr['term'] : '';
	$data = [];
	$args = ! empty( $query ) ? [
		's' => $term,
		'post_type' => $query,
	] : [
		's' => $term,
		'post_type' => 'any',
	];
	$args['vc_search_by_title_only'] = true;
	$args['numberposts'] = - 1;
	if ( 0 === strlen( $args['s'] ) ) {
		unset( $args['s'] );
	}
	add_filter( 'posts_search', 'vc_search_by_title_only', 500, 2 );
	$posts = get_posts( $args );
	if ( is_array( $posts ) && ! empty( $posts ) ) {
		foreach ( $posts as $post ) {
			$data[] = [
				'value' => $post->ID,
				'label' => $post->post_title,
				'group' => $post->post_type,
			];
		}
	}

	return $data;
}

/**
 * Exclude render field.
 *
 * @param array $value
 *
 * @return array|bool
 */
function vc_exclude_field_render( $value ) {
	$post = get_post( $value['value'] );

	return is_null( $post ) ? false : [
		'label' => $post->post_title,
		'value' => $post->ID,
		'group' => $post->post_type,
	];
}
