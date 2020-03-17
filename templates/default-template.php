<?php
/*
Template Name: Content Template
*/


get_header();

?>

<?php if(get_field('hero_image_hd')) : ?>

<section class="hero hero-image">
    <div class="container overlay__vertical overlay__intro">
    <div class="content">


        </div>

    </div>

    <?php the_image_tag('hero_image_hd', 'hero_image', 'hero-image'); ?>

</section>
<?php endif; ?>

<section class="section white">
    <div class="container">

        <div class="content">

            <div class="column">

            <div class="body-text">

                <h1 class="has-text-left is-underlined"><?php the_field('section_title'); ?></h1>
                <?php the_field('body_content') ?>
            </div>
            </div>

        </div>
    </div>
</section>


<?php get_footer();

