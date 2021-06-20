<?php
require_once("service/connection.php");
$db = dbConnect();
$sql = "SELECT artikel.id as artikel_id, judul, tanggal, gambar, kategori.nama as kategori, pengguna.nama as author, konten FROM artikel 
        JOIN kategori ON artikel.kategori_id = kategori.id
        JOIN pengguna ON pengguna.id = artikel.pengguna_id
        ORDER BY tanggal DESC";
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
<title>News Atol</title>

<div class="px-5 mt-5">

    <?php if ($res->num_rows > 0) { ?>
        <div class="row mt-5">
            <?php foreach ($data as $key => $val) {
                if ($key == 0) {
            ?>
                    <div class="col-12">
                        <a href="/details/articles?id=<?= $val['artikel_id'] ?>" class="no-decor">
                            <div class="card-hero mb-3 mt-5">
                                <div class="row no-gutters">
                                    <div class="col-6">
                                        <img src="<?= $val['gambar']; ?>" alt="..." class="card-img-hero">
                                    </div>
                                    <div class="col-6">
                                        <div class="card-body card-body-home my-4">
                                            <div class="d-flex justify-content-between">
                                                <p class="card-text-category-time mt-1 mb-1 mx-4"><span class="mr-2"><?= $val["kategori"]; ?> </span> <?= $val["tanggal"]; ?></p>
                                                <div class="author-home mx-4"><span>by</span> <?= $val['author']; ?></div>
                                            </div>

                                            <p class="card-text-title mt-1 mx-4"><?= $val["judul"]; ?></p>
                                            <div class="card-text-desc mx-4"><?= substr(strip_tags($val["konten"]), 0, 270); ?>..<strong> Read More</strong></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="title-home col-12 mb-4 mt-3">Semua Artikel</div>
                <?php continue;
                } ?>

                <div class="col-4">
                    <a href="/details/articles?id=<?= $val['artikel_id'] ?>">
                        <div class="card card-home mb-5">
                            <img src="<?= $val["gambar"]; ?>" class="card-img-top" alt="...">
                            <div class="card-body card-body-all mx-3">
                                <p class="card-text-category-time mb-0"><span class="mr-2"><?= $val["kategori"]; ?> </span> <?= $val["tanggal"]; ?></p>
                                <div class="author mb-2"><span>by</span> <?= $val['author']; ?></div>
                                <p class="card-text-title"><?= $val["judul"]; ?></p>
                                <div class="card-text-desc"><?= substr(strip_tags($val["konten"]), 0, 100); ?>..<strong> Read More</strong></div>
                            </div>
                            <div class="d-flex flex-row action-article justify-content-end">

                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="text-center mt-5 pt-5"> Belum ada artikel</div>

    <?php }
    ?>



</div>

<?php ob_start('setScripts') ?>
<script type="text/javascript">
    function setDeleteModal(id) {
        $('#deleteModal').modal('show')
        $('#modalID').val(id)
    }
</script>
<?php ob_end_flush(); ?>