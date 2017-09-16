<?php
session_start();
include_once '../../library/koneksi.php';
include_once '../../library/function.php';

if (isset($_POST) && !empty($_POST)):
    $id                 = sql_injection($_POST['id_hutang']);
    $tanggal_hutang     = sql_injection($_POST['tanggal_hutang']);
    $kategori           = sql_injection($_POST['kategori']);
    $nama_kreditur      = sql_injection($_POST['nama_kreditur']);
    $jumlah_hutang      = sql_injection($_POST['jumlah_hutang']);
    $keterangan_hutang  = sql_injection($_POST['keterangan_hutang']);
    $status_hutang      = sql_injection($_POST['status_hutang']);

    // prepare statement
    $query = "UPDATE `hutang` SET `tanggal_hutang`=?, `kategori_id`=?, `kreditur_hutang`=?, `jumlah_hutang`=?, `keterangan_hutang`=?, `status_hutang`=? WHERE `id_hutang`=?";
    $statement = $link->prepare($query);
    $statement->bind_param("sssssss", $tanggal_hutang, $kategori, $nama_kreditur, $jumlah_hutang, $keterangan_hutang, $status_hutang, $id);

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
