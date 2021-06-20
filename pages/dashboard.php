<?php require_once("service/connection.php");
$db = dbConnect();
$sql = "SELECT * FROM pengguna";
$res = $db->query($sql);
$data = $res->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>No Telp </th>
            <th>Username</th>
            <th>Email</th>
            <th>Roles</th>
            <th colspan="2">action</th>
        </tr>
        <?php foreach ($data as $val) { ?>
            <tr>
                <td><?= $val["id"] ?></td>
                <td><?= $val["nama"]; ?></td>
                <td><?= $val["no_telp"]; ?></td>
                <td><?= $val["username"]; ?></td>
                <td><?= $val["email"]; ?></td>
                <td><?= $val["roles"]; ?></td>
                <td>
                    <a href="ubah.php?id=<?= $val['IdPegawai'] ?>"><button>Ubah</button></a>

                </td>
                <td>
                    <form action="hapus.php" method="POST">
                        <input type="hidden" value="<?= $val['IdPegawai'] ?>" name="idPegawai">
                        <button type="submit" name="delete">Hapus</button>
                    </form>
                </td>
            <tr>
            <?php } ?>

    </table>

</body>

</html>