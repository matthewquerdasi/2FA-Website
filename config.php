<?php

  // creating variables for connection info
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'atthewq2_WPBEW');
  define('DB_PASSWORD', 'boogieman');
  define('DB_NAME', 'atthewq2_login');

  // connect to server and select login database
  $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

  // testing connection
  if(!$link){
      echo 'Connection error: ' . mysqli_connect_error();
  }

?>
