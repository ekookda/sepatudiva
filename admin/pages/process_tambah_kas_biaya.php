<?php
session_start();
include_once '../../library/koneksi.php';
include_once '../../library/function.php';

if (isset($_POST)):
    $tanggal_biaya    = sql_injection($_POST['tanggal_biaya']);
    $jumlah_biaya     = sql_injection($_POST['jumlah_biaya']);
    $kategori_biaya   = sql_injection($_POST['kategori_biaya']);
    $keterangan_biaya = sql_injection($_POST['keterangan_biaya']);
    $status_biaya     = sql_injection($_POST['status_biaya']);

    // mengubah format tanggal sesuai format sql
	$tanggal_biaya = date('Y-m-d', strtotime($tanggal_biaya));

    if (!empty($tanggal_biaya) && !empty($jumlah_biaya) && !empty($kategori_biaya) && !empty($keterangan_biaya) && !empty($status_biaya)):
        // Last ID From Table
        $last_id = insert_last_id('biaya', 'id_biaya');

        // prepare statement
        $query = "INSERT INTO biaya (id_biaya, tanggal_biaya, kategori_id, jumlah_biaya, keterangan_biaya, status_biaya) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $link->prepare($query);
        $statement->bind_param("isssss", $last_id, $tanggal_biaya, $kategori_biaya, $jumlah_biaya, $keterangan_biaya, $status_biaya);

        // execute
        $execeute = $statement->execute();
        if ($execeute) {
            echo 'true';
        } else {
            echo 'false';
        }

        // closing
        $statement->close();

    endif; // !empty($kategori) && !empty($keterangan) && !empty($tanggal) && !empty($jumlah) && !empty($status)
endif; // !isset($_POST)
?>
