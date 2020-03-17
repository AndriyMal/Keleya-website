<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package keleya
 */

get_header();
?>

    <section class="hero hero-alt page-404">


        <div class="is-overlay overlay__vertical overlay__404 has-text-centered">
            <div class="content">
            <h4><?php the_field('404_title', 'option'); ?></h4>

            <?php the_field('404_text', 'option'); ?>
            </div>
        </div>


        <?php
        $arr = get_field('404_image', 'option');

        $arr = array(
                'hd' => $arr['url'],
                'sd' => $arr['sizes']['hero-image'],
                'mob' => $arr['sizes']['about-footer-mobile'],
                'alt' => $arr['alt']
        );

        $sizes = array(
                'width' => '1440',
                'height' => '700',
                'mobile_width' => '460',
                'mobile_height' => '560'
        );

        any_image_tag($arr, $sizes, '404-page');

        ?>


    </section>
<?php
get_footer();
