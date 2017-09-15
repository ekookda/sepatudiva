<?php
session_start();
include_once '../../library/koneksi.php';
include_once '../../library/function.php';

if (isset($_POST)):
    $nomor_akun = sql_injection($_POST['nomor_akun']);
    $nama_akun  = sql_injection($_POST['nama_akun']);
    $tanggal    = sql_injection($_POST['tanggal']);
    $jumlah     = sql_injection($_POST['jumlah']);
    $kategori   = sql_injection($_POST['kategori']);
    $status     = sql_injection($_POST['status']);
    $keterangan = sql_injection($_POST['keterangan']);

    // mengubah format tanggal sesuai format sql
    $tanggal    = date('Y-m-d', strtotime($tanggal));

    if (!empty($nomor_akun) && !empty($nama_akun) && !empty($kategori) && !empty($keterangan) && !empty($tanggal) && !empty($jumlah) && !empty($status)):
        // Last ID From Table
        $last_id = insert_last_id('hutang', 'id_hutang');

        // prepare statement
        $query = "INSERT INTO hutang (id_hutang, no_akun_debit, nama_akun, tanggal_debit, jumlah, kategori_id, status_id, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $link->prepare($query);
        $statement->bind_param("isssssss", $last_id, $nomor_akun, $nama_akun, $tanggal, $jumlah, $kategori, $status, $keterangan);

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
