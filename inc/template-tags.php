<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package keleya
 */

if ( ! function_exists( 'keleya_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function keleya_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'keleya' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'keleya_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function keleya_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'keleya' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'keleya_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function keleya_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'keleya' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				//printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'keleya' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'keleya' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				//printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'keleya' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
//			comments_popup_link(
//				sprintf(
//					wp_kses(
//						/* translators: %s: post title */
//						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'keleya' ),
//						array(
//							'span' => array(
//								'class' => array(),
//							),
//						)
//					),
//					get_the_title()
//				)
//			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'keleya' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'keleya_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function keleya_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php
                global $post;
                get_image_by_post($post, 'blog-single', 'blog-single-mobile');

                ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
			?>
		</a>

		<?php
		endif; // End is_singular().
	}
endif;

function webp_picture_fix($content){
    global $post;
    preg_match_all("/<img(.*?)class=('|\")(.*?)('|\")(.*?)src=('|\")(.*?)('|\")(.*?)>/i", $content, $images);

    if(!is_null($images)){
        $i = -1;
        foreach ($images as $key) {
            $i++;
            //echo $key[$i];
            if(isset($images[3][$i])) :
                if(strpos($images[3][$i], 'size-full') !== false){
                    //echo "hi";
                    $imageTag = $images[7][$i];
                    $sewebp = preg_replace('/\\.[^.\\s]{3,4}$/', '', $imageTag);
                    $webp_src = $sewebp.".webp";
                    $replacement = '<picture><source srcset="'.$webp_src.'" type="image/webp" /><img class="lazy" '.$images[1][$i].'class='.$images[2][$i].$images[3][$i].$images[4][$i].$images[5][$i].'src='.$images[6][$i].$images[7][$i].$images[8][$i].$images[9][$i].'></picture>';
                    $content = str_replace($images[0][$i], $replacement, $content);
                }
            endif;
        }
    }

    return $content;
}
//add_filter('the_content', 'webp_picture_fix', 9999);


function kel_related_posts(){


    // Check if we are on a single page, if not, return false
    if ( !is_single() )
        return false;

    // Get the current post id
    $post_id = get_queried_object_id();

    // Get the post categories
    $categories = get_the_category( $post_id );

    // Lets build our array
    // If we don't have categories, bail
    if ( !$categories )
        return false;

    foreach ( $categories as $category ) {
        if ( $category->parent == 0 ) {
            $term_ids[] = $category->term_id;
        } else {
            $term_ids[] = $category->parent;
            $term_ids[] = $category->term_id;
        }
    }

    // Remove duplicate values from the array
    $unique_array = array_unique( $term_ids );

    // Lets build our query
    $args = [
        'post__not_in' => [$post_id],
        'posts_per_page' => 15, // Note: showposts is depreciated in favor of posts_per_page
        'ignore_sticky_posts' => 1, // Note: caller_get_posts is depreciated
        'orderby' => 'title',
        'no_found_rows' => true, // Skip pagination, makes the query faster
        'tax_query' => [
            [
                'taxonomy' => 'category',
                'terms' => $unique_array,
                'include_children' => false,
            ],
        ],
    ];
    $q = new WP_Query( $args );
    if ( $q->have_posts() ) : ?>
        <div class="width-wrapper category-wrapper">
       <h3 class="has-text-centered related__posts_header"><?php _e('Related topics', 'keleya') ?></h3>

                    <div class="related-posts-carousel">
        <?php while ( $q->have_posts() ) : ?>

           <div class="slide">

                <?php

                $q->the_post();

                if ( has_post_thumbnail( get_the_ID() ) ) {
                    echo '<a href="' . get_permalink( get_the_ID() ) . '" title="' . esc_attr( get_the_title() ) . '">';

                    $post = get_post(get_the_ID());

                    get_image_by_post($post, 'related-post', 'related-post-mobile');

                    echo '</a>';
                }; ?>

               <h4 class="title">
                   <?php the_title() ?>
               </h4>

           </div>
        <?php endwhile ?>
        </div>

        <?php wp_reset_postdata();
        endif; ?>

    </div>
        <?php
}

function floating_app_buttons(){

    echo '<div class="floating__app__buttons">';

        get_app_icons();
     ?>

    </div>
<?php }


function get_app_icons(){

    $link_arr = get_field('apple_button_link', 'option');
    if(!isset($link_arr['target'])) :
        $link_arr['target'] = '_self';
    endif;

    $arr = get_field('apple_button', 'option');

    $arr = array(
        'hd' => $arr['url'],
        'sd' => $arr['sizes']['app-button'],
        'mob' => $arr['sizes']['app-button-mobile'],
        'alt' => $arr['alt']
    );

    $sizes = array(
        'width' => '186',
        'height' => '63',
        'mobile_width' => '186',
        'mobile_height' => '63'
    );

    ?>

    <a id="ga_apple" href="<?= $link_arr['url'] ?>" title="<?= $link_arr['title'] ?>" target="<?= $link_arr['target']?>">
        <?php any_image_tag($arr, $sizes, 'app-button');
        ?>
    </a>

    <?php

    $link_arr = get_field('google_play_button_link', 'option');

    if($link_arr['target'] == '') :

        $link_arr['target'] = '_self';
    endif;

    $arr = get_field('google_play_button', 'option');

    $arr = array(
        'hd' => $arr['url'],
        'sd' => $arr['sizes']['app-button'],
        'mob' => $arr['sizes']['app-button-mobile'],
        'alt' => $arr['alt']
    );

    $sizes = array(
        'width' => '186',
        'height' => '63',
        'mobile_width' => '186',
        'mobile_height' => '63'
    );


    ?>


    <a id="ga_google" href="<?= $link_arr['url'] ?>" title="<?= $link_arr['title'] ?>" target="<?= $link_arr['target']?>">
        <?php any_image_tag($arr, $sizes, 'app-button'); ?>
    </a>

    <?php
    }
