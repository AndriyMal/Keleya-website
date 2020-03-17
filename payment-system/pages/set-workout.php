<?php

require_once __DIR__ . '/../parts/header.php';
?>
<div class="step workout-goal">
  <a href="<?= kp_get_route("set-product") ?>" class="go-back">
    <img src="<?= get_template_directory_uri() ?>/payment-system/assets/images/path-back.svg" alt="">
  </a>
  <div class="progress">
  </div>
  <div class="step-content">
    <h1 class="step-title">
      Dein Workout-Ziel
    </h1>
    <p class="step-subtitle">
      Klick auf die Anzahl der Tage pro Woche, an denen du Workouts erhalten möchtest. Dein Ziel kannst du
      jederzeit ändern.
    </p>

    <form action="<?= kp_get_route('set-feeling') ?>" method="post" class="set-product-form">
      <div class="set-workout-often-wrapper">
        <label class="often-item">
          <span>7</span>
          <input type="radio" name="workoutGoal" value="7" class="d-n">
        </label>
        <label class="often-item">
          <span>6</span>
          <input type="radio" name="workoutGoal" value="6" class="d-n">
        </label>
        <label class="often-item">
          <span>5</span>
          <input type="radio" name="workoutGoal" value="5" class="d-n">
        </label>
        <label class="often-item">
          <span>4</span>
          <input type="radio" name="workoutGoal" value="4" class="d-n">
        </label>
        <label class="often-item">
          <span>3</span>
          <input type="radio" name="workoutGoal" value="3" class="d-n">
        </label>
        <label class="often-item">
          <span>2</span>
          <input type="radio" name="workoutGoal" value="2" class="d-n">
        </label>
        <label class="often-item">
          <span>1</span>
          <input type="radio" name="workoutGoal" value="1" class="d-n">
        </label>
      </div>

    </form>
  </div>
</div>
<?php
require_once __DIR__ . '/../parts/footer.php';
?>
