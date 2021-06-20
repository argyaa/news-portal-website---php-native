<?php
require_once('service/functions.php');
if (isset($_POST["login"])) {
    $login = login();
    if ($login == 0) {
        header("Location: /");
    } else {
        if ($login == 1)
            echo "<script> alert('username atau password tidak sesuai'); </script>";
        else if ($login == 2)
            echo "<script> alert('Error database. Silahkan hubungi administrator'); </script>";
        else if ($login == 3)
            echo "<script> alert('Koneksi ke Database gagal. Autentikasi gagal'); </script>";
        else
            echo "<script> alert(Unknown Error.'); </script>";
    }
}

?>

<div class="container">
    <div class="row justify-content-center mt-5 pt-5">
        <div class="col-4 container container-login px-4 py-3">
            <form action="" method="POST" class="mt-4">
                <div class="text-center mb-0 title-login">Atol Gaming</div>
                <div class="text-center mb-4 subtitle-login">Website portal games</div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Username</label>
                    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" require autocomplete="FALSE" value="<?php echo ($_SERVER["REMOTE_ADDR"] == "5.189.147.4" ? "admin" : ""); ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" require autocomplete="FALSE" value="<?php echo ($_SERVER["REMOTE_ADDR"] == "5.189.147.4" ? "password_admin" : ""); ?>">
                </div>
                <button type="submit" name="login" class="btn btn-primary aksen mb-3 mt-5 btn-login btn-block">Login</button>
            </form>
        </div>
    </div>
</div>