<?php
    session_start();
    // SESSION CHECK //
    // check if session loggedIN id has been set and redirec to login if not //
    if ($_SESSION['loggedIN'] != '2') {
        header('Location: index.php');
        exit();
    }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Home Page</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

<h2> Welcome <?php echo $_POST[''] ?></h2>

<a href="logout.php">Log out</a>

</body>
</head>
