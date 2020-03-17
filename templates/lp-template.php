<?php
/*
Template Name: LP Template
*/



get_header();
?>

<section class="section offer__section top__section">

        <div class="container">
            <div class="columns is-vcentered">

                <div class="column offer__image">
                <?php the_field('section_1_video') ?>
                </div>

                <div class="column content">
                    <h3 class="main-color"><?php the_field('section_1_header') ?></h3>
                    <?php kel_get_text('section_1_text') ?>

                    <div class="app-icons">

                        <h5><?php the_field('section_1_cta') ?></h5>
                        <div class="flex-row get-app-icons">
                            <?php get_app_icons() ?>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        </div>

    </section>


<section class="section offer__section turquiose">
    <div class="container">
        <div class="columns is-vcentered">
            <div class="column content">
                <h3><?php the_field('section_2_header') ?></h3>
                <?php kel_get_text('section_2_text') ?>

                <div class="big-list">
                    <?php kel_get_big_list('section_2_the_list', 'section_2_list') ?>
                </div>
            </div>


            <div class="column offer__image">
                <?php the_image_tag('section_2_image_hd', 'section_2_image', 'app-image-double'); ?>
            </div>
        </div>

    </div>
    </div>

</section>

<section class="section offer__section white">
        <div class="container">
            <div class="columns is-vcentered">



                <div class="column offer__image">
                    <?php the_image_tag('section_3_image_hd', 'section_3_image', 'app-image-double'); ?>
                </div>

                <div class="column content">
                    <h3 class="main-color"><?php the_field('section_3_header') ?></h3>
                    <?php kel_get_text('section_3_text') ?>

                    <div class="big-list">
                        <?php kel_get_big_list('section_3_the_list', 'section_3_list') ?>
                    </div>
                </div>
            </div>

        </div>
        </div>

    </section>

<section class="section offer__section turquiose">
<div class="container">
<div class="columns custom-columns is-vcentered is-multiline">
    <div class="column is-12 content">
        <h2 class="has-text-centered black mt-3">
            <?php the_field('section_4_title') ?>
        </h2>
        <span class="underline"></span>
    </div>
    <div class="column content review-column">

        <?php kel_get_reviews('reviews') ?>

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


<?php



get_footer();

