<?php

require_once __DIR__ . '/../parts/header.php';
?>
<div class="step set-product">
  <a href="<?= kp_get_route("set-birthday") ?>" class="go-back">
    <img src="<?= get_template_directory_uri() ?>/payment-system/assets/images/path-back.svg" alt="">
  </a>
  <div class="progress second">
  </div>
  <div class="step-content">
    <h1 class="step-title">
      Deine Ernährung
    </h1>
    <p class="step-subtitle">
      Wähle deinen Ernährungstyp aus. Allergene und Sachen, die dir nicht schmecken, kannst du später in
      der App einrichten.
    </p>
    <form action="<?= kp_get_route('set-workout') ?>" method="post" class="set-product-form">
      <div class="set-product-wrapper">
        <div class="product-item active" id="vegan" data-text="Vegetarisch" data-hover="images/eat/veg-hover.svg">
          <input type="hidden" name="foodPreferences[veganAllowed]" value="true">
        </div>
        <div class="product-item" id="fish" data-text="Fisch" data-hover="images/eat/fish-hover.svg">
          <input type="hidden" name="foodPreferences[fishAllowed]" value="true">
        </div>
        <div class="product-item" id="meat" data-text="Fleisch" data-hover="images/eat/meat-hover.png">
          <input type="hidden" name="foodPreferences[meatAllowed]" value="true">
        </div>
      </div>

      <p class="change-text">
        Ich esse Vegetarisch.
      </p>

      <div class="btn-group">
        <button type="submit" class="submit-btn"><span>Weiter</span></button>
      </div>
    </form>
  </div>
</div>
<?php
require_once __DIR__ . '/../parts/footer.php';
?>
