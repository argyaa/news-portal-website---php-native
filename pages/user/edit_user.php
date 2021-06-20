<?php
require_once("service/connection.php");
$db = dbConnect();

if (isset($_POST["update"])) {
    if (updateUser($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil diubah');
            </script>
        ";
        header("Location: /manage/users");
    } else {
        echo "
            <script>
                alert('GAGAL NJIR');
            </script>
        ";
        echo mysqli_error($db);
        header("Location: /manage/users");
    }
}


if (isset($_POST["edit"])) {
    $id = $_POST["id"];
    $sql = "SELECT id, nama, no_telp, username, email, roles FROM pengguna WHERE id = '$id'";
    $res = $db->query($sql);
    $data = $res->fetch_assoc();
    if ($data) {

?>

        <div class="container mb-lg-5 mt-5">
            <div class="row">
                <div class="col-4 container mt-lg-5">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="inputnama">Nama</label>
                            <input type="text" name="nama" class="form-control" id="inputnama" required autocomplete="FALSE" value="<?php echo $data['nama']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="inputno">No Telp</label>
                            <input type="text" name="notelp" class="form-control" id="inputno" required autocomplete="FALSE" value="<?php echo $data['no_telp']; ?>">
                        </div>
                        <div class=" form-group">
                            <label for="inputemail">Email</label>
                            <input type="email" name="email" class="form-control" id="inputemail" required autocomplete="FALSE" value="<?php echo $data['email']; ?>">
                        </div>
                        <div class=" form-group">
                            <label for="inputroles">Roles</label>
                            <select id="inputroles" name="roles" class="form-control" required autocomplete="FALSE">
                                <?php
                                echo "<option value=\"admin\" ";
                                if ($data["roles"] == "admin")
                                    echo " selected";
                                echo ">admin </option>";
                                echo "<option value=\"editor\" ";
                                if ($data["roles"] == "editor")
                                    echo " selected";
                                echo ">editor </option>";
                                ?> </select>
                        </div>
                        <input type="hidden" value="<?php echo $data['id'] ?>" name="id">
                        <a href="/manage/users" class="btn btn-outline-secondary mr-2">Batalkan</a>
                        <button type="submit" name="update" class="btn btn-primary aksen">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
<?php
    }
}
?>