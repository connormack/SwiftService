<?php

    // start session
    session_start();

    // constants: DRY
    define('SITEURL', 'http://localhost/SDP/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or (mysqli_error()); // DB connection 
    $db_select = mysqli_select_db($conn, DB_NAME) or (mysqli_error()); // DB selection

?>