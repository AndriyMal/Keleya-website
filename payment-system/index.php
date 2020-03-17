<?php

require_once 'inc/routes.php';

$url = parse_url($_SERVER['REQUEST_URI']);
$route = explode('/', $url['path']);
require_once 'inc/promocode.php';
require_once 'inc/payment.php';
require_once "inc/registration.php";
require_once "inc/userManager.php";
(new kp_registration())->init();


//todo refactor it
if (in_array('online-registration', $route)) {
    if (!empty($_COOKIE["items"])) {
        $items = json_decode(str_ireplace('+', ' ', stripslashes($_COOKIE['items'])), true);
    }
    if (!empty($_GET['add_to_cart'])) {
        $items[$_GET['add_to_cart']] =
            [
                'name' => $_GET['item'],
                'price' => $_GET['price'],
                'code' => $_GET['code'],
            ];
        $json = json_encode($items);
        setcookie("items", $json, time() + 3600);
    }
    $kp_registrator = new kp_registration();
    $kp_registrator->checkField();

    if (!empty($_POST['register'])) {
        $kp_registrator->register();
    } elseif (!empty($_POST['login'])) {
        $kp_registrator->authorization();
    }

    if (!empty($route[2]) && file_exists(__DIR__ . "/pages/" . $route[2] . ".php")) {
        error_reporting(-1);
        ini_set('display_errors', 'On');


        require_once 'pages/' . $route[2] . '.php';
        die();
    } elseif (empty($route[2])) {
        require_once 'pages/main.php';
        die();
    }
}
