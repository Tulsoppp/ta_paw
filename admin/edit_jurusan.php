<?php
require_once '../database.php';
require_once '../validasi.php';

$id = $_GET["ID_JURUSAN"] ?? null;
$kuota = $_GET["KUOTA_JURUSAN"] ?? null;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $kuotaBaru = $_POST["KUOTA_JURUSAN"];

    val_required($errors, "kuota", $kuotaBaru, "Kuota wajib diisi.");
    val_numeric($errors, "kuota", $kuotaBaru, "Kuota harus berupa angka.");

    if (empty($errors)) {

        edit_kuota($id, $kuotaBaru);
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