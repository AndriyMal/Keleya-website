<?php

unset($items['course']);
$json = json_encode($items);
setcookie("items", $json, time() + 3600);


require_once __DIR__ . '/../parts/header.php';
$skipLink = empty($items) ? kp_get_route("finish") : kp_get_route("payment")
?>
<div class="step set-course without-progress">
  <a href="<?= kp_get_route("set-plan") ?>" class="go-back">
    <img src="<?= get_template_directory_uri() ?>/payment-system/assets/images/path-back.svg" alt="">
  </a>
  <a href="<?= $skipLink ?>" class="skip-btn">Weiter ohne Kurs</a>
  <div class="step-content">
    <h1 class="step-title">Interesse an Geburtsvorbereitung?</h1>
    <p class="step-subtitle">
      Dieser Kurs bereitet dich optimal auf deine Geburt vor. Hebamme Sabine Kroh und Pre- & Postnatal
      Yoga-Lehrerin
      Sarah Müggenburg (Mitgründerin von Keleya) beantworten deine Fragen.
    </p>

    <div class="video-wrapper">
      <iframe src="https://player.vimeo.com/video/321947756?title=0&byline=0&portrait=0" width="454" height="264"
              frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
    </div>

    <div class="material-list">
      <p class="material-item">13 Expertenvideos</p>
      <p class="material-item">13 Podcasts</p>
      <p class="material-item">9 Artikel</p>
      <p class="material-item">Checklisten</p>
    </div>
    <div class="propositional-wrapper">
      <div class="propositional-cart">

        <div class="price">49,99€</div>

        <div class="desc">Hol dir den kompletten Kurs mit nur einer Zahlung. Dein Zugriff wird nie ablaufen.
        </div>
        <hr>
        <a href="<?= kp_get_route('payment') ?>?add_to_cart=course&item=Geburtsvorbereitungskurs&price=49.99"
           class="buy">KURS
          DAZUBUCHEN</a>
      </div>
    </div>


    <div class="main-content">
      <h3 class="subtitle">Nutzerstimmen</h3>

      <div class="testimonials-wrapper">
        <div class="testimonials-item">
          <div class="t-header">
            <p class="author">
              Sophie,
            </p>
            <div class="rating"></div>
            <div class="date">
              12.12.2018
            </div>
          </div>

          <div class="desc">
            “Ich brauche die App seit der 24 SSW fast täglich und bin total begeistert. Die Workouts sind
            perfekt
            angepasst auf die jeweilige Schwangerschaftswoche, entwickeln sich mit und ich fühle mich danach
            immer in
            Form und trotzdem entspannt.”
          </div>
        </div>
        <div class="testimonials-item">
          <div class="t-header">
            <p class="author">
              Daniela,
            </p>
            <div class="rating"></div>
            <div class="date">
              29.01.2019
            </div>
          </div>

          <div class="desc">
            “Eine wirklich tolle App!! Ich bin begeistert!! Stylisch, zeitgemäß, intuitiv und nicht so
            steril wie viele
            andere Schwangerschaft-Apps. Die Artikel sind liebevoll, informativ und gut recherchiert.”
          </div>
        </div>
      </div>


      <h3 class="subtitle">Inhalt des Geburtsvorbereitungskurses</h3>

      <div class="plan">
        <div class="modul">
          <p class="title">1. Modul: Schwangerschaft</p>
          Veränderung im 2. Trimester <br>
          Veränderung im 3. Trimester<br>
          Bildungsförderung und Aufbau von Elternkompetenz<br>
          Atemübungen und Massagetechniken<br>
          Meditation und Atemtechniken für Schwangerschaft und Geburt<br>
          Sexualität in der Schwangerschaft<br>

          <p class="title">2. Modul: Vorbereitung aud die Geburt</p>
          Geburtsort<br>
          Kliniktasche<br>
          Zeichen für den Geburtsbeginn<br>
          Vorbereitung für das Wochenbett<br>

          <p class="title">3.Modul: Die Geburt</p>
          Fit für die Geburt Workout<br>
          Die Phasen der Geburt<br>
          Tipps für die Geburt<br>
          Geburtspositionen<br>
          PDA und Schmerzmittel<br>
          Operative Geburtsmethoden<br>
          sanfte Geburtserleichternde Maßnahmen<br>

          <p class="title">4. Modul: Nach der Geburt</p>
          Erste Stunden + Tage nach der Geburt<br>
          Erstversorgung, Untersuchungen und Prophylaxe fürs Baby<br>
          Babypflege und -handling<br>
          Die Babypflege<br>
          Tipps für ein entspanntes Wochenbett<br>

          <p class="title">5. Modul: Das Stillen</p>
          Tipps für den Stillbeginn<br>
          Stolpersteine in der Stillzeit<br>
        </div>
      </div>
      <div class="btn-group">
        <a href="<?= kp_get_route('payment') ?>?add_to_cart=course&item=Geburtsvorbereitungskurs&price=49.99"
           class="submit-btn"><span>
            Kurs dazubuchen
          </span></a>

        <a href="<?= $skipLink ?>" class="btn-skip">
          Weiter ohne Kurs
        </a>
      </div>
    </div>
  </div>
</div>
<?php
require_once __DIR__ . '/../parts/footer.php';
?>
