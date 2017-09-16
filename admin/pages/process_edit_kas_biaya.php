<?php
session_start();
include_once '../../library/koneksi.php';
include_once '../../library/function.php';

if (isset($_POST) && !empty($_POST)):
    $id               = sql_injection($_POST['id_biaya']);
    $tanggal_biaya    = sql_injection($_POST['tanggal_biaya']); // format: 'Y-m-d'
    $kategori         = sql_injection($_POST['kategori']);
    $jumlah_biaya     = sql_injection($_POST['jumlah_biaya']);
    $keterangan_biaya = sql_injection($_POST['keterangan_biaya']);
    $status_biaya     = sql_injection($_POST['status_biaya']);

    // prepare statement
    $query = "UPDATE `biaya` SET `tanggal_biaya`=?, `kategori_id`=?, `jumlah_biaya`=?, `keterangan_biaya`=?, `status_biaya`=? WHERE `id_biaya`=?";
    $statement = $link->prepare($query);
    $statement->bind_param("ssssss", $tanggal_biaya, $kategori, $jumlah_biaya, $keterangan_biaya, $status_biaya, $id);

    // execute
    $execeute = $statement->execute();
    if ($execeute) {
        echo 'true';
    } else {
        echo 'false';
    }

    // closing
    $statement->close();
    $link->close();
endif; // !isset($_POST)
?>
