<?php

require_once __DIR__ . '/../parts/header.php';
?>
<div class="step without-progress register">
  <a href="<?= kp_get_route("congrats") ?>" class="go-back">
    <img src="<?= get_template_directory_uri() ?>/payment-system/assets/images/path-back.svg" alt="">
  </a>
  <div class="step-content">
    <h1 class="step-title">
      Mit Email einloggen
    </h1>
    <form method="post" action="<?= kp_get_route('set-plan') ?>" class="register custom-form">
      <div class="form-item">
        <input type="text" id="email" name="email" class="text-input custom-field" onfocus="this.placeholder = ''"
               onblur="this.placeholder = 'Email-Adresse'" placeholder="Email-Adresse"
               oninput="disabledSudmitChecker(this, ['#email', '#password'], ['#cl-2', '#cl-3'])">
      </div>
      <div class="form-item">
        <input type="password" id="password" name="password" class="text-input custom-field"
               onfocus="this.placeholder = ''"
               onblur="this.placeholder = 'Password'" placeholder="Password"
               oninput="disabledSudmitChecker(this, ['#email', '#password'], ['#cl-2', '#cl-3'])">
        <div class="show-password" onclick="showPassword()">

        </div>
      </div>

      <div class="legacy-wrapper">
        <div class="checkbox-item">
          <input type="checkbox" id="cl-1" name="cl-1">
          <label for="cl-1">Erhalte wöchentliche Infos zu dir, deiner SSW und deinem Baby</label>
        </div>

        <div class="checkbox-item">
          <input required type="checkbox" id="cl-2" name="cl-2"
                 onchange="disabledSudmitChecker(this, ['#email', '#password'], ['#cl-2', '#cl-3'])">
          <label for="cl-2">Akzeptiere unsere <a target="_blank" href="/online-registration/privacy/">AGB</a> und unsere <a
              href="/online-registration/terms/" target="_blank">Datenschutzrichtlinien</a></label>
        </div>

        <div class="checkbox-item">
          <input type="checkbox" id="cl-3" name="cl-3"
                 onchange="disabledSudmitChecker(this, ['#email', '#password'], ['#cl-2', '#cl-3'])">
          <label for="cl-3">Akzeptiere <a href="/online-registration/advice/" target="_blank">Keleyas Hinweisen</a></label>
        </div>
      </div>

      <div class="btn-group">
        <button type="submit" name="register" value="true" disabled class="disabled submit-btn"><span>Weiter</span>
        </button>
      </div>

    </form>
  </div>
</div>
<?php
require_once __DIR__ . '/../parts/footer.php';
?>
