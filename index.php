<?php
/**
 * Plugin Name: Custom post 
 * Plugin URI: https://example.com
 * Description: This is Project Custom post type 
 * Version: 1.0.0
 * Author: Target Themes
 * Author URI: https://targetsoftbd.com
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: target-custom-post
 */

if ( ! defined( 'ABSPATH' ) ) {
    return;
}


class target_custom_post{
  
    public function __construct(){
        add_action('init', array( $this, 'init' ));
    }

    public function init(){

        register_post_type( 'services', array(
            'labels' => array(
                'name' => 'Services',
                'singular_name' => 'Service',
                'add_new_item' => 'Add New Service',
                'search_items' => 'Search Searvices',
                'view_item' => 'View Service',
                'not_found' => 'No Service Found',
            ),
            'public' => true,
            'show_in_rest' => true,
            'supports' => array( 'title', 'editor', 'page-attributes', 'thumbnail' ),
            'hierarchical' => true,
            // 'exclude_from_search' => true,
            // 'publicly_queryable' => false,
            'menu_position' => 8,
            'menu_icon' => 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBmaWxsPSIjZmZmIj48IS0tIUZvbnQgQXdlc29tZSBGcmVlIDYuNy4xIGJ5IEBmb250YXdlc29tZSAtIGh0dHBzOi8vZm9udGF3ZXNvbWUuY29tIExpY2Vuc2UgLSBodHRwczovL2ZvbnRhd2Vzb21lLmNvbS9saWNlbnNlL2ZyZWUgQ29weXJpZ2h0IDIwMjQgRm9udGljb25zLCBJbmMuLS0+PHBhdGggZD0iTTMuOSA1NC45QzEwLjUgNDAuOSAyNC41IDMyIDQwIDMybDQzMiAwYzE1LjUgMCAyOS41IDguOSAzNi4xIDIyLjlzNC42IDMwLjUtNS4yIDQyLjVMMzIwIDMyMC45IDMyMCA0NDhjMCAxMi4xLTYuOCAyMy4yLTE3LjcgMjguNnMtMjMuOCA0LjMtMzMuNS0zbC02NC00OGMtOC4xLTYtMTIuOC0xNS41LTEyLjgtMjUuNmwwLTc5LjFMOSA5Ny4zQy0uNyA4NS40LTIuOCA2OC44IDMuOSA1NC45eiIvPjwvc3ZnPg==',
            'has_archive' => true,
            'rewrite' => array( 'slug' => 'Services' ),
        ) );

        register_taxonomy( 'services_category', 'services', array(
            'labels' => array(
                'name' => 'Categories',
                'singular_name' => 'Category',
                'add_new_item' => 'Add New Category',
            ),
            'show_in_rest' => true,
            'hierarchical' => true,
            'rewrite' => array( 'slug' => 'Service-categories' ),
        ) );

        register_taxonomy( 'services_tags', 'services', array(
            'labels' => array(
                'name' => 'Tags',
                'singular_name' => 'Tag',
                'add_new_item' => 'Add New Tag',
            ),
            'show_in_rest' => true,
            'hierarchical' => false,
        ) );

    }


}

new target_custom_post();