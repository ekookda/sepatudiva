<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?=base_url();?>admin/">Informasi Pengeluaran Sepatudiva</a>
    </div>
    <?php $url = (isset($_GET['menu']) ? xss_filter($_GET['menu']) : false); ?>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="<?php if ($url == null) { echo 'active'; } ?>"><a href="<?=base_url();?>admin/"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="<?php if ($url == 'kas_masuk') { echo 'active'; } ?>"><a href="index.php?menu=kas_masuk"><i class="fa fa-sign-in"></i>&nbsp;Pemasukan</a></li>
            <li class="<?php if ($url == 'kas_keluar') { echo 'active'; } ?>"><a href="index.php?menu=kas_keluar"><i class="fa fa-sign-out"></i>&nbsp;Pengeluaran</a></li>
            <li class="<?php if ($url == 'kas_biaya') { echo 'active'; } ?>"><a href="index.php?menu=kas_biaya"><i class="fa fa-user"></i>&nbsp;Kelola Biaya</a></li>
            <li class="<?php if ($url == 'manajemen_kategori') { echo 'active'; } ?>"><a href="index.php?menu=manajemen_kategori"><i class="fa fa-list-alt"></i>&nbsp;Kelola Kategori</a></li>
            <li class="<?php if ($url == 'logout') { echo 'active'; } ?>"><a href="logout.php"><i class="fa fa-power-off"></i>&nbsp;Logout</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right navbar-user">
            <!-- User Profile -->
            <li class="dropdown user-dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo ucfirst($_SESSION['nama']); ?></a>
                <ul class="dropdown-menu">
                    <!-- <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                    <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                    <li class="divider"></li> -->
                    <li><a href="<?=base_url();?>admin/logout.php"><i class="fa fa-sign-out"></i>&nbsp;Keluar</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
