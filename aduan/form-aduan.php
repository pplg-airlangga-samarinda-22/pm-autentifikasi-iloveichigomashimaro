<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Aduan</title>
</head>
<body>
    <h1>Tambah Aduan</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form=item">
            <label for="laporan">Isi Laporan</label>
            <textarea name="laporan" id="laporan"></textarea>
        </div>
        <div class="form-item">
            <label for="foto">Foto Pendukung</label>
            <input for="file" name="foto" id="foto">
        </div>
        <button type="submit">Kirim Laporan</button>
    </form>
</body>
</html>

<?php
    session_start();
    require "koneksi.php";

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        var_dump($_POST);
        $tanggal = data('Y-m-d');
        $nik = $_SESSION['nik'];
        $laporan = $_POST['laporan'];
        $foto = (isset($_FILES['foto']))?$_FILES['foto']['name']:"";
        $status = 0;

        $sql = "INSERT INTO pengaduan (tgl, pengaduan, nik, isi_laporan, foto, status) values(?, ?, ?, ?, ?)";
        $koneksi->execute_query($sql, [$tanggal, $nik, $laporan, $foto, $status]);

        if ($koneksi) {
            echo "<script>alert('Pengaduan baru telah berhasil disimpan!')</script>";
            header("location:aduan.php");
        }
    }
    
?>
