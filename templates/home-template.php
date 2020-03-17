<?php
/*
Template Name: HomePage Template
*/



get_header();
?>

<section class="hero hero-image">
    <?php kel_load_hero() ?>
</section>

<section class="section offer__section cta-section">

        <div class="container">
            <div class="columns">
                <div class="column content">
                    <div class="content__inner__left">
                        <div class="content__head">
                            <h2><?php the_field('section_1_header') ?></h2>
                        </div>

                        <div class="big-list">
                            <?php kel_get_big_list('section_1_text', 'section_1_list') ?>
                        </div>


                        <div class="app-info">
                            <div class="app-icons">

                                <h5><?php the_field('section_1_cta') ?></h5>
                                <div class="flex-row get-app-icons">
                                    <?php get_app_icons() ?>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="column offer__image"
                         data-aos="fade-up"
                         data-aos-offset="0"
                         data-aos-anchor=".page-template"
                         data-aos-delay="250"
                         data-aos-duration="1500"
                         data-aos-once="true"
                         data-aos-anchor-placement="top-top"
                    >

                        <div class="align__right">
                            <?php
                            the_image_tag('section_1_image_hd', 'section_1_image_hd', 'app-image'); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
<section class="section offer__section turquiose">
    <div class="container">
        <div class="columns custom-columns is-vcentered">
            <div class="column larger-image"
                 data-aos="slide-right"
                 data-aos-offset="0"
                 data-aos-delay="250"
                 data-aos-duration="1500"
                 data-aos-once="true">
                <?php the_image_tag('section_2_image_hd', 'section_2_image', 'app-image-double'); ?>
            </div>


            <div class="column content">
                <div class="content__inner__right">
                <div class="content__head">
                    <h3><?php the_field('section_2_header') ?></h3>
                    <div class="icons-svg">
                    <span><?= kel_inline_svg(get_field('section_2_icon')); ?></span>
                    <span><?= kel_inline_svg(get_field('section_2_icon_extra')); ?></span>
                    </div>
                </div>
                <?php kel_get_text('section_2_text') ?>


                <?php get_button(get_field('section_2_cta'), 'button-regular') ?>


                </div>
            </div>

        </div>
    </div>

</section>

<section class="section offer__section white">
<div class="container">
<div class="columns custom-columns is-vcentered">
    <div class="column content">
        <div class="content__inner__left">
            <div class="content__head">
                <h3><?php the_field('section_3_header') ?></h3>
                <span class="has-text-centered icon-svg"><?= kel_inline_svg(get_field('section_3_icon')); ?></span>
            </div>
            <?php kel_get_text('section_3_text') ?>

            <?php get_button(get_field('section_3_cta'), 'button-regular') ?>
        </div>
    </div>

    <div class="column offer__image"
         data-aos="slide-left"
         data-aos-offset="0"
         data-aos-delay="250"
         data-aos-duration="1500"
         data-aos-once="true">

        <?php the_image_tag('section_3_image_hd', 'section_3_image', 'app-image'); ?>
    </div>

</div>
</div>

</section>


<section class="section turquiose unique__women">
<div class="container">
<div class="columns is-multiline">

   <div class="column is-12 content">


       <h2 class="has-text-centered">
           <?php the_field('section_4_title') ?>
       </h2>
       <span class="underline"></span>
   </div>

    <div class="column is-6 image-col" data-aos="slide-right"
         data-aos-offset="0"
         data-aos-delay="250"
         data-aos-duration="1500"
         data-aos-once="true">
        <?php the_image_tag('section_4_image_hd', 'section_4_image', 'large'); ?>
        <div class="is-size-5 has-text-centered"><?php the_field('section_4_founders_names') ?></div>
        <div class="has-text-centered light-font"><?php the_field('section_4_founders_position') ?></div>
    </div>

    <div class="column is-6 content">

        <?php kel_get_text('section_4_text') ?>

        <?php get_button(get_field('section_4_cta'), 'button-regular') ?>

    </div>
</div>
</div>

</section>

<section class="section white">

<div class="container">
<div class="columns is-multiline">
<div class="column is-12 content">
    <h2 class="has-text-centered black">
        <?php the_field('section_5_title') ?>
    </h2>
    <span class="underline"></span>
</div>
<div class="column">
    <?php kel_get_carousel() ?>
</div>
</div>
</div>
</section>

<section class="section turquiose">
    <div class="container">
        <div class="columns custom-columns is-vcentered is-multiline">
            <div class="column is-12 content">
                <h2 class="has-text-centered black mt-3">
                    <?php the_field('review_title') ?>
                </h2>
                <span class="underline"></span>
            </div>
            <div class="column content review-column">

                <?php kel_get_reviews('reviews') ?>

            </div>

        </div>
    </div>

</section>

<section class="hero newsletter__section newsletter-block">
    <div class="is-overlay overlay__bg is-mobile"></div>
<div class="is-overlay">
<div class="">
<div class="custom-container">

<div class="content">
    <h2>
        <?php the_field('section_6_title') ?>
    </h2>
    <span class="underline"></span>

    <?php kel_get_list('newsletter_text', 'list') ?>

    <a class="button is-primary is-large open-newsletter" href="#">
        <?php the_field('blog_newsletter_button', 'option') ?>
    </a>

    <?php //echo do_shortcode(get_field('newsletter_form')); ?>


</div>

</div>
</div>
</div>
<div class="banner">
    <?php
    the_image_tag('newsletter_image_hd', 'newsletter_image', 'newsletter-image');
    ?>
</div>

</section>


<?php



get_footer();

