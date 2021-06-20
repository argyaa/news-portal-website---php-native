<?php
include_once("service/functions.php");
$sql2 = "SELECT * from kategori";
$res2 = $db->query($sql2);
$kategori = $res2->fetch_all(MYSQLI_ASSOC);


if (isset($_POST["update"])) {

    if (UpdateArticle($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan');
            </script>
        ";
        header("Location: /manage/articles");
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan');
            </script>
        ";
        header("Location: /manage/articles");
        echo mysqli_error($db);
    }
}

if (isset($_POST["edit"])) {
    $id = $_POST["idartikel"];
    $sql = "SELECT judul, gambar, konten, kategori_id 
    FROM artikel
    WHERE id='$id' ";
    $res = $db->query($sql);
    $data = $res->fetch_assoc();
    if ($data) {
?>

        <div class="container mt-5">
            <form action="" method="POST">
                <div class="row">

                    <div class="col-sm-10">
                        <div class="row mt-5">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="Inputjudul">Judul</label>
                                    <input type="text" name="judul" value="<?php echo $data['judul']; ?>" class="form-control" id="Inputjudul" aria-describedby="emailHelp" placeholder="Masukkan judul" require autocomplete="FALSE">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="Inputgambar">Gambar</label>
                                    <input type="text" name="gambar" value="<?php echo $data['gambar']; ?>" class="form-control" id="Inputgambar" placeholder="Masukkan url gambar" require autocomplete="FALSE">
                                </div>
                            </div>
                        </div>
                        <div class="container-textarea">
                            <div class="form-group">
                                <textarea class="form-control" name="konten" val id="trumbowyg-text" require autocomplete="FALSE"><?php echo $data['konten']; ?></textarea>
                            </div>
                        </div>

                        <div class="d-felx flex-row justify-content-end">
                            <a href="/manage/articles" class="btn btn-outline-secondary">Batalkan</a>
                            <input type="hidden" value="<?= $id ?>" name="idartikel">
                            <button type="submit" name="update" class="btn btn-primary aksen">Ubah</button>
                        </div>
                    </div>
                    <div class="col-sm-2 mt-5">
                        <div class="kategori-title mb-1">kategori</div>
                        <div class="kategori-subtitle mb-4" id="getLabel">Pilih salah satu kategori</div>
                        <?php foreach ($kategori as $key => $val) { ?>
                            <label for="kategori<?= $key ?>" class="btn radio-category" id="labelKategori<?= $key ?>">
                                <?= $val['nama'] ?>
                                <input type="radio" class="kategori" id="kategori<?= $key ?>" name="kategori" value="<?= $val['id'] ?>" data-category="<?= $key ?>" <?= ($val['id'] == $data['kategori_id'] ? 'checked' : '') ?>>
                            </label>
                        <?php } ?>
                    </div>

                </div>
            </form>
        </div>
<?php }
} ?>

<?php ob_start("setScripts") ?>
<script type="text/javascript">
    $('#trumbowyg-text').trumbowyg()
    var temp = -1

    for (const item of $('.kategori')) {
        if ($(item).prop('checked')) {
            $(item).parent().addClass('radio-active')
            temp = $(item).data('category')
        }
    }

    $('.kategori').change((e) => {
        if (temp > -1) $('#labelKategori' + temp).removeClass('radio-active')
        $('#labelKategori' + $($(e)[0].target).data('category')).addClass('radio-active')
        temp = $($(e)[0].target).data('category')
    })
</script>
<?php ob_end_flush(); ?>