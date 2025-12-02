<?php
// Mengecek apakah admin sudah login
require_once 'cekLoginAdmin.php';
// Header dan navbar admin
require_once '../includes/header.php';
require_once '../includes/navbarAdmin.php';
require_once "../database.php";

if (isset($_GET["ID_JURUSAN"])) {
    $id=$_GET["ID_JURUSAN"];
        $stmnt=$pdo->prepare("SELECT NAMA_KEBUTUHAN DELETE FROM jurusan WHERE ID_JURUSAN=:id");
        $stmnt->bindValue(':id',$id);
        $stmnt->execute();
    header("Location:jurusan.php");
}
?>

// Ambil nama jurusan untuk ditampilkan
$stm = $pdo->prepare("SELECT NAMA_JURUSAN FROM jurusan WHERE ID_JURUSAN = :id");
$stm->execute([':id' => $id]);
$jurusan = $stm->fetchColumn();

// Jika tombol konfirmasi hapus ditekan
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $stmnt = $pdo->prepare("DELETE FROM jurusan WHERE ID_JURUSAN = :id");
    $stmnt->bindValue(':id', $id);
    $stmnt->execute();

    header("Location: jurusan.php");
    exit();
}
?>

<h2>Konfirmasi Hapus</h2>
<p>Apakah Anda yakin ingin menghapus jurusan <b><?= htmlspecialchars($jurusan) ?></b>?</p>

<form method="POST">
    <button type="submit" class="btn_kebutuhan btn-submit">Ya, Hapus</button>
    <a href="jurusan.php" class="btn_a">Tidak</a>
</form>