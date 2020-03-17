<?php

require_once __DIR__ . '/../parts/header.php';
?>
<div class="step set-name">
  <a href="<?= kp_get_route("/") ?>" class="go-back">
    <img src="<?= get_template_directory_uri() ?>/payment-system/assets/images/path-back.svg" alt="">
  </a>
  <div class="progress first">
  </div>
  <div class="step-content">
    <h1 class="step-title">Schön, dass du da bist!<br>
      Wie sollen wir dich nennen?</h1>
    <form method="post" action="<?= kp_get_route('set-birthday') ?>" class="custom-form set-name">
      <div class="">
        <input type="text" name="name" class="text-input custom-field" id="set-name" onfocus="this.placeholder = ''"
               onblur="this.placeholder = 'Dein Name'" placeholder="Dein Name"
               oninput="disabledSudmitChecker(this, ['#set-name'])">
      </div>
      <div class="btn-group">
        <button type="submit" disabled class="disabled submit-btn"><span>Weiter</span></button>
      </div>

    </form>
  </div>
</div>
<?php
require_once __DIR__ . '/../parts/footer.php';
?>
