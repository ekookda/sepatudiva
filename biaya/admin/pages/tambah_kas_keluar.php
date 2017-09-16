<?php
$menu = (isset($_GET['menu']) ? $_GET['menu'] : false);
$menu = xss_filter($url);
$explode = explode("_", $menu);
$title = implode(" ", $explode);
?>
<!-- Title -->
<h1 class="page-header"><?=ucwords($title);?></h1>

<!-- Form Entry Kas -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-info-circle"></i>&nbsp;Kas Keluar</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <form action="<?=base_url();?>admin/pages/process_tambah_kas_keluar.php" method="POST" class="form-horizontal" role="form" id="form_entry">
                <div class="col-sm-5">
                    <!-- Tanggal Hutang -->
                    <div class="form-group">
                        <label for="tanggal_hutang" class="control-label col-sm-4">Tanggal</label>
                        <div class="col-sm-6">
                            <input type="date" name="tanggal_hutang" id="tanggal_hutang" class="form-control" required="required">
                            <!-- messages error -->
                            <span id="messagesError" class="error text-danger"><i></i></span>
                        </div>
                    </div> <!-- Tanggal Hutang -->

                    <!-- Nama Kreditur Hutang -->
                    <div class="form-group">
                        <label for="kreditur_hutang" class="control-label col-sm-4">Kreditur Hutang</label>
                        <div class="col-sm-8">
                            <input type="text" name="kreditur_hutang" id="kreditur_hutang" class="form-control" required="required">
                            <!-- messages error -->
                            <span id="messagesError" class="error text-danger"><i></i></span>
                        </div>
                    </div> <!-- Nama Kreditur Hutang -->

                    <!-- Jumlah Hutang -->
                    <div class="form-group">
                        <label for="jumlah_hutang" class="control-label col-sm-4">Jumlah</label>
                        <div class="col-sm-8">
                            <input type="number" minlength="5" name="jumlah_hutang" id="jumlah_hutang" class="form-control" placeholder="Rp" required="required">
                            <!-- messages error -->
                            <span id="messagesError" class="error text-danger"><i></i></span>
                        </div>
                    </div> <!-- Jumlah -->

                </div> <!-- @/.col-sm-6 -->

                <div class="col-sm-6">
                    <!-- Kategori -->
                    <div class="form-group">
                        <label for="kategori" class="control-label col-sm-4">Kategori</label>
                        <div class="col-sm-8">
                            <select name="kategori_hutang" id="kategori_hutang" class="form-control" required="required">
                                <option value="">---- Pilih Kategori ----</option>
                                <!-- Ambil data Kategori dari table Category -->
                                <?php
                                $sql = "SELECT * FROM kategori";
                                $qry = $link->query($sql);
                                if ($qry->num_rows > 0) {
                                    while ($r = $qry->fetch_assoc()) {
                                        echo "<option value='" . $r['id_kategori'] . "'>" . ucfirst($r['nama_kategori']) . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <!-- messages error -->
                            <span id="messagesError" class="error text-danger"><i></i></span>
                        </div>
                    </div> <!-- Kategori -->

                    <!-- Status -->
                    <div class="form-group">
                        <label for="status" class="control-label col-sm-4">Status</label>
                        <div class="col-sm-8">
                            <select name="status_hutang" id="status_hutang" class="form-control" required="required">
                                <option value="">---- Pilih Status ----</option>
                                <!-- Ambil data Kategori dari table Category -->
                                <option value="belum lunas">Belum Lunas</option>
                                <option value="lunas">Lunas</option>
                            </select>
                            <!-- messages error -->
                            <span id="messagesError" class="error text-danger"><i></i></span>
                        </div>
                    </div> <!-- Status -->

                    <!-- Keterangan -->
                    <div class="form-group">
                        <label for="keterangan_hutang" class="control-label col-sm-4">Keterangan</label>
                        <div class="col-sm-8">
                            <textarea name="keterangan_hutang" id="keterangan_hutang" rows="4" cols="5" class="form-control" style="resize:none;" required="required"></textarea>
                            <!-- messages error -->
                            <span id="messagesError" class="error text-danger"><i></i></span>
                        </div>
                    </div> <!-- Keterangan -->

                    <!-- Submit Button -->
                    <div class="form-group">
                        <div class=" col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-primary" id="btnSubmit"><i class="fa fa-save"></i> Simpan</button>
                            <button type="button" id="back_button" class="btn btn-warning"><i class="fa fa-backward"></i> Back</button>
                        </div>
                    </div>
                </div> <!-- @/.col-sm-6 -->
            </form>
        </div> <!-- @/.panel-row -->
    </div> <!-- @/.panel-body -->
</div> <!-- @/.panel-default -->
<!-- End Form Entry -->

<hr>

<!-- Panel Show Data Kas From Table Kas -->
<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-info-circle"></i>&nbsp;Manajemen Biaya Keluar</h3>
    </div>
    <div class="panel-body">
    <?php $menu = (isset($_GET['menu']) ? $_GET['menu'] : 'example');?>
        <table id="tambah_kas_keluar" class="table table-striped table-bordered table-responsive table-hover" cellspacing="0" width="100%">
            <thead>
            <tr style="background:#428BCA;color:#FFF">
                <th class="text-center" width="">No</th>
                <th class="text-center" width="">Tanggal Piutang</th>
                <th class="text-center" width="">Kategori</th>
                <th class="text-center" width="">Kreditur</th>
                <th class="text-center" width="">Jumlah</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center" width="">Status</th>
            </tr>
            </thead>
            <tbody>
                <!-- Mengambil data dari database -->
                <?php
                $nama_bulan = ['01'=>'Januari' ,'02'=>'Februari', '03'=>'Maret', '04'=>'April', '05'=>'Mei', '06'=>'Juni',
                    '07'=>'Juli', '08'=>'Agustus', '09'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember'
                ];

                $sql = "SELECT hutang.*, kategori.* FROM hutang INNER JOIN kategori ON hutang.kategori_id=kategori.id_kategori";
                $query = $link->query($sql);
                if ($query->num_rows !== NULL):
                    $no = 1;
                    while ($row = $query->fetch_assoc()):
                ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-center">
		                    <?php
		                    echo date('d', strtotime($row['tanggal_hutang'])) . ' ' . (ucfirst($nama_bulan[date('m', strtotime($row['tanggal_hutang']))])) . ' ' . date('Y', strtotime($row['tanggal_hutang']));
		                    ?>
                        </td>
                        <td class="text-center"><?= ucfirst($row['nama_kategori']); ?></td>
                        <td class="text-center"><?= ucfirst($row['kreditur_hutang']); ?></td>
                        <td class="text-center">Rp <?= number_format($row['jumlah_hutang'], 0, ',', '.'); ?>,-</td>
                        <td class="text-center"><?= ucfirst($row['keterangan_hutang']); ?></td>
                        <!-- Nama Status -->
	                    <?php
	                    $status = $row['status_hutang'];
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
                    </tr>
                <?php
                    endwhile;
                endif;
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- End -->

<script type="text/javascript">
$(document).ready(function() {
    // jQuery.validator.setDefaults({
    //     debug: true,
    //     success: "valid"
    // });

    // Validasi Form Data Biaya Keluar
    $('#form_entry').validate({
        submitHandler: function(form) {
            // ambil value dari form
            var tanggal_hutang = $('#tanggal_hutang').val();
            var kreditur_hutang = $('#kreditur_hutang').val();
            var jumlah_hutang = $('#jumlah_hutang').val();
            var kategori_hutang = $('#kategori_hutang').val();
            var keterangan_hutang = $('#keterangan_hutang').val();
            var status_hutang = $('#status_hutang').val();

            $.ajax({
                url : "<?=base_url();?>admin/pages/process_tambah_kas_keluar.php",
                type: "POST",
                data: "tanggal_hutang=" + tanggal_hutang + "&kreditur_hutang=" + kreditur_hutang + "&jumlah_hutang=" + jumlah_hutang + "&kategori_hutang=" + kategori_hutang + "&keterangan_hutang=" + keterangan_hutang + "&status_hutang=" + status_hutang,
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
                    alert('A jQuery error has occurred. Status: ' + status + '\nmessages: ' + message);
                }
            });
            return false;
        }
    });

    // dataTable
    $("#tambah_kas_keluar").dataTable({
        'ordering': false,
        'searching': false
    });
});
</script>
