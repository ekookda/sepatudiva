<?php
session_start();
include_once '../../library/koneksi.php';
include_once '../../library/function.php';

if (isset($_POST)):
    $tanggal_piutang    = sql_injection($_POST['tanggal_piutang']);
    $kreditur_piutang   = sql_injection($_POST['kreditur_piutang']);
    $jumlah_piutang     = sql_injection($_POST['jumlah_piutang']);
    $kategori_piutang   = sql_injection($_POST['kategori_piutang']);
    $keterangan_piutang = sql_injection($_POST['keterangan_piutang']);
    $status_piutang     = sql_injection($_POST['status_piutang']);

    // mengubah format tanggal sesuai format sql
	$tanggal_piutang = date('Y-m-d', strtotime($tanggal_piutang));

    if (!empty($tanggal_piutang) && !empty($kreditur_piutang) && !empty($jumlah_piutang) && !empty($kategori_piutang) && !empty($keterangan_piutang) && !empty($status_piutang)):
        // Last ID From Table
        $last_id = insert_last_id('piutang', 'id_piutang');

        // prepare statement
        $query = "INSERT INTO piutang (id_piutang, tanggal_piutang, kategori_id, kreditur_piutang, jumlah_piutang, keterangan_piutang, status_piutang) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $statement = $link->prepare($query);
        $statement->bind_param("issssss", $last_id, $tanggal_piutang, $kategori_piutang, $kreditur_piutang, $jumlah_piutang, $keterangan_piutang, $status_piutang);

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
