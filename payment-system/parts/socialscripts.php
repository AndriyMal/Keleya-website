<script src="https://apis.google.com/js/platform.js"></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v6.0&appId=245778305927486&autoLogAppEvents=1"></script>
<script>
  function sendRequestToLogin(media, access_token) {
    var data = "apiToken=" + access_token;

    var xhr = new XMLHttpRequest();
    xhr.withCredentials = true;

    xhr.addEventListener("readystatechange", function () {
      if (this.readyState === 4) {
        if (this.status === 200) {
          let response = JSON.parse(this.responseText);
          setCookie("usertoken", response.apiToken);
          window.location = "/online-registration/set-plan";
        }

      }
    });

    xhr.open("POST", "/wp-admin/admin-ajax.php?action=kp_" + media + "_login");
    xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhr.setRequestHeader("cache-control", "no-cache");

    xhr.send(data);
  }


  //GOOGLE LOGIN
  var googleUser = {};
  var startApp = function () {
    gapi.load('auth2', function () {
      // Retrieve the singleton for the GoogleAuth library and set up the client.
      auth2 = gapi.auth2.init({
        client_id: '352170916813-rpb81sd2rjr1k7i3r4ppvuflqs8o4aac.apps.googleusercontent.com',

        cookiepolicy: 'single_host_origin',
        // Request scopes in addition to 'profile' and 'email'
        // scope: 'additional_scope'
      });
      attachSignin(document.querySelector('.large-btn.google'));
    });
  };

  function attachSignin(element) {
    auth2.attachClickHandler(element, {},
      function (googleUser) {
        let token = gapi.auth2.getAuthInstance().currentUser.get().getAuthResponse(true).access_token;
        sendRequestToLogin("google", token);

      }, function (error) {
      });
  }

  startApp();
  <!--FACEBOOK LOGIN-->

  window.fbAsyncInit = function () {
    FB.init({
      appId: '245778305927486',
      version: 'v6.0',
      oauth: true,
      status: true, // check login status
      cookie: true, // enable cookies to allow the server to access the session
      xfbml: true // parse XFBML
    });

  };

  function fb_login() {
    FB.login(function (response) {

      if (response.authResponse) {
        access_token = response.authResponse.accessToken; //get access token
        user_id = response.authResponse.userID; //get FB UID

        sendRequestToLogin("fb", access_token);

        FB.api('/me', function (response) {
        });

      } else {
        //user hit cancel button

      }
    }, {
      scope: 'publish_stream,email'
    });
  }

  (function () {
    var e = document.createElement('script');
    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
  }());
</script>
