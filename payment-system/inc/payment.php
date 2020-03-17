<?php

use Stripe\Checkout\Session;
use Stripe\Stripe;

$KP_PAYMENT_ITEMS = [
    "1 Monat Premium" => [],
    "3 Monate Premium" => [],
    "6 Monate Premium" => [],
    "Geburtsvorbereitungskurs" => [],
    "Sonderpaket für Mitglieder der AOK Plus" => [],
];


add_action('wp_ajax_nopriv_kp_payment', 'kp_create_checkout');
add_action('wp_ajax_kp_payment', 'kp_create_checkout');


function kp_create_checkout()
{
    if (!empty($_POST['promocode_discount'])) {
        $discount = intval($_POST['promocode_discount']);
    }

    $items = json_decode(str_ireplace('+', ' ', stripslashes($_POST['cart'])), true);

    Stripe::setApiKey('rk_test_8VmVN0ipzUk216l68oP7mpi200SZSY9XbF');

    $checkout_data = [
        'success_url' => 'https://keleya.de/online-registration/success',
        'cancel_url' => 'https://keleya.de/online-registration/payment',
        'payment_method_types' => ['card'],
    ];

    foreach ($items as $item) {
        $price = str_replace('.', '', $item["price"]);
        if (!empty($discount)) {
            $disc_value = $price / 100 * $discount;
            $price = intval($price) - intval($disc_value);
        }
        $checkout_data['line_items'][] = [
            'name' => $item['name'],
            'images' => ["https://keleya.de/wp-content/themes/keleya/img/keleya-logo.png"],
            'quantity' => '1',
            'amount' => $price,
            'currency' => 'EUR'
        ];
    }
    $checkout_session = Session::create($checkout_data);


    echo json_encode($checkout_session);
    die();
    return;
}


add_action('wp_ajax_nopriv_kp_webhook', 'kp_webhook');
add_action('wp_ajax_kp_webhook', 'kp_webhook');


