<?php
/*
Template Name: Jobs Template
*/



get_header();
?>

<section class="hero hero-image">


    <div class="hero-body is-paddingless">
        <div class="content overlay__vertical overlay__intro">
            <h1 class="hero-title">
                <?php the_field('section_title') ?>
            </h1>
        </div>
        <?php the_image_tag('hero_image_hd', 'hero_image', 'hero-image'); ?>



    </div>

</section>


<section class="section white">
    <div class="container">

        <div class="content">

            <h2 class="has-text-left is-underlined"><?php the_field('section_title'); ?></h2>

            <?php the_field('section_description') ?>

        </div>

    </div>


</section>

<section class="section turquiose jobs__section">
    <div class="container">
    <?php


    // starting the jobs loop.. pulling the repeater field from the CFs

    $key = 'jobs';

    if( have_rows($key) ): ?>


        <div class="jobs columns is-multiline">

            <?php $index = 0 ?>


            <?php while( have_rows($key) ): the_row(); ?>

            <?php $index++; ?>

            <div class="column job__col is-6" onClick="">
                <div class="job__col__inner job job__link" data-target="modal-<?= $index ?>">
                    <h4>
                        <?php the_sub_field('title'); ?>
                    </h4>
                    <p>
                        <?php the_sub_field('start_date'); ?>
                    </p>
                </div>

            </div>


           <?php endwhile; ?>

        </div>

    <?php endif;


    ?>
    </div>
</section>

<section class="hero hero-image hero-alt">

    <?php the_image_tag('bottom_image_hd', 'bottom_image_mobile', 'about-footer') ?>

    <div class="content overlay__vertical overlay__footer">
        <h2 class="has-text-centered">
            <?php the_field('bottom_title'); ?>
        </h2>

        <?php $link_arr = get_field('bottom_button_link');

        if(empty($link_arr['target'])) :
            $link_arr['target'] = "_self";
        endif;
        ?>


        <a class="button is-primary is-large open-general-form" href="<?= $link_arr['url'] ?>" title="<?= $link_arr['title'] ?>" target="<?= $link_arr['target']?>">
            <?php the_field('bottom_button') ?>
        </a>
    </div>

</section>


<?php

if( have_rows($key) ):

$index = 0;

while( have_rows($key) ): the_row();

   $index++; ?>

    <div class="modal job__modal" id="modal-<?= $index ?>">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">


                <button class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body content white">
                <div itemscope itemtype="http://schema.org/JobPosting">
                <h2 itemprop="title" class="modal-card-title job-title">
                    <?php the_sub_field('title'); ?>
                </h2>

                <div class="job__meta">
                <p><?php the_sub_field('start_date') ?></p>
                <p><span itemprop="jobLocation" itemscope itemtype="http://schema.org/Place">
                        <span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                            <span itemprop="addressLocality"><?php the_sub_field('location_city') ?></span>
                            <?php the_sub_field('location_country') ?>
                        </span></span></p>
                </div>

                <div itemprop="description">
                    <?= get_sub_field('description') ?>
                </div>

                    <span class="underline turquiose"></span>

                <div class="has-text-centered is-cta-text">
                <?php the_sub_field('action_text') ?>
                </div>

                <?php $link_arr = get_sub_field('cta_button_link');
                      $rand =  rand(0,100);
                ?>
                <div class="has-text-centered">
                    <a class="button is-large is-primary open-form" data-id="form-<?= $rand ?>" href="#" title="<?= $link_arr['title'] ?>" target="<?= $link_arr['target']?>">
                        <?php the_sub_field('cta_button_text') ?>
                    </a>
                </div>
                    <div class="has-form" id="form-<?= $rand ?>" data-job="<?php the_sub_field('title'); ?>">
                        <span class="close-form" data-id="form-<?= $rand ?>"></span>
                        <?php echo do_shortcode('[contact-form-7 id="'.get_sub_field('form').'" title=""]') ?>
                    </div>
                </div>

            </section>

        </div>
    </div>

<?php endwhile;

endif;

get_general_application_form();

get_footer();

