<?php include_once("service/functions.php");
$sql = "SELECT * from kategori";
$res = $db->query($sql);
$data = $res->fetch_all(MYSQLI_ASSOC);
$no = 1;
$id = $_SESSION['id'];

if (isset($_POST["save"])) {

    if (addArticle($_POST, $id) > 0) {
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

?>
<div class="container mt-5">
    <form action="" method="POST">
        <div class="row">

            <div class="col-sm-10 mt-5">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="Inputjudul">Judul</label>
                            <input type="text" name="judul" class="form-control" id="Inputjudul" aria-describedby="emailHelp" placeholder="Masukkan judul" require autocomplete="FALSE">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="Inputgambar">Gambar</label>
                            <input type="text" name="gambar" class="form-control" id="Inputgambar" placeholder="Masukkan url gambar" require autocomplete="FALSE">
                        </div>
                    </div>
                </div>
                <div class="container-textarea">
                    <div class="form-group">
                        <textarea class="form-control" name="konten" id="trumbowyg-text" require autocomplete="FALSE"></textarea>
                    </div>
                </div>

                <div class="d-felx flex-row justify-content-end">
                    <a href="/manage/articles" class="btn btn-outline-secondary">Batalkan</a>
                    <button type="submit" name="save" class="btn btn-primary aksen">Simpan</button>
                </div>
            </div>
            <div class="col-2 mt-5">
                <div class="kategori-title mb-1">kategori</div>
                <div class="kategori-subtitle mb-4" id="getLabel">Pilih salah satu kategori</div>
                <?php if ($_SESSION["roles"] == "admin") { ?>
                    <div class="edit-category mt-n2 mb-4">
                        <a href="/manage/category" class="no-decor btn btn-outline-secondary">Edit kategori</a>
                    </div>
                <?php } ?>
                <?php foreach ($data as $key => $val) { ?>
                    <label for="kategori<?= $key ?>" class="btn radio-category" id="labelKategori<?= $key ?>">
                        <?= $val['nama'] ?>
                        <input type="radio" class="kategori" id="kategori<?= $key ?>" name="kategori" value="<?= $val['id'] ?>" data-category="<?= $key ?>">
                    </label>
                <?php } ?>

            </div>

        </div>
    </form>
</div>


<?php ob_start("setScripts") ?>
<script type="text/javascript">
    $('#trumbowyg-text').trumbowyg()
    var temp = -1

    $('.kategori').change((e) => {
        if (temp > -1) $('#labelKategori' + temp).removeClass('radio-active')
        $('#labelKategori' + $($(e)[0].target).data('category')).addClass('radio-active')
        temp = $($(e)[0].target).data('category')
    })
</script>
<?php ob_end_flush(); ?>