<?php
session_start();
include_once '../../library/koneksi.php';
include_once '../../library/function.php';

if (isset($_POST)):
	$nama_kategori = sql_injection($_POST['nama_kategori']);
    // convert to lowercase
    $nama_kategori = strtolower($nama_kategori);

    if (!empty($nama_kategori)):
        // Last ID From Table
        $last_id = insert_last_id('kategori', 'id_kategori');
        // convert to integer/numeric
        if (!is_numeric($last_id))
            $id_kategori = (int)$last_id;

        // prepare statement
        $query = "INSERT INTO kategori (id_kategori, nama_kategori) VALUES (?, ?)";
        $statement = $link->prepare($query);
        $statement->bind_param("is", $id_kategori, $nama_kategori);

        // execute
        $execeute = $statement->execute();
        if ($execeute) {
            echo 'true';
        } else {
            echo 'false';
        }

        // closing
        $statement->close();

    endif; // !empty($nama_kategori)
endif; // !isset($_POST)
?>
