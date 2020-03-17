<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package keleya
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>

    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <style>
        .section.content, .footer {
            background-color: white;
            z-index: 999999999;
            position: relative;
            margin-bottom: -15px;
        }

        .go_back_btn {
            color: #9adcd8;
            margin: 10px 0;
        }

        .go_back_btn a {
            color: #9adcd8;
            text-transform: uppercase;
            font-weight: 500;
            font-size: 20px;
        }
        .go_back_btn a:hover {
            color: black;
        }
        @media (min-width: 826px) {
            .m-only {
                display: none;
            }
            .single-post .entry-content h1, .single-post .entry-content h2, .single-post .entry-content h3, .single-post .entry-content h4, .single-post .entry-content h5, .single-post .entry-content h6, .single-post .entry-content p {
              text-align: left;
              word-break: break-word;
              word-wrap: break-word;
            }
        }
        .go_back_btn.m-only {
            text-align: center;
        }
        @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap');
        font-family: 'Roboto', sans-serif;
        font-family: 'Open Sans', sans-serif;
    </style>
    <meta name="apple-itunes-app" content="app-id=1258470013, app-argument=https://keleya.de">
    <meta name="google-play-app" content="app-id=de.keleya.app">

    <?php wp_head(); ?>

    <!-- Facebook Pixel Code -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '298983480567603');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1"
             src="https://www.facebook.com/tr?id=298983480567603&ev=PageView
&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
<!--    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-103795708-1"></script>-->
<!--    <script>-->
<!--        window.dataLayer = window.dataLayer || [];-->
<!--        function gtag(){dataLayer.push(arguments);}-->
<!--        gtag('js', new Date());-->
<!---->
<!--        gtag('config', 'UA-103795708-1', { 'optimize_id': 'GTM-MMC8R9V'});-->
<!--    </script>-->
</head>

<body id="sitewrap" <?php body_class(); ?>>

<!-- Google Tag Manager (noscript) -->
<!--<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=UA-103795708-1"-->
<!--                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>-->
<!-- End Google Tag Manager (noscript) -->

<!-- Anti-flicker snippet (recommended)  -->
<!--<style>.async-hide { opacity: 0 !important} </style>-->
<!--<script>(function(a,s,y,n,c,h,i,d,e){s.className+=' '+y;h.start=1*new Date;-->
<!--        h.end=i=function(){s.className=s.className.replace(RegExp(' ?'+y),'')};-->
<!--        (a[n]=a[n]||[]).hide=h;setTimeout(function(){i();h.end=null},c);h.timeout=c;-->
<!--    })(window,document.documentElement,'async-hide','dataLayer',4000,-->
<!--        {'OPT_CONTAINER_ID':true});</script>-->

<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '{245778305927486}',
            cookie: true,
            xfbml: true,
            version: '{v3.2}'
        });

        FB.AppEvents.logPageView();

    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<div id="preloader">
    <div id="loader"></div>
</div>
<div id="menu-overlay">
</div>

<header id="masthead" class="site-header">
    <nav class="navbar main-navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="<?php echo esc_url(home_url('/')); ?>" rel="home">

                <?php logo_handler() ?>
            </a>

            <!--                    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBurger">-->
            <!---->
            <!--                    </a>-->

            <?php


            wp_nav_menu(
                array(
                    'theme_location' => 'menu-app',
                    'menu_id' => 'menu-app-alt',
                    'container' => '',
                    'container_class' => '',
                    'container_id' => '',
                    'menu_class' => 'app-link-alt',
                    'walker' => new Description_Walker(),
                    'nav_menu_css_class' => 'link',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                )
            );
            ?>

            <?php if (!get_field('hide_menu')) : ?>
                <a class="cmn-toggle-switch cmn-toggle-switch__htra" aria-label="menu" aria-expanded="false"
                   data-target="navbarBurger" title="toggle">
                    <span>toggle menu</span>
                </a>
            <?php endif ?>

        </div>

        <?php if (get_field('hide_menu')) : ?>
            <style>
                @media only screen and (max-width: 768px) {
                    #navbarBurger {
                        display: none;
                    }
                }
            </style>
        <?php endif ?>
        <div id="navbarBurger" class="navbar-menu">

            <?php

            wp_nav_menu(
                array(
                    'theme_location' => 'menu-app',
                    'menu_id' => '',
                    'container' => '',
                    'container_class' => '',
                    'container_id' => '',
                    'menu_class' => 'app-link',
                    'walker' => new Description_Walker(),
                    'nav_menu_css_class' => 'link',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                )
            );
            ?>
            <?php

            wp_nav_menu(
                array(
                    'theme_location' => 'menu-1',
                    'menu_id' => '',
                    'container' => '',
                    'container_class' => '',
                    'container_id' => '',
                    'menu_class' => 'navbar-start',
                    'walker' => new Description_Walker(),
                    'nav_menu_css_class' => 'navbar-item',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                )
            );
            ?>

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
            <?php

            $link = get_field('header_button', 'option');

            if (!isset($link['target'])) :
                $link['target'] = '_blank';
            endif;

            ?>

            <div class="social-icons">
                <?php load_social_icons(); ?>
            </div>

            <div class="actions">
                <a href="#" class="cta_button open-signup"><?php the_field('try_now', 'option') ?></a>
            </div>
        </div>


    </nav><!-- #site-navigation -->
</header><!-- #masthead -->
