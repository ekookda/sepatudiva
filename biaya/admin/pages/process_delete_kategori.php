<?php
session_start();

include_once '../../library/koneksi.php';
include_once '../../library/function.php';

$id = (isset($_GET['id'])) ? sql_injection($_GET['id']) : false;

$query = "DELETE FROM kategori WHERE id_kategori=?";
$qry = $link->prepare($query);
$qry->bind_param('i', $id);
$exe = $qry->execute();

if ($exe) {
    echo 'true';
} else {
    echo 'false';
}

$link->close();

?>