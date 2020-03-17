<?php

require_once __DIR__ . '/../parts/header.php';
?>
<div class="step set-birthday">
  <a href="<?= kp_get_route("set-name") ?>" class="go-back">
    <img src="<?= get_template_directory_uri() ?>/payment-system/assets/images/path-back.svg" alt="">
  </a>
  <div class="progress">
  </div>
  <div class="step-content">
    <h1 class="step-title">Wähle deinen Geburtstermin.</h1>
    <form method="post" method="post" action="<?= kp_get_route('set-product') ?>" class="custom-form set-birthday">

      <input type="date" name="birthPrep" id="kp-datepicker" class="datepicker d-n">
      <div class="btn-group">
        <button type="submit" class="submit-btn"><span>Weiter</span></button>
      </div>

    </form>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelector(".calendar-nav-next").click();
    document.querySelector(".calendar-nav-previous").click();
  });


</script>
<?php
require_once __DIR__ . '/../parts/footer.php';
?>
