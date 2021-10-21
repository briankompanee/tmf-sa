<?php

namespace App;

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});

/**
 * Template Hierarchy should search for .blade.php files
 */
collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment', 'embed'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});

/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    collect(['get_header', 'wp_head'])->each(function ($tag) {
        ob_start();
        do_action($tag);
        $output = ob_get_clean();
        remove_all_actions($tag);
        add_action($tag, function () use ($output) {
            echo $output;
        });
    });
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);

/**
 * Render comments.blade.php
 */
add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory().'/index.php';
    }

    return $comments_template;
}, 100);


/**
 * Local JSON for ACF - json save location
 * https://www.advancedcustomfields.com/resources/local-json/
 */
add_filter('acf/settings/save_json', __NAMESPACE__.'\\wfm_acf_json_save_point');
 
function wfm_acf_json_save_point( $path ) {
    
    $path = get_stylesheet_directory() . '/acf-json-sync';
    return $path;
    
}

/**
 * Local JSON for ACF - json load location
 * https://www.advancedcustomfields.com/resources/local-json/
 */
add_filter('acf/settings/load_json', __NAMESPACE__.'\\wfm_acf_json_load_point');

function wfm_acf_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    $paths[] = get_stylesheet_directory() . '/acf-json-sync';
    return $paths;
    
}

/**
 * Hide Taxonomy Meta Boxes from the WordPress Editor Sidebar in Gutenberg
 * https://github.com/WordPress/gutenberg/issues/13816#issuecomment-470137667
 */
add_filter( 'rest_prepare_taxonomy', __NAMESPACE__.'\\remove_taxonomy_from_editor_sidebar', 10, 3 );

function remove_taxonomy_from_editor_sidebar( $response, $taxonomy, $request ){

	$context = ! empty( $request['context'] ) ? $request['context'] : 'view';

	// Context is edit in the editor
	if( $context === 'edit' && $taxonomy->meta_box_cb === false ){
		$data_response = $response->get_data();
		$data_response['visibility']['show_ui'] = false;
		$response->set_data( $data_response );
	}

	return $response;
}

/**
 * Disable canonical redirect for custom post type to get pagination work
 * https://core.trac.wordpress.org/ticket/15551
 */
add_filter( 'redirect_canonical', __NAMESPACE__.'\\custom_disable_redirect_canonical' );

function custom_disable_redirect_canonical( $redirect_url ){

    if ( is_singular('company') ) $redirect_url = false;

    return $redirect_url;
}
