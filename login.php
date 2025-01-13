<?php
require "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik = $_POST['nik'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //fungsi execute_query hanya bisa digunakan pada PHP 8.2
    $sql = "SELECT * FROM masyarakat WHERE nik-? AND username=? AND password";
    $row = $koneksi ->execute_query($sql, [$nik, $username, $password]);

    if (mysqli_num_rows($row) == 1) {
        session_start();
        $_SESSION['nik'] = $nik;
        header("location:index.php");
    } else {
        echo "<script>alert('Gagal Login!')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="" method="post" class="form-login">
        <p>Silahkan Login</p>
        <div class="form-item">
            <label for = "nik">NIK</label>
            <input type="text" name="nik" id="nik" required></input>
        </div>
        <div class="form.item">
            <label for="password">Password</label>
            <input type="password" name="paswword" id="password" required>
        </div>
        <button type="submit">Login</button>
        <a href="register.php">register</a>
    </form>
</body>

</html>