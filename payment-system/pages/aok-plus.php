<?php

unset($items['aok']);
$json = json_encode($items);
setcookie("items", $json, time() + 3600);

require_once __DIR__ . '/../parts/header.php';
$skipLink = empty($items) ? kp_get_route("finish") : kp_get_route("payment")
?>
<div class="step aok-plus without-progress">
  <a href="<?= kp_get_route("set-plan") ?>" class="go-back">
    <img src="<?= get_template_directory_uri() ?>/payment-system/assets/images/path-back.svg" alt="">
  </a>
  <div class="step-content">
    <h1 class="step-title">Sonderpaket für Mitglieder der AOK Plus</h1>
    <p class="step-subtitle">
      Erhalte sowohl ein <b>Lifetime Keleya Premium Abo</b> (zeitlich unbegrenzten Zugriff auf alle Workouts,
      Rezepte,
      Podcasts
      & Expertenvideos), als auch den <b>Geburtsvorbereitungskurs</b>!
    </p>

    <div class="aok-spec">
      <img src="<?= get_template_directory_uri() ?>/payment-system/assets/images/aok-plus.png"
           alt="">
      <p>Die AOK Plus übernimmt die Paketgebühr für alle Mitglieder! Reiche dafür wie üblich einfach deine
        Rechnung
        ein.</p>
    </div>

    <div class="propositional-wrapper">
      <div class="propositional-cart">

        <div class="price">54,99€</div>

        <div class="desc">Erhalte ein Premium-Abo und den Geburts-vorbereitungskurs mit einer einmaligen
          Zahlung.
        </div>
        <hr>
        <a href="<?= kp_get_route(
          'payment'
        ) ?>?add_to_cart=aok&item=Sonderpaket%20für%20Mitglieder%20der%20AOK%20Plus&price=54.99"
           class="buy">PAKET KAUFEN</a>
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


      <div class="video-wrapper">
        <p class="videotitle">Schau dir den Trailer zum Geburtsvorbereitungskurs an!</p>

        <iframe src="https://player.vimeo.com/video/321947756?title=0&byline=0&portrait=0" width="454"
                height="264"
                frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
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
        <a href="<?= kp_get_route(
          'payment'
        ) ?>?add_to_cart=aok&item=Sonderpaket%20für%20Mitglieder%20der%20AOK%20Plus&price=54.99"
           class="submit-btn"><span>
            Paket kaufen
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
