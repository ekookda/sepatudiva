<h1 class="page-header">Biaya Pemasukan</h1>
<a href="index.php?menu=tambah_kas_masuk" class="btn btn-small btn-primary"><i class="fa fa-plus-circle"></i>&nbsp;Entry</a>
<br><br>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-info-circle"></i>&nbsp;Manajemen Biaya Masuk</h3>
    </div>
    <div class="panel-body">
		<?php
		$menu = (isset($_POST['menu']) ? $_POST['menu'] : 'example');
		$menu = xss_filter($menu);
		?>
        <div class="row">
            <div class="col-sm-12">
                <!-- pencarian berdasarkan tanggal -->
                <?php
                $tgl = (isset($_POST['q']) ? sql_injection($_POST['q']) : false);

                if (isset($_POST['start']) && isset($_POST['end'])) {
                    $start = sql_injection($_POST['start']);
                    $end = sql_injection($_POST['end']);

                    $start = date('d-m-Y', strtotime($start));
                    $end = date('d-m-Y', strtotime($end));

                    echo "
                    <p>Filter berdasarkan tanggal&nbsp;
                        <span class=\"badge\" style=\"background: #27374b\">" . $start . " s/d " . $end . "</span>
                    </p>
                    ";
                } else {
                    $start = FALSE;
                    $end = FALSE;
                }

                ?>

                <form method="post" class="form-inline" id="form-search">
                    <div class="form-group" id="sandbox-container">
                    <!--
                        <div class="input-group date" id="datepicker">
                            <input type="text" class="input-sm form-control" name="q" id="keyword" required="required"/>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    -->
                        <div class="input-daterange input-group" id="datepicker">
                            <input type="text" class="input-sm form-control" name="start" required="required" />
                            <span class="input-group-addon">to</span>
                            <input type="text" class="input-sm form-control" name="end" required="required" />
                        </div>
                    </div>

                    <!-- Button Submit -->
                    <button type="submit" name="search" id="btn-search" class="btn btn-sm btn-primary">
                        <i class="fa fa-search"></i>&nbsp;Search
                    </button>
                    <!-- Button Refresh Data -->
                    <button type="button" name="refresh" id="btn-refresh" class="btn btn-sm btn-default btn-refresh">
                        <i class="fa fa-list-alt"></i>&nbsp;Tampilkan Semua
                    </button>
                </form>
            </div>
        </div>

            <br>
        <div class="table-responsive">
            <!-- DataTable -->
            <table id="kas_masuk" class="table table-striped table-bordered table-hover" cellspacing="0"
                   width="100%">
                <thead>
                <tr style="background:#428BCA;color:#FFF">
                    <th class="text-center" width="">No</th>
                    <th class="text-center" width="">Tanggal Piutang</th>
                    <th class="text-center" width="">Kategori</th>
                    <th class="text-center" width="">Kreditur</th>
                    <th class="text-center" width="">Jumlah</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center" width="">Status</th>
                    <th class="text-center" width="">Aksi</th>
                </tr>
                </thead>
                <!-- Mengambil data dari database -->
                <tbody>
                <?php
                if (isset($_POST['search'])):
                    if (!empty($_POST['start']) && !empty($_POST['end'])):
                        // $keyword = sql_injection($_POST['q']);
                        $start = sql_injection($_POST['start']);
                        $end = sql_injection($_POST['end']);

                        $sql = "SELECT piutang.*, kategori.nama_kategori FROM piutang INNER JOIN kategori ON piutang.kategori_id=kategori.id_kategori WHERE piutang.tanggal_piutang >='$start' AND piutang.tanggal_piutang <= '$end' ORDER BY piutang.tanggal_piutang ASC";

                        $query = $link->query($sql);
                    endif;
                else:
                    $sql = "SELECT piutang.*, kategori.nama_kategori FROM piutang INNER JOIN kategori ON piutang.kategori_id=kategori.id_kategori";
                    $query = $link->query($sql);
                endif;

				if ($query->num_rows > 0):
					$nama_bulan = [
                        '01' => 'Januari',
                        '02' => 'Februari',
                        '03' => 'Maret',
                        '04' => 'April',
                        '05' => 'Mei',
                        '06' => 'Juni',
                        '07' => 'Juli',
                        '08' => 'Agustus',
                        '09' => 'September',
                        '10' => 'Oktober',
                        '11' => 'November',
                        '12' => 'Desember'
					];
					$no = 1;
					while ($row = $query->fetch_assoc()):
						?>
                        <!-- Menampilkan sejummlah data dari database kedalam tabel -->
                        <tr class="allData" style="display: ">
                            <td class="text-center"><?= $no; ?></td>
                            <td class="text-center">
								<?php
								echo date('d', strtotime($row['tanggal_piutang'])) . ' ' . (ucfirst($nama_bulan[date('m', strtotime($row['tanggal_piutang']))])) . ' ' . date('Y', strtotime($row['tanggal_piutang']));
								?>
                            </td>
                            <td class="text-center"><?= ucfirst($row['nama_kategori']); ?></td>
                            <td class="text-center"><?= ucfirst($row['kreditur_piutang']); ?></td>
                            <td class="text-center">Rp <?= number_format($row['jumlah_piutang'], 0, ',', '.'); ?>,-</td>
                            <td class="text-center"><?= ucfirst($row['keterangan_piutang']); ?></td>
                            <!-- Nama Status -->
							<?php
							$status = $row['status_piutang'];
							switch ($status):
								case 'belum lunas':
									$statusName = '<span class="label label-warning" style="font-size:12px;">Belum Lunas</span>';
									break;
								case 'lunas':
									$statusName = '<span class="label label-success" style="font-size:12px;">Lunas</span>';
									break;
								default:
									$statusName = '<span class="label label-danger" style="font-size:12px;">Cancel</span>';
									break;
							endswitch;
							?>
                            <td class="text-center"><?= $statusName; ?></td>
                            <td class="text-center">
                                <a class="btn btn-xs btn-info" data-toggle="tooltip" title="Edit Data"
                                   href="index.php?menu=edit_kas_masuk&id=<?= $row['id_piutang']; ?>&kode=<?= $row['id_piutang']; ?>"
                                   role="button"><i class="fa fa-edit"></i></a>
                                <a onclick="hapus(<?=$row['id_piutang'];?>)" class="btn btn-xs btn-danger delete-link"
                                   data-toggle="tooltip" title="Hapus Data" id="btn_delete" role="button"><i
                                            class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
						<?php
						$no++;
					endwhile;
				endif;
				?>
                </tbody>
                <tfoot>
                <tr class="info">
                    <td colspan="6" class="text-right">Jumlah</td>
					<?php
					/*
					 * Informasi sementara menjumlahkan berdasarkan tanggal pencarian
					 * querynya: SELECT SUM(`jumlah`) FROM `piutang` WHERE `tanggal_kredit` BETWEEN '$tanggal_awal' AND '$tanggal_akhir';
					 */
					if (isset($_POST['search'])) {
					    $start = sql_injection($_POST['start']);
					    $end = sql_injection($_POST['end']);
						$sumQuery = "SELECT SUM(jumlah_piutang) FROM piutang WHERE piutang.tanggal_piutang>='$start' AND piutang.tanggal_piutang<='$end'";
						$qry = $link->query($sumQuery);
						$sum = $qry->fetch_assoc();

                        $total = "Rp " . number_format($sum["SUM(jumlah_piutang)"], 0, ',', '.') . ',-';
                    } else {
						$sumQuery = "SELECT SUM(jumlah_piutang) FROM piutang";
						$qry = $link->query($sumQuery);
						$sum = $qry->fetch_assoc();

						$total = "Rp " . number_format($sum["SUM(jumlah_piutang)"], 0, ',', '.') . ',-';
                    }
					?>
                    <td colspan="2" class="text-left"><strong><?= $total; ?></strong></td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- DatePicker Search -->
<script type="text/javascript">
    $(document).ready(function () {
        var dataKeyword = $('#keyword').val();
        $('#btn-refresh').click(function() {
            var url = "<?=base_url();?>admin/index.php?menu=kas_masuk";
            window.location = url;
        });

        // tooltip
        $('[data-toggle="tooltip"]').tooltip();

        $("#kas_masuk").dataTable({
            'ordering': false,
            'searching': false
        });

        $('#sandbox-container .input-daterange').datepicker({
            //language: "id",
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            toggleActive: true,
            format: "yyyy-mm-dd"
        });

        hapus = function(id) {
            var getLink = "<?=base_url();?>admin/pages/process_delete_masuk.php?id=" + id;
            swal({
                title: 'Yakin?',
                text: "Data akan dihapus secara permanent",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085D6',
                cancelButtonColor: '#D33',
                confirmButtonText: 'Ya, hapus!'
            }).then(function() {
                $.ajax({
                    url: getLink,
                    type: "GET",

                    success: function (html) {
                        if (html == 'true') {
                            swal({
                                title: "Berhasil",
                                text: "Data berhasil di hapus",
                                type: "success"
                            }).then(function () {
                                setTimeout(function () {
                                    location.reload();
                                }, 0001);
                            });
                        } else {
                            swal({
                                title: "Oops",
                                text: "Data gagal di hapus",
                                type: "error"
                            });
                        }
                    },
                    error: function (jqXHR, status, message) {
                        alert('A jQuery error has occurred. Status: ' + status + '\nmessages: ' + message);
                    }
                });
            });
            return false;
        }

        // $('#sandbox-container .input-daterange').datepicker({});
    });

</script>

