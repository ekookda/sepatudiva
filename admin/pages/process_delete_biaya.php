<?php
session_start();
include_once '../../library/koneksi.php';
include_once '../../library/function.php';

$id = (isset($_GET['id']) ? sql_injection($_GET['id']) : false);

$query = $link->query("DELETE FROM biaya WHERE id_biaya='$id'");

if ($query) {
    echo 'true';
} else {
    echo 'false';
}

// close connection
$link->close();
?>
