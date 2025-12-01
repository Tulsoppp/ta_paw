<?php
session_start();

// Jika user sudah menekan tombol "YA"
if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
    session_destroy();
    header("Location: ../ta_paw");
    exit;
}

// Jika user menekan tombol "TIDAK"
if (isset($_POST['confirm']) && $_POST['confirm'] === 'no') {
    header("Location: index.php");
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
    <button type="submit" name="confirm" value="no">Batal</button>
</form>

</body>
</html>
