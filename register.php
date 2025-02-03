<?php
require "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nik = $_POST['nik'];

    //cek dulu apakah nik telah terdaftar
    $sql = "SELECT * FROM masyarakat WHERE nik=?";
    $cek = $koneksi->execute_query($sql, [$nik]);

    if (mysqli_num_rows($cek) == 1) {
        echo "<script>alert('nNIK sudah digunakan!')</script>";
    } else {
        $nama = $_POST['nama'];
        $telepon = $_POST['telepon'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $sql = "INSERT INTO masyarakat SET nik=?, nama=?, telp=?, username=?, password=?";
        $koneksi->execute_query($sql, [$nik, $nama, $telepon, $username, $password]);
        echo "<script>alert('Pendaftaran Berhasil!')</script>";
        header("location:login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>
<body>
    <h1>Registrasi Pengguna Baru</h1>
    <form actiion="" method="post">
        <div class="form-item">
            <label for="nik">NIK</label>
            <input type="text" name="nik" id="nik">
        </div>
        <div class="form-item">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama">
        </div>
        <div class="form-item">
            <label for="telepon">Telepon</label>
            <input type="tel" name="telepon" id="telepon">
        </div>
        <div class="form-item">
            <label for="username">Username</label>
            <input type="text" name="username" id="Username">
        </div>
        <div class="form_item">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <button type="submit">Register</button>
    </form>
    <a href="login.php">Batal</a>
</body>
</html>