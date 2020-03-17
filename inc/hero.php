<?php
/**
 Hero Images / Slider is generated here
 */



function kel_load_hero(){

    //echo do_shortcode('[rev_slider alias="home"]');

            //$slide = first_slide();


?>
        <div class="banners">

            <?php echo do_shortcode(get_field('hero_banner')); ?>

        </div>

<?php
}
function kel_load_video(){
    ?>



    <?php

    echo do_shortcode('[rev_slider alias="home-image"]');

    //the_sub_field('video');

}

function kel_load_extra_banner(){
    the_sub_image_tag('hero_image_hd', 'hero_image', 'hero-image');
    ?>

    <div class="is-overlay content banner__overlay">
        <h2>
            <?php the_sub_field('hero_title'); ?>
        </h2>

        <h3>
            <?php the_sub_field('hero_description'); ?>
        </h3>

        <div class="app__bar">
            <?php $link_arr = get_field('app_icon_left_link');
            if(!isset($link_arr['target'])) :
                $link_arr['target'] = '_self';
            endif;
            ?>

            <a href="<?= $link_arr['url'] ?>" title="<?= $link_arr['title'] ?>" target="<?= $link_arr['target']?>">
                <?php get_images('app_icon_left', 'app_icon_left'); ?>
            </a>

            <?php $link_arr = get_field('app_icon_right_link');

            if($link_arr['target'] == '') :

                $link_arr['target'] = '_self';
            endif;

            ?>


            <a href="<?= $link_arr['url'] ?>" title="<?= $link_arr['title'] ?>" target="<?= $link_arr['target']?>">
                <?php
                get_images('app_icon_right', 'app_icon_right');
                ?>

            </a>

        </div>
    </div>

    <?php

}


function kel_load_review(){




// we need the optimus plugin, it will generate webp images automagically

    the_sub_image_tag('hero_image_hd', 'hero_image', 'hero-image');
?>

<div class="is-overlay review__overlay">
    <div class="testimonial__header">
        <div class="blurred__bg" style="background-image:url(<?= get_stylesheet_directory_uri() . '/img/white-circle-blur.png'?>);">

        </div>

        <div class="testimonial__inner">

            <div class="quote__right">
                <img src="<?php echo get_template_directory_uri() . '/img/quote-right@2x.png' ?>" alt="testimonial" />
            </div>

            <div class="profile__image">
                <?php get_sub_images('review_image', 'review_image'); ?>
            </div>
            <div class="profile__info">
                <span><?php the_sub_field('review_title') ?></span>
            </div>
            <div class="profile__review">
                <p><?php the_sub_field('review') ?></p>
            </div>
            <div class="profile__rating">
                <?php show_rating(get_sub_field('rating')) ?>
            </div>
            <div class="quote__left">
                <img src="<?php echo get_template_directory_uri() . '/img/quote-right@2x.png' ?>" alt="testimonial" />
            </div>

        </div>


    </div>

    <div class="app__bar">

        <?php $link_arr = get_field('app_icon_left_link');
            if(!isset($link_arr['target'])) :
                $link_arr['target'] = '_self';
            endif;
        ?>

        <a href="<?= $link_arr['url'] ?>" title="<?= $link_arr['title'] ?>" target="<?= $link_arr['target']?>">
            <?php get_images('app_icon_left', 'app_icon_left'); ?>
        </a>

        <?php $link_arr = get_field('app_icon_right_link');

        if($link_arr['target'] == '') :

            $link_arr['target'] = '_self';
            endif;

        ?>


        <a href="<?= $link_arr['url'] ?>" title="<?= $link_arr['title'] ?>" target="<?= $link_arr['target']?>">
        <?php
           get_images('app_icon_right', 'app_icon_right');
            ?>
        </a>

    </div>


</div>
<?php
}

function kel_load_info(){
$data = [];

$data['hd'] = get_site_url() . '/wp-content/uploads/2018/12/dachterasse-yoga-707@2x.jpg';
$data['sd'] = get_site_url() . '/wp-content/uploads/2018/12/dachterasse-yoga-707.jpg';
$data['mob'] = get_site_url() . '/wp-content/uploads/2018/12/home_section_mobile.jpg';
$data['fallback'] = get_site_url() . '/wp-content/uploads/2018/12/dachterasse-yoga-707.jpg';
$data['alt'] = 'Receive stuff';

generate_image_tag($data);
}
