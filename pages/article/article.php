<?php
require_once("service/connection.php");
$db = dbConnect();
$id = $_SESSION['id'];
// var_dump($id);
// var_dump($_SESSION['username']);
if (isset($_POST["search"])) {
    $keyword = $_POST["keyword"];

    $sql = "SELECT artikel.id as id,judul, tanggal, gambar, kategori.nama as kategori, pengguna.nama as author, konten FROM artikel 
            JOIN kategori ON artikel.kategori_id = kategori.id
            JOIN pengguna ON pengguna.id = artikel.pengguna_id
            WHERE pengguna.id = '$id' AND
            judul LIKE '%$keyword%' OR
            tanggal LIKE '%$keyword%' OR
            kategori.nama LIKE '%$keyword%'
            ORDER BY tanggal DESC";
} else {
    $sql = "SELECT artikel.id as id, judul, tanggal, gambar, kategori.nama as kategori, pengguna.nama as author, konten FROM artikel 
        JOIN kategori ON artikel.kategori_id = kategori.id
        JOIN pengguna ON pengguna.id = artikel.pengguna_id
        WHERE pengguna.id = '$id'
        ORDER BY tanggal DESC";
}

$res = $db->query($sql);
$data = $res->fetch_all(MYSQLI_ASSOC);

$no = 1;

// if (isset($_POST["delete"])) {
//     if (deleteUser($_POST) > 0) {
//         header("Location: /users");
//     } else {
//         echo "
//             <script>
//                 alert('data berhasil dihapus');
//             </script>
//         ";
//         header("Location: /users");
//         echo mysqli_error($db);
//     }
// }

?>
<title>Manage Article</title>
<div class="px-5 pt-5">
    <div class="col-12 mt-3 pt-5 pl-0 title-article">Artikelmu</div>
    <div class="d-flex justify-content-between mt-3">
        <form action="" method="POST" class="form-inline my-lg-0">
            <input class="form-control mr-sm-2 search-box" type="search" name="keyword" placeholder="Search" aria-label="Search" value="<?php $keyword ?>">
            <button class="btn btn-outline-secondary my-2 my-sm-0" name="search" type="submit">Cari artikel</button>
        </form>
        <a class="btn btn-tambah" href="/manage/add-article">
            Tambahkan artikel baru
        </a>
    </div>




    <?php if ($res->num_rows > 0) { ?>
        <div class="row mt-lg-5">
            <?php foreach ($data as $index => $val) { ?>
                <div class="col-4">

                    <div class="card mb-5">
                        <img src="<?= $val["gambar"]; ?>" class="card-img-top" alt="...">
                        <div class="card-body mx-3">
                            <p class="card-text-category-time mb-1"><span class="mr-2"><?= $val["kategori"]; ?> </span> <?= $val["tanggal"]; ?></p>
                            <a href="/details/articles?id=<?= $val['id'] ?>" class="no-decor">
                                <p class="card-text-title"><?= $val["judul"]; ?></p>
                            </a>
                            <div class="card-text-desc"><?= substr(strip_tags($val["konten"]), 0, 120); ?>..<strong> Read More</strong></div>
                        </div>
                        <div class="d-flex flex-row action-article justify-content-end">
                            <form action="/manage/edit-article" method="POST">
                                <input type="hidden" value="<?= $val["id"] ?>" name="idartikel">
                                <button type="submit" name="edit" class="btn btn-outline-secondary">Ubah</button>
                                <button type="button" class="btn btn-outline-secondary ml-2 mr-2" onclick="setDeleteModal(<?= $val['id'] ?>)" data-toggle="modal" data-target="#deleteModal">Hapus</button>
                            </form>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="text-center mt-5"> Belum ada artikel</div>

    <?php }
    ?>
    <div class="modal fade text-center" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bentar dulu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Yakin mau hapus artikel ini?
                </div>
                <form action="/manage/del-article" method="POST" id="form_submit">
                    <input type="hidden" value="" name="id" id="modalID">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Ga jadi</button>
                        <button type="submit" class="btn btn-outline-secondary" name="delete">Yakin</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



</div>

<?php ob_start('setScripts') ?>
<script type="text/javascript">
    function setDeleteModal(id) {
        $('#modalID').val(id)
    }
</script>
<?php ob_end_flush(); ?>