<?php

require_once __DIR__ . '/../parts/header.php';


$curl = curl_init();

curl_setopt_array(
  $curl,
  array(
    CURLOPT_URL => "https://app-stage.keleya.de/api/V4/payments",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\"subscriptionType\": \"type\", \"purchaseType\": \"stripe\"}",
    CURLOPT_HTTPHEADER => array(
      "authorization: JWT eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjhhZjc4MzYyLWQ5ZGQtNGJkMi04Yjg2LTM1YzQ4ZmI3NzZiOSIsInJvbGUiOiJ1c2VyIiwiaWF0IjoxNTgxNjE2NTc5fQ.LZLZ_KN1xVQek0NSL6EcclzsO2DzWFPr_UXMwcuSWlo",
      "cache-control: no-cache",
      "content-type: application/json",
      "postman-token: 8d54093f-f798-196f-78a9-0fa2525c48bb"
    ),
  )
);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
//  echo "cURL Error #:" . $err;
} else {
//  echo $response;
}


?>
<div class="step without-progress finish">
  <div class="step-content">
    <h1 class="step-title">
      Vielen Dank, für deinen Einkauf
    </h1>
    <p class="step-subtitle">
      Wir wünschen dir viel Spaß mit Keleya Premium!
    </p>

    <div class="app-wrapper screen">
      <div class="app-screen-item apple">
      </div>
      <div class="app-screen-item google">
      </div>
    </div>


    <p class="step-subtitle">Hast du dir die App schon runtergeladen? Hol sie dir jetzt und lege los.</p>

    <div class="app-wrapper btn">
      <a href="https://go.onelink.me/qetV/fe281763" class="app-btn-item apple">
      </a>
      <a href="https://go.onelink.me/qetV/fe281763" class="app-btn-item google">
      </a>
    </div>
  </div>
</div>
<?php
require_once __DIR__ . '/../parts/footer.php';
?>
