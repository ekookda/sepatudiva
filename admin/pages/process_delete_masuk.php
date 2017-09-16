<?php
include_once '../../library/koneksi.php';
include_once '../../library/function.php';

$id = (isset($_GET['id']) ? sql_injection($_GET['id']) : false);

$query = $link->query("DELETE FROM piutang WHERE id_piutang='$id'");

if ($query) {
    echo 'true';
} else {
    echo 'false';
}

// close connection
$link->close();
?>
