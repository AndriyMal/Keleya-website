<?php

require_once __DIR__ . '/../parts/header.php';
?>
<div class="step workout-goal">
  <a href="<?= kp_get_route("set-workout") ?>" class="go-back">
    <img src="<?= get_template_directory_uri() ?>/payment-system/assets/images/path-back.svg" alt="">
  </a>
  <div class="progress">
  </div>
  <div class="step-content">
    <h1 class="step-title">
      Wie geht’s dir heute?
    </h1>
    <p class="step-subtitle">
      Sag uns wie es dir geht, um deine individuellen Workouts und Rezepte zu erhalten.
    </p>

    <form action="<?= kp_get_route('congrats') ?>" method="post" class="set-feeling-form">
      <div class="set-feeling-wrapper">
        <?php
        $optionsArray = [
          'Stimmung' => [
            'Normal' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-18@3x.png',
              'value' => 'mood-normal'
            ],
            'Glücklich' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-17@3x.png',
              'value' => 'mood-happy'
            ],
            'Gestresst' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-16@3x.png',
              'value' => 'mood-stressed'
            ],
            'Ängstlich' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-15@3x.png',
              'value' => 'mood-scared'
            ],
            'Stimmungs-schwankungen' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-14@3x.png',
              'value' => 'mood-swings'
            ],
            'Müde' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group@3x.png',
              'value' => 'mood-fatigue'
            ],
          ],
          'Nährstoffmangel' => [
            'Folsäure' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-13@3x.png',
              'value' => 'nutrition-deficiency-folic-acid'
            ],
            'Eisen' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-12@3x.png',
              'value' => 'nutrition-deficiency-iron'
            ],
            'Jod' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-11@3x.png',
              'value' => 'nutrition-deficiency-iodine'
            ],
            'Magnesium' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-10@3x.png',
              'value' => 'nutrition-deficiency-magnesium'
            ],
            'Vitamin D' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-10-copy@3x.png',
              'value' => 'nutrition-deficiency-vitamin-d'
            ],
          ],
          'Verdauung' => [
            'Durchfall' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-9@3x.png',
              'value' => 'digestion-problems-diarrhea'
            ],
            'Verstopfung' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-8@3x.png',
              'value' => 'digestion-problems-constipation'
            ],
            'Sodbrennen' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-7@3x.png',
              'value' => 'digestion-problems-heartburn'
            ],
            'Blähungen' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-6@3x.png',
              'value' => ''
            ],
          ],
          'Schmerzen' => [
            'Rücken-schmerzen' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-2@3x.png',
              'value' => 'pains-back-pain'
            ],
            'Nacken-schmerzen' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-4@3x.png',
              'value' => 'pains-nerve-tension'
            ],
            'Kopf-schmerzen' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-5@3x.png',
              'value' => 'pains-headache'
            ],
            'Fuß-schmerzen' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-19@3x.png',
              'value' => ''
            ],
            'Symphysen-lockerung' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-20@3x.png',
              'value' => 'pains-symphysis-pubis-dysfunction'
            ],
          ],
          'Beschwerden' => [
            'Atem-losigkeit' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-21@3x.png',
              'value' => 'other-breathlessness'
            ],
            'Wasser-einlagerungen' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-22@3x.png',
              'value' => 'other-water-retention'
            ],
            'Inkontinenz' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-23@3x.png',
              'value' => 'other-incontinence'
            ],
            'Übelkeit' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-24@3x.png',
              'value' => 'other-morning-sickness'
            ],
            'Schlaf-losigkeit' => [
              'icon' => '/payment-system/assets/images/feeling-icons/group-25@3x.png',
              'value' => 'other-sleeping-difficulty'
            ],
          ]
        ];
        foreach ($optionsArray as $groupName => $options) {
          ?>
          <div class="set-feeling-group">
            <h2 class="group-name"><?= $groupName ?></h2>
            <div class="option-wrapper">
              <?php foreach ($options as $optionName => $optionData) { ?>
                <label class="set-item ">
                  <div class="option-icon">
                    <img src="<?= get_template_directory_uri() . $optionData["icon"] ?>" alt="">
                  </div>
                  <p><?= $optionName ?></p>
                  <input type="checkbox" name="symptoms[]" value="<?= $optionData["value"] ?>" class="d-n">
                </label>
              <?php } ?>


            </div>
          </div>
          <?php
        }
        ?>
      </div>

      <div class="btn-group">
        <button type="submit" class="submit-btn"><span>Weiter</span></button>
      </div>
    </form>
  </div>
</div>

<?php
require_once __DIR__ . '/../parts/footer.php';
?>
