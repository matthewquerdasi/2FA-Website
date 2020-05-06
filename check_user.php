<?php

    session_start();

    // SESSION CHECKS //
    // check if already logged in and authenticated //
    if ($_SESSION['loggedIN'] == '2') {
        header('Location: home.php');
        exit();
    }

    // check if session loggedIN id has been set and redirec to login if not //
    if ($_SESSION['loggedIN'] != '1') {
        header('Location: index.php');
        exit();
    }


    // getting PHP Gangsta open source google authenticator //
    require "libs/GoogleAuthenticator.php";
    //require "GoogleAuthenticator.php";

    // initalizing authenticator //
    $authenticator = new PHPGangsta_GoogleAuthenticator();

    // generating secret string //
    $secret = $authenticator->createSecret();
    //echo "Secret is: ".$secret."\n\n";

    // getting QR code url //
    $qrCodeUrl = $authenticator->getQRCodeGoogleUrl('2FA', $secret);
    //echo "Google Charts URL for the QR-Code: ".$qrCodeUrl."\n\n";

    // getting 6 digit code //
    $code = $authenticator->getCode($secret);


?>


<!DOCTYPE html>
<html>
<head>
  <!-- Google analytics tracking tag -->
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-158867952-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-158867952-1');
  </script>

  <!-- title and styling -->
  <title id="welcome-instruction">QR Code</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

  <!-- favicon -->
  <link rel="icon" href="https://matthewquerdasi.com/2fa/images/2FA-favicon.jpg" type="image/jpg">
</head>

<body id="comp-back">

  <div id="login-box">

    <h2> Scan QR code with Google Authenticator app</h2>

    <img src="<?php echo $qrCodeUrl ?>" />

    <!-- QR code validation form -->
    <form method="post">

      <p>
        <label> Authenticator code: </label>
        <input type="text" id="auth_code" name="auth_code" placeholder="******" required />
      </p>

      <p>
        <button type="button" value="Submit" name="btn-code-submit" id="btn-code-submit">Submit</button>
      </p>

      <p> Having trouble? Return to <a class="log-swap" href="logout.php"> login </a></p>

    </form>

    <p id="response"></p>




  <!-- jquery scripting -->
  <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
  <script type="text/javascript">
      $(document).ready(function() {
          $("#btn-code-submit").on('click', function() {
              var code = $("#auth_code").val();

              // checking if code input is empty //
              if (code == "")
                  alert("Please input your code");

              else {
                  // sending input to php file using ajax //
                  $.ajax(
                    {
                        url: 'check_user2.php',
                        method: 'POST',
                        data: {
                          // creating data for php code //
                          authCheck: 1,
                          userCode: code,
                          secret: "<?php echo $secret ?>"
                        },
                        // checking if ajax query executes and sending to screen //
                        success: function(server_response) {
                          $("#response").html(server_response);

                          // redirecting to home page if login successful //
                          if (server_response.indexOf('success') >= 0)
                              window.location = 'home.php';
                          else {
                            window.location = 'check_user.php';
                            window.alert('Incorrect input: please try again');

                          }
                        },
                        dataType: 'text'
                    }
                  );
              }
          })
      });
  </script>

  </div>

</body>
</head>
