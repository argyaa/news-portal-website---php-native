<?php
require_once("connection.php");
require_once("auth.php");
$db = dbConnect();

// function checkConnection()
// {
//     $db = dbConnect();
//     if ($db->connect_errno > 0)
//         echo "Gagal koneksi" . (DEVELOPMENT ? " " . $db->connect_error : "") . "<br>";
// }

$scripts;

function addUser($data)
{
    global $db;
    $nama = $data["nama"];
    $notelp = $data["notelp"];
    $username = $data["username"];
    $email = $data["email"];
    $password = $data["password"];
    $roles = $data["roles"];

    $sql = "INSERT INTO pengguna (nama, no_telp, username, password, email, roles)
            VALUES
            ('$nama','$notelp','$username','$password','$email','$roles')
    ";

    mysqli_query($db, $sql);
    return mysqli_affected_rows($db);
}

function updateUser($data)
{
    global $db;
    $id = $data["id"];
    $nama = $data["nama"];
    $notelp = $data["notelp"];
    $email = $data["email"];
    $roles = $data["roles"];

    $sql = "UPDATE pengguna
            SET  nama= '$nama', email = '$email', no_telp = '$notelp', roles = '$roles'
            WHERE id = '$id' ";

    mysqli_query($db, $sql);
    return mysqli_affected_rows($db);
}

function updateArticle($data)
{
    global $db;
    $id = $data['idartikel'];
    $judul = $data["judul"];
    $gambar = $data["gambar"];
    $konten = $data["konten"];
    $kategori = $data["kategori"];

    $sql = "UPDATE artikel  
            SET  judul= '$judul', gambar = '$gambar',tanggal = NOW(), konten = '$konten', kategori_id = '$kategori'
            WHERE id='$id'";
    mysqli_query($db, $sql);
    return mysqli_affected_rows($db);
}

function deleteUser($data)
{
    global $db;
    $id = $data["id"];
    $sql = "DELETE FROM pengguna WHERE id = $id";
    mysqli_query($db, $sql);
    return mysqli_affected_rows($db);
}

function addArticle($data, $id)
{
    global $db;
    $judul = $data["judul"];
    $gambar = $data["gambar"];
    $konten = $data["konten"];
    $kategori = $data["kategori"];

    $sql = "INSERT INTO artikel (pengguna_id, kategori_id, judul, konten, tanggal, gambar)
            VALUES
            ('$id','$kategori','$judul','$konten',NOW(),'$gambar')
    ";

    mysqli_query($db, $sql);
    return mysqli_affected_rows($db);
}

function deleteArticle($data)
{
    global $db;
    $id = $data["id"];
    $sql = "DELETE FROM artikel WHERE id = $id";
    mysqli_query($db, $sql);
    return mysqli_affected_rows($db);
}

function setScripts($buffer)
{
    global $scripts;
    $scripts = $buffer;
}

function getScripts()
{
    global $scripts;
    return $scripts;
}

function updateProfile($data)
{
    global $db;
    $id = $_SESSION['id'];
    $nama = $data["nama"];
    $notelp = $data["notelp"];
    $username = $data["username"];
    $email = $data["email"];
    $password = $data["password"];

    $sql = "UPDATE pengguna
            SET  nama= '$nama', email = '$email', no_telp = '$notelp',username = '$username', password = '$password'
            WHERE id = '$id' ";
    mysqli_query($db, $sql);
    return mysqli_affected_rows($db);
}

function addCategory($data)
{
    global $db;
    $nama = $data["kategori"];

    $sql = "INSERT INTO kategori (nama)
            VALUES ('$nama')";

    mysqli_query($db, $sql);
    return mysqli_affected_rows($db);
}

function deleteCategory($data)
{
    global $db;
    $id = $data["id"];
    $sql = "DELETE FROM kategori WHERE id='$id'";
    mysqli_query($db, $sql);
    return mysqli_affected_rows($db);
}

function updateCategory($data)
{
    global $db;
    $nama = $data["kategori"];
    $id = $data["id"];
    $sql = "UPDATE kategori SET nama= '$nama' WHERE id='$id'";
    mysqli_query($db, $sql);
    return mysqli_affected_rows($db);
}
