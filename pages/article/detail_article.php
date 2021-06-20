<?php
require_once("service/connection.php");
$db = dbConnect();
$id = $_GET['id'];
$sql = "SELECT judul, gambar, konten, tanggal, kategori.nama as kategori
        FROM artikel  
        JOIN kategori ON kategori.id = artikel.kategori_id
        WHERE artikel.id='$id'";
$res = $db->query($sql);
$data = $res->fetch_assoc();
if ($data) {
?>
    <title>details</title>
    <div class="detail-hero mt-2">
        <img src="<?php echo $data['gambar']; ?>" class="position-absolute mt-5" alt="">

        <div class="card-body-detail justify-content-center">
            <div class="kategori-detail"><span class="mr-3"><?php echo $data['kategori']; ?> </span> <?php echo $data['tanggal']; ?></div>
            <div class="title-detail"><?= $data['judul']; ?></div>
            <div class="konten-detail my-4 mb-4"><?= html_entity_decode($data['konten']); ?></div>
        </div>
    </div>
<?php } ?>