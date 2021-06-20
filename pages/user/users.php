<?php
require_once("service/functions.php");
$db = dbConnect();
if (isset($_POST["search"])) {
    $keyword = $_POST["keyword"];
    $sql = "SELECT * FROM pengguna 
            where 
            nama like '%$keyword' or
            username like '%$keyword' or
            roles like '%$keyword'
            ";
} else {
    $sql = "SELECT * FROM pengguna";
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
<title>Manage User</title>
<div class="container mt-5">
    <div class="row">

        <div class="container mt-5">
            <div class="d-flex flex-row mb-3 justify-content-between">
                <form action="" method="POST" class="form-inline my-lg-0">
                    <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" name="search" type="submit">Cari User</button>
                </form>
                <a class="btn btn-tambah" href="/manage/add-user">
                    Tambahkan user baru
                </a>
            </div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">No Telp</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $val) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $val["nama"]; ?></td>
                            <td><?= $val["no_telp"]; ?></td>
                            <td><?= $val["username"]; ?></td>
                            <td><?= $val["email"]; ?></td>
                            <td><?= $val["roles"]; ?></td>
                            <td>
                                <div class="d-flex">
                                    <form action="/manage/edit-user" method="POST">
                                        <input type="hidden" value="<?= $val['id'] ?>" name="id">
                                        <button type="submit" name="edit" class="mr-2 btn btn-outline-secondary">Ubah</button>
                                    </form>

                                    <button type="button" class="btn btn-outline-secondary ml-2 mr-2" onclick="setDeleteModal(<?= $val['id'] ?>)" data-toggle="modal" data-target="#deleteModal">Hapus</button>

                                </div>
                            </td>

                        <tr>
                        <?php } ?>
                </tbody>
            </table>
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
                            Yakin mau hapus user ini?
                        </div>
                        <form action="/manage/del-user" method="POST" id="form_submit">
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
    </div>
</div>


<?php ob_start('setScripts') ?>
<script type="text/javascript">
    function setDeleteModal(id) {
        $('#modalID').val(id)
    }
</script>
<?php ob_end_flush(); ?>