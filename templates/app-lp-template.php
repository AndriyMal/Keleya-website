<?php
/*
Template Name: APP LP Template
*/



get_header();
?>

<section class="section offer__section top__section turquiose">

        <div class="container">
            <div class="columns is-vcentered">

                <div class="column content newsletter-info">
                    <?php the_field('newsletter_info') ?>

                    <?php echo do_shortcode(''.get_field('form').'') ?>
                </div>

                <div class="column content">
                    <?php the_field('content') ?>
                </div>
            </div>

        </div>
        </div>

</section>



<?php



get_footer();

