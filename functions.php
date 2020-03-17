<?php
/**
 * keleya functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package keleya
 */
require_once "vendor/autoload.php";
require_once "payment-system/index.php";
/* set global */

define('HIDE_BUTTONS', true);


// if we want to add buttons again

add_filter(
  'body_class',
  function ($classes) {
    if (HIDE_BUTTONS) :
      $class = 'hide-buttons';
    endif;

    return array_merge($classes, array($class));
  }
);


if (!function_exists('keleya_setup')) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function keleya_setup()
  {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on keleya, use a find and replace
     * to change 'keleya' to the name of your theme in all the template files.
     */
    load_theme_textdomain('keleya', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
      array(
        'menu-1' => esc_html__('Primary', 'keleya'),
        'menu-app' => esc_html__('App Menu', 'keleya'),
        'menu-lang' => esc_html__('Language Menu', 'keleya'),
        'menu-blog' => esc_html__('Blog Menu', 'keleya'),
      )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
      'html5',
      array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
      )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
      'custom-background',
      apply_filters(
        'keleya_custom_background_args',
        array(
          'default-color' => 'ffffff',
          'default-image' => '',
        )
      )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
      'custom-logo',
      array(
        'height' => 250,
        'width' => 250,
        'flex-width' => true,
        'flex-height' => true,
      )
    );
  }
endif;
add_action('after_setup_theme', 'keleya_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function keleya_content_width()
{
  // This variable is intended to be overruled from themes.
  // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
  // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
  $GLOBALS['content_width'] = apply_filters('keleya_content_width', 640);
}

add_action('after_setup_theme', 'keleya_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function keleya_widgets_init()
{
  register_sidebar(
    array(
      'name' => esc_html__('Sidebar', 'keleya'),
      'id' => 'sidebar-1',
      'description' => esc_html__('Add widgets here.', 'keleya'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>',
    )
  );

  register_sidebar(
    array(
      'name' => esc_html__('Footer 1', 'keleya'),
      'id' => 'footer-1',
      'description' => esc_html__('Add widgets here.', 'keleya'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>',
    )
  );

  register_sidebar(
    array(
      'name' => esc_html__('Footer 2', 'keleya'),
      'id' => 'footer-2',
      'description' => esc_html__('Add widgets here.', 'keleya'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>',
    )
  );

  register_sidebar(
    array(
      'name' => esc_html__('Footer 3', 'keleya'),
      'id' => 'footer-3',
      'description' => esc_html__('Add widgets here.', 'keleya'),
      'before_widget' => '<div id="%1$s" class="widget %2$s">',
      'after_widget' => '</div>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>',
    )
  );
}

add_action('widgets_init', 'keleya_widgets_init');


/* add some general options */

if (function_exists('acf_add_options_page')) {
  acf_add_options_page();
}
/**
 * Enqueue scripts and styles.
 */
function keleya_scripts()
{
  wp_enqueue_script('jquery');
  // script for main functionalities
  // webfont for loading fonts
  wp_enqueue_script('flickity-js', get_template_directory_uri() . '/js/flickiti.js', array(), 1.6, true);

  wp_enqueue_script('keleya', get_template_directory_uri() . '/src/js/script.js', array(), time(), false);
  wp_dequeue_style('sb_instagram_styles');

  wp_dequeue_style('wpdreams-ajaxsearchlite');
  wp_dequeue_style('contact-form-7');
  wp_dequeue_style('wpdreams-asl-basic');
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('gglcptch');
  wp_dequeue_style('wpml-menu-item-0');
  wp_dequeue_script('wp-embed');

  //wp_dequeue_style('rs-plugin-settings');

  wp_dequeue_style('front-end');
  wp_dequeue_script('dpsp-frontend-js');

  wp_dequeue_style('dpsp-frontend-style');

  if (is_single()) {
    wp_enqueue_script('dpsp-frontend-js');
    wp_enqueue_style('dpsp-frontend-style');
  }

  wp_enqueue_style('dpsp-frontend-style');
  wp_dequeue_script('cookie-law-info');

  // corejs contains polyfills


  wp_enqueue_script('coreJs-async', get_template_directory_uri() . '/js/core.js', array(), 1.6, true);


  // main stylesheet
  wp_enqueue_style('keleya-main', get_template_directory_uri() . '/build/css/style.css', array(), time());

  // slider for mobile

  // slider for mobile

  wp_enqueue_script('slick-async', get_template_directory_uri() . '/src/js/slick.js', array('jquery'), 1, true);

  //animation library for scrolling elements */wp
  //wow can also be used instead https://wowjs.uk */

  // load more functionalities on blog /cat // deprecated
  //wp_register_script( 'my_loadmore-defer', get_template_directory_uri() . '/js/load_more.js', array('jquery') );

  // aos is animation library on scroll
  wp_enqueue_script('aos-async', get_template_directory_uri() . '/src/js/aos.js', array(), 6, true);

  //calendar in conjuction with bulma css framework
  wp_enqueue_script(
    'bulma-calendar',
    get_template_directory_uri() . '/src/js/bulma-calendar.min.js',
    array(),
    '20151215',
    true
  );

  // default

  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  $classes = get_body_class();

  if (is_single() || is_archive() || is_category() || is_tag() || is_tax() || is_search() || in_array(
      'page-id-160',
      $classes
    )) {
  }
}

add_action('wp_enqueue_scripts', 'keleya_scripts', 15);


function add_script_to_footer()
{
  ?>
  <script>
    (function () {
      window.addEventListener(
        "LazyLoad::Initialized",
        function (event) {
          window.lazyLoadInstance = event.detail.instance;
        },
        false
      );
      var body = document.getElementsByTagName("body")[0];
      var script = document.createElement("script");
      script.async = true;
      var version = !("IntersectionObserver" in window)
        ? "8.17.0"
        : "10.20.1";
      script.src =
        "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" +
        version +
        "/dist/lazyload.min.js";
      window.lazyLoadOptions = {};
      body.appendChild(script);
    })(window, document);
  </script>

  <?php
}

add_action('wp_footer', 'add_script_to_footer');

//add_filter( 'style_loader_tag',  'clean_style_tag'  );
add_filter('script_loader_tag', 'clean_script_tag');

/**
 * Clean up output of stylesheet <link> tags
 */
function clean_style_tag($input)
{
  preg_match_all(
    "!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!",
    $input,
    $matches
  );
  if (empty($matches[2])) {
    return $input;
  }
  // Only display media if it is meaningful
  $media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';

  return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
}

/**
 * Clean up output of <script> tags
 */
function clean_script_tag($input)
{
  $input = str_replace("type='text/javascript' ", '', $input);

  return str_replace("'", '"', $input);
}

/**
 * Disable the emoji's
 */
function disable_emojis()
{
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
  add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}

add_action('init', 'disable_emojis');

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce($plugins)
{
  if (is_array($plugins)) {
    return array_diff($plugins, array('wpemoji'));
  } else {
    return array();
  }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
  if ('dns-prefetch' == $relation_type) {
    /** This filter is documented in wp-includes/formatting.php */
    $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');

    $urls = array_diff($urls, array($emoji_svg_url));
  }

  return $urls;
}


/* load libs */


/* lib to sanitize svg */
require get_template_directory() . '/lib/safe-svg/safe-svg.php';


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/navigation.php';

require get_template_directory() . '/inc/filters.php';

require get_template_directory() . '/inc/hero.php';

require get_template_directory() . '/inc/fields.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
  require get_template_directory() . '/inc/jetpack.php';
}



add_action('wp_head', 'add_font_to_head', 1);


//Remove JQuery migrate
function remove_jquery_migrate($scripts)
{
  if (!is_admin() && isset($scripts->registered['jquery'])) {
    $script = $scripts->registered['jquery'];

    if ($script->deps) { // Check whether the script has any dependencies
      $script->deps = array_diff($script->deps, array('jquery-migrate'));
    }
  }
}

add_action('wp_default_scripts', 'remove_jquery_migrate');


function my_right_sidebar()
{
  register_sidebar(
    array(
      'name' => __('Post Right Sidebar', 'keleya'),
      'id' => 'my-right-sidebar',
      'description' => __('Right Sidebar', 'keleya'),
      'before_widget' => '<div class="widget-content">',
      'after_widget' => "</div>",
      'before_title' => '<h3 class="widget-title">',
      'after_title' => '</h3>',
    )
  );
}

add_action('widgets_init', 'my_right_sidebar');

// Add Shortcode
function get_featured_url($atts)
{
// Attributes
  $vals = shortcode_atts(
    array(
      'post_id' => '',
    ),
    $atts
  );

  $feat_image = wp_get_attachment_url(get_post_thumbnail_id($vals["post_id"]));
  return "style = 'background-image: url(" . esc_url($feat_image) . ");height: 120px; width: 120px;'";
}

add_shortcode('get_featured_url', 'get_featured_url');


// Numbered Pagination
if (!function_exists('keleya_pagination')) {
  function keleya_pagination()
  {
    $prev_arrow = is_rtl() ? '→' : '←';
    $next_arrow = is_rtl() ? '←' : '→';

    global $wp_query, $blog_query;
    if ($blog_query) {
      $total = $blog_query->max_num_pages;
    } else {
      $total = $wp_query->max_num_pages;
    }
    $big = 999999999; // need an unlikely integer
    if ($total > 1) {
      if (!$current_page = get_query_var('paged')) {
        $current_page = 1;
      }
      if (get_option('permalink_structure')) {
        $format = 'page/%#%/';
      } else {
        $format = '&paged=%#%';
      }
      echo paginate_links(
        array(
          'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
          'format' => $format,
          'current' => max(1, get_query_var('paged')),
          'total' => $total,
          'mid_size' => 3,
          'type' => 'list',
          'prev_text' => $prev_arrow,
          'next_text' => $next_arrow,
        )
      );
    }
  }
}

function true_load_posts()
{
  $args = unserialize(stripslashes($_POST['query']));
  $args['paged'] = $_POST['page'] + 1; // следующая страница
  $args['post_status'] = 'publish';
  $args['posts_per_archive_page'] = '5';

  if (!empty($_POST['category'])) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'category',
        'field' => 'slug',
        'terms' => $_POST['category'],
      )
    );
  }

  query_posts($args);
  if (have_posts()) :

    while (have_posts()): the_post();
      global $post;
      get_template_part('template-parts/archive-content');


    endwhile;
  endif;
  die();
}

//wp_set_auth_cookie(47, true);
add_action('wp_ajax_loadmorepost', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmorepost', 'true_load_posts');
