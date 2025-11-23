<?php
    require_once "../database.php";
    require_once "../includes/header.php";
    require_once "../includes/navbarAdmin.php";
    require_once "../validasi.php";

    $errors=[];
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $kode_jurusan = $_POST["kode_jurusan"]; 
        val_required($errors,"kode_j",$kode_jurusan,"Kode jurusan wajib diisi.");
        val_numeric($errors,"kode_j",$kode_jurusan,"Kode jurusan harus berupa angka.");

        $nama_jurusan = $_POST["nama_jurusan"];
        val_required($errors,"nama_j",$nama_jurusan,"Nama jurusan wajib diisi.");
        val_alpha($errors,"nama_j",$nama_jurusan,"Nama jurusan hanya boleh mengandung huruf dan spasi.");

        $kuota = $_POST["kuota"];
        val_required($errors,"kuota",$kuota,"Kuota wajib diisi.");
        val_numeric($errors,"kuota",$kuota,"Kuota harus berupa angka.");
        if(empty($errors)){
            $stmnt=$pdo->prepare("INSERT INTO jurusan (ID_JURUSAN,NAMA_JURUSAN,KUOTA_JURUSAN) VALUES (:KODE_JURUSAN,:NAMA_JURUSAN,:KUOTA_JURUSAN)");
            $stmnt->execute([
                ":KODE_JURUSAN"=> $_POST["kode_jurusan"],
                ":NAMA_JURUSAN"=> $_POST["nama_jurusan"],
                ":KUOTA_JURUSAN"=> $_POST['kuota']
            ]);
            header("Location:jurusan.php");
        }
    }
?>
<div class="tambah_jurusan">
    <div>
        <form method="POST">
        <h2>Tambah jurusan</h2>
        <table>
            <tr></tr>
                <td>
                    <label for="">Kode Jurusan :</label>
                    <input type="text" name="kode_jurusan" valuue="<?= htmlspecialchars($kode_jurusan ?? '') ?>">
                    <span class='error'><?= $errors['kode_j'] ?? "" ?></span>
                </td>
            <tr>
                <td>
                    <label for="">Nama Jurusan :</label>
                    <input type="text" name="nama_jurusan" value="<?= htmlspecialchars($nama_jurusan ?? '') ?>">
                    <span class='error'><?= $errors['nama_j'] ?? "" ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Kouta :</label>
                    <input type="text" name="kuota" value="<?= htmlspecialchars($kuota ?? '') ?>">
                    <span class='error'><?= $errors['kuota'] ?? "" ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit">Tambah</button>
                </td>
            </tr>
        </table>
        </form>
     </div>
</div>