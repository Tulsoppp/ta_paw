<?php
// Mengecek apakah admin sudah login
require_once 'cekLoginAdmin.php';
// Koneksi database dan fungsi validasi
require_once '../database.php';
require_once '../validasi.php';

$id = $_GET["ID_JURUSAN"] ?? null;
$kuota = $_GET["KUOTA_JURUSAN"] ?? null;
$jurusan = $_GET["NAMA_JURUSAN"] ?? null;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $kuotaBaru = $_POST["KUOTA_JURUSAN"];
    $namaBaru = $_POST["NAMA_JURUSAN"];

    val_required($errors, "kuota", $kuotaBaru, "Kuota wajib diisi.");
    val_numeric($errors, "kuota", $kuotaBaru, "Kuota harus berupa angka.");

    val_required($errors, "kuota", $namaBaru, "Nama Jurusan wajib diisi.");

    if (empty($errors)) {

        edit_kuota($id, $kuotaBaru);
        edit_namaJurusan($id,$namaBaru);
        exit();
    }
}

require_once '../includes/header.php';
require_once '../includes/navbarAdmin.php';
?>

<div class="edit_kouta">
    <div>
        <form method="POST">
            <h2>Edit Kuota</h2>

             <div class="form-group">
                <label for="nama_jurusan">Jurusan :</label>
                <input type="text" id="nama_jurusan" name="NAMA_JURUSAN" value="<?= htmlspecialchars($jurusan ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="kuota_jurusan">Kuota :</label>
                <input type="text" id="kuota_jurusan" name="KUOTA_JURUSAN" value="<?= htmlspecialchars($kuota ?? '') ?>">
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-submit">Edit</button>
                <a href="jurusan.php" class="btn-back">Kembali</a>
            </div>
        </form>
    </div>
</div>