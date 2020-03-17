<?php

/*
 *
 * Filters.php contains mainly helpers + actions / filters
 *
 */

// allow webp format. OPtimus generates those with a plugin //

function webp_upload_mimes( $existing_mimes ) {
    // add webp to the list of mime types
    $existing_mimes['webp'] = 'image/webp';

    // return the array back to the function with our added mime type
    return $existing_mimes;
}
add_filter( 'mime_types', 'webp_upload_mimes' );
//setup image sizes used all over the pages.

add_action( 'wp_loaded', 'kel_image_sizes' );
function kel_image_sizes() {
    add_image_size( 'blog-overview', 656, 444, true );
    add_image_size( 'blog-overview-mobile', 328, 222, true );

    add_image_size('blog-carousel', 576, 768, true);

    add_image_size('featured-article', 1200, 900, true);


    add_image_size( 'blog-tile', 1366, 888, true );
    add_image_size( 'blog-tile-mobile', 1366, 888, true );

    add_image_size( 'blog-single', 807, 451, true );
    add_image_size( 'blog-single-mobile', 807, 451, true );

    add_image_size( 'app-image', 538, 1096, true );
    add_image_size( 'app-image-mobile', 538, 1096, true );

    add_image_size( 'app-image-double', 860, 1096, true );
    add_image_size( 'app-image-double-mobile', 860, 1096, true );

    add_image_size( 'hero-image', 1440, 400, true );
    add_image_size( 'hero-image-mobile', 460, 400, true );

    add_image_size( 'newsletter-image', 1440, 720, true );
    add_image_size( 'newsletter-image-mobile', 320, 787, true );

    add_image_size( 'founders', 209, 209, false );
    add_image_size( 'founders-mobile', 209, 209, false );

    add_image_size( 'experts', 200, 200, true );
    add_image_size( 'experts-mobile', 200, 200, true );

    add_image_size('about-founders', 260, 260, true);
    add_image_size('about-founders-mobile', 260, 260, true);

    add_image_size('about-team', 167, 167, false);
    add_image_size('about-team-mobile', 167, 167, false);

    add_image_size('about-footer', 1440, 389, false);
    add_image_size('about-footer-mobile', 460, 587, false);

    add_image_size('press-item', 217, 100, false);
    add_image_size('press-item-mobile', 217, 100, false);

    add_image_size('related-post', 592, 592, true);
    add_image_size('related-post-mobile', 592, 592, true);

    add_image_size('app-button', 186, 63, false);
    add_image_size('app-button-mobile', 186, 63, false);

}

/* add async or defer attr to tag */

function add_asyncdefer_attribute($tag, $handle) {
    // if the unique handle/name of the registered script has 'async' in it
    if (strpos($handle, 'async') !== false) {
        // return the tag with the async attribute
        return str_replace( '<script ', '<script async ', $tag );
    }
    // if the unique handle/name of the registered script has 'defer' in it
    else if (strpos($handle, 'defer') !== false) {
        // return the tag with the defer attribute
        return str_replace( '<script ', '<script defer ', $tag );
    }
    // otherwise skip
    else {
        return $tag;
    }
}
add_filter('script_loader_tag', 'add_asyncdefer_attribute', 10, 2);

// this is used to set image tags with responsive sets//

function the_image_tag($hd, $mobile, $size){

    $img_array = get_field($mobile);
    $img_hd_array = get_field($hd);
    //var_dump($img_hd_array);

    $width = $img_hd_array['sizes'][$size.'-width'];
    $height = $img_hd_array['sizes'][$size.'-height'];

    $mobile_size = $size.'-mobile';

    $mobile_width = $img_array['sizes'][$mobile_size.'-width'];
    $mobile_height = $img_array['sizes'][$mobile_size.'-height'];

    $alt = $img_hd_array['alt'];


    $data['hd'] = $img_hd_array['sizes'][$size];
    $data['sd'] = $img_hd_array['url'];
    $data['hdWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $img_hd_array['sizes'][$size]);
    $data['sdWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $img_hd_array['url']);
    $data['mobWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $img_array['url']);
    $data['fallback'] = $img_hd_array['sizes'][$size];
    $data['mob'] = $img_array['sizes'][$mobile_size];
    $data['alt'] = $alt;

    $style_attr = 'min-width:'.$width.'px;max-height:'.$height.'px;';

    $mobile_style_attr = 'max-width:100%;max-height:'.$mobile_height.'px;';

    $id = '.'.$hd;
    ?>
    <picture>
        <source
                media="(min-width: 1024px)"
                data-srcset="<?= $data['hdWebP'] ?> 1x, <?= $data['hdWebP'] ?> 2x" type="image/webp">
        <source
                media="(min-width: 1024px)"
                data-srcset="<?= $data['hd'] ?> 1x, <?= $data['hd'] ?> 2x">

        <source
                media="(min-width: 320px)"
                data-srcset="<?= $data['sdWebP'] ?> 1x, <?= $data['sdWebP'] ?> 2x" type="image/webp">
        <source
                media="(min-width: 320px)"
                data-srcset="<?= $data['sd'] ?> 1x, <?= $data['sd'] ?> 2x">

        <img alt="<?= $data['alt'] ?>" class="lazy" data-src="<?= $data['sd'] ?>" width="<?= $width ?>" height="<?= $height ?>">
    </picture>
    <?php

}

// carousel needs a specific image tag //
function load_carousel_image($hd, $mobile, $size){
    $img_array = get_sub_field($mobile);
    $img_hd_array = get_sub_field($hd);
    //var_dump($img_hd_array);

    $width = $img_hd_array['sizes'][$size.'-width'];
    $height = $img_hd_array['sizes'][$size.'-height'];

    $mobile_size = $size.'-mobile';

    $mobile_width = $img_array['sizes'][$mobile_size.'-width'];
    $mobile_height = $img_array['sizes'][$mobile_size.'-height'];

    $alt = $img_hd_array['alt'];


    $data['hd'] = $img_hd_array['sizes'][$size];
    $data['sd'] = $img_hd_array['sizes'][$size];
    $data['hdWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $img_hd_array['sizes'][$size]);
    $data['sdWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $img_hd_array['sizes'][$size]);
    $data['mobWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $img_array['sizes'][$mobile_size]);
    $data['fallback'] = $img_hd_array['sizes'][$size];
    $data['mob'] = $img_array['sizes'][$mobile_size];
    $data['alt'] = $alt;

    $style_attr = 'min-width:'.$width.'px;min-height:'.$height.'px;';

    $mobile_style_attr = 'max-width:768px;max-height:'.$mobile_height.'px;';
    $rand = $size.'-'.rand(0,100);
    $id = '.'.$rand;
    ?>

        <img class="carousel-cell-image lazy" width="<?= $width ?>" height="<?= $height ?>" data-src="<?= $data['sd'] ?>" alt="<?= $data['alt'] ?>">
    <?php
}

// image tag but for subfields //
function the_sub_image_tag($hd, $mobile, $size){

    $img_array = get_sub_field($mobile);
    $img_hd_array = get_sub_field($hd);
    //var_dump($img_hd_array);

    $width = $img_hd_array['sizes'][$size.'-width'];
    $height = $img_hd_array['sizes'][$size.'-height'];

    $mobile_size = $size.'-mobile';

    $mobile_width = $img_array['sizes'][$mobile_size.'-width'];
    $mobile_height = $img_array['sizes'][$mobile_size.'-height'];

    $alt = $img_hd_array['alt'];


    $data['hd'] = $img_hd_array['sizes'][$size];
    $data['sd'] = $img_hd_array['sizes'][$size];
    $data['hdWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $img_hd_array['sizes'][$size]);
    $data['sdWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $img_hd_array['sizes'][$size]);
    $data['mobWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $img_array['sizes'][$mobile_size]);
    $data['fallback'] = $img_hd_array['sizes'][$size];
    $data['mob'] = $img_array['sizes'][$mobile_size];
    $data['alt'] = $alt;

    $style_attr = 'min-width:'.$width.'px;min-height:'.$height.'px;';

    $mobile_style_attr = 'max-width:768px;max-height:'.$mobile_height.'px;';
    $rand = $size.'-'.rand(0,100);
    $id = '.'.$rand;
    ?>

    <picture>
        <source media="(min-width: 56.25em)" data-srcset="<?= $data['hdWebP'] ?>" type="image/webp">
        <source media="(min-width: 56.25em)" data-srcset="<?= $data['hd'] ?>">

        <source media="(min-width: 37.5em)" data-srcset="<?= $data['sdWebP'] ?>" type="image/webp">
        <source media="(min-width: 37.5em)" data-srcset="<?= $data['sd'] ?>">

        <!-- this the small one for mobile -->

        <source data-srcset="<?= $data['mobWebP'] ?>" type="image/webp">

        <!-- media="(max-width: 48em) and (orientation: portrait)" -->
        <source data-srcset="<?= $data['mob'] ?>">
        <img class="lazy" width="<?= $width ?>" height="<?= $height ?>" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 <?= $width ?> <?= $height ?>'%3E%3C/svg%3E" data-src="<?= $data['sd'] ?>" alt="<?= $data['alt'] ?>">
    </picture>
    <?php

}

// image that but feed in any url for mob / regular / hd */

function any_image_tag($data, $sizes, $id = 0){

    $data['hdWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $data['hd']);
    $data['sdWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $data['sd']);
    $data['mobWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $data['mob']);
    $data['fallback'] = $data['sd'];
    $data['alt'] = $data['alt'];

    $width = $sizes['width'];
    $height = $sizes['height'];
    $mobile_height = $sizes['mobile_height'];
    $mobile_width = $sizes['mobile_width'];

    $style_attr = 'min-width:'.$width.'px;max-height:'.$height.'px;';

    $mobile_style_attr = 'max-width:100%;max-height:'.$mobile_height.'px;';

    $id = '.'.$id;
    ?>
    <picture>
        <source media="(min-width: 56.25em)" data-srcset="<?= $data['hdWebP'] ?>" type="image/webp">
        <source media="(min-width: 56.25em)" data-srcset="<?= $data['hd'] ?>">

        <source media="(min-width: 37.5em)" data-srcset="<?= $data['sdWebP'] ?>" type="image/webp">
        <source media="(min-width: 37.5em)" data-srcset="<?= $data['sd'] ?>">

        <!-- this the small one for mobile -->

        <source data-srcset="<?= $data['mobWebP'] ?>" type="image/webp">

        <!-- media="(max-width: 48em) and (orientation: portrait)" -->
        <source data-srcset="<?= $data['mob'] ?>">
        <img class="lazy" width="<?= $width ?>" height="<?= $height ?>" data-src="<?= $data['sd'] ?>" alt="<?= $data['alt'] ?>">
    </picture>
    <?php

}

// old generation of image tags //
function generate_image_tag($data){

    // data contains
    // 1. desktop hd URL
    // 2. desktop regular url
    // 3. phone url
    // 4. fallback url (regular quality)
    // 5. low res version
    // 6. alt tag

    $data['hdWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $data['hd']);
    $data['sdWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $data['sd']);
    $data['mobWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $data['mob']);
    $data['lazyload'] = true;

    if($data['lazyload']) :
        $class = 'class="lazyload"';
    endif;


    ?>
    <picture>
        <source media="(min-width: 56.25em)" data-srcset="<?= $data['hdWebP'] ?>" type="image/webp">
        <source media="(min-width: 56.25em)" data-srcset="<?= $data['hd'] ?>">

        <source media="(min-width: 37.5em)" data-srcset="<?= $data['sdWebP'] ?>" type="image/webp">
        <source media="(min-width: 37.5em)" data-srcset="<?= $data['sd'] ?>">

        <!-- this the small one for mobile -->

        <source data-srcset="<?= $data['mobWebP'] ?>" type="image/webp">

        <!-- media="(max-width: 48em) and (orientation: portrait)" -->
        <source data-srcset="<?= $data['mob'] ?>">
        <img class="lazy" data-src="<?= $data['sd'] ?>" alt="<?= $data['alt'] ?>">
    </picture>


<?php

}

// used in menu + footer to load social icons//
// update paths for new icons //
function load_social_icons(){

    $icons = [];
    $icons[] = array('path' => get_template_directory_uri() . '/svg/icons/instagram.svg',
        'link' => 'https://www.instagram.com/mykeleya/?hl=en',
        'title' => 'instagram'
    );
    $icons[] = array('path' => get_template_directory_uri() . '/svg/icons/facebook-square.svg', 'link' => 'https://www.facebook.com/getkeleya/', 'title' => 'facebook');
    $icons[] = array('path' => get_template_directory_uri() . '/svg/icons/twitter.svg', 'link' => 'https://twitter.com/mykeleya', 'title' => 'twitter');
    $icons[] = array('path' => get_template_directory_uri() . '/svg/icons/youtube.svg', 'link' => 'https://www.youtube.com/channel/UC_QdUEJmz8caSITJW9F7uAg', 'title' => 'youtube');
    $icons[] = array('path' => get_template_directory_uri() . '/svg/icons/pinterest.svg', 'link' => 'https://www.pinterest.de/mykeleya/', 'title' => 'pinterest');

    foreach($icons as $key => $val) : ?>
    <div class="icon-item">
        <a href="<?= $val['link'] ?>" title="<?= $val['title'] ?>" target="_blank">
            <img data-src="<?= $val['path'] ?>" class="lazy" />
        </a>
    </div>
    <?php endforeach;
}

// shows rating in hero//
function show_rating($numberOfStars){

    echo '<div class="stars star--'.$numberOfStars.'">';
    echo '<svg viewBox="0 0 199 32" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" stroke-linecap="round" stroke-linejoin="round"><path fill="none" d="M0 0h198.275v31.749H0z"/><clipPath id="acx"><path d="M2.921.89h30v30h-30z"/></clipPath><g clip-path="url(#acx)"><path d="M18.012 1.163l4.546 9.273L32.83 11.89l-7.454 7.182 1.818 10.182-9.182-4.818-9.182 4.818 1.818-10.182-7.454-7.182 10.273-1.454 4.545-9.273z" fill="#ffd46b" fill-rule="nonzero" stroke="#ffd46b"/></g><clipPath id="bcx"><path d="M42.748.89h30v30h-30z"/></clipPath><g clip-path="url(#bcx)"><path d="M57.839 1.163l4.545 9.273 10.273 1.454-7.455 7.182 1.819 10.182-9.182-4.818-9.182 4.818 1.818-10.182-7.454-7.182 10.272-1.454 4.546-9.273z" fill="#ffd46b" fill-rule="nonzero" stroke="#ffd46b"/></g><clipPath id="cx"><path d="M82.857.89h30v30h-30z"/></clipPath><g clip-path="url(#cx)"><path d="M97.948 1.163l4.545 9.273 10.273 1.454-7.454 7.182 1.818 10.182-9.182-4.818-9.182 4.818 1.818-10.182-7.454-7.182 10.272-1.454 4.546-9.273z" fill="#ffd46b" fill-rule="nonzero" stroke="#ffd46b"/></g><clipPath id="dx"><path d="M122.684.89h30v30h-30z"/></clipPath><g clip-path="url(#dx)"><path d="M137.775 1.163l4.545 9.273 10.273 1.454-7.455 7.182 1.818 10.182-9.181-4.818-9.182 4.818 1.818-10.182-7.455-7.182 10.273-1.454 4.546-9.273z" fill="#ffd46b" fill-rule="nonzero" stroke="#ffd46b"/></g><clipPath id="ex"><path d="M162.558 1.037h30v30h-30z"/></clipPath><g clip-path="url(#ex)"><path d="M177.649 1.31l4.545 9.272 10.273 1.455-7.455 7.182 1.818 10.182-9.181-4.819-9.182 4.819 1.818-10.182-7.455-7.182 10.273-1.455 4.546-9.272z" fill="#ffd46b" fill-rule="nonzero" stroke="#ffd46b"/></g></svg>';
    echo '</div>';


}

// helper to for blog posts
function get_image_by_post($post, $size, $sizeMobile){
    $attachment_id = get_post_thumbnail_id( $post->ID );

    $hd = wp_get_attachment_image_src(  $attachment_id, $size,false );
    $data['hd'] = $hd[0];
    $width = $hd[1];
    $height = $hd[2];

    // we need a lesser version *half size of the highres one for regular screens
    $sd = wp_get_attachment_image_src(  $attachment_id, $size, false );
    $data['sd'] = $sd[0];
    $width = $hd[1];
    $height = $hd[2];

    $alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );

    $mob = wp_get_attachment_image_src(  $attachment_id, $sizeMobile, false );
    $mobile_width = $mob[1];
    $mobile_height = $mob[2];
    $data['mob'] = $mob[0];
    $data['fallback'] = $sd[0];

    $data['hdWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $data['hd']);
    $data['sdWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $data['sd']);
    $data['mobWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $data['mob']);
    $data['fallback'] = $data['sd'];
    $data['alt'] = $alt;


    ?>

    <picture>

        <source media="(min-width: 56.25em)" data-srcset="<?= $data['hd'] ?>">

        <source media="(min-width: 37.5em)" data-srcset="<?= $data['sd'] ?>">

        <!-- this the small one for mobile -->
        <!-- media="(max-width: 48em) and (orientation: portrait)" -->
        <source data-srcset="<?= $data['mob'] ?>">
        <img  width="<?= $width ?>" height="<?= $height ?>" data-src="<?= $data['sd'] ?>" src="<?= $data['sd'] ?>" alt="<?= $data['alt'] ?>">
    </picture>
    <?php
}

// helper for multiple images //
function get_images($key, $mobile_key){
    $attachment_id = get_field($key);

    /* $image is an image ID
       adjust so we can get different formats from the attachment

    */

    // returns HD version for highres screens
    $hd = wp_get_attachment_image_src(  $attachment_id, 'full',false );
    $data['hd'] = $hd[0];
    // we need a lesser version *half size of the highres one for regular screens
    $sd = wp_get_attachment_image_src(  $attachment_id, 'medium', false );
    $data['sd'] = $sd[0];
    $alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );

    $data['alt'] = $alt;

    $attachment_id = get_field($mobile_key);

    $mob = wp_get_attachment_image_src(  $attachment_id, 'full', false );
    $data['mob'] = $mob[0];
    $data['fallback'] = $sd[0];

    //var_dump($data);

    generate_image_tag($data);
}

// helper for specific post //
function get_blog_image($hd, $mobile, $size){
    /*

    we are passing directly the array..

    */

    $img_array = $mobile;
    $img_hd_array = $hd;
    //var_dump($img_hd_array);

    $width = $img_hd_array['sizes'][$size.'-width'];
    $height = $img_hd_array['sizes'][$size.'-height'];

    $mobile_size = $size.'-mobile';

    $mobile_width = $img_array['sizes'][$mobile_size.'-width'];
    $mobile_height = $img_array['sizes'][$mobile_size.'-height'];

    $alt = $img_hd_array['alt'];


    $data['hd'] = $img_hd_array['sizes'][$size];
    $data['sd'] = $img_hd_array['sizes'][$size];
    $data['hdWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $img_hd_array['sizes'][$size]);
    $data['sdWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $img_hd_array['sizes'][$size]);
    $data['mobWebP'] = preg_replace('"\.(jpg|png)$"', '.webp', $img_array['sizes'][$mobile_size]);
    $data['fallback'] = $img_hd_array['sizes'][$size];
    $data['mob'] = $img_array['sizes'][$mobile_size];
    $data['alt'] = $alt;

    $style_attr = 'max-width:'.$width.'px;max-height:'.$height.'px;';

    $mobile_style_attr = 'max-width:'.$mobile_width.'px;max-height:'.$mobile_height.'px;';

    $id = '#'.$size;
    ?>
    <picture>
        <source media="(min-width: 56.25em)" data-srcset="<?= $data['hdWebP'] ?>" type="image/webp">
        <source media="(min-width: 56.25em)" data-srcset="<?= $data['hd'] ?>">

        <source media="(min-width: 37.5em)" data-srcset="<?= $data['sdWebP'] ?>" type="image/webp">
        <source media="(min-width: 37.5em)" data-srcset="<?= $data['sd'] ?>">

        <!-- this the small one for mobile -->

        <source data-srcset="<?= $data['mobWebP'] ?>" type="image/webp">

        <!-- media="(max-width: 48em) and (orientation: portrait)" -->
        <source data-srcset="<?= $data['mob'] ?>">
        <img class="lazy" width="<?= $width ?>" height="<?= $height ?>" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 <?= $width ?> <?= $height ?>'%3E%3C/svg%3E" data-src="<?= $data['sd'] ?>" alt="<?= $data['alt'] ?>">
    </picture>
    <?php

}

// helper for multiple sub images //
function get_sub_images($key, $mobile_key){
    $attachment_id = get_sub_field($key);

    /* $image is an image ID
       adjust so we can get different formats from the attachment

    */

    // returns HD version for highres screens
    $hd = wp_get_attachment_image_src(  $attachment_id, 'full',false );
    $data['hd'] = $hd[0];
    // we need a lesser version *half size of the highres one for regular screens
    $sd = wp_get_attachment_image_src(  $attachment_id, 'medium', false );
    $data['sd'] = $sd[0];
    $alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );

    $data['alt'] = $alt;

    $attachment_id = get_sub_field($mobile_key);

    $mob = wp_get_attachment_image_src(  $attachment_id, 'full', false );
    $data['mob'] = $mob[0];
    $data['fallback'] = $sd[0];

    //var_dump($data);

    generate_image_tag($data);
}

// used on homepage to inline svg paths //
function kel_inline_svg($path){

    echo file_get_contents($path);
}

// used on homepage to list bullet points based on custom fields //
function kel_get_general_list($key, $subkey){

    if( have_rows($key, 'option') ): ?>

	<ul class="listy">

	<?php while( have_rows($key, 'option') ): the_row();

		$list = get_sub_field($subkey, 'option');

		?>

		<li>
            <span>
                <?= $list ?>
            </span>
		</li>

	<?php endwhile; ?>

	</ul>

<?php endif;

}

function kel_get_list($key, $subkey){

    if( have_rows($key) ): ?>

        <ul class="listy">

            <?php while( have_rows($key) ): the_row();

                $list = get_sub_field($subkey);

                ?>

                <li>
            <span>
                <?= $list ?>
            </span>
                </li>

            <?php endwhile; ?>

        </ul>

    <?php endif;

}


function kel_get_big_list($key, $subkey){

    if( have_rows($key) ): ?>

        <ul class="listy">

            <?php while( have_rows($key) ): the_row();

                $list = get_sub_field($subkey);

                ?>

                <li>
            <span>
                <?= $list ?>
            </span>
                </li>

            <?php endwhile; ?>

        </ul>

    <?php endif;

}

function kel_get_reviews($key){

    if( have_rows($key) ): ?>

        <div class="reviews">

            <?php while( have_rows($key) ): the_row();



                ?>

                <div class="review">

                    <div class="top-">
                        <img data-src="<?php the_sub_field('image') ?>" class="lazy" />

                        <div class="top-side-">
                            <span class="name"><?php the_sub_field('name') ?></span>
                            <span class="date"><?php the_sub_field('date') ?></span>
                        </div>

                        <div class="stars"><img data-src="<?php the_sub_field('review') ?>" class="lazy" /></div>
                    </div>

                    <div class="bottom-description">
                        <?php the_sub_field('description') ?>
                    </div>

                </div>

            <?php endwhile; ?>

        </div>

    <?php endif;

}



// helper for creating readmore section on homepage
function kel_get_text($key) {

    ?>
    <div class="text__area">
        <p>
            <?php echo get_field($key); ?>
        </p>

    </div>
<?php
}

// helper for sub cf for creating readmore fields on about page
function kel_get_sub_text($key) {

    $dataid = rand(0,500);
    ?>
    <div class="text__area">
        <p>
            <?php echo get_sub_field($key); ?>
        </p>

    </div>
    <?php
}

// creates the home carousel. Javascript is in script.js //
function kel_get_carousel(){
    $key = 'experts';
    $subkey = '';

    ?>
    <div class="carousel" data-flickity='{ "hash": true }'>
        <?php
        $index = 0;

        while( have_rows($key) ):

            the_row();

            $position = get_sub_field('position');
            $text = get_sub_field('text');

            if($index == 0) :
                $class = 'centered';
            else :
                $class = '';
            endif;

        ?>
        <div class="carousel-cell <?= $class ?>">
            <div class="inner-cell">
            <div class="sub__image">
                    <?php load_carousel_image('image', 'image', 'experts') ?>
                </div>
                <div class="extra__info">
                    <span class="name"><?php the_sub_field('name'); ?></span>
                    <span><?php the_sub_field('job') ?></span>

                </div>
                <div class="quote">

                    <div class="quote__right">
                        <img src="<?php echo get_template_directory_uri() . '/img/quote-right@2x.png' ?>" alt="expert" />
                    </div>
                    <p>
                        <?= $text ?>
                    </p>

                    <div class="quote__left">
                        <img src="<?php echo get_template_directory_uri() . '/img/quote-right@2x.png' ?>" alt="expert" />
                    </div>
                </div>
            </div>
        </div>
            <?php  $index++; ?>
        <?php endwhile; ?>
    </div>

    <?php

//    if( have_rows($key) ): ?>
<!---->
<!---->
<!--     <ul class="carousel">-->
<!---->
<!--        --><?php //while( have_rows($key) ): the_row();
//
//            $position = get_sub_field('position');
//            $text = get_sub_field('text');
//            ?>
<!--            <li class="item --><?//= $position ?><!--">-->
<!--                <div class="sub__image">-->
<!---->
<!--                    --><?php //load_carousel_image('image', 'image', 'experts') ?>
<!--                </div>-->
<!--                <div class="extra__info">-->
<!--                    <span class="name">--><?php //the_sub_field('name'); ?><!--</span>-->
<!--                    <span>--><?php //the_sub_field('job') ?><!--</span>-->
<!---->
<!--                </div>-->
<!--                <div class="quote">-->
<!---->
<!--                    <div class="quote__right">-->
<!--                        <img src="--><?php //echo get_template_directory_uri() . '/img/quote-right@2x.png' ?><!--" alt="expert" />-->
<!--                    </div>-->
<!--                    <p>-->
<!--                        --><?//= $text ?>
<!--                    </p>-->
<!---->
<!--                    <div class="quote__left">-->
<!--                        <img src="--><?php //echo get_template_directory_uri() . '/img/quote-right@2x.png' ?><!--" alt="expert" />-->
<!--                    </div>-->
<!--                </div>-->
<!--                    </li>-->
<!--         --><?php //endwhile; ?>
<!---->
<!--        </ul>-->
<!---->
<!--         --><?php //endif;
}

// loads a whole post based on post object//
function kel_show_post($post){
    if ( has_post_thumbnail( $post->ID ) ) {
        echo '<a class="blog__post" href="' . get_permalink( $post->ID ) . '" title="' . esc_attr( $post->post_title ) . '">';

        get_image_by_post($post, 'blog-tile', 'blog-tile');

        echo '<span class="overlay__post overlay__vertical button is-outlined">';

        _e('Read More', 'keleya');
        echo '</span>';

        echo '</a>';
    };

    echo '<h3>';

    echo get_the_title($post);

    echo '</h3>';

    echo '<div class="excerpt">';

    echo get_the_excerpt($post);

    echo '</div>';

    echo '<a class="button is-outlined" href="' . get_permalink( $post->ID ) . '" title="' . __('Read More', 'keleya') . '">';
    _e('Read More', 'keleya');
    echo '</a>';
}

// used in header to generate the tag for the logo. Stickyness.. //
function logo_handler(){
    global $post;
    $logo_alt = 'logo';

    if(isset($post)) :
    $template = get_post_meta( $post->ID, '_wp_page_template', true );

    else :
        $template = '';
    endif;



    ?>

    <?php if($template == 'templates/blog-template.php' || is_singular('post') || is_category()) : ?>
        <img id="logo" class="lazy" data-src="<?= get_template_directory_uri() . '/img/keleya-logo.png' ?>"  alt="<?= $logo_alt ?>">
        <!--                        --><?php //the_custom_logo(); ?>
        <!--                        --><?php //bloginfo( 'name' ); ?>
    <?php else : ?>
        <img id="logo" class="lazy" data-src="<?= get_template_directory_uri() . '/img/keleya-logo.png' ?>" alt="<?= $logo_alt ?>">
        <!--                        --><?php //the_custom_logo(); ?>
        <!--                        --><?php //bloginfo( 'name' ); ?>
    <?php endif;
    ?>
<?php

}

// helper for blog + cat + single pages for the categories //
function the_category_navigation(){

    ?>
    <div class="category__navigation">
        <div class="middle-module">
        <div class="columns is-multiline is-centered">
            <div class="column is-8">
                <div class="content">
                    <h3><?php the_field('search_title', 'option') ?></h3>
                </div>
            </div>
            <div class="column is-5">
                <div class="search__form"><?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?></div>

            </div>
        </div>


            <?php get_the_category_navigation() ?>



        </div>
    </div>


<?php
}

function the_post_category_navigation(){
    ?>

    <div class="category__navigation post-category-navigation">
        <div class="middle-module">
            <div class="columns is-vcentered is-multiline">
                <div class="column is-9">
                    <?php get_the_category_navigation() ?>
                </div>
                <div class="column is-3">
                    <div class="search__form"><?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?></div>
                </div>
            </div>






        </div>
    </div>

    <?php
}

function footer_newsletter(){
?>

    <a class="button is-primary is-large open-newsletter" href="#">
        <?php the_field('blog_newsletter_button', 'option') ?>
    </a>
    <?php
    //echo do_shortcode(get_field('footer_newsletter', 'option'));

}


function get_the_category_navigation(){
    ?>



        <div class="burger-container">
            <div id="burger">
                <div class="bar topBar"></div>
                <div class="bar btmBar"></div>
            </div>

            <div class="cat-all">
            <?php _e('All Categories', 'keleya'); ?>
                </div>
        </div>


        <ul class="cat-menu">
            <li class="cat-item">
                <a href="<?php echo site_url() . '/mag' ?>" title="Mag">
                    <?php _e('Mag', 'keleya'); ?>
                </a>
            </li>
            <?php

            wp_list_categories( array(
                'orderby'    => 'name',
                'show_count' => false,
                'title_li' => ''
            ) );

            ?>
            <li class="search--btn">
                <i class="far fa-search"></i>
            </li>
        </ul>

        <?php


}
// helper to list posts //
function the_search_posts(){

    if(is_category()) :
        $obj = get_queried_object();
        $s = $_GET['s'];

        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_archive_page' => 1,
            'post_per_page' => 1,
            'orderby' => 'date',
            'order' => 'DESC',
            'paged' => 1,
            's' => $s
        );

    else :

        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 3,
            'paged' => 1,
        );

    endif;

//    $args = array(
//        'post_type' => 'post',
//        'post_status' => 'publish',
//        'posts_per_page' => 3,
//        'paged' => 1,
//    );


    echo '<div class="columns is-gapless is-multiline blog-posts">';

    $my_posts = new WP_Query( $args );

    while ( $my_posts->have_posts() ) : $my_posts->the_post();

        echo '<div class="column is-4">';

        global $post;

        if ( has_post_thumbnail( $post->ID ) ) {
            echo '<a class="blog__post" href="' . get_permalink( $post->ID ) . '" title="' . esc_attr( $post->post_title ) . '">';

            get_image_by_post($post, 'blog-overview', 'blog-overview');

            ?>
            <span class="overlay__post overlay__vertical button is-outlined">

        <?php _e('Read More', 'keleya'); ?>
        </span>
            <?php

            echo '</a>';
        };

        echo '<h3>';

        echo get_the_title($post);

        echo '</h3>';

        echo '</div>';

    endwhile;

    echo '</div>';
    echo '<div class="button is-primary is-large loadmore">Load More...</div>';


    // don't display the button if there are not enough posts

}
// helper to list posts //
function the_blog_posts(){

    if(is_category()) :
        $obj = get_queried_object();

        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_archive_page' => 1,
            'post_per_page' => 1,
            'orderby' => 'date',
            'order' => 'DESC',
            'paged' => 1,
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
        'posts_per_page' => 3,
        'paged' => 1,
    );

    endif;

//    $args = array(
//        'post_type' => 'post',
//        'post_status' => 'publish',
//        'posts_per_page' => 3,
//        'paged' => 1,
//    );
    $my_posts = new WP_Query( $args );

    $found_posts = $my_posts->post_count;

    echo '<div class="columns is-gapless is-multiline blog-posts">';


        while ( $my_posts->have_posts() ) : $my_posts->the_post();

        echo '<div class="column is-4">';

            global $post;

            if ( has_post_thumbnail( $post->ID ) ) {
                    echo '<a class="blog__post" href="' . get_permalink( $post->ID ) . '" title="' . esc_attr( $post->post_title ) . '">';

                    get_image_by_post($post, 'blog-overview', 'blog-overview');

                    ?>
                <span class="overlay__post overlay__vertical button is-outlined">

        <?php _e('Read More', 'keleya'); ?>
        </span>
                <?php

                    echo '</a>';
                };

            echo '<h3>';

                echo get_the_title($post);

            echo '</h3>';

        echo '</div>';

    endwhile;

    echo '</div>';

    if($found_posts >= 3) :
    ?>
    <div class="button is-primary is-large loadmore"><?php _e('Load More', 'keleya') ?></div>

        <?php
    endif;



    // don't display the button if there are not enough posts

}

add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');


// ajax load more used on blog / cat pages //
function load_posts_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');
    $paged = $_POST['page'];

    if(is_category()) :
        $obj = get_queried_object();

        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_archive_page' => 1,
            'post_per_page' => 1,
            'orderby' => 'date',
            'order' => 'DESC',
            'paged' => $paged,
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
            'posts_per_page' => 3,
            'paged' => $paged,
        );

    endif;
    $my_posts = new WP_Query( $args );
    if ( $my_posts->have_posts() ) :
        ?>
        <?php while ( $my_posts->have_posts() ) : $my_posts->the_post();
        global $post;
        ?>
        <div class="column is-4">
            <a class="blog__post" href="<?php the_permalink() ?>" title="<?php the_title() ?>">
                <?php the_post_thumbnail('blog-overview') ?>
                <span class="overlay__post overlay__vertical button is-outlined">

        <?php _e('Read More', 'keleya'); ?>
        </span>
            </a>
        <h3><?php the_title() ?></h3>
        </div>


    <?php endwhile ?>
    <?php

    else :

        ?>


    <?php

    endif;

    wp_die();
}

// old backup solution //

function kel_loadmore_ajax_handler(){

    // prepare our arguments for the query
    $args = json_decode( stripslashes( $_POST['query'] ), true );
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';

	// it is always better to use WP_Query but not here
	query_posts( $args );

	if( have_posts() ) :

        // run the loop
        while( have_posts() ): the_post();

            // look into your theme code how the posts are inserted, but you can use your own HTML of course
            // do you remember? - my example is adapted for Twenty Seventeen theme

            echo '<div class="column is-4">';

            global $post;

            if ( has_post_thumbnail( $post->ID ) ) {
                echo '<a href="' . get_permalink( $post->ID ) . '" title="' . esc_attr( $post->post_title ) . '">';

                get_image_by_post($post, 'blog-overview', 'blog-overview');

                echo '</a>';
            };

            echo '<h3>';

            echo get_the_title($post);

            echo '</h3>';

            echo '</div>';

            // for the test purposes comment the line above and uncomment the below one
            // the_title();


        endwhile;

    endif;
	die; // here we exit the script and even no wp_reset_query() required!
}

add_action('wp_ajax_loadmore', 'kel_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'kel_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}


// general application form modal used on jobs template //
function get_general_application_form(){



    ?>
    <div class="modal job__modal" id="modal-general-application">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">


                <button class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body content white">

                    <div class="form-info">
                        <?php the_field('general_form_description') ?>
                    </div>

                    <div class="has-form" id="form-general-application">
                        <?php echo do_shortcode('[contact-form-7 id="'.get_field('general_form').'" title=""]') ?>
                    </div>

            </section>

        </div>
    </div>


<?php
}
// get the newsletter popup

function get_newsletter_popup($title, $subtitle){



        ?>
        <div class="modal job__modal" id="modal-newsletter">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body content white">



                    <div class="form-info content">

                        <img class="graphic lazy" data-src="<?= get_template_directory_uri() . '/img/keleya-logo.png' ?>" />


                        <h3>
                        <?php echo $title ?>
                        </h3>
                        <h4><?php echo $subtitle ?></h4>
                        <span class="underline"></span>

                    </div>

                    <?php //kel_get_list('newsletter_text', 'list') ?>

                        <?php echo do_shortcode('[mc4wp_form id="34"]'); ?>


                </section>

            </div>
        </div>


        <?php
}

function get_signup_popup(){



    ?>
    <div class="modal job__modal" id="modal-signup">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <button class="delete" aria-label="close"></button>
            </header>
            <section class="modal-card-body content white">

                <div class="form-info content">

                    <div class="column-left">
                        <img class="graphic lazy" data-src="<?php the_field('benefits_image', 'option') ?>" />
                    </div>
                    <div class="column-right">

                    <h3><?php the_field('benefits_title', 'option') ?></h3>


                    <?php the_field('benefits', 'option') ?>

                        <div class="buttons">
                            <?php get_app_icons() ?>
                        </div>

                    </div>

                    </div>



            </section>

        </div>
    </div>


    <?php
}


// get current url grabs the url on any page  //
function wpse_217882_current_url() {

    // Protocol
    $url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ) ? 'https://' : 'http://';
    // Server
    $url .= $_SERVER['SERVER_NAME'];
    // Port
    $url .= ( '80' == $_SERVER['SERVER_PORT'] ) ? '' : ':' . $_SERVER['SERVER_PORT'];
    // URI
    $url .= $_SERVER['REQUEST_URI'];

    return trailingslashit( $url );
}

/* dont compress the jpegs please */

add_filter('jpeg_quality', function($arg){return 100;});


function wpdocs_excerpt_more( $more ) {
    return '..';
}

add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );
function wpdocs_custom_excerpt_length( $length ) {
    return 10;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );


function get_button($link, $class, $popup = false, $id ='', $data = '')
{

    if($link) {
        if (!isset($link['target'])) :
            $link['target'] = '_blank';
        endif;
        ?>

        <a href="<?= $link['url'] ?>"
           target="<?= $link['target'] ?>"
           title="<?= $link['title'] ?>"
           class="button <?= $class ?>" <?php echo ($popup) ? 'data-toggle="modal" data-target="#' . $id . '"' : '' ?> <?php echo $data ?>>
            <?= $link['title'] ?>
        </a>

        <?php
    }
}

function create_redirects(){


    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DSC'

    );

    $blog_query = new WP_Query( $args );
    $my_posts = $blog_query;
    $found_posts = $my_posts->post_count;

    while ( $my_posts->have_posts() ) : $my_posts->the_post();
        global $post;

        $post->slug;

        $items[] = $post->slug;

        $defaults = array('fields' => 'slugs');
        $args = wp_parse_args( $args, $defaults );
        $cats = wp_get_object_terms($post->ID, 'category', $args);

        endwhile;


    $fp = fopen('../redirects.json', 'w');
    fwrite($fp, json_encode($items));
    fclose($fp);

}
