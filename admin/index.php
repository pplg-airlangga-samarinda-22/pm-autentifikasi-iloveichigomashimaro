<html lang="en">
<head>
    <title>Admin Pengaduan</title>
</head>
<body>
    <h1>Selamat Datang di Sistem Pengaduan Masyarakat</h1>
    <nav>
        <a href="index.php">Dashboard</a>
        <a href="pengaduan.php">Pengaduan</a>
        <a href="masyarakat.php">Masyarakat</a>
        <a href="petugas.php">Petugas</a>
        <a href="laporan.php">Laporan</a>
        <a href="Logout.php">Logout</a>
    </nav>
</body>
</html>

<?php
session_start();
require "koneksi.php";
if (empty($_SESSION['level'])) {
    header("location:login.php");
}
?>