<?php
session_start();

include_once 'library/koneksi.php';
include_once 'library/function.php';
include_once 'template/header.php';
?>

    <!-- stylesheet -->
    <link rel="stylesheet" href="<?=base_url();?>bower_components/css/login.css" />
    <style>
    /* body {
        background-image: url('https://openclipart.org/image/2400px/svg_to_png/253845/seigaiha-blue.png');
        background-attachment: fixed;
    } */

    .kotakform {
        /* margin: 100px auto; */
        height: 420px;
        padding: 30px;
        border: 1px solid lightgreen;
        background-color: rgba(255, 255, 255, 0.5);
    }

    .kotakform {
        box-shadow: 0 0 30px gray;
    }
    </style>

</head>
<body>

<!-- mainpage-login -->
<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-sm-6">
            <div class="kotakform">
                <center><img src="https://sepatudiva.com/wp-content/uploads/2017/08/small-logo.png" class="img-responsive img-thumbnail"></center>
                <br>
                <!-- error -->
                <div class="alert alert-danger" id="error" style="display:none;">Username atau Password salah!</div>

                <form class="form-horizontal" id="formLogin">
                    <!-- Username -->
                    <div class="form-group">
                        <label for="username" class="control-label col-sm-4">Username</label>
                        <div class="col-sm-6">
                            <input type="text" id="username" class="form-control" placeholder="Username" required="required" autofocus />
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="control-label col-sm-4">Password</label>
                        <div class="col-sm-6">
                            <input type="password" id="password" class="form-control" placeholder="Password" required="required" name="password" />
                        </div>
                    </div>

                    <!-- Show Password -->
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                            <div class="checkbox">
                                <label for="showpassword"><input type="checkbox" class="form-checkbox" id="checkbox">Tampilkan Password</label>
                            </div>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary" id="validasi" name="btn-login"><i class="fa fa-sign-in"></i>&nbsp;Masuk</button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;Reset</button>
                    </div>
                </form>
                <br><br>
                <hr>
                <p class="text-center">Copyright &copy; <?=date('Y');?>. Developed by Adi Ningghar</p>
            </div> <!-- @/.kotakform -->
        </div> <!-- @/.col-offset-sm-4 -->
    </div> <!-- @/.row -->
</div> <!-- @/.container -->
<!-- end-mainpage -->

<!-- Javascript -->
<?php include_once 'template/javascript.php'; ?>

<script type="text/javascript">
    $(document).ready(function() {
        // ceklist show password
        $('#checkbox').click(function() {
            if ($('#checkbox').is(':checked')) {
                $('#password').attr('type', 'text');
            } else {
                $('#password').attr('type', 'password');
            }
        });

        $('#validasi').click(function() {
            var username = $('#username').val();
            var password = $('#password').val();

            $.ajax({
                type: "POST",
                url: "cek_login.php",
                data: "user=" + username + "&pass=" + password,
                success: function (html) {
                    if (html == 'true') {
                        swal({
                            title: 'Success',
                            text: 'Login Berhasil',
                            type: 'success'
                        }).then(function() {
                            window.location="admin/index.php";
                        });
                    } else {
                        $('#error').css('display', 'block');
                        $('.kotakform').css('height', '500px');
                    }
                }
            });
            return false;
        });
    });
</script>

<?php if (isset($_SESSION['error'])): ?>
<script type="text/javascript">
    swal('Oops', "<?php flashdata('error'); ?>", 'error');
</script>
<?php endif; ?>

</body>
</html>
