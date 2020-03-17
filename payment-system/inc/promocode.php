<?php

class kpPromodes
{

  private $db;

  const TABLE_NAME = "promocode";

  public function __construct()
  {
    global $wpdb;
    $this->db = $wpdb;
  }

  private function generateRandomString($length = 10)
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  public function migrate()
  {
    $this->db->query(
      "CREATE TABLE `promocode` ( `id` INT NOT NULL AUTO_INCREMENT , `code` VARCHAR(255) NOT NULL , `amount` VARCHAR NOT NULL , `date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `used` INT(1) NOT NULL DEFAULT '0' , PRIMARY KEY (`id`));"
    );
    $this->db->qusey("ALTER TABLE `keleya`.`promocode` ADD UNIQUE `uniqPromocode` (`code`);");
  }

  public function createUniqPromocode($count = 0, $amount)
  {
    for ($i = 0; $i < $count; $i++) {
      $this->db->query(
        "INSERT INTO `" . self::TABLE_NAME . "` (`id`, `code`, `amount`, `date`, `used`) VALUES (NULL, '" . $this->generateRandomString(
          10
        ) . "', '" . $amount . "', CURRENT_TIMESTAMP, '0')"
      );
    }
  }

  private function checkPromocode($promocode)
  {
    $result = $this->db->get_results(
      "SELECT * FROM `" . self::TABLE_NAME . "` WHERE code = '" . trim($promocode) . "' AND `used` = 0",
      ARRAY_A
    );
    if (!empty($result)) {
      return $result;
    } else {
      return false;
    };
  }

  public function ajaxCheckPromocode()
  {
    $promocode = $this->checkPromocode($_POST['promocode']);
    if ($promocode) {
      $test = $this->db->update(
        self::TABLE_NAME,
        ['used' => 1],
        ["code" => trim($_POST['promocode'])]
      );
      echo intval($promocode[0]['amount']);
    } else {
      return "false";
    }
    die();
  }

  public function init()
  {
    add_action('wp_ajax_nopriv_kp_check_promocode', [$this, 'ajaxCheckPromocode']);
    add_action('wp_ajax_kp_check_promocode', [$this, 'ajaxCheckPromocode']);
  }
}


/*
 * ADD PAGE TO ADMIN PANEL
 */


//add_action(
//  'admin_menu',
//  function () {
//    add_menu_page(
//      'Promocodes',
//      'Promocodes',
//      'manage_options',
//      'promocodes',
//      function () {
//        require_once 'page_promocode.php';
//      },
//      '',
//      4
//    );
//  }
//);

//$promo = new kpPromodes();
//$promo->init();
//$promo->migrate();
//$promo->createUniqPromocode(125, '10%');
//$promo->createUniqPromocode(250, '20%');
//$promo->createUniqPromocode(125, '30%');
//die();


// NEW PROMOCODE

class Promocodes
{


  public function init()
  {
    $this->registerPostType();
    $this->addMetaBox();
    $this->saveMetaboxeData();
    $this->ajaxCheckPromocode();
    $this->exportPromocodes();
  }

  private function registerPostType()
  {
    // Register Custom Post Type


    add_action(
      'init',
      function () {
        $labels = array(
          'name' => _x('promocodes', 'Post Type General Name', 'keleya'),
          'singular_name' => _x('promocode', 'Post Type Singular Name', 'keleya'),
          'menu_name' => __('Promocodes', 'keleya'),
          'name_admin_bar' => __('Promocodes', 'keleya'),
          'archives' => __('Item Archives', 'keleya'),
          'attributes' => __('Item Attributes', 'keleya'),
          'parent_item_colon' => __('Parent Item:', 'keleya'),
          'all_items' => __('All Items', 'keleya'),
          'add_new_item' => __('Add New Item', 'keleya'),
          'add_new' => __('Add New', 'keleya'),
          'new_item' => __('New Item', 'keleya'),
          'edit_item' => __('Edit Item', 'keleya'),
          'update_item' => __('Update Item', 'keleya'),
          'view_item' => __('View Item', 'keleya'),
          'view_items' => __('View Items', 'keleya'),
          'search_items' => __('Search Item', 'keleya'),
          'not_found' => __('Not found', 'keleya'),
          'not_found_in_trash' => __('Not found in Trash', 'keleya'),
          'featured_image' => __('Featured Image', 'keleya'),
          'set_featured_image' => __('Set featured image', 'keleya'),
          'remove_featured_image' => __('Remove featured image', 'keleya'),
          'use_featured_image' => __('Use as featured image', 'keleya'),
          'insert_into_item' => __('Insert into item', 'keleya'),
          'uploaded_to_this_item' => __('Uploaded to this item', 'keleya'),
          'items_list' => __('Items list', 'keleya'),
          'items_list_navigation' => __('Items list navigation', 'keleya'),
          'filter_items_list' => __('Filter items list', 'keleya'),
        );
        $args = array(
          'label' => __('promocode', 'keleya'),
          'labels' => $labels,
          'supports' => array('title', 'custom-fields'),
          'taxonomies' => array('group'),
          'hierarchical' => false,
          'public' => true,
          'show_ui' => true,
          'show_in_menu' => true,
          'menu_position' => 5,
          'menu_icon' => 'dashicons-megaphone',
          'show_in_admin_bar' => true,
          'show_in_nav_menus' => true,
          'can_export' => true,
          'has_archive' => false,
          'exclude_from_search' => true,
          'publicly_queryable' => false,
          'rewrite' => false,
          'capability_type' => 'page',
        );
//            register promocodes
        register_post_type('promocodes', $args);

        //            register promocode item

        register_post_type(
          'promocode_item',
          array(
            'label' => __('promocode_item', 'keleya'),
            'supports' => array('title', 'custom-fields'),
            'taxonomies' => array(),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => false,
            'show_in_admin_bar' => false,
            'show_in_nav_menus' => false,
            'can_export' => false,
            'has_archive' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'rewrite' => false,
            'capability_type' => 'page',
          )
        );
      },
      0
    );
  }

  private function saveMetaboxeData()
  {
    add_action(
      'save_post',
      function ($post_id) {
        $post = get_post($post_id);
        if ($post->post_status == 'publish' && $post->post_type == 'promocodes') {
          $promocode_type = get_field("type");
          $code = get_field("code");
          $expiration_date = get_field('expiration_date');
          $count_of_use = get_field('count_of_use');
          $codes_count = get_field("codes_count");

          if ($promocode_type === "one") {
            $this->onePromoCreateProcessor($post_id, $code, $expiration_date, $count_of_use);
          } elseif ($promocode_type === "many") {
            $this->manyPromoCreateProcessor($post_id, $codes_count, $code);
          }
        }
      }
    );
  }

  private function manyPromoCreateProcessor($post_id, $codes_count, $prefix = null)
  {
    for ($i = 0; $i < $codes_count; $i++) {
      if (is_int($i / 10000)) {
        sleep(1);
      }
      $this->onePromoCreateProcessor($post_id, $prefix . $this->generateRandomString(10));
    }
  }

  private function onePromoCreateProcessor($post_id, $code, $expiration_date = null, $count_of_use = null)
  {
    $post_data = array(
      'post_title' => $code,
      'post_parent' => $post_id,
      'post_status' => 'publish',
      'post_type' => "promocode_item",
      "meta_input" => [
        'expire_date' => !empty($expiration_date) ? $expiration_date : null,
        'max_count_of_use' => !empty($count_of_use) ? $count_of_use : 1,
        'current_count_of_use' => "0",
      ]
    );
    $post_id = wp_insert_post($post_data);
  }

  private function getPromocodeItemsByPromoId($promoId)
  {
//        todo implement it
    $posts = get_posts(
      array(
        'numberposts' => -1,
        'post_parent' => $promoId,
        'post_type' => 'promocode_item',
        'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
      )
    );

    return $posts;
  }

  public function checkPromocode()
  {
    $code = $_POST['promocode'];
    $promocode_item = get_page_by_title($code, 'OBJECT', 'promocode_item');

    if (empty($promocode_item)) {
      return "false";
      die();
    }

    $meta = get_post_meta($promocode_item->ID);
    $new_current_count_of_use = $meta["current_count_of_use"][0] + 1;
    $max_count_of_use = $meta['max_count_of_use'][0];

    if ($new_current_count_of_use >= $max_count_of_use) {
      return "false";
      die();
    }

    update_post_meta($promocode_item->ID, 'current_count_of_use', $new_current_count_of_use);

    $discount = get_field("discount_percent", $promocode_item->post_parent);
    echo intval($discount);
    die();
  }

  private function ajaxCheckPromocode()
  {
    add_action('wp_ajax_nopriv_kp_check_promocode', [$this, 'checkPromocode']);
    add_action('wp_ajax_kp_check_promocode', [$this, 'checkPromocode']);
  }

  public function prepareCsvForExport($code)
  {
    $promocodes = $this->getPromocodeItemsByPromoId($code);
    $promocodesArrayToExport = [];

    foreach ($promocodes as $promocode) {
      $meta = get_post_meta($promocode->ID);
      $promocodesArrayToExport[] = [
        $promocode->post_title,
        $meta["current_count_of_use"][0],
        $meta['max_count_of_use'][0]
      ];
    }

    return $promocodesArrayToExport;
  }

  public function exportPromoToCsv()
  {
    $code = $_GET['code'];
    $array = $this->prepareCsvForExport($code);
    $filename = "export.csv";
    $delimiter = ";";
    // open raw memory as file so no temp files needed, you might run out of memory though
    $f = fopen('php://memory', 'w');
    // loop over the input array

    fputcsv($f, ['Code', 'Current count of use', 'Count of max use'], $delimiter);

    foreach ($array as $line) {
      // generate csv lines from the inner arrays
      fputcsv($f, $line, $delimiter);
    }
    // reset the file pointer to the start of the file
    fseek($f, 0);
    // tell the browser it's going to be a csv file
    header('Content-Type: application/csv');
    // tell the browser we want to save it instead of displaying it
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    // make php send the generated csv lines to the browser
    fpassthru($f);
    die();
  }

  public function exportPromocodes()
  {
    add_action('wp_ajax_nopriv_kp_export_promodes', [$this, 'exportPromoToCsv']);
    add_action('wp_ajax_kp_export_promodes', [$this, 'exportPromoToCsv']);
  }

  private function addMetaBox()
  {
    add_action(
      'add_meta_boxes',
      function () {
        add_meta_box(
          'promocode-settings',
          'Promocode settings',
          // HTML код блока
          function ($post) {
            global $current_screen;
            if ($current_screen->action !== "add") {
              $this->addedPromoMetabox($post);
            } else {
              ?>
              <style>
                #promocode-settings {
                  display: none !important;
                }
              </style>
              <?php
            }
          },
          'promocodes',
          'normal',
          'high'
        );
      }
    );
  }

  private function addedPromoMetabox($post)
  {
    $codes = $this->getPromocodeItemsByPromoId(get_the_ID());
    $total_max_use = 0;
    $total_current_use = 0;
    foreach ($codes as $code) {
      $meta = get_post_meta($code->ID);
      $total_max_use += $meta['max_count_of_use'][0];
      $total_current_use += $meta['current_count_of_use'][0];
    }
    wp_enqueue_style(
      'bootstrap',
      "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    );
    wp_nonce_field(plugin_basename(__FILE__), 'promocode_noncename');
    $value = get_post_meta($post->ID, 'promotion_data', 1);
    ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">
    <style>
      #normal-sortables > div, .acf-postbox {
        display: none !important;
      }

      #normal-sortables > #promocode-settings {
        display: block !important;
      }
    </style>
    <script>
      document.querySelector("#publish").remove();
    </script>

    <div class="added_promocode_details">
      <div class="field">
        Expiration date: <?= get_field("expiration_date"); ?> <br>
        Discount percent: <?= get_field("discount_percent"); ?> <br>
        Count of promocodes: <?= count($codes) ?> <br>
        Total possible uses: <?= $total_max_use ?> <br>
        Total used: <?= $total_current_use ?> <br>
        <?php

        //        require_once 'page_promocode.php'
        ?>
      </div>
      <a href="/wp-admin/admin-ajax.php?action=kp_export_promodes&code=<?= get_the_ID() ?>"
         class="btn btn-primary btn active" role="button" aria-pressed="true">Export to csv</a>
    </div>
    <?php
  }

  private
  function generateRandomString(
    $length = 10
  ) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
}

(new Promocodes())->init();
