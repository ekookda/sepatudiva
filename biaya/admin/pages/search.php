<?php
session_start();
include_once '../../library/koneksi.php';
include_once '../../library/function.php';

if (isset($_POST)):
	$keyword = sql_injection($_POST['q']);
	ob_start();
	include 'kas_masuk.php';
	$html = ob_get_contents();
	ob_end_clean();

	echo json_encode(array('hasil'=>$html));
endif;