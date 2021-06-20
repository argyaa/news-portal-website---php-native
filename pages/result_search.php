<?php
require_once("service/connection.php");
$db = dbConnect();
$keyword = $_GET["q"];

$sql = "SELECT artikel.id as id, judul, tanggal, gambar, kategori.nama as kategori, pengguna.nama as author, konten FROM artikel 
        JOIN kategori ON artikel.kategori_id = kategori.id
        JOIN pengguna ON pengguna.id = artikel.pengguna_id
        WHERE
        judul LIKE '%$keyword%' OR
        tanggal LIKE '%$keyword%' OR
        kategori.nama LIKE '%$keyword%' OR
        pengguna.nama LIKE '%$keyword%'
        ORDER BY tanggal DESC";
$res = $db->query($sql);
$data = $res->fetch_all(MYSQLI_ASSOC);
?>
<title>Result</title>
<?php var_dump($keyword); ?>
<div class="px-5 mt-5">
    <div class="row">
        <div class="col-12">
            <form action="/result?<?php $_GET['q']; ?>" method="GET" class="form-inline justify-content-center mt-5">
                <input name="q" class="form-control mr-sm-2 search-box" type="search" placeholder="Kategori, Judul, Author, etc" aria-label="Search">
                <button class="btn btn-tambah my-2 my-sm-0" type="submit">Cari artikel</button>
            </form>

        </div>
    </div>
    <?php if ($res->num_rows > 0) { ?>
        <div class="row mt-5">
            <div class="col-12 text-center">
                <div class="mt-0 mb-5 result-info">Hasil pencarian anda "<span><?php echo $keyword; ?></span>"</div>
            </div>
            <?php foreach ($data as $key => $val) { ?>
                <div class="col-4">
                    <a href="/details/articles?id=<?= $val['id'] ?>">
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
        <div class="text-center mt-5"> artikel yang anda cari tidak ada</div>

    <?php }
    ?>
</div>