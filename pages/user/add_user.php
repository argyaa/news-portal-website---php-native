<?php
include_once("service/functions.php");
if (isset($_POST["submit"])) {

    if (addUser($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan');
            </script>
        ";
        header("Location: /manage/users");
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan');
            </script>
        ";
        header("Location: /manage/users");
        echo mysqli_error($db);
    }
}
?>

<div class="container mb-5 pt-5">
    <div class="row">
        <div class="col-4 container mt-lg-5">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="inputnama">Nama</label>
                    <input type="text" name="nama" class="form-control" id="inputnama" required autocomplete="FALSE">
                </div>
                <div class="form-group">
                    <label for="inputno">No Telp</label>
                    <input type="text" name="notelp" class="form-control" id="inputno" required autocomplete="FALSE">
                </div>
                <div class="form-group">
                    <label for="inputusername">Username</label>
                    <input type="text" name="username" class="form-control" id="inputusername" required autocomplete="FALSE">
                </div>
                <div class="form-group">
                    <label for="inputemail">Email</label>
                    <input type="email" name="email" class="form-control" id="inputemail" required autocomplete="FALSE">
                </div>
                <div class="form-group">
                    <label for="inputpass">Password</label>
                    <input type="password" name="password" class="form-control" id="inputpass" required autocomplete="FALSE">
                </div>
                <div class="form-group">
                    <label for="inputroles">Roles</label>
                    <select id="inputroles" name="roles" class="form-control" required autocomplete="FALSE">
                        <option value="admin">admin</option>
                        <option value="editor">editor</option>
                    </select>
                </div>
                <a href="/manage/users" class="btn btn-outline-secondary mr-2">Batalkan</a>
                <button type="submit" name="submit" class="btn btn-primary aksen">Daftar</button>
            </form>
        </div>
    </div>
</div>