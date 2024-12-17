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

        add_filter( 'manage_services_posts_columns', array( $this, 'add_custome_column_in_services' ) );
        add_action( 'manage_services_posts_custom_column', array( $this, 'manage_services_posts_custom_column' ), 10, 2 );


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
            'menu_position' => 15,
            'menu_icon' => 'dashicons-id',
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

    
    public function add_custome_column_in_services(  $columns  ){

        $columns[ 'cate' ] = 'Categorys';
        $columns[ 'tags' ] = 'Tags';

         return $columns;
    }

    public function manage_services_posts_custom_column(  $column_name,  $post_id  ){
       
        if( 'cate' == $column_name ){

            $terms = wp_get_post_terms( $post_id, 'services_category' );
            $terms_name = array_map(function( $term ){
                // return $term->name;
                return '<a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';
            }, $terms);

            echo implode( ', ', $terms_name );
        
        }

        if( 'tags' == $column_name ){

           echo  $terms = wp_get_post_tags( $post_id, 'services_tags' );
            $terms_name = array_map(function( $term ){
                // return $term->name;
                return '<a href="' . esc_url( get_term_link( $term ) ) . '">' . esc_html( $term->name ) . '</a>';
            }, $terms);

            echo implode( ', ', $terms_name );
        
        }
        
       

    }

}

new target_custom_post();