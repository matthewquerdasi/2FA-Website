<?php
    session_start();

    // removing loggedIN key and deleting session //
    unset($_SESSION['loggedIN']);
    session_destroy();

    // redirecting to login //  
    header('Location: index.php');
    exit();
?>
