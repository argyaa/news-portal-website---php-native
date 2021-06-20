<?php require_once("service/functions.php");
$db = dbConnect();
$id = $_SESSION['id'];
$sql = "SELECT * FROM pengguna WHERE id='$id'";
$res = $db->query($sql);
$data = $res->fetch_assoc();

if (isset($_POST["update"])) {
    if (updateProfile($_POST) > 0) {
        echo "
            <script>
                alert('data berhasil ditambahkan');
            </script>
        ";
        endSession();
        header("Location: /login");
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan');
            </script>
        ";
        endSession();
        header("Location: /login");
    }
}
if ($data) {
?>
    <div class="container mb-5 mt-5 pt-5">
        <div class="row">
            <div class="col-4 container mt-lg-5 container-login">
                <form action="" method="POST" class="">
                    <div class="form-group mt-3">
                        <label for="inputnama">Nama</label>
                        <input type="text" name="nama" onfocus="showBtn()" class="form-control" id="inputnama" value="<?php echo $data['nama']; ?>" required autocomplete="FALSE">
                    </div>
                    <div class="form-group">
                        <label for="inputno">No Telp</label>
                        <input type="text" name="notelp" onfocus="showBtn()" class="form-control" id="inputno" value="<?php echo $data['no_telp']; ?>" required autocomplete="FALSE">
                    </div>
                    <div class="form-group">
                        <label for="inputusername">Username</label>
                        <input type="text" name="username" onfocus="showBtn()" class="form-control" id="inputusername" value="<?php echo $data['username']; ?>" required autocomplete="FALSE">
                    </div>
                    <div class="form-group">
                        <label for="inputemail">Email</label>
                        <input type="email" name="email" onfocus="showBtn()" class="form-control" id="inputemail" value="<?php echo $data['email']; ?>" required autocomplete="FALSE">
                    </div>
                    <div class="form-group">
                        <label for="inputpass">Password</label>
                        <input type="password" name="password" onfocus="showBtn()" class="form-control" id="inputpass" value="<?php echo $data['password']; ?>" required autocomplete="FALSE">
                    </div>
                    <div class="aksi-profile mb-3" id="aksi">
                        <a href="/" class="btn btn-outline-secondary mr-2">Batalkan</a>
                        <button type="submit" name="update" class="btn btn-primary aksen">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php }
ob_start("setScripts") ?>
<script type="text/javascript">
    function showBtn() {
        var aksi = document.getElementById("aksi");
        aksi.style.setProperty("display", "block", "important");
    }
</script>
<?php ob_end_flush(); ?>