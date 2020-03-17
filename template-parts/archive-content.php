<div class="column is-full-mobile is-two-thirds-tablet is-half-desktop is-one-third-widescreen is-one-third-fullhd" id="blog_posts">


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
        endif;                            };
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