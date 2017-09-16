<?php
session_start();
include_once 'library/koneksi.php';
include_once 'library/function.php';

if (isset($_POST['user']) && isset($_POST['pass'])):
    $uName = $_POST['user'];
    $pwd   = $_POST['pass'];

    // mencegah sql injection
    $username = sql_injection($uName);
    $password = sql_injection($pwd);

    if (!empty(trim($username)) && !empty(trim($password))) {
        // query database
        $query = "SELECT * FROM login WHERE username = '$username'";
        $exec  = $link->query($query);

        if ($exec->num_rows == 1) {
            $row = $exec->fetch_assoc();
            $password_verify = password_verify($password, $row['password']);
            if ($password_verify) {
                echo 'true';
                // buat session
                $_SESSION['nama'] = $row['nama'];
                $_SESSION['user'] = $row['username'];
                $_SESSION['logged_in'] = TRUE;
            } else {
                echo 'false';
            }
        } else {
            echo 'false';
        }
    } else {
        set_flashdata('error', 'Form tidak boleh kosong');
        redirect(base_url());
    }
endif;
?>
