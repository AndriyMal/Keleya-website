<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package keleya
 */



    echo '<div class="column is-4">';

    global $post;

    if ( has_post_thumbnail( $post->ID ) ) {
        echo '<a class="blog__post" href="' . get_permalink( $post->ID ) . '" title="' . esc_attr( $post->post_title ) . '">';

        $overview_image = get_field('blog_overview_image', $post->ID);
        if($overview_image) :
            $r = wp_get_attachment_image_src( $overview_image, 'full');
            $alt = get_post_meta( $overview_image, '_wp_attachment_image_alt', true);
            ?>
            <img class="lazy" data-src="<?= $r[0] ?>" alt="<?= $alt ?>">
        <?php
        else :
            get_image_by_post($post, 'blog-carousel', 'blog-carousel');
        endif;

        ?>
        <span class="overlay__post overlay__vertical button is-outlined">

        <?php _e('Read More', 'keleya'); ?>
        </span>
        <?php

        echo '</a>';
    };

    echo '<h3>';

    echo get_the_title($post);

    echo '</h3>';

    echo '</div>';

