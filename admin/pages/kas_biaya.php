<h1 class="page-header">Kelola Biaya</h1>
<a href="index.php?menu=tambah_kas_biaya" class="btn btn-small btn-primary"><i class="fa fa-plus-circle"></i>&nbsp;Entry</a>
<br><br>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-info-circle"></i>&nbsp;Pengelolaan Biaya</h3>
    </div>
    <div class="panel-body">
		<?php
		$menu = (isset($_GET['menu']) ? sql_injection($_GET['menu']) : 'example');
		$menu = xss_filter($menu);
		?>
        <div class="table-responsive">
            <div class="row">
                <div class="col-sm-12">
                    <!-- pencarian berdasarkan tanggal -->
                    <?php
                    if (isset($_POST['start']) && isset($_POST['end'])) {
                        $start = sql_injection($_POST['start']);
                        $end = sql_injection($_POST['end']);

                        $from = date('d-m-Y', strtotime($start));
                        $to = date('d-m-Y', strtotime($end));

                        echo "
                        <p>Filter berdasarkan tanggal&nbsp;
                            <span class=\"badge\" style=\"background: #27374b\">" . $from . " s/d " . $to . "</span>
                        </p>
                        ";
                    } else {
                        $start = FALSE;
                        $end = FALSE;
                    }
                    ?>
                    <div id="sandbox-container">
                        <form method="post" class="form-inline" id="form-search">
                            <div class="form-group" id="sandbox-container">
                                <div class="input-daterange input-group" id="datepicker">
                                    <input type="text" class="input-sm form-control" name="start" required="required" />
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="input-sm form-control" name="end" required="required" />
                                </div>
                            </div>
                            <!-- Button Submit -->
                            <button type="submit" name="search" id="btn-search" class="btn btn-sm btn-primary">
                                <i class="fa fa-search"></i>&nbsp;Filter
                            </button>
                            <!-- Button Refresh Data -->
                            <button type="button" name="refresh" id="btn-refresh" class="btn btn-sm btn-default btn-refresh">
                                <i class="fa fa-list-alt"></i>&nbsp;Tampilkan Semua
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <br>
            <!-- DataTable -->
            <table id="kas_biaya" class="table table-striped table-bordered table-hover" cellspacing="0"
                   width="100%">
                <thead>
                <tr style="background:#428BCA;color:#FFF">
                    <th class="text-center" width="">No</th>
                    <th class="text-center" width="">Tanggal Biaya</th>
                    <th class="text-center" width="">Kategori</th>
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
                    if (isset($_POST['start']) && isset($_POST['end'])):
                        $start = sql_injection($_POST['start']);
                        $end = sql_injection($_POST['end']);

                        $sql = "SELECT biaya.*, kategori.nama_kategori FROM biaya INNER JOIN kategori ON biaya.kategori_id=kategori.id_kategori WHERE biaya.tanggal_biaya>='$start' AND biaya.tanggal_biaya<='$end' ORDER BY biaya.tanggal_biaya ASC";
                        $query = $link->query($sql);
                    endif;
				else:
					$sql = "SELECT biaya.*, kategori.nama_kategori FROM biaya INNER JOIN kategori ON biaya.kategori_id=kategori.id_kategori";
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
								echo date('d', strtotime($row['tanggal_biaya'])) . ' ' . (ucfirst($nama_bulan[date('m', strtotime($row['tanggal_biaya']))])) . ' ' . date('Y', strtotime($row['tanggal_biaya']));
								?>
                            </td>
                            <td class="text-center"><?= ucfirst($row['nama_kategori']); ?></td>
                            <td class="text-center">Rp <?= number_format($row['jumlah_biaya'], 0, ',', '.'); ?>,-</td>
                            <td class="text-center"><?= ucfirst($row['keterangan_biaya']); ?></td>
                            <!-- Nama Status -->
							<?php
							$status = $row['status_biaya'];
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
                                   href="index.php?menu=edit_kas_keluar&id=<?= $row['id_biaya']; ?>&kode=<?= $row['id_biaya']; ?>"
                                   role="button"><i class="fa fa-edit"></i></a>
                                <a onclick="hapus(<?= $row['id_biaya']; ?>)" class="btn btn-xs btn-danger delete-link"
                                   data-toggle="tooltip" title="Hapus Data" id="btn_delete" role="button"><i
                                            class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
						<?php
						$no++;
					endwhile;
                else:
                    echo 'NO';
				endif;
				?>
                </tbody>
                <tfoot>
                <tr class="info">
                    <td colspan="6" class="text-right">Jumlah</td>
					<?php
					/*
					 * Informasi sementara menjumlahkan berdasarkan tanggal pencarian
					 * querynya: SELECT SUM(`jumlah`) FROM `biaya` WHERE `tanggal_kredit` BETWEEN '$tanggal_awal' AND '$tanggal_akhir';
					 */
					if (isset($_POST['search'])):
                        if (isset($_POST['start']) && isset($_POST['end'])):
                            $start = sql_injection($_POST['start']);
                            $end = sql_injection($_POST['end']);
                            $sumQuery = "SELECT SUM(jumlah_biaya) FROM biaya WHERE tanggal_biaya>='$start' AND tanggal_biaya<='$end'";
                            $qry = $link->query($sumQuery);
                            $sum = $qry->fetch_assoc();
                        endif;

						$total = "Rp " . number_format($sum["SUM(jumlah_biaya)"], 0, ',', '.') . ',-';
					else:
						$sumQuery = "SELECT SUM(jumlah_biaya) FROM biaya";
						$qry = $link->query($sumQuery);
						$sum = $qry->fetch_assoc();

						$total = "Rp " . number_format($sum["SUM(jumlah_biaya)"], 0, ',', '.') . ',-';
					endif;
					?>
                    <td colspan="" class="text-left"><strong><?= $total; ?></strong></td>
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
            var url = "<?=base_url();?>admin/index.php?menu=kas_biaya";
            window.location = url;
        });

        // tooltip
        $('[data-toggle="tooltip"]').tooltip();

        $("#kas_biaya").dataTable({
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
            var getLink = "<?=base_url();?>admin/pages/process_delete_biaya.php?id=" + id;
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
    });
</script>

