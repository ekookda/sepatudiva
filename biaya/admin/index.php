<?php
include_once '../core/init.php';

// cek session. jika belum login, arahkan ke halaman login
$session = (isset($_SESSION['logged_in']) ? $_SESSION['logged_in'] : false);
if (!$session || $session == false) {
    set_flashdata('error', 'Anda belum melakukan login');
    redirect(base_url());
}

include_once 'template/header.php';
?>
<!-- you need to include the shieldui css and js assets in order for the charts to work -->
<link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light-bootstrap/all.min.css" />
<link rel="stylesheet" type="text/css" href="<?=base_url();?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.css">
<link rel="stylesheet" type="text/css" href="<?=base_url();?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css">

<script src="<?=base_url();?>bower_components/jquery/dist/jquery.min.js"></script>

<style>
    html, body {
        height: 100%;
    }

    #wrapper {
        min-height:100%;
        position:relative;
        padding-bottom:60px;
    }

    .error {
        color: #A94442;
        font-style: italic;
    }

    #footer {
        position: absolute;
        height: 50px;
        line-height: 50px;
        bottom: 0;
        width: 80%;
        border: 1px solid #f8f8f8;
        background: #E7E7E7;
        padding: 10px auto;
    }
</style>

</head>
<body>

<div id="wrapper">
    <!-- HEADER SECTION -->
    <?php include_once 'template/menu-nav.php'; ?>
    <!-- END HEADER SECTION -->

    <!-- Main-Page -->
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <!-- Pemanggilan Halaman -->
                <?php
                $menu = (isset($_GET['menu']) ? $_GET['menu'] : false);
                $menu = xss_filter($menu);

                // List files and directories inside the specified path
                $directory = 'pages';

                // Cek URL Menu
                if (!empty($menu)):
                    $pages = scandir($directory);
                    unset($pages[0], $pages[1]);

                    if (in_array($menu . ".php", $pages)) {
                        include($directory . '/' . $menu . '.php');
                    } else {
                        // false
                        echo "
                            <center>
                                <img class='img-responsive' src='" . base_url() . "img/pac-404.png' />
                                <h1>Halaman yang anda cari tidak ada</h1>
                            </center>
                        ";
                    }
                else:
                    // tampilkan panel index atau home
                ?>

                <!-- panel index/home -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-info-circle"></i>&nbsp;Tentang Aplikasi</h3>
                    </div>
                    <div class="panel-body">
                        <div class="bs-example">
                            <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                                <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                                <!-- <li><a href="#profile" data-toggle="tab">Profile</a></li> -->
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane fade active in container" id="home">
                                    <h4>Selamat Datang di Sistem Informasi Pengelolaan Kas</h4>
                                </div>
                            </div>
                        </div>
                    </div> <!-- @/.panel-body -->
                </div> <!-- @/.panel-default -->
                <?php endif; ?>
            </div>  <!-- @/.col-lg-12 -->
        </div> <!-- @/.row -->
    </div> <!-- @/.page-wrapper -->
    <!-- End-Main-Page -->

    <!-- Footer -->
    <div class="container-fluid">
        <?php include_once 'footer.php'; ?>
    </div>
</div> <!-- @/#wrapper -->


<!-- JavaScript -->
<?php include_once '../template/javascript.php'; ?>

<!-- DataTables JS -->
<script src="<?=base_url();?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url();?>bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?=base_url();?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Template JS -->
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="http://www.prepbootstrap.com/Content/js/gridData.js"></script>

<?php if (flashdata('error')): ?>
    <script type="text/javascript">
        alert("<?=flashdata('error');?>");
    </script>
<?php elseif (flashdata('success')): ?>
    <script type="text/javascript">
        alert("<?=flashdata('success');?>");
    </script>
<?php endif; ?>

</body>
</html>
