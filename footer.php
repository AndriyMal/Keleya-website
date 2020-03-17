<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package keleya
 */

?>

<footer id="colophon" class="footer site-footer">
  <a href="#" class="" id="scrollToTop">
    <img src="<?= get_template_directory_uri() . '/svg/icons/arrow-up.svg' ?>" alt="scrolltop"/>
  </a>
  <div class="container">
    <div class="columns top-footer">
      <div class="column content">

        <h2><?php the_field('footer_left_title', 'option'); ?></h2>
        <h3><?php the_field('footer_follow_us', 'option'); ?></h3>

        <div class="social-icons-section social-icons">
          <?php load_social_icons(); ?>
        </div>

        <div class="newsletter-section">
          <h3><?php the_field('footer_newsletter_title', 'option'); ?></h3>

          <?php footer_newsletter() ?>
        </div>


        <h3><?php the_field('footer_download', 'option'); ?></h3>
        <div class="app-icons">
          <?php get_app_icons() ?>
        </div>

        <?php if (is_active_sidebar('footer-3')) : ?>
          <div id="footer-3" class="widget-area" role="complementary">
            <?php //dynamic_sidebar( 'footer-3' ); ?>


          </div><!-- #primary-sidebar -->
        <?php endif; ?>
      </div>
      <div class="column">
        <?php if (is_active_sidebar('footer-1')) : ?>
          <div id="footer-1" class="widget-area" role="complementary">
            <?php dynamic_sidebar('footer-1'); ?>
          </div><!-- #primary-sidebar -->
        <?php endif; ?>
      </div>

      <div class="column">
        <?php if (is_active_sidebar('footer-2')) : ?>
          <div id="footer-2" class="widget-area" role="complementary">
            <?php dynamic_sidebar('footer-2'); ?>
          </div><!-- #primary-sidebar -->
        <?php endif; ?>
        <div class="language-block">
          <?php
          wp_nav_menu(
            array(
              'theme_location' => 'menu-lang',
              'menu_id' => '',
              'container' => '',
              'container_class' => '',
              'container_id' => '',
              'menu_class' => 'navbar-end',
              'walker' => new Description_Walker(),
              'nav_menu_css_class' => 'navbar-item',
              'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
            )
          );
          ?>
        </div>
        <div class="ce-wrapper" style="align-items: center;display: flex;margin-top: 10px;">
          <img style="width: 50px; display: inline; margin-left: 9px; margin-top: 0px; margin-right: 0px;"
               src="/wp-content/uploads/2020/01/ce-mark-e1578397656466.png" alt="" class="loading"
               data-was-processed="true" style="
    width: 50px;
    display: inline;
    margin-left: 9px;
    margin-top: 10px;
">
          <?php if (trim(ICL_LANGUAGE_CODE) == "en") { ?>
            <span style="font-size: 15px" class=""><?= _("KELEYA is a certified CE medical app") ?></span>
          <?php } elseif (trim(ICL_LANGUAGE_CODE) == "de") { ?>
            <span style="font-size: 15px" class=""><?= _("KELEYA ist eine CE-zertifizierte medizinische App") ?></span>

          <?php } ?>
        </div>
      </div>


    </div>
    <div class="columns footer__bottom is-vcentered">
      <div class="column">

      </div>
      <div class="column is-5 has-text-centered">
        <?php
        /* translators: %s: CMS name, i.e. WordPress. */
        printf(esc_html__('&copy; Copyright %s', 'keleya'), date('Y'));
        ?>

      </div>
      <div class="column">

      </div>


    </div><!-- .site-info -->


  </div>


  <?php
  // loading newsletter popup
  get_newsletter_popup(get_field('newsletter_title', 'option'), get_field('newsletter_subtitle', 'option'));
  get_signup_popup()
  ?>

  <!-- mailchimp setup -->
  <script id="mcjs">!function (c, h, i, m, p) {
      m = c.createElement(h), p = c.getElementsByTagName(h)[0], m.async = 1, m.src = i, p.parentNode.insertBefore(m, p)
    }(document, "script", "https://chimpstatic.com/mcjs-connected/js/users/2e87c24c509100df36b69421b/51e46a110fd820a08dfad0d54.js");</script>

  <script>

    //          todo rewrite to ES 6
    jQuery(function ($) {

      $(window).scroll(function () {
        try {


          var bottomOffset = 2000; // отступ от нижней границы сайта, до которого должен доскроллить пользователь, чтобы подгрузились новые посты
          var data = {
            'action': 'loadmorepost',
            'query': true_posts,
            'page': current_page
          };
          var scroll = $('#true_loadmore');

          if ($(document).scrollTop() > ($(document).height() - bottomOffset) && !$('body').hasClass('loading')) {
            if (scroll.attr('data-category')) {
              data.category = scroll.attr('data-category');
            }
            console.dir(data);
            $.ajax({
              url: ajaxurl,
              data: data,
              type: 'POST',
              beforeSend: function (xhr) {
                $('body').addClass('loading');
              },
              success: function (data) {
                if (data) {
                  $('#true_loadmore').before(data);
                  $('body').removeClass('loading');
                  current_page++;
                }
              }
            });
          }
        } catch (e) {

        }
      });
    });
  </script>
</footer><!-- #colophon -->

<?php wp_footer(); ?>
<script>
  <?php the_field('additional-js-code') ?>
</script>
</body>
</html>
