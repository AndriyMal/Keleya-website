<?php

require_once __DIR__ . '/../parts/header.php';
?>
<div class="step without-progress login">
  <a href="<?= kp_get_route("/") ?>" class="go-back">
    <img src="<?= get_template_directory_uri() ?>/payment-system/assets/images/path-back.svg" alt="">
  </a>
  <div class="step-content">
    <h1 class="step-title">
      Mit Email einloggen
    </h1>
    <form method="post" action="<?= kp_get_route('set-plan') ?>" class="login custom-form">
      <div class="form-item">
        <input type="text" name="email" id="email" class="text-input custom-field" onfocus="this.placeholder = ''"
               onblur="this.placeholder = 'Email-Adresse'" placeholder="Email-Adresse"
               oninput="disabledSudmitChecker(this, ['#email', '#password'])">
      </div>
      <div class="form-item">
        <input type="password" name="password" id="password" class="text-input custom-field"
               onfocus="this.placeholder = ''"
               onblur="this.placeholder = 'Password'" placeholder="Password"
               oninput="disabledSudmitChecker(this, ['#email', '#password'])">
        <div class="show-password" onclick="showPassword()">

        </div>
      </div>

      <div class="btn-group">
        <button name="login" value="true" type="submit" disabled class="disabled submit-btn"><span>Weiter</span>
        </button>
      </div>

    </form>
  </div>
</div>
<?php
require_once __DIR__ . '/../parts/footer.php';
?>
