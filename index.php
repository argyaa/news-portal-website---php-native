<?php
require_once('service/routes.php');
require_once("service/connection.php");
$db = dbConnect();
$id = isset($_GET['id']) ? $_GET['id'] : '';
$keyword = isset($_GET['q']) ? $_GET['q'] : '';
// var_dump($id);
// var_dump($_SESSION['username']);
if (isset($_POST["search"])) {
    $keyword = $_POST["keyword"];

    $sql = "SELECT judul, tanggal, gambar, kategori.nama as kategori, pengguna.nama as author, konten FROM artikel 
            JOIN kategori ON artikel.kategori_id = kategori.id
            JOIN pengguna ON pengguna.id = artikel.pengguna_id
            WHERE
            judul LIKE '%$keyword%' OR
            tanggal LIKE '%$keyword%' OR
            kategori.nama LIKE '%$keyword%'
            ORDER BY tanggal DESC";
} else {
    $sql = "SELECT artikel.id as artikel_id, judul, tanggal, gambar, kategori.nama as kategori, pengguna.nama as author, konten FROM artikel 
        JOIN kategori ON artikel.kategori_id = kategori.id
        JOIN pengguna ON pengguna.id = artikel.pengguna_id
        ORDER BY tanggal DESC";
}

$res = $db->query($sql);
$data = $res->fetch_all(MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


    <?php if ($_SERVER['REQUEST_URI'] == "/login") { ?>
        <link rel="stylesheet" href="../css/auth.css">
    <?php } else { ?>
        <link rel="stylesheet" href="../css/main.css">
    <?php } ?>
    <link rel="stylesheet" href="../css/trumbowyg.min.css">

</head>

<body>
    <?php
    $hiddenNav = getHiddenNav();
    if (!getHiddenNav()) { ?>
        <nav class="navbar fixed-top navbar-expand-lg z-index-10 navbar-light bg-light">
            <a class="navbar-brand" href="/">Atol Gaming</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul> -->
                <?php if ($_SERVER['REQUEST_URI'] == "/manage/users" || $_SERVER['REQUEST_URI'] == "/manage/articles" || $_SERVER['REQUEST_URI'] == "/manage/add-article" || $_SERVER['REQUEST_URI'] == "/manage/add-user" || $_SERVER['REQUEST_URI'] == "/manage/edit-user" || $_SERVER['REQUEST_URI'] == "/details/articles?id=" . $id . "" || $_SERVER['REQUEST_URI'] == "/manage/edit-article" || $_SERVER['REQUEST_URI'] == "/result?q=" . $keyword . "" || $_SERVER['REQUEST_URI'] == "/profile/users" || $_SERVER['REQUEST_URI'] == "/manage/category" || $_SERVER['REQUEST_URI'] == "/manage/edit-category") { ?>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item z-index-10">
                            <a class="nav-link" href="/">Beranda</a>
                        </li>
                    </ul>
                <?php } else { ?>
                    <form action="/result?<?php $_GET['q']; ?>" method="GET" class="form-inline mx-auto my-lg-0">
                        <input name="q" class="form-control mr-sm-2 search-box" type="search" placeholder="Kategori, Judul, Author, etc" aria-label="Search">
                        <button class="btn btn-tambah my-2 my-sm-0" type="submit">Cari artikel</button>
                    </form>
                <?php } ?>
                <ul class="navbar-nav">
                    <?php if (!getStatusAuth()) { ?>
                        <li class="nav-item">
                            <a class="nav-link btn login" href="/login">Login</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $_SESSION['username']; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/profile/users">profile</a>
                                <?php if ($_SESSION['roles'] == 'admin') { ?>
                                    <a class="dropdown-item" href="/manage/users">manage users</a>
                                <?php } ?>
                                <a class="dropdown-item" href="/manage/articles">manage article</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout">Logout</a>
                            </div>
                        </li>
                    <?php } ?>
                </ul>

            </div>
        </nav>


    <?php
    }
    include getPage();
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="../js/main.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/trumbowyg.min.js"></script>
    <script>
        $.trumbowyg.svgPath = '../css/icons.svg';
    </script>
    <?= getScripts() ?>
</body>

</html>