<?php
/**
 * Custom Post Types Registration
 *
 * @package Cpfauto
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Vehicle Custom Post Type
 */
function cpfauto_register_vehicle_post_type() {

    $labels = array(
        'name'                  => _x('Vehicles', 'Post Type General Name', 'cpfauto'),
        'singular_name'         => _x('Vehicle', 'Post Type Singular Name', 'cpfauto'),
        'menu_name'             => __('Vehicles', 'cpfauto'),
        'name_admin_bar'        => __('Vehicle', 'cpfauto'),
        'archives'              => __('Vehicle Archives', 'cpfauto'),
        'attributes'            => __('Vehicle Attributes', 'cpfauto'),
        'parent_item_colon'     => __('Parent Vehicle:', 'cpfauto'),
        'all_items'             => __('All Vehicles', 'cpfauto'),
        'add_new_item'          => __('Add New Vehicle', 'cpfauto'),
        'add_new'               => __('Add New', 'cpfauto'),
        'new_item'              => __('New Vehicle', 'cpfauto'),
        'edit_item'             => __('Edit Vehicle', 'cpfauto'),
        'update_item'           => __('Update Vehicle', 'cpfauto'),
        'view_item'             => __('View Vehicle', 'cpfauto'),
        'view_items'            => __('View Vehicles', 'cpfauto'),
        'search_items'          => __('Search Vehicle', 'cpfauto'),
        'not_found'             => __('Not found', 'cpfauto'),
        'not_found_in_trash'    => __('Not found in Trash', 'cpfauto'),
        'featured_image'        => __('Featured Image', 'cpfauto'),
        'set_featured_image'    => __('Set featured image', 'cpfauto'),
        'remove_featured_image' => __('Remove featured image', 'cpfauto'),
        'use_featured_image'    => __('Use as featured image', 'cpfauto'),
        'insert_into_item'      => __('Insert into vehicle', 'cpfauto'),
        'uploaded_to_this_item' => __('Uploaded to this vehicle', 'cpfauto'),
        'items_list'            => __('Vehicles list', 'cpfauto'),
        'items_list_navigation' => __('Vehicles list navigation', 'cpfauto'),
        'filter_items_list'     => __('Filter vehicles list', 'cpfauto'),
    );

    $args = array(
        'label'                 => __('Vehicle', 'cpfauto'),
        'description'           => __('Vehicle listings for car dealer', 'cpfauto'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
        'taxonomies'            => array('vehicle_category', 'vehicle_tag'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-car',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'rewrite'               => array('slug' => 'vehicles'),
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true, // Enable Gutenberg editor
    );

    register_post_type('vehicle', $args);
}
add_action('init', 'cpfauto_register_vehicle_post_type', 0);

/**
 * Register Vehicle Categories Taxonomy
 */
function cpfauto_register_vehicle_category_taxonomy() {

    $labels = array(
        'name'                       => _x('Vehicle Categories', 'Taxonomy General Name', 'cpfauto'),
        'singular_name'              => _x('Vehicle Category', 'Taxonomy Singular Name', 'cpfauto'),
        'menu_name'                  => __('Categories', 'cpfauto'),
        'all_items'                  => __('All Categories', 'cpfauto'),
        'parent_item'                => __('Parent Category', 'cpfauto'),
        'parent_item_colon'          => __('Parent Category:', 'cpfauto'),
        'new_item_name'              => __('New Category Name', 'cpfauto'),
        'add_new_item'               => __('Add New Category', 'cpfauto'),
        'edit_item'                  => __('Edit Category', 'cpfauto'),
        'update_item'                => __('Update Category', 'cpfauto'),
        'view_item'                  => __('View Category', 'cpfauto'),
        'separate_items_with_commas' => __('Separate categories with commas', 'cpfauto'),
        'add_or_remove_items'        => __('Add or remove categories', 'cpfauto'),
        'choose_from_most_used'      => __('Choose from the most used', 'cpfauto'),
        'popular_items'              => __('Popular Categories', 'cpfauto'),
        'search_items'               => __('Search Categories', 'cpfauto'),
        'not_found'                  => __('Not Found', 'cpfauto'),
        'no_terms'                   => __('No categories', 'cpfauto'),
        'items_list'                 => __('Categories list', 'cpfauto'),
        'items_list_navigation'      => __('Categories list navigation', 'cpfauto'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'                    => array('slug' => 'vehicle-category'),
        'show_in_rest'               => true,
    );

    register_taxonomy('vehicle_category', array('vehicle'), $args);
}
add_action('init', 'cpfauto_register_vehicle_category_taxonomy', 0);

/**
 * Register Vehicle Tags Taxonomy
 */
function cpfauto_register_vehicle_tag_taxonomy() {

    $labels = array(
        'name'                       => _x('Vehicle Tags', 'Taxonomy General Name', 'cpfauto'),
        'singular_name'              => _x('Vehicle Tag', 'Taxonomy Singular Name', 'cpfauto'),
        'menu_name'                  => __('Tags', 'cpfauto'),
        'all_items'                  => __('All Tags', 'cpfauto'),
        'parent_item'                => __('Parent Tag', 'cpfauto'),
        'parent_item_colon'          => __('Parent Tag:', 'cpfauto'),
        'new_item_name'              => __('New Tag Name', 'cpfauto'),
        'add_new_item'               => __('Add New Tag', 'cpfauto'),
        'edit_item'                  => __('Edit Tag', 'cpfauto'),
        'update_item'                => __('Update Tag', 'cpfauto'),
        'view_item'                  => __('View Tag', 'cpfauto'),
        'separate_items_with_commas' => __('Separate tags with commas', 'cpfauto'),
        'add_or_remove_items'        => __('Add or remove tags', 'cpfauto'),
        'choose_from_most_used'      => __('Choose from the most used', 'cpfauto'),
        'popular_items'              => __('Popular Tags', 'cpfauto'),
        'search_items'               => __('Search Tags', 'cpfauto'),
        'not_found'                  => __('Not Found', 'cpfauto'),
        'no_terms'                   => __('No tags', 'cpfauto'),
        'items_list'                 => __('Tags list', 'cpfauto'),
        'items_list_navigation'      => __('Tags list navigation', 'cpfauto'),
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'                    => array('slug' => 'vehicle-tag'),
        'show_in_rest'               => true,
    );

    register_taxonomy('vehicle_tag', array('vehicle'), $args);
}
add_action('init', 'cpfauto_register_vehicle_tag_taxonomy', 0);

/**
 * Flush rewrite rules on theme activation
 */
function cpfauto_flush_rewrite_rules() {
    cpfauto_register_vehicle_post_type();
    cpfauto_register_vehicle_category_taxonomy();
    cpfauto_register_vehicle_tag_taxonomy();
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'cpfauto_flush_rewrite_rules');
