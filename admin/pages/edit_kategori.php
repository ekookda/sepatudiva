<?php
$menu = (isset($_GET['menu']) ? sql_injection($_GET['menu']) : false);
$menu = xss_filter($menu);
$explode = explode("_", $menu);
$title = implode(" ", $explode);

if (isset($_POST['id'])) {
    $id = sql_injection($_POST['id']);
    $qry = "SELECT * FROM `kategori` WHERE `id_kategori`='$id'";
    $qry = $link->query($qry);
} else {
    $qry = false;
}

if ($qry == false || $qry->num_rows <= 0):
    // redirect

else:
    while ($r = $qry->fetch_assoc()):
?>

<!-- Form add Kategori -->
<form action="<?=base_url();?>admin/pages/process_edit_kategori.php" method="POST" class="form-horizontal" role="form" id="form_entry">
    <div class="col-sm-12">
        <!-- Kategori -->
        <div class="form-group">
            <label for="kategori" class="control-label col-sm-4">Nama Kategori</label>
            <div class="col-sm-6">
                <input type="hidden" value="<?=$r['id_kategori'];?>" name="id_kategori" id="id_kategori">
                <input type="text" value="<?=$r['nama_kategori'];?>" name="nama_kategori" id="nama_kategori" class="form-control" required="required">
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

<?php
    endwhile;
endif;
?>