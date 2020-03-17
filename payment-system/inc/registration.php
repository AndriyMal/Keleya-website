<?php


class kp_registration
{

  public $name = true;

  public $email = true;

  public $password = true;

  public $birthPrep = true;

  public $status = "free";

  public $foodPreferences = true;

  public $workoutGoal = true;

  public $symptoms = true;

  private $storage;

  public function __construct()
  {
    $this->unserializeUserData();
  }


  private function unserializeUserData()
  {
    if (!empty($_COOKIE['kp_userdata'])) {
      $this->storage = json_decode(stripslashes($_COOKIE['kp_userdata']), true);
    }
  }

  private function serializeUserData()
  {
    setcookie("kp_userdata", json_encode($this->storage), time() + 3600);
  }


  public function checkField()
  {
    foreach ($_POST as $key => $value) {
      if (isset($this->$key)) {
        $this->storage[$key] = $value;
      }
    }
    $this->serializeUserData();
  }


  public function saveUserToken($token)
  {
    setcookie("usertoken", $token, time() + 3600 * 24);
    setcookie("kp_userdata", "");
  }


  private function authBy($media, $key)
  {
    $curl = curl_init();

    curl_setopt_array(
      $curl,
      array(
        CURLOPT_URL => "https://app-stage.keleya.de/api/V4/user/auth/" . $media,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"access_token\": \"" . $key . "\"}",
        CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache",
          "content-type: application/json",
        ),
      )
    );

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      http_response_code('400');

      echo "cURL Error #:" . $err;
    } else {
      echo $response;
    }
  }

  public function authByFacebook()
  {
    $key = $_POST['apiToken'];
    $this->authBy("facebook", $key);
    die();
  }

  public function authByGoogle()
  {
    $key = $_POST['apiToken'];
    $this->authBy("google", $key);
    die();
  }

  public function register()
  {
    $curl = curl_init();

    curl_setopt_array(
      $curl,
      array(
        CURLOPT_URL => "https://app-stage.keleya.de/api/V4/user",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($this->storage),
        CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache",
          "content-type: application/json",
          "postman-token: c9c0f980-7a54-aa10-8d92-c051243adea3"
        ),
      )
    );

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    $result = json_decode($response, true);

    if (!is_array($result)) {
      wp_redirect(
        kp_get_route(
          'registration'
        ) . "?error=Registrierungsfehler.%20Ihre%20E-Mail%20wird%20möglicherweise%20bereits%20verwendet."
      );
    } else {
      $this->saveUserToken(json_decode($response, true)['apiToken']);
    }
  }

  public function authorization()
  {
    $curl = curl_init();

    curl_setopt_array(
      $curl,
      array(
        CURLOPT_URL => "https://app-stage.keleya.de/api/V4/user/auth",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"email\": \"" . $_POST['email'] . "\", \"password\": \"" . $_POST['password'] . "\"}",
        CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache",
          "content-type: application/json",
          "postman-token: fb8e4a1c-15b9-13be-7c4c-5dff400fafda"
        ),
      )
    );

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    $result = json_decode($response, true);
    if (!is_array($result)) {
      var_dump($result);
      wp_redirect(kp_get_route('login') . "?error=Ungültige%20Authentifizierungsdaten");
    } else {
      $this->saveUserToken(json_decode($response, true)['apiToken']);
    }
  }


  public function init()
  {
    add_action('wp_ajax_nopriv_kp_fb_login', [$this, 'authByFacebook']);
    add_action('wp_ajax_kp_fb_login', [$this, 'authByFacebook']);
    add_action('wp_ajax_nopriv_kp_google_login', [$this, 'authByGoogle']);
    add_action('wp_ajax_kp_google_login', [$this, 'authByGoogle']);
  }

}

function kp_checkLogin()
{
  if (empty($_COOKIE['usertoken'])) {
    ?>
    <script>
      window.location.href = "<?= kp_get_route('login') . "?error=Authentifizierung fehlgeschlagen" ?>//";
    </script>
    <?php
  }
}
