<?php
include_once("service/functions.php");

if (isset($_POST["delete"])) {
    if (deleteUser($_POST) > 0) {
        header("Location: /manage/users");
    } else {
        echo "
            <script>
                alert('data berhasil dihapus');
            </script>
        ";
        header("Location: /manage/users");
        echo mysqli_error($db);
    }
}
