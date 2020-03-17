<?php
/*
Template Name: App Template
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
                            <?php the_field('app_info') ?>
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
                            $img = get_field('section_1_image');
                            $r = wp_get_attachment_image_src( $img['id'], 'full'); ?>

                            <img class="lazy" data-src="<?= $r[0] ?>" alt="keleya" width="250px" />
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
<section class="section offer__section turquiose">
    <div class="container">
        <div class="columns custom-columns is-vcentered">
            <div class="column offer__image"
                 data-aos="slide-right"
                 data-aos-offset="0"
                 data-aos-delay="250"
                 data-aos-duration="1500"
                 data-aos-once="true">
                <?php
                $img = get_field('section_2_image');
                $r = wp_get_attachment_image_src($img['id'], 'full');

                ?>

                <img class="lazy" data-src="<?= $r[0] ?>" alt="keleya" width="250px" />            </div>


            <div class="column content">
                <div class="content__inner__right">
                <div class="content__head">
                    <h3><?php the_field('section_2_header') ?></h3>

                    </div>
                </div>
                <?php kel_get_text('section_2_text') ?>

                <?php get_button(get_field('section_2_cta'), 'button-alt') ?>

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

        <?php
        $img = get_field('section_3_image');
        $r = wp_get_attachment_image_src( $img['id'], 'full'); ?>

        <img class="lazy" data-src="<?= $r[0] ?>" alt="keleya" width="250px" />
    </div>

</div>
</div>

</section>

<section class="section offer__section turquiose">
        <div class="container">
            <div class="columns custom-columns is-vcentered">
                <div class="column offer__image"
                     data-aos="slide-right"
                     data-aos-offset="0"
                     data-aos-delay="250"
                     data-aos-duration="1500"
                     data-aos-once="true">
                    <?php
                    $img = get_field('section_4_image');
                    $r = wp_get_attachment_image_src($img['id'], 'full');

                    ?>

                    <img class="lazy" data-src="<?= $r[0] ?>" alt="keleya" width="250px" />            </div>


                <div class="column content">
                    <div class="content__inner__right">
                        <div class="content__head">
                            <h3><?php the_field('section_4_header') ?></h3>

                        </div>
                    </div>
                    <?php kel_get_text('section_4_text') ?>

                    <?php get_button(get_field('section_4_cta'), 'button-alt') ?>

                </div>
            </div>

        </div>
        </div>

    </section>

<?php



get_footer();

