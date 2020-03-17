<?php
/*
Template Name: About Template
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

<?php
    $key = 'co_founders';

    if( have_rows($key) ): ?>
        <?php $index = 0 ?>
        <?php while( have_rows($key) ): the_row(); ?>

                    <?php //TODO make it check for numbers divisible by 2 And 0
                    if($index == 0 || $index == 2 || $index == 4) : ?>
                        <section class="section turquiose <?= $index ?>">
                            <div class="container">
                            <div class="columns cofounders">


                                      <div class="column is-3">

                                    <?php the_sub_image_tag('image_hd', 'image', 'about-founders') ?>

                                </div>

                                <div class="column is-9">
                                    <div class="cofounder__inner__right">

                                    <div class="cofounders__name">
                                        <?php the_sub_field('name') ?>
                                    </div>
                                    <div class="cofounders__position">
                                        <?php the_sub_field('position') ?>
                                    </div>
                                    <div class="cofounders__description">

                                        <?php kel_get_sub_text('description'); ?>
                                    </div>
                                    </div>

                                </div>

                            </div>
                            </div>
                        </section>
                    <?php else : ?>
                        <section class="section white">
                            <div class="container">
                    <div class="columns cofounders">

                        <div class="column is-9">
                            <div class="cofounder__inner__left">

                            <div class="cofounders__name">
                                <?php the_sub_field('name') ?>
                            </div>
                            <div class="cofounders__position">
                                <?php the_sub_field('position') ?>
                            </div>
                            <div class="cofounders__description">
                                <?php kel_get_sub_text('description'); ?>
                            </div>
                            </div>





                        </div>

                        <div class="column is-3">

                            <?php the_sub_image_tag('image_hd', 'image', 'about-founders') ?>

                        </div>
                    </div>
                            </div>
                    </section>
                    <?php endif; ?>
            <?php $index++; ?>
        <?php endwhile; ?>


    <?php endif;


?>

 <?php $key = 'team';

        if( have_rows($key) ): ?>

<section class="section turquiose">
    <div class="container">
        <div class="columns is-multiline team">
   <?php
            while( have_rows($key) ): the_row(); ?>


        <div class="column is-4">
            <div class="team__image">
                <?php the_sub_image_tag('image', 'image_hd', 'about-team'); ?>
            </div>

            <div class="team__name"><?php the_sub_field('name') ?></div>
            <div class="team__position"><?php the_sub_field('position') ?></div>

        </div>

            <?php endwhile; ?>


        </div>
    </div>
</section>
        <?php endif; ?>

<?php if(get_field('bottom_section_title')) : ?>
<section class="hero hero-image hero-alt">

        <?php the_image_tag('bottom_section_image_hd', 'bottom_section_image', 'about-footer') ?>

        <div class="content overlay__vertical overlay__footer">
            <h2 class="has-text-centered">
                <?php the_field('bottom_section_title'); ?>
            </h2>

            <?php $link_arr = get_field('bottom_section_button_link');

            if(empty($link_arr['target'])) :
                $link_arr['target'] = "_self";
                endif;
            ?>

            <a class="button is-primary is-large" href="<?= $link_arr['url'] ?>" title="<?= $link_arr['title'] ?>" target="<?= $link_arr['target']?>">
                <?php the_field('bottom_section_button') ?>
            </a>
        </div>

</section>
<?php endif ?>






<?php
get_general_application_form();


get_footer();

