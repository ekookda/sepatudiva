<?php
$url = (isset($_GET['menu']) ? $_GET['menu'] : false);
$url = xss_filter($url);
$explode = explode("_", $url);
$title = implode(" ", $explode);
?>
<!-- Title -->
<h2 class="page-header"><?=ucwords($title);?></h2>

<!-- Form Entry Kas -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-info-circle"></i>&nbsp;Kas Masuk</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <form action="<?=base_url();?>admin/pages/process_edit_kas_masuk.php" method="POST" class="form-horizontal" role="form" id="form_entry">
                <?php
                $id = (isset($_GET['id']) ? $_GET['id'] : false);
                $kode = (isset($_GET['kode']) ? $_GET['kode'] : false);
                $id = htmlentities($id, ENT_QUOTES);
                $kode = htmlentities($kode, ENT_QUOTES);

                // Query Select Where
                $query = "SELECT piutang.*, kategori.* FROM piutang INNER JOIN kategori ON piutang.kategori_id=kategori.id_kategori WHERE piutang.id_piutang='$id' AND piutang.no_akun_kredit='$kode'";

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
                        <label for="nomor_akun" class="control-label col-sm-4">Nomor Akun</label>
                        <div class="col-sm-8">
                            <input type="text" name="nomor_akun" id="nomor_akun" class="form-control" required="required" value='<?=$row['no_akun_kredit'];?>'>
                        </div>
                    </div> <!-- Nomor Akun -->

                    <!-- Nama Akun -->
                    <div class="form-group">
                        <label for="nama_akun" class="control-label col-sm-4">Nama Akun</label>
                        <div class="col-sm-8">
                            <input type="text" name="nama_akun" id="nama_akun" class="form-control" required="required" value='<?=$row['nama_akun'];?>'>
                            <!-- messages error -->
                            <span id="messagesError" class="error text-danger"><i></i></span>
                        </div>
                    </div> <!-- Nama Akun -->

                    <!-- Jumlah -->
                    <div class="form-group">
                        <label for="jumlah" class="control-label col-sm-4">Jumlah</label>
                        <div class="col-sm-8">
                            <input type="number" minlength="6" name="jumlah" id="jumlah" class="form-control" placeholder="Rp" required="required" value='<?=$row['jumlah'];?>'>
                            <!-- messages error -->
                            <span id="messagesError" class="error text-danger"><i></i></span>
                        </div>
                    </div> <!-- Jumlah -->

                    <!-- Tanggal Kas Masuk -->
                    <div class="form-group">
                        <label for="tanggal" class="control-label col-sm-4">Tanggal</label>
                        <div class="col-sm-6">
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required="required" value='<?=$row['tanggal_kredit'];?>'>
                            <!-- messages error -->
                            <span id="messagesError" class="error text-danger"><i></i></span>
                        </div>
                    </div> <!-- Tanggal Kas Masuk -->
                </div> <!-- @/.col-sm-6 -->

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
                            <select name="status" id="status" class="form-control" required="required">
                                <option value="">---- Pilih Status ----</option>
                                <!-- Ambil data status dari table Status -->
                                <?php
                                $sql = "SELECT * FROM status";
                                $qry = $link->query($sql);
                                if ($qry->num_rows > 0) {
                                    while ($s = $qry->fetch_assoc()):
                                        if ($s['id_status'] == $row['status_id']) {
                                            $selected = ' selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                ?>
                                        <option value="<?=$s['id_status'];?>"<?=$selected;?>><?=ucfirst($s['nama_status']);?></option>
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
                            <textarea name="keterangan" id="keterangan" rows="4" cols="5" class="form-control" style="resize:none;" required="required"><?=$row['keterangan'];?></textarea>
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
    $('#form_entry').validate({
        submitHandler: function(form) {
            // ambil value dari form
            var dataId = $('#id_piutang').val();
            var dataNomorAkun = $('#nomor_akun').val();
            var dataNamaAkun = $('#nama_akun').val();
            var dataKategori = $('#kategori').val();
            var dataKeterangan = $('#keterangan').val();
            var dataJumlah = $('#jumlah').val();
            var dataTanggal = $('#tanggal').val();
            var dataStatus = $('#status').val();

            $.ajax({
                url : "<?=base_url();?>admin/pages/process_edit_kas_masuk.php",
                type: "POST",
                data: "id_piutang=" + dataId + "&nomor_akun=" + dataNomorAkun + "&nama_akun=" + dataNamaAkun + "&kategori=" + dataKategori + "&keterangan=" + dataKeterangan + "&jumlah=" + dataJumlah + "&tanggal=" + dataTanggal + "&status=" + dataStatus,
                success: function (html) { // jqXHR -> data
                    if (html == 'true') {
                        swal({
                            title: 'Success',
                            text : 'Data berhasil disimpan!',
                            type : 'success'
                        }).then(function() {
                            setTimeout(function() {
                                // location.reload();
                                window.location.href='<?=base_url();?>admin/index.php?menu=kas_masuk'
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
                    alert('A jQuery error has occurred. Status: ');
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
