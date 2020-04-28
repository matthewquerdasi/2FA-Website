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


    // getting PHP Gangsta authenticator //
    require "GoogleAuthenticator.php";

    // initalizing authenticator //
    $authenticator = new PHPGangsta_GoogleAuthenticator();

    // getting updated 6 digit code from passed secret value //
    $code = $authenticator->getCode($_POST['secret']);

    // checking users code //
    if (isset($_POST['authCheck'])) {

      if ($_POST['userCode'] == $code) {
          // updating session id //
          $_SESSION['loggedIN'] = '2';
          // exit message to be received by AJAX code //
          exit('Authentication success...');

      } else {
          $_SESSION['loggedIN'] = '1';
          // exit message to be received by AJAX // 
          exit('NOT A BINGO');
      }
    }


?>
