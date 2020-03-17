<?php

setcookie("items", null);
require_once __DIR__ . '/../parts/header.php';
//kp_checkLogin()
?>
<div class="step set-plan without-progress">
  <a onclick="window.history.back();"
    class="go-back">
    <img src="<?= get_template_directory_uri() ?>/payment-system/assets/images/path-back.svg" alt="">
  </a>
  <a href="<?= kp_get_route('additional-course') ?>" class="skip-btn">Überspringen</a>
  <div class="step-content">
    <h1 class="step-title">Unser Angebot zur Anmeldung</h1>
    <div class="set-plan-wrapper">

      <div class="plan-item second">
        <h3>
          1 Monat <br>
          Premium
        </h3>
        <p class="price">
          9,99€
        </p>
        <p class="desc">
          Zugriff auf absolut
          allen Content für
          einen Monat
        </p>
        <a href="<?= kp_get_route('additional-course') ?>?add_to_cart=plan&item=1%20Monat%20Premium&price=9.99&code=subscribed-1m"
           class="btn">
          Auswählen
        </a>
      </div>

      <div class="plan-item main">
        <div class="sale">-51%</div>
        <h3>
          3 Monate <br>
          Premium
        </h3>
        <p class="price discount">
          14,49€
          <span class="old">
          32,20€
        </span>
        </p>
        <ul class="desc">
          <li>Alle Workouts & Rezepte</li>
          <li>Alle Podcasts, Experten-videos, Hebammentipps und mehr</li>
          <li>Geburtsvorbereitungs-kurs in der App erhältlich</li>

        </ul>
        <a href="<?= kp_get_route('additional-course') ?>?add_to_cart=plan&item=3%20Monate%20Premium&price=14.49&code=subscribed-3m"
           class="btn">
          Auswählen
        </a>
      </div>

      <div class="plan-item second">
        <div class="sale">-51%</div>

        <h3>
          6 Monate <br>
          Premium
        </h3>
        <p class="price discount">
          28,49€
          <span class="old">
          64,42€
        </span>
        </p>
        <p class="desc">
          Zugriff auf absolut
          allen Content für
          einen Monat
        </p>
        <a href="<?= kp_get_route('additional-course') ?>?add_to_cart=plan&item=6%20Monate%20Premium&price=28.49&code=subscribed-6m"
           class="btn">
          Auswählen
        </a>
      </div>
    </div>
    <p class="capture">
      Wird als einmalige Zahlung abgebucht.
    </p>

    <div class="capture-spec">
      <img src="<?= get_template_directory_uri() ?>/payment-system/assets/images/capture-spec.png" alt="">
      <span><a href="<?= kp_get_route('aok-plus') ?>">Zum Sonderangebot </a> für Versicherte der AOK Plus.
    </span>
    </div>

    <div class="capture-bottom">
      Für weitere Informationen zur Zahlung, besuch bitte unsere <a href="">Allgemeinen <br>
        Geschäftsbedingungen</a> und <a href="#">Datenschutzerklärung.</a>
    </div>

  </div>
</div>
<script>
  setCookie('items', null);
</script>
<?php
require_once __DIR__ . '/../parts/footer.php';
?>
