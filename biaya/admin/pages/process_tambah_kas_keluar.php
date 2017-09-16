<?php
session_start();
include_once '../../library/koneksi.php';
include_once '../../library/function.php';

if (isset($_POST)):
    $tanggal_hutang    = sql_injection($_POST['tanggal_hutang']);
    $kreditur_hutang   = sql_injection($_POST['kreditur_hutang']);
    $jumlah_hutang     = sql_injection($_POST['jumlah_hutang']);
    $kategori_hutang   = sql_injection($_POST['kategori_hutang']);
    $keterangan_hutang = sql_injection($_POST['keterangan_hutang']);
    $status_hutang     = sql_injection($_POST['status_hutang']);

    // mengubah format tanggal sesuai format sql
	$tanggal_hutang = date('Y-m-d', strtotime($tanggal_hutang));

    if (!empty($tanggal_hutang) && !empty($kreditur_hutang) && !empty($jumlah_hutang) && !empty($kategori_hutang) && !empty($keterangan_hutang) && !empty($status_hutang)):
        // Last ID From Table
        $last_id = insert_last_id('hutang', 'id_hutang');

        // prepare statement
        $query = "INSERT INTO hutang (id_hutang, tanggal_hutang, kategori_id, kreditur_hutang, jumlah_hutang, keterangan_hutang, status_hutang) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $statement = $link->prepare($query);
        $statement->bind_param("issssss", $last_id, $tanggal_hutang, $kategori_hutang, $kreditur_hutang, $jumlah_hutang, $keterangan_hutang, $status_hutang);

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
