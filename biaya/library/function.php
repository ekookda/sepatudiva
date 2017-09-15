<?php
// format tanggal Indonesia
function TanggalIndo($date)
{
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl   = substr($date, 8, 2);

    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
    return($result);
}

// paging halaman
function paging($table, $row, $koneksi)
{
    # untuk paging (pembagian halaman)
    $hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
    $pageSql = "SELECT * FROM $table";
    $pageQry = $koneksi->query($pageSql);
    $jml = $pageQry->num_rows;
    $max = ceil($jml / $row);
}

// function header
function redirect($url, $permanent = false)
{
    if (headers_sent() === false) {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }
    exit();
}

// base_url
function base_url($url = 'http://localhost/sepatudiva/biaya/')
{
    return $url;
}
// if (!function_exists('base_url')) {
//     function base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE)
//     {
//         if (isset($_SERVER['HTTP_HOST'])) {
//             $http     = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
//             $hostname = $_SERVER['HTTP_HOST'];
//             $dir      = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
//             $core     = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
//             $core     = $core[0];
//             $tmplt    = $atRoot ? ($atCore ? "%s  : //%s/%s/" : "%s             : //%s/"): ($atCore ? "%s://%s/%s/": "%s://%s%s");
//             $end      = $atRoot ? ($atCore ? $core: $hostname): ($atCore ? $core: $dir);
//             $base_url = sprintf( $tmplt, $http, $hostname, $end );
//         }
//         else {
//             $base_url = 'http://localhost/';
//         }

//         if ($parse) {
//             $base_url = parse_url($base_url);
//             if (isset($base_url['path']))
//                 if ($base_url['path'] == '/')
//                     $base_url['path'] = '';
//         }
//         return $base_url;
//     }
// }

// anti sql injection
function sql_injection($data)
{
    global $link;

    $vuln = $link->real_escape_string(stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES))));
    return $vuln;
}

// membuat pesan flashdata
function set_flashdata($name, $value)
{
    $_SESSION[$name] = $value;
    return $_SESSION[$name];
}

// menampilkan pesan flashdata
function flashdata($name)
{
    if (isset($_SESSION[$name])) {
        echo $_SESSION[$name];
        unset($_SESSION[$name]);
    }
}

// menampilkan id terakhir dari table
function insert_last_id($table, $column_id)
{
    global $link;
    
    $query = "SELECT MAX($column_id) AS last_id FROM $table";
    $qry = $link->query($query);

    if ($qry->num_rows > 0) {
        $r = $qry->fetch_assoc();
        $id = $r["last_id"] + 1;
    } else {
        $id = 1;
    }

    return $id;
}

// sanitize and validate URL
function xss_filter($data)
{
    $filter = preg_replace('/[^-a-zA-Z0-9_]/', '', $data);
    return $filter;
}

?>
