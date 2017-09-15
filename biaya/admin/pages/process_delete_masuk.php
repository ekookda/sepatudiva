<?php
session_start();
include_once '../../library/koneksi.php';
include_once '../../library/function.php';

$id = (isset($_GET['id']) ? $_GET['id'] : false);
$id = xss_filter($id);

$query = $link->query("DELETE FROM piutang WHERE id_piutang='$id'");

if ($query) {
    echo 'true';
} else {
    echo 'false';
}

// close connection
$link->close();
?>
