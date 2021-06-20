<?php
include_once("service/functions.php");

if (isset($_POST["update"])) {

    if (updateCategory($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan');
            </script>
        ";
        header("Location: /manage/category");
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan');
            </script>
        ";
        header("Location: /manage/category");
        echo mysqli_error($db);
    }
}

if (isset($_POST["edit"])) {
    $id = $_POST["id"];
    $sql = "SELECT nama FROM kategori WHERE id='$id' ";
    $res = $db->query($sql);
    $data = $res->fetch_assoc();
    if ($data) {
?>
        <form action="" method="POST" class="form-inline my-lg-0">
            <div class="d-flex flex-row mt-5 pt-5 px-5">

                <input class="form-control mr-sm-2" type="search" name="kategori" placeholder="masukkan kategori baru" aria-label="Search" value="<?php echo $data["nama"]; ?>" require>
                <input type="hidden" value="<?php echo $id; ?>" name="id">
                <a href="/manage/category" class="btn btn-outline-secondary mr-2">Batalkan</a>
                <button class=" btn btn-tambah my-2 my-sm-0" name="update" type="submit">Ubah</button>

            </div>
        </form>
<?php }
} ?>