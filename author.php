<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package keleya
 */

get_header();
?>

    <section class="hero blog__nav">
        <div class="container-fluid">
            <?php the_category_navigation() ?>
        </div>


    </section>

<section class="section blog__section">
    <div class="container">
        <?php $post_id = 132; ?>
       <?php $fields = get_fields($post_id); ?>

        <div class="tile is-ancestor">
            <div class="tile is-7 is-vertical is-parent">
                <div class="tile is-child box content">
                    <?php
                    $obj = get_queried_object();

                    $posts = get_posts(array('category' => $obj->term, 'numberposts' => 2));


                    $post = get_post($posts[0]);

                    kel_show_post($post);

                    ?>



                </div>
                <div class="tile is-child box content">

                    <?php
                    $fields['bottom_left_post'];

                    //$post_bl = get_post($posts[1]);

                    kel_show_post($posts[1]);

                    ?>


                </div>
            </div>
            <div class="tile is-4 is-parent is-vertical needs-margin">
                <div class="tile is-child box about__box content">
                    <?php

                    get_blog_image($fields['top_right_image_hd'], $fields['top_right_image'], 'blog-overview');

                    echo $fields['top_right_description'];

                    ?>
                    <?php $link_arr = $fields['top_right_button_link'] ?>

                    <a class="button" href="<?= $link_arr['url'] ?>" title="<?= $link_arr['title'] ?>" target="<?= $link_arr['target']?>">
                        <?= $fields['top_right_button'] ?>
                    </a>

                    <?php ?>
                </div>

                <div class="tile is-child-box">

                    <div class="download__apps">

                        <?php $link_arr = $fields['app_button_link_left'];
                        if(!isset($link_arr['target'])) :
                            $link_arr['target'] = '_self';
                        endif;
                        ?>

                        <a href="<?= $link_arr['url'] ?>" title="<?= $link_arr['title'] ?>" target="<?= $link_arr['target']?>">
                            <?php
                            $sd = wp_get_attachment_image_src($fields['app_icon_left'], 'full', false );
                            ?>
                            <img src="<?= $sd[0] ?>" alt="<?= $fields['app_button_text_left'] ?>">
                        </a>

                        <?php $link_arr = $fields['app_button_link_right'];

                        if($link_arr['target'] == '') :

                            $link_arr['target'] = '_self';
                        endif;

                        ?>
                        <a href="<?= $link_arr['url'] ?>" title="<?= $link_arr['title'] ?>" target="<?= $link_arr['target']?>">
                            <?php
                            $sd = wp_get_attachment_image_src($fields['app_icon_right'], 'full', false );
                            ?>
                            <img src="<?= $sd[0] ?>" alt="<?= $fields['app_button_text_right'] ?>">

                        </a>

                    </div>
                </div>

                <div class="tile is-child box insta-box">

                <h3 class="insta__title"><?= $fields['instagram_title'] ?></h3>
                    <span class="underline"></span>

                <?php echo do_shortcode('[instagram-feed showheader=false showbio=false showcaption=false showlikes=false showbutton=false num=6 cols=2 showfollow=false layout=grid imagepadding=0 imagepaddingunit="px"]' )
 ?>

                </div>
            </div>
        </div>

    </div>
</section>

<section class="section">

    <div class="container">
        <div class="newsletter__box content">

            <h2 class="text__underline newsletter__title"><?= $fields['newsletter_title'] ?></h2>

            <p>
            <?= $fields['newsletter_description'] ?>
            </p>
            <?php echo do_shortcode('[mc4wp_form id="34"]'); ?>
        </div>

    </div>
</section>

<section class="section blog__articles">
    <div class="container">
    <?php the_blog_posts(); ?>
    </div>
</section>

<?php
get_footer();
