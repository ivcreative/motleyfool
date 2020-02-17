<?php
/* ========================================================================================================================

  Creating a function to create our custom post types

  ======================================================================================================================== */

  function foolish_post_type() {




    /*
     * Stock Recommendation
     */
    $args = array(
    	'label'        => __('Stocks Recommendations', 'foolishtest'),
    	'description'  => __('Stock Recommendations section', 'foolishtest'),
    	'labels'       => array(
    		'name'                => _x('Stock Recommendation', 'foolishtest'),
    		'singular_name'       => _x('Stock Recommendation', 'foolishtest'),
    		'menu_name'           => __('Stock Recommendations', 'foolishtest'),
    		'parent_item_colon'   => __('Stock Recommendation Locations', 'foolishtest'),
    		'all_items'           => __('Stocks Recommendations', 'foolishtest'),
    		'view_item'           => __('View Stock Recommendation', 'foolishtest'),
    		'add_new_item'        => __('Add New Stock Recommendation', 'foolishtest'),
    		'add_new'             => __('Add New', 'foolishtest'),
    		'edit_item'           => __('Edit Stock Recommendation', 'foolishtest'),
    		'update_item'         => __('Update Stock Recommendation', 'foolishtest'),
    		'search_items'        => __('Search for a Stock Recommendation', 'foolishtest'),
    		'not_found'           => __('Not Found', 'foolishtest'),
    		'not_found_in_trash'  => __('Not found in Trash', 'foolishtest'),
    	),
    	'supports' => array('title', 'editor', 'author', 'excerpt', 'thumbnail', 'revisions', 'custom-fields',),
    	"rewrite" => array('slug' => 'stock-recommendation', 'with_front' => true),
    	'taxonomies' => array(),
    	'hierarchical' => true,
    	'public'               => true,
    	'show_ui'              => true,
    	'show_in_menu'         => true,
    	'show_in_nav_menus'    => true,
    	'show_in_admin_bar'    => true,
    	'menu_position'        => 20,
    	'menu_icon'            => 'dashicons-chart-area',
    	'can_export'           => true,
    	'has_archive'          => true,
    	'exclude_from_search'  => false,
    	'publicly_queryable'   => true,
    	'capability_type'      => 'post',
    );
    register_post_type('fool_stocks', $args);

    

    
}

/* Hook into the 'init' action so that the function
 * Containing our post type registration is not 
 * unnecessarily executed. 
 */

add_action('init', 'foolish_post_type', 0);

/* ========================================================================================================================

 * Lets add some taxonomies
 * Taxonomies are like  Foolish categories :)

  ======================================================================================================================== */
  function add_foolish_taxonomies() {

    register_taxonomy('ticker', [ 'post', 'fool_stocks' ], array(
        // Hierarchical taxonomy (like categories)
        'hierarchical'      => true, // true category false tags
        // This array of options controls the labels displayed in the WordPress Admin UI
        'labels'            => array(
            'name'          => _x('Tickers', 'foolishtest'),
            'singular_name' => _x('Ticker', 'foolishtest'),
            'search_items'  => __('Tickers', 'foolishtest'),
            'all_items'     => __('All Tickers', 'foolishtest'),
            'edit_item'     => __('Edit Ticker', 'foolishtest'),
            'update_item'   => __('Update Ticker', 'foolishtest'),
            'add_new_item'  => __('Add New Ticker', 'foolishtest'),
            'new_item_name' => __('New Ticker', 'foolishtest'),
            'menu_name'     => __('Ticker', 'foolishtest'),
        ),
        // Control the slugs used for this taxonomy
        'rewrite'           => array(
            //'slug' => 'goverment_type', // This controls the base slug that will display before each term
            'with_front'    => false, // Don't display the category base before "/locations/"
            'hierarchical'  => true, // This will allow URL's like "/locations/boston/cambridge/"
        ),
        'show_in_rest'      => true
    ));

    register_taxonomy('company_tag', [ 'post', 'fool_stocks', 'page' ], array(
        // Hierarchical taxonomy (like categories)
        'hierarchical'      => true, // true category false tags
        // This array of options controls the labels displayed in the WordPress Admin UI
        'labels'            => array(
            'name'          => _x('Company API name', 'foolishtest'),
            'singular_name' => _x('Company API name', 'foolishtest'),
            'search_items'  => __('Company API name', 'foolishtest'),
            'all_items'     => __('All Companies API name', 'foolishtest'),
            'edit_item'     => __('Edit Company API name', 'foolishtest'),
            'update_item'   => __('Update Company API name', 'foolishtest'),
            'add_new_item'  => __('Add New Company API name', 'foolishtest'),
            'new_item_name' => __('New Company API name', 'foolishtest'),
            'menu_name'     => __('Company API', 'foolishtest'),
        ),
        // Control the slugs used for this taxonomy
        'rewrite'           => array(
            //'slug' => 'goverment_type', // This controls the base slug that will display before each term
            'with_front'    => false, // Don't display the category base before "/locations/"
            'hierarchical'  => true, // This will allow URL's like "/locations/boston/cambridge/"
        ),
        'description'       => __('Use these tags to relate a company to an article.', 'foolishtest'),
        'show_in_rest'      => true
    ));

}
add_action('init', 'add_foolish_taxonomies', 0);