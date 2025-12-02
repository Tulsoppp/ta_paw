<?php
session_start();

// Jika user menekan tombol YA
if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {

    // Simpan role user sebelum session dihancurkan
    $role = $_SESSION['role'] ?? null;

    // Hapus session
    session_destroy();

    // Redirect sesuai role
    if ($role === 'siswa') {
        header("Location: siswa/profile.php");
        exit;
    } elseif ($role === 'admin') {
        header("Location: admin/index.php");
        exit;
    } else {
        header("Location: index.php");
        exit;
    }
}

// Jika user menekan tombol TIDAK
if (isset($_POST['confirm']) && $_POST['confirm'] === 'no') {

    if (isset($_SESSION['role']) && $_SESSION['role'] === 'siswa') {
        header("Location: siswa/profil_siswa.php");
        exit;
    } elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        header("Location: admin/index.php");
        exit;
    }

    header("Location:index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Konfirmasi Logout</title>
</head>
<body>

<h3>Apakah Anda yakin ingin logout?</h3>

<form method="post">
    <button type="submit" name="confirm" value="yes">Ya, Logout</button>
</form>

</body>
</html>
