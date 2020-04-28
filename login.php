<?php
    // LOGIN PAGE //
    session_start();

    // SESSION CHECKS //
    // checks if user is already logged in and authenticated //
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

        // querying database //
        $query = "SELECT id FROM users WHERE username='$user' AND password='$password'";
        $data = $connection->query($query);

        // checks if username and pass match //
        if ($data->num_rows > 0) {
            // setting session id and storing user //
            $_SESSION['loggedIN'] = '1';
            $_SESSION['user'] = $user;
            // response message //
            exit('Login success...');
        } else
            exit('Username or password not found');

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
    <h3> Login </h3>
    <form method="post">

      <p>
        <label> Username: </label>
        <input type="text" id="login_user" placeholder="Username" required />
      </p>

      <p>
        <label> Password: </label>
        <input type="password" id="login_pass" name="login_pass" placeholder="Password" required />
      </p>

      <p>
        <button type="button" value="Submit" name="btn-reg-submit" id="btn-reg-submit">Submit</button>
      </p>

      <p> Don't have an account? Register <a href="index.php"> here </a></p>

    </form>

    <!-- showing server response on screen -->
    <p id="response"></p>


    <!-- jquery scripting -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#btn-reg-submit").on('click', function() {
                var user = $("#login_user").val();
                var password = $('#login_pass').val();

                // checking if username or pass empty //
                if (user == "" || password == "")
                    alert("Please check your inputs");

                else {
                    // sending input to php file using ajax //
                    $.ajax(
                      {
                          url: 'login.php',
                          method: 'POST',
                          data: {
                            // creating data for php code //
                            login: 1,
                            userPHP: user,
                            passwordPHP: password
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
