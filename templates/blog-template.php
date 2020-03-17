<?php
/*
Template Name: Blog Template
*/

get_header();

$fields = get_fields();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

?>


    <section class="hero blog__nav">

        <div class="hero-body">
            <div class="main-carousel">
                <?php putRevSlider('blog-slider'); ?>
            </div>
            <div class="blogCategoriesContainer">
                <h1 class="title is-1 is-spaced ">Blog</h1>

                <div class="blogCategories">

                    <?php $categories = get_field('categories_magazine', 'option');
                    foreach ($categories as $category) {
                        echo '<a class="cat-button" href="' . get_category_link(
                                $category
                            ) . '">' . $category->name . '</a>';
                    }
                    ?>

                    <?php echo get_search_form(); ?>
                </div>
            </div>
        </div>
    </section>
    <section class="section blog-wrappers">
        <div class="width-wrapper category-wrapper">
            <h3><?php the_field('Blog', 'options') ?></h3>
            <div class="columns is-multiline">


                <?php

                if (is_category()) :
                    $obj = get_queried_object();

                    $args = array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'posts_per_archive_page' => 9,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'paged' => $paged,
                        'caller_get_posts' => 1,
                        'tax_query' => array(
                            array(
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
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'posts_per_archive_page' => 9,
                        'paged' => $paged,

                    );

                endif;
                $blog_query = new WP_Query($args);
                $my_posts = $blog_query;
                $found_posts = $my_posts->post_count;

                while ($my_posts->have_posts()) : $my_posts->the_post();
                    global $post;

                    get_template_part('template-parts/archive-content');

                endwhile;
                wp_reset_postdata();
                ?>
                <?php

                $wp_query = $blog_query;
                if ($wp_query->max_num_pages > 1) : ?>
                    <script id="true_loadmore" data-category="<?= $obj->slug ?>">
                        var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
                        var true_posts = '<?php echo serialize($wp_query->query_vars); ?>';
                        var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                    </script>
                <?php endif; ?>
            </div>
        </div>
        </div>

        </div>
    </section>
  <!--todo delete pagination after approve refactoring -->
<!--    <div class="pagination">--><?php //keleya_pagination(); ?><!--</div>-->



<?php

get_footer();

