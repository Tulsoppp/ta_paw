<?php
require_once "../database.php";
// Mengecek apakah admin sudah login
require_once 'cekLoginAdmin.php';
// Header dan navbar admin
require_once '../includes/header.php';
require_once '../includes/navbarAdmin.php';
//Koneksi ke database dan fungsi

$id = $_GET["ID_KEBUTUHAN"] ?? null;

// Jika ID kosong → balik
if (!$id) {
    header("Location: kebutuhan.php");
    exit;
}

// Ambil nama kebutuhan untuk ditampilkan di konfirmasi
$stm = $pdo->prepare("SELECT NAMA_KEBUTUHAN FROM kebutuhan WHERE ID_KEBUTUHAN = :id");
$stm->execute([':id' => $id]);
$nama = $stm->fetchColumn();

// Jika admin menekan tombol "Ya, hapus"
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $stmnt = $pdo->prepare("DELETE FROM kebutuhan WHERE ID_KEBUTUHAN = :id");
    $stmnt->bindValue(':id', $id);
    $stmnt->execute();

    header("Location: kebutuhan.php");
    exit;
}
?>
<h2>Konfirmasi Hapus</h2>
<p>Apakah Anda yakin ingin menghapus kebutuhan <b><?= htmlspecialchars($nama) ?></b>?</p>

<form method="POST">
    <button type="submit" >Ya, Hapus</button>
    <a href="kebutuhan.php" class="btn_a">Tidak</a>
</form>
