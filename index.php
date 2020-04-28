<?php
    // REGISTRATION PAGE //
    session_start();

    // SESSION CHECKS //
    // checks if user is already logged in and authenticated//
    if ($_SESSION['loggedIN'] == '2') {
      header('Location: home.php');
      exit();
    }

    // checks if user is already logged in //
    if ($_SESSION['loggedIN'] == '1') {
      header('Location: check_user.php');
      exit();
    }


    if (isset($_POST['login'])) {
        // creating variables for database connection info //
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'atthewq2_WPBEW');
        define('DB_PASSWORD', 'boogieman');
        define('DB_NAME', 'atthewq2_login');

        // connect to server and select login database //
        $connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        // setting variables and escaping to prevent attacks //
        $user = $connection->real_escape_string($_POST['userPHP']);
        // using md5 hashing function on password //
        // $password = md5($connection->real_escape_string($_POST['passwordPHP']));
        $password = $connection->real_escape_string($_POST['passwordPHP']);
        $password2 = $connection->real_escape_string($_POST['passwordPHP2']);

        // check if input passwords match //
        if ($password != $password2) {
            exit('Passwords do not match');

        } else
            // check for existing username //
            $query = "SELECT id FROM users WHERE username='$user'";
            $data = $connection->query($query);

            if ($data->num_rows > 0) {
                exit('An account already exists with that username');
            } else
                // add user and pass to database //
                $query = "INSERT INTO users (username, password) VALUES ('$user', '$password')";
                $data = $connection->query($query);

                // setting session id and storing user //
                $_SESSION['loggedIN'] = '1';
                $_SESSION['user'] = $user;
                // response message //
                exit('Registration success...');



        exit($user . " = " . $password);
    }

?>


<!-- HTML -->
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
  <div id="login-box">
    <h2> Welcome to TwoPhoto </h2>
    <h3> Register </h3>
    <form method="post">

      <p>
        <label> Enter a username: </label>
        <input type="text" id="reg_user" placeholder="Username" required />
      </p>

      <p>
        <label> Create a password: </label>
        <input type="password" id="reg_pass" name="reg_pass" placeholder="Password" required />
      </p>

      <p>
        <label> Confirm password: </label>
        <input type="password" id="reg_pass2" name="reg_pass2" placeholder="Confirm password" required />
      </p>

      <p>
        <button type="button" value="Submit" name="btn-reg-submit" id="btn-reg-submit">Submit</button>
      </p>

      <p> Already have an account? Login <a href="login.php"> here </a></p>

    </form>

    <!-- showing server response on screen -->
    <p id="response"></p>


    <!-- jquery scripting -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#btn-reg-submit").on('click', function() {
                var user = $("#reg_user").val();
                var password = $('#reg_pass').val();
                var password2 = $('#reg_pass2').val();

                // checking if user or pass empty //
                if (user == "" || password == "")
                    alert("Please check your inputs");

                else {
                    // sending input to php file using ajax //
                    $.ajax(
                      {
                          url: 'index.php',
                          method: 'POST',
                          data: {
                            // creating data for php code //
                            login: 1,
                            userPHP: user,
                            passwordPHP: password,
                            passwordPHP2: password2
                          },
                          // checking if ajax query executes and sending to screen //
                          success: function(server_response) {
                            $("#response").html(server_response);

                            // redirecting to home page if login successful //
                            if (server_response.indexOf('success') >= 0)
                                window.location = 'check_user.php';
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
</html>
