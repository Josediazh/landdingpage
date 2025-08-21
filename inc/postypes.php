<?php
add_action( 'init', 'create_post_type' );
function create_post_type()
{
    register_post_type('Galeria',
        array(
            'labels' => array(
                'name' => __('Galeria'),
                'singular_name' => __('Galeria')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title','thumbnail'),
            'menu_icon' => 'dashicons-format-gallery',
        )
    );

    register_post_type('Testimonial',
        array(
            'labels' => array(
                'name' => __('Testimonial'),
                'singular_name' => __('Testimonial')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title','editor','thumbnail'),
            'menu_icon' => 'dashicons-testimonial',
        )
    );
}

?>