<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'sait_db_uts');

$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
?>