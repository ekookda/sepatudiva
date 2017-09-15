<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="" name="author by Adi Ningghar" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <?php $title = (isset($_GET['menu']) ? $_GET['menu'] : false); ?>
    <title><?=$title;?></title>

    <!-- StyleSheet/CSS -->
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>bower_components/sweetalert2/dist/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>bower_components/components-font-awesome/css/font-awesome.min.css">