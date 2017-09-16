<?php
session_start();
include_once '../../library/koneksi.php';
include_once '../../library/function.php';

if (isset($_POST) && !empty($_POST)):
    $id                 = sql_injection($_POST['id_piutang']);
    $tanggal_piutang    = sql_injection($_POST['tanggal_piutang']); // format: 'Y-m-d'
    $kategori           = sql_injection($_POST['kategori']);
    $nama_kreditur      = sql_injection($_POST['nama_kreditur']);
    $jumlah_piutang     = sql_injection($_POST['jumlah_piutang']);
    $keterangan_piutang = sql_injection($_POST['keterangan_piutang']);
    $status_piutang     = sql_injection($_POST['status_piutang']);

    // prepare statement
    $query = "UPDATE piutang SET `tanggal_piutang`=?, `kategori_id`=?, `kreditur_piutang`=?, `jumlah_piutang`=?, `keterangan_piutang`=?, `status_piutang`=? WHERE id_piutang=?";
    $statement = $link->prepare($query);
    $statement->bind_param("sssssss", $tanggal_piutang, $kategori, $nama_kreditur, $jumlah_piutang, $keterangan_piutang, $status_piutang, $id);

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
