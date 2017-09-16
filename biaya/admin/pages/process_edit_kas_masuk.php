<?php
session_start();
include_once '../../library/koneksi.php';
include_once '../../library/function.php';

if (isset($_POST)):
    $id = sql_injection($_POST['id_piutang']);
    $nomor_akun = sql_injection($_POST['nomor_akun']);
    $nama_akun = sql_injection($_POST['nama_akun']);
    $jumlah = sql_injection($_POST['jumlah']);
    $tanggal = sql_injection($_POST['tanggal']); // format: 'Y-m-d'
    $kategori = sql_injection($_POST['kategori']);
    $status = sql_injection($_POST['status']);
    $keterangan = sql_injection($_POST['keterangan']);

    if (!empty($_POST)):
        // prepare statement
        $query = "UPDATE piutang SET `no_akun_kredit`=?, `nama_akun`=?, `tanggal_kredit`=?, `jumlah`=?, `kategori_id`=?, `status_id`=?, `keterangan`=? WHERE id_piutang=?";
        $statement = $link->prepare($query);
        $statement->bind_param("ssssssss", $nomor_akun, $nama_akun, $tanggal, $jumlah, $kategori, $status, $keterangan, $id);

        // execute
        $execeute = $statement->execute();
        if ($execeute) {
            echo 'true';
        } else {
            echo 'false';
        }

        // closing
        $statement->close();
    else:
        echo 'false';
    endif; // !empty($kategori) && !empty($keterangan) && !empty($tanggal) && !empty($jumlah) && !empty($status)
endif; // !isset($_POST)
?>
