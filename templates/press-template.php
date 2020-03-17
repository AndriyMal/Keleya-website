<?php
/*
Template Name: Press Template
*/


get_header();

?>

<section class="hero hero-image">
    <div class="hero-body is-paddingless">
        <div class="content overlay__vertical overlay__intro">
            <h1 class="hero-title">
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

<section class="section turquiose press__section">
    <div class="container">

        <div class="content">
            <h2 class="has-text-centered"><?php the_field('press_title'); ?></h2>
            <span class="press__underline"></span>
        </div>

    <?php


    // starting the jobs loop.. pulling the repeater field from the CFs

    $key = 'press';

    if( have_rows($key) ): ?>


        <div class="press__columns columns is-multiline">

            <?php $index = 0 ?>


            <?php while( have_rows($key) ): the_row(); ?>

            <?php $index++; ?>

            <div class="column press__col is-6">
                <div class="press__inner">
                <?php $link_arr = get_sub_field('cta_button_link'); ?>
                <a class="press press__link" href="<?= $link_arr['url'] ?>" title="<?= $link_arr['title'] ?>" target="<?= $link_arr['target']?>">

                    <h4>
                        <?php the_sub_field('title'); ?>
                    </h4>
                    <p>
                        <?php the_sub_field('date'); ?>
                    </p>

                    <span><?php the_sub_field('cta_button_text') ?>
                    </span>

                    <div class="press__hover">
                        <?php the_sub_field('description'); ?>
                    </div>
                </a>

                </div>
            </div>


           <?php endwhile; ?>

        </div>

    <?php endif;


    ?>
    </div>
</section>


<section class="section white press__items__section">
    <div class="container">

        <div class="content">

            <h2 class="has-text-centered">
                <?php the_field('bottom_title') ?>
            </h2>
            <span class="press__underline"></span>
        </div>
        <?php


        // starting the jobs loop.. pulling the repeater field from the CFs

        $key = 'press_items';

        if( have_rows($key) ): ?>


            <div class="press__items columns is-multiline is-vcentered">

                <?php $index = 0 ?>


                <?php while( have_rows($key) ): the_row(); ?>

                    <?php $index++; ?>

                    <?php if($index > 5) : ?>

                    <div class="column is-3 is-only-centered press-item-<?= $index ?>">
                        <?php $link_arr = get_sub_field('link'); ?>
                            <a class="" href="<?= $link_arr['url'] ?>" title="<?= $link_arr['title'] ?>" target="<?= $link_arr['target']?>">
                                <?php the_sub_image_tag('image','image', 'press-item') ?>
                            </a>

                    </div>

                    <?php else : ?>

                        <div class="column is-2">
                            <?php $link_arr = get_sub_field('link'); ?>
                            <a class="" href="<?= $link_arr['url'] ?>" title="<?= $link_arr['title'] ?>" target="<?= $link_arr['target']?>">
                                <?php the_sub_image_tag('image','image', 'press-item') ?>
                            </a>

                        </div>

                    <?php endif; ?>


                <?php endwhile; ?>

            </div>

        <?php endif;


        ?>
    </div>
</section>

<?php get_footer();

