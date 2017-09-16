<?php
define('DB_NAME', 'sepatudiva');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'R0ckmyt@');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');


// koneksi ke mysql
$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die (mysqli_error());
?>