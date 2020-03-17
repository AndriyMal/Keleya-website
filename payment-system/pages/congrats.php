<?php
require_once __DIR__ . '/../parts/header.php';
kp_checkLogin();
$userManager = new userManager();
$user = $userManager->getUser($_COOKIE['usertoken']);
$user['status'] = !empty($items['plan']['code']) ? $items['plan']['code'] : 'free';
$user['birthPrep'] = !empty($items['course']['code']) ? "subscribed" : 'free';
$userManager->updateUser($_COOKIE['usertoken'], $user);
?>
<div class="step without-progress congrats">
    <a href="<?= kp_get_route("set-feeling") ?>" class="go-back">
        <img src="<?= get_template_directory_uri() ?>/payment-system/assets/images/path-back.svg" alt="">
    </a>

    <div class="step-content">
        <h1 class="step-title">
            Dein individueller Plan ist bereit! 🎉
        </h1>
        <p class="step-subtitle">
            Du benötigst ein Konto, um deine Fortschritte zu speichern.
        </p>


        <a class="large-btn manual" href="<?= kp_get_route('registration') ?>"><span>Mit Email registrieren</span></a>
        <a class="large-btn fb" onclick="fb_login();">
            <span class="icon"></span>

            <span>Weiter mit Facebook</span>
        </a>


        <a class="large-btn google" data-onsuccess="onSignIn">
            <span class="icon"></span>
            <span>Sign in with Google</span></a>

        <div class="down-text">

            <span>Du hast schon ein Konto?  </span>
            <a href="<?= kp_get_route('login') ?>">Hier einloggen.</a>
        </div>
    </div>
</div>
<?php
require_once get_template_directory() . "/payment-system/parts/socialscripts.php";
require_once __DIR__ . '/../parts/footer.php';
?>
