<?php

require_once __DIR__ . '/../parts/header.php';
?>
<div class="step">
  <h1 class="step-title">Wie möchtest du dich einloggen?</h1>

  <a class="large-btn manual" href="<?= kp_get_route('login') ?>"><span>Mit Email einloggen</span></a>
  <a class="large-btn fb" onclick="fb_login();">
    <span class=" icon"></span>

    <span>Weiter mit Facebook</span>
  </a>


  <a class="large-btn google" data-onsuccess="onSignIn">
    <span class="icon"></span>
    <span>Sign in with Google</span></a>

  <div class="down-text">
    <span>Du hast noch kein Konto? </span>
    <a href="<?= kp_get_route('set-name') ?>">Hier registrieren.</a>
  </div>
</div>
<?php
require_once get_template_directory() . "/payment-system/parts/socialscripts.php";
require_once __DIR__ . '/../parts/footer.php';
?>
