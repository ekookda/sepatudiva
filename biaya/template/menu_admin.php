<?php $url = (isset($_GET['menu']) ? $_GET['menu'] : null); ?>
<div id="left">
    <ul id="menu" class="collapse">
        <li class="panel <?php if ($url == null) {
			echo 'active';
		} ?>"><a href="index.php"><i class="icon-home"></i> Dashboard</a></li>
        <!--<li><a href="?menu=kas_masuk"><i class="icon-paper-clip"> </i> Kas Masuk</a></li>-->
        <li class="panel <?php if ($url == 'kas_keluar') {
			echo 'active';
		} ?>"><a href="?menu=kas_keluar"><i class="icon-book"></i> Kas Keluar</a></li>
        <!--<li><a href="?menu=laporanpertanggal"><i class="icon-paper-clip"></i> Laporan Kas Masuk</a></li>-->
        <!--<li><a href="?menu=laporankas_keluar"><i class="icon-paper-clip"></i> Laporan Kas Keluar</a></li>-->
        <!--<li><a href="?menu=laporanrekapitulasi"><i class="icon-paper-clip"></i> Laporan Rekapitulasi</a></li>-->

        <!--<li><a href="?menu=user"><i class="icon-user "></i> Daftar User</a></li>-->
    </ul>
</div>

<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h1>Biaya Pengeluaran</h1>
            </div>
        </div>
        <hr/>
        <!--BLOCK SECTION -->
        <div class="row">
            <div class="col-lg-12">
				<?php
				if (isset($_GET["menu"])):
					include_once("load.php");
				else:
				?>
					<div class='col-lg-12'>
						<div class='panel panel-default'>
							<div class='panel-heading'>Tentang Aplikasi</div>
							<div class='panel-body'>
								<ul class='nav nav-tabs'>
									<li class='active'><a href='#home' data-toggle='tab'>Home</a></li>
								</ul>

								<div class='tab-content'>
									<div class='tab-pane fade in active' id='home'>
										<h4>Selamat Datang di Sistem Informasi Pengelolaan Kas </h4>
									</div>
													
								</div>
							</div> <!-- @/.panel-body -->
						</div> <!-- @/.panel panel-default -->
					</div> <!-- @/.col-lg-12 -->
				<?php endif; ?>
            </div> <!-- @/.col-lg-12 -->
        </div> <!-- @/.row -->
        <!--END BLOCK SECTION -->
        <hr/>
    </div> <!-- @/.inner -->
</div> <!-- @/.content -->