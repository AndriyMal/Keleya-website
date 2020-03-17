<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package keleya
 */

get_header();

$fields = get_fields();
global $wp_query;
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

?>


<section class="hero blog__nav">
    <div class="hero-body">

        <div class="blogCategoriesContainer">
            <?php    $slugs = explode('/', get_query_var('category_name'));
            $currentCategory = get_category_by_slug('/'.end($slugs));
          echo '<h1 class="title is-1 is-spaced ">'.$currentCategory->name.'</h1>';


            ?>
            <div class="blogCategories">

        <?php  $categories= get_field('categories_magazine', 'option');
        foreach($categories as $category) {

            echo '<a class="cat-button" href="'.get_category_link( $category ).'">'.$category->name.'</a>';

        }
        ?>
        <?php echo get_search_form(); ?>
        </div>
        </div>
    </div>
</section>
<section class="section blog-wrappers">
    <div class="width-wrapper category-wrapper">
        <div class="columns is-multiline">



            <?php

            if(is_category()) :
                $obj = get_queried_object();

                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'category_name' => $currentCategory->slug,
                    'posts_per_archive_page' => 9,
                    'post_per_page' => $post_page,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'paged' => $paged,
                    'caller_get_posts'=> 1,
                    'tax_query' => array(
                        array (
                            'taxonomy' => 'category',
                            'field' => 'slug',
                            'terms' => $obj->slug
                        )
                    ),
                );

            else :

                $args = array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => $post_page,
                    'paged' => $paged,
                    'caller_get_posts'=> 1,
                    'orderby' => 'date',
                    'order' => 'DESC',
                );

            endif;
            $my_posts = new WP_Query( $args );
            $found_posts = $my_posts->post_count;

            while ( $wp_query->have_posts() ) : $wp_query->the_post();
                global $post;

?>
                        <div class="column is-full-mobile is-two-thirds-tablet is-half-desktop is-one-third-widescreen is-one-third-fullhd">

                            <?php
                            if ( has_post_thumbnail( $post->ID ) ) {
                                echo '<a class="blog__post" href="' . get_permalink( $post->ID ) . '" title="' . esc_attr( $post->post_title ) . '">';
                               $overview_image = get_field('blog_overview_image', $post->ID);
                                if($overview_image) :
                                    $r = wp_get_attachment_image_src( $overview_image, 'full');
                                    $alt = get_post_meta( $overview_image, '_wp_attachment_image_alt', true);
                                    ?>
                                    <img class="lazy" data-src="<?= $r[0] ?>" alt="<?= $alt ?>">
                                <?php
                                    else :
                                        get_image_by_post($post, 'blog-carousel', 'blog-carousel');
                                endif;
                            };
                            echo '</a>'; ?>
                            <?php
                            $title = get_the_title();
                            $short_title = wp_trim_words( $title, 5, '...' );
                            echo '<h4 class="blogTitle">'.$short_title.'</h4>';
                            ?>
                            <?php
                            $excerpt = get_the_excerpt();
                            $short_excerpt = wp_trim_words( $excerpt, 20, '...' );
                            echo '<h4 class="blogDescription">'.$short_excerpt.'</h4>';
                            ?>
                            </div>
            <?php endwhile; ?>
          <?php

          $wp_query = $my_posts;
          if ($wp_query->max_num_pages > 1) : ?>
            <script id="true_loadmore" data-category="<?= $obj->slug ?>">
              var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
              var true_posts = '<?php echo serialize($wp_query->query_vars); ?>';
              var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
            </script>
          <?php endif; ?>
        </div>

    </div>

</section>

<!--todo delete pagination after approve refactoring -->
<!--    <div class="paginationContainer">-->
<!--        <div class="pagination">-->
<!--            --><?php //keleya_pagination(); ?>
<!---->
<!--        </div>-->
<!--    </div>-->

<?php
get_footer();
