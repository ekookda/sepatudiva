<!DOCTYPE html>
<html>
<head>
    <title>Contoh AJAX</title>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
</head>
<body>
    <span id="loading" style="display:none;">LOADING ...</span>
    <button id="tombol">Klik disini!</button>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#tombol').click(function() {
                $.ajax({
                    url: "proses.php",
                    beforeSend: function() {
                        setTimeout(function() {
                            $('#loading').show();
                        }, 0001);
                    },
                    success: function(html) {
                        $('#loading').hide();
                        alert(html);
                    }
                });
            });
        });
    </script>
</body>
</html>