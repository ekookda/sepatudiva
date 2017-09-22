<?php
$menu = (isset($_GET['menu']) ? $_GET['menu'] : false);
$menu = xss_filter($menu);
$explode = explode("_", $menu);
$title = implode(" ", $explode);
?>
<!-- Title -->
<h1 class="page-header"><?=ucwords($title);?></h1>

<!-- Data -->
<div class="row">
	<div class="col-lg-6 col-sm-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-info-circle"></i>&nbsp;Input Kategori</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<!-- Form add Kategori -->
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
					<!-- End Form add Kategori -->
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
				$menu = (isset($_GET['menu']) ? sql_injection($_GET['menu']) : 'example');
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
									<!-- <a class="btn btn-xs btn-info" data-toggle="tooltip" title="Edit Data" href="index.php?menu=edit_kategori&id" role="button"><i class="fa fa-edit"></i></a> -->

									<!-- Edit -->
									<button type="button" data-target="#modal-edit" class="btn btn-xs btn-info" data-toggle="modal" data-id="<?=$row['id_kategori'];?>"><i class="fa fa-edit"></i></button>
									<a onclick="hapus(<?=$row['id_kategori'];?>)" class="btn btn-xs btn-danger delete-link" data-toggle="tooltip" title="Hapus Data" id="btn_delete" role="button"><i class="fa fa-trash-o"></i></a>
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

<!-- Form Edit Modal -->
<div class="modal fade" id="modal-edit" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Kategori</h4>
			</div>
			<div class="modal-body">
				<div id="hasil_data"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


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

		hapus = function(id)
		{
			var id = id;
			var getUrl = "<?=base_url();?>admin/pages/process_delete_kategori.php?id=" + id;
			swal({
				title: 'Anda yakin?',
				text: 'Data akan dihapus dari database',
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yakin!',
				showLoaderOnConfirm: true,
				preConfirm: function(html) {
					return new Promise(function(resolve, reject) {
						setTimeout(function() {
							resolve();
						}, 2000);
					});
				}
			}).then(function() {
				$.ajax({
					url: getUrl,
					type: "GET",
					success: function(html) {
						if (html == 'true') {
							swal({
								title: 'Berhasil',
								text: 'Data berhasil dihapus',
								type: 'success'
							}).then(function() {
								setTimeout(function() {
									location.reload();
								}, 0001);
							});
						} else {
							swal({
								title: 'Berhasil',
								text: html,
								type: 'error'
							});
						}
					},
					error: function(jqXHR, status, message) {
						alert('status: ' + status + '\nmessages: ' + message);
					}
				});
			});
		}

        // dataTable
        $("#data_kategori").dataTable({
            'ordering': false
        });

		$('#modal-edit').on('show.bs.modal', function(e) {
			var dataIdKategori = $(e.relatedTarget).data('id');
			$.ajax({
				url: "<?=base_url();?>admin/pages/edit_kategori.php",
				type: 'POST',
				data: 'id=' + dataIdKategori,
				success: function() {
					$('#hasil_data').html(data);
				}
			});
		})
    });
</script>