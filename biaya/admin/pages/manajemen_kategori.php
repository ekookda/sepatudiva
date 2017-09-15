<?php
$url = (isset($_GET['menu']) ? $_GET['menu'] : false);
$url = xss_filter($url);
$explode = explode("_", $url);
$title = implode(" ", $explode);
?>
<!-- Title -->
<h1 class="page-header"><?=ucwords($title);?></h1>

<!-- Data -->
<div class="row">
	<div class="col-lg-6 col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-info-circle"></i>&nbsp;Kas Masuk</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<form action="<?=base_url();?>admin/pages/process_tambah_kategori.php" method="POST" class="form-horizontal" role="form" id="form_entry">
						<div class="col-sm-12">
							<!-- Kategori -->
							<div class="form-group">
								<label for="kategori" class="control-label col-sm-4">Nama Kategori</label>
								<div class="col-sm-6">
									<input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required="required">
									<!-- messages error -->
									<span id="messagesError" class="error text-danger"><i></i></span>
								</div>
							</div> <!-- Kategori -->

							<!-- Submit Button -->
							<div class="form-group">
								<div class=" col-sm-offset-4 col-sm-6">
									<button type="submit" class="btn btn-primary" id="btnSubmit"><i class="fa fa-save"></i> Simpan</button>
									<!--							<button type="button" id="back_button" class="btn btn-warning"><i class="fa fa-backward"></i> Back</button>-->
								</div>
							</div>
						</div> <!-- @/.col-sm-6 -->
					</form>
				</div> <!-- @/.panel-row -->
			</div> <!-- @/.panel-body -->
		</div> <!-- @/.panel-default -->
	</div>
	<!-- End Form Entry -->

	<div class="col-lg-6 col-sm-6">
		<!-- Panel Show Data Kategori From Table Kategori -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-info-circle"></i>&nbsp;Data Menu Kategori</h3>
			</div>
			<div class="panel-body">
				<?php
				$menu = (isset($_GET['menu']) ? $_GET['menu'] : 'example');
				$menu = xss_filter($menu);
				?>
				<div class="table-responsive">
					<table id="data_kategori" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
					<thead>
					<tr style="background:#428BCA;color:#FFF">
						<th class="text-center" width="">No</th>
						<th class="text-center" width="">Nama Kategori</th>
						<th class="text-center" width="">Aksi</th>
					</tr>
					</thead>
					<tbody>
					<!-- Mengambil data dari database -->
					<?php
					$sql = "SELECT * FROM kategori";
					$query = $link->query($sql);
					if ($query->num_rows !== NULL):
						$no = 1;
						while ($row = $query->fetch_assoc()):
							?>
							<tr>
								<td class="text-center"><?=$no++;?></td>
								<td class="text-center"><?=ucfirst($row['nama_kategori']);?></td>

								<td class="text-center">
									<a class="btn btn-xs btn-info" data-toggle="tooltip" title="Edit Data" href="index.php?menu=edit_kas_masuk&id=<?=$row['id_piutang'];?>&kode=<?=$row['no_akun_kredit'];?>" role="button"><i class="fa fa-edit"></i></a>
									<a onclick="hapus(<?=$row['id_piutang'];?>)" class="btn btn-xs btn-danger delete-link" data-toggle="tooltip" title="Hapus Data" id="btn_delete" role="button"><i class="fa fa-trash-o"></i></a>
								</td>
							</tr>
							<?php
						endwhile;
					endif;
					?>
					</tbody>
				</table>
				</div>

			</div>
		</div>
		<!-- End -->
	</div>
</div>
<!-- End Data -->

<script type="text/javascript">
    $(document).ready(function() {
        // jQuery.validator.setDefaults({
        //     debug: true,
        //     success: "valid"
        // });

        // Validasi Form Data Biaya Masuk
        $('#form_entry').validate({
            submitHandler: function(form) {
                // ambil value dari form
                var dataNamaKategori = $('#nama_kategori').val();

                $.ajax({
                    url : "<?=base_url();?>admin/pages/process_tambah_kategori.php",
                    type: "POST",
                    data: "nama_kategori=" + dataNamaKategori,
                    success: function (html) { // jqXHR -> data
                        if (html == 'true') {
                            swal({
                                title: 'Success',
                                text : 'Data berhasil disimpan!',
                                type : 'success'
                            }).then(function() {
                                setTimeout(function() {
                                    location.reload();
                                }, 0001);
                            });
                        } else {
                            swal({
                                title: 'Oops',
                                text : 'Data gagal disimpan',
                                type : 'error'
                            });
                        }
                    },
                    error: function(jqXHR, status, message) {
                        alert('A jQuery error has occurred. Status: ' + status + ' messages: ' + message);
                    }
                });
                return false;
            }
        });

        // dataTable
        $("#data_kategori").dataTable({
            'ordering': false
        });
    });
</script>