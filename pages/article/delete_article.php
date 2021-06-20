<?php
include_once("service/functions.php");

if (isset($_POST["delete"])) {
    if (deleteArticle($_POST) > 0) {
        header("Location: /manage/articles");
    } else {
        echo "
            <script>
                alert('data berhasil dihapus');
            </script>
        ";
        header("Location: /manage/articles");
        echo mysqli_error($db);
    }
}
