<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller {

    public function siteName() {
        return get_bloginfo('name');
    }

    public static function title() {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }
        return get_the_title();
    }

    public function primaryMenu() {
        $args = array(
            'theme_location'    => 'primary_navigation',
            'menu_class'        => 'navbar-nav mr-auto',
            'container'         => '',
            'walker'            => new \App\wp_bootstrap4_navwalker(),
        );
        return $args;
    }

    public function featuredImg() {

        $post_id = get_queried_object_id();

        if ( has_post_thumbnail( $post_id ) ) {

            $thumb_id        = get_post_thumbnail_id( $post_id );
            $thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'large', TRUE );

            return (object) array(

                'large_size'  => $thumb_url_array[0],
                'full_size'   => wp_get_original_image_url( $thumb_id ),
                'alt'         => get_post_meta( $thumb_id, '_wp_attachment_image_alt', TRUE ),
                'title'       => get_the_title( $thumb_id ),
            
            );

        } else {

            return;
       }
    }

}