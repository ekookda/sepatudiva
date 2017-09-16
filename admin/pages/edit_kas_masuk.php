<?php
$menu = (isset($_GET['menu']) ? $_GET['menu'] : false);
$menu = xss_filter($menu);
$explode = explode("_", $menu);
$title = implode(" ", $explode);
?>
<!-- Title -->
<h2 class="page-header"><?=ucwords($title);?></h2>

<!-- Form Entry Kas -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-info-circle"></i>&nbsp;Edit Kas Masuk</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <form action="<?=base_url();?>admin/pages/process_edit_kas_masuk.php" method="POST" class="form-horizontal" role="form" id="form_edit">
                <?php
                $id = (isset($_GET['id']) ? sql_injection($_GET['id']) : false);
                $kode = (isset($_GET['kode']) ? sql_injection($_GET['kode']) : false);

                // Query Select Where
                $query = "SELECT piutang.*, kategori.* FROM piutang INNER JOIN kategori ON piutang.kategori_id=kategori.id_kategori WHERE piutang.id_piutang='$id' AND piutang.id_piutang='$kode'";

                $qry = $link->query($query);
                if ($qry->num_rows < 1 || !$qry):
                    // Data tidak cocok/null
                    redirect(base_url() . 'admin/index.php?menu=kas_masuk');
                else:
                    $row = $qry->fetch_assoc();
                    if ($row != null):
                ?>
                <div class="col-sm-5">
                    <!-- id_hidden -->
                    <input type="hidden" id="id_piutang" name="id_piutang" value="<?=$row['id_piutang'];?>">

                    <!-- Nomor Akun -->
                    <div class="form-group">
                        <label for="nama_kreditur" class="control-label col-sm-4">Nama Kreditur</label>
                        <div class="col-sm-8">
                            <input type="text" name="nama_kreditur" id="nama_kreditur" class="form-control" required="required" value='<?=$row['kreditur_piutang'];?>'>
                        </div>
                    </div> <!-- Nomor Akun -->

                    <!-- jumlah_piutang -->
                    <div class="form-group">
                        <label for="jumlah_piutang" class="control-label col-sm-4">jumlah_piutang</label>
                        <div class="col-sm-8">
                            <input type="number" minlength="6" name="jumlah_piutang" id="jumlah_piutang" class="form-control" placeholder="Rp" required="required" value='<?=$row['jumlah_piutang'];?>'>
                            <!-- messages error -->
                            <span id="messagesError" class="error text-danger"><i></i></span>
                        </div>
                    </div> <!-- jumlah_piutang -->

                    <!-- tanggal_piutang Kas Masuk -->
                    <div class="form-group">
                        <label for="tanggal_piutang" class="control-label col-sm-4">tanggal_piutang</label>
                        <div class="col-sm-6">
                            <input type="date" name="tanggal_piutang" id="tanggal_piutang" class="form-control" required="required" value='<?=$row['tanggal_piutang'];?>'>
                            <!-- messages error -->
                            <span id="messagesError" class="error text-danger"><i></i></span>
                        </div>
                    </div> <!-- tanggal_piutang Kas Masuk -->
                </div> <!-- @/.col-sm-6 -->

                <!-- Kategori -->
                <div class="col-sm-6">
                    <!-- Kategori -->
                    <div class="form-group">
                        <label for="kategori" class="control-label col-sm-4">Kategori</label>
                        <div class="col-sm-8">
                            <select name="kategori" id="kategori" class="form-control" required="required">
                                <option value="">---- Pilih Kategori ----</option>
                                <!-- Ambil data Kategori dari table Category -->
                                <?php
                                $opt = $link->query("SELECT * FROM kategori");
                                while ($o = $opt->fetch_assoc()):
                                    if ($o['id_kategori'] == $row['kategori_id']) {
                                        $selected = ' selected="selected"';
                                    } else {
                                        $selected = '';
                                    }
                                ?>
                                    <option value="<?=$o['id_kategori'];?>"<?=$selected;?>><?=ucfirst($o['nama_kategori']);?></option>
                                <?php
                                endwhile;
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
                            <select name="status_piutang" id="status_piutang" class="form-control" required="required">
                                <option value="">---- Pilih Status ----</option>
                                <!-- Ambil data status dari table Status -->
                                <?php
                                $sql = "SELECT * FROM status";
                                $qry = $link->query($sql);
                                if ($qry->num_rows > 0) {
                                    while ($s = $qry->fetch_assoc()):
                                        if ($s['nama_status'] == $row['status_piutang']) {
                                            $selected = ' selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                ?>
                                        <option value="<?=$s['nama_status'];?>"<?=$selected;?>><?=ucwords($s['nama_status']);?></option>
                                <?php
                                    endwhile;
                                }
                                ?>
                            </select>
                            <!-- messages error -->
                            <span id="messagesError" class="error text-danger"><i></i></span>
                        </div>
                    </div> <!-- Status -->

                    <!-- Keterangan -->
                    <div class="form-group">
                        <label for="keterangan" class="control-label col-sm-4">Keterangan</label>
                        <div class="col-sm-8">
                            <textarea name="keterangan_piutang" id="keterangan_piutang" rows="4" cols="5" class="form-control" style="resize:none;" required="required"><?=$row['keterangan_piutang'];?></textarea>
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
            <?php
                endif;
            endif;
            ?>
            </form>
        </div> <!-- @/.panel-row -->
    </div> <!-- @/.panel-body -->
</div> <!-- @/.panel-default -->
<!-- End Form Entry -->

<script type="text/javascript">
$(document).ready(function() {
    // jQuery.validator.setDefaults({
    //     debug: true,
    //     success: "valid"
    // });

    // Validasi Form Data Biaya Masuk
    $('#form_edit').validate({
        submitHandler: function(form) {
            // ambil value dari form
            var dataId = $('#id_piutang').val();
            var dataNamaKreditur = $('#nama_kreditur').val();
            var dataKategori = $('#kategori').val();
            var dataKeteranganPiutang = $('#keterangan_piutang').val();
            var dataJumlahPiutang = $('#jumlah_piutang').val();
            var dataTanggalPiutang = $('#tanggal_piutang').val();
            var dataStatusPiutang = $('#status_piutang').val();
            var getUrl = $('#form_edit').attr('action');

            $.ajax({
                url: getUrl,
                type: "POST",
                data:  "id_piutang=" + dataId +
                        "&nama_kreditur=" + dataNamaKreditur +
                        "&kategori=" + dataKategori +
                        "&keterangan_piutang=" + dataKeteranganPiutang +
                        "&jumlah_piutang=" + dataJumlahPiutang +
                        "&tanggal_piutang=" + dataTanggalPiutang +
                        "&status_piutang=" + dataStatusPiutang,
                success: function(html) { // jqXHR -> data
                    if (html === 'true') {
                        swal({
                            title: 'Success',
                            text : 'Data berhasil disimpan!',
                            type : 'success'
                        }).then(function() {
                            setTimeout(function() {
                                // location.reload();
                                window.location='<?=base_url();?>admin/index.php?menu=kas_masuk'
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
    $("#<?=$menu;?>").dataTable({
        'ordering': false
    });
});
</script>

<!-- Close Connection -->
<?php $link->close(); ?>
