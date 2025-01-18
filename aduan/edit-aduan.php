<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Aduan</title>
</head>
<body>
    <h1>Edit Aduan</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-item">
            <label for="laporan">Isi Laporan</label>
            <textarea name="laporan" id="laporan"><?= htmlspecialchars($row["isi_laporan"]) ?></textarea>
        </div>
        <div class="form-item">
            <label for="foto">Foto Pendukung</label>
            <img src="gambar/<?= htmlspecialchars($row["foto"]) ?>" alt=""><br>
            <input type="file" name="foto" id="foto"><br><br>
        </div>
        <button type="submit">Kirim Laporan</button>
        <a href="aduan.php">Batal</a>
    </form>
</body>
</html>

<?php
session_start();
require "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (isset($_GET["id"])) {
        $id_pengaduan = $_GET["id"];

        $sql = "SELECT * FROM pengaduan WHERE id_pengaduan=?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("i", $id_pengaduan);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_GET["id"])) {
        $id_pengaduan = $_GET["id"];
        $laporan = $_POST["laporan"];
        $foto = "";

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $foto = $_FILES['foto']['name'];
            $target_dir = "gambar/";
            $target_file = $target_dir . basename($foto);
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            } else {
                echo "<script>alert('File upload failed.')</script>";
                exit;
            }
        }

        $tanggal = date('Y-m-d');
        
        $sql = "UPDATE pengaduan SET tgl_pengaduan=?, isi_laporan=?, foto=? WHERE id_pengaduan=?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("sssi", $tanggal, $laporan, $foto, $id_pengaduan);
        
        if ($stmt->execute()) {
            echo "<script>alert('Pengaduan berhasil diperbarui!'); window.location.href = 'aduan.php';</script>";
        } else {
            echo "<script>alert('Pengaduan gagal diperbarui.');</script>";
        }
    }
}
?>
