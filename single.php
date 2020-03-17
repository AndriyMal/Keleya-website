
<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package keleya
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

            <div class="cover-image">
                <?php
                $title = get_the_title();
                echo '<h4 class="hero-text">'.$title.'</h4>';

                $attachment_id = get_post_thumbnail_id( $post_id );
                $hd = wp_get_attachment_image_src(  $attachment_id, ‘2024x768’,false );
                ?>

                <picture>
                <source media="(min-width: 56.25em)" data-srcset="<?= $hd[0] ?>" type="image/webp">
                    <source media="(min-width: 56.25em)" data-srcset="<?= $data['hd'] ?>">
                    ​<img class="lazy" data-src="<?= $hd[0] ?>" alt="<?= $data['alt'] ?>">

<!-- to do responsive   <source media="(min-width: 56.25em)" data-srcset="--><?//= $data['hdWebP'] ?><!--" type="image/webp">-->
<!--                    <source media="(min-width: 37.5em)" data-srcset="--><?//= $data['sdWebP'] ?><!--" type="image/webp">-->
<!--                    <source media="(min-width: 37.5em)" data-srcset="--><?//= $data['sd'] ?><!--">-->
<!--                    <!-- this the small one for mobile -->
<!--                    <source data-srcset="--><?//= $data['mobWebP'] ?><!--" type="image/webp">-->
<!--                    <!-- media="(max-width: 48em) and (orientation: portrait)" -->
<!--                    <source data-srcset="--><?//= $data['mob'] ?><!--">-->
<!--                    <img class="lazy" data-src="--><?//= $data['sd'] ?><!--" alt="--><?//= $data['alt'] ?><!-->
                </picture>
            </div>
            <section class="section">
                <div class="container">


<!--                    <div class="right-sidebar">-->
<!--                    --><?php //if ( is_active_sidebar( 'my-right-sidebar' ) ) : ?>
<!--                        --><?php //dynamic_sidebar( 'my-right-sidebar' );?>
<!--                    --><?php //endif; ?>
<!--                    </div>-->
                    <div class="left-sidebar">
                        <div class="go_back_btn">
                            <a href="javascript:void(0);" onclick="window.history.go(-1); return false;">
                                <i class="fas fa-chevron-left"></i>
                                <?php echo  _e('Go back'); ?>
                            </a>
                        </div>
                        <?php
                        get_sidebar();
                        ?>
                    </div>
                    <div class="go_back_btn m-only">
                        <a href="javascript:void(0);" onclick="window.history.go(-1); return false;">
                            <i class="fas fa-chevron-left"></i>
                            <?php echo _e('Go back'); ?>
                        </a>
                    </div>
                    <?php
                    while ( have_posts() ) :

                        the_post();

                        get_template_part( 'template-parts/content', get_post_type() );

                        //the_post_navigation();

                        // If comments are open or we have at least one comment, load up the comment template.


                    endwhile; // End of the loop.
                    ?>
                    <div class="columns is-centered">
                    <div class="column is-10">
                        <?php

                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;

                        ?>
                    </div>
                    </div>
                </div>
            </section>



            <section class="section content">
                <div class="container">
                 <?php echo'<h3 class="related__posts_header" id="related">Related Posts</h3><br><br>'; ?>
                    <div class="columns is-multiline">

    <?php $orig_post = $post;
    global $post;

    $categories = get_the_category($post->ID);
    if ($categories) {
        $category_ids = array();
        foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

        $args=array(
            'category__in' => $category_ids,
            'post__not_in' => array($post->ID),
            'posts_per_page'=> 3, // Number of related posts that will be shown.
            'caller_get_posts'=>1
        );

        $my_query = new wp_query( $args );
        if( $my_query->have_posts() ) {

            while( $my_query->have_posts() ) {
                $my_query->the_post();?>

            <div class="column is-full-mobile is-two-thirds-tablet is-one-third-desktop is-one-third-widescreen is-one-third-fullhd">

                <?php
                if ( has_post_thumbnail( $post->ID ) ) {
                    echo '<a class="blog__post" href="' . get_permalink( $post->ID ) . '" title="' . esc_attr( $post->post_title ) . '">';
                    get_image_by_post($post, 'blog-carousel', 'blog-carousel');
                };
                echo '</a>'; ?>

                <?php
                $title = get_the_title();
                echo '<h4 class="relatedTitle">'.$title.'</h4>';
                ?>
                <?php
                $excerpt = get_the_excerpt();
                echo '<h4 class="relatedDescription">'.$excerpt.'</h4>';
                ?>
            </div>
                    <?php
            }
        }
    }
    $post = $orig_post;
    wp_reset_query(); ?>

                    </div>
                </div>
            </section>





		</main><!-- #main -->
	</div><!-- #primary -->


<?php

//floating_app_buttons();

get_footer();

