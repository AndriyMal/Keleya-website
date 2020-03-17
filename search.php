<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package keleya
 */

get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>


            <section class="hero">
                <div class="container-fluid">
                    <div class="blogCategoriesContainer">
                        <h1 class="title is-1 is-spaced ">Blog</h1>

                        <div class="blogCategories">

                            <?php $categories= get_field('categories_magazine', 'option');
                            foreach($categories as $category) {

                                echo '<a class="cat-button" href="'.get_category_link( $category ).'">'.$category->name.'</a>';

                            }
                            ?>

                            <?php echo get_search_form(); ?>
                        </div>
                </div>


            </section>


            <section class="section blog__articles">
                <div class="container">

			<?php
			/* Start the Loop */
            echo '<div class="columns is-gapless is-multiline blog-posts">';

			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
                 *
                 *
				 */


                get_template_part( 'template-parts/content', 'search' );

    			endwhile;

            echo '</div>';

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
                </div>
            </section>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
