<?php
session_start();
include_once '../../library/koneksi.php';

$id = (isset($_GET['id']) ? $_GET['id'] : false);
$query = $link->query("DELETE FROM hutang WHERE id_hutang='$id'");

if ($query) {
    echo 'true';
} else {
    echo 'false';
}

// close connection
$link->close();
?>
