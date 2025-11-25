<!-- halaman untuk menambah jurusan baru -->
<?php
    require_once "../database.php";
    require_once "../includes/header.php";
    require_once "../includes/navbarAdmin.php";
    require_once "../validasi.php";

    $errors=[];
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $kode_jurusan = $_POST["kode_jurusan"]; 

        // validasi kode jurusan
        val_required($errors,"kode_j",$kode_jurusan,"Kode jurusan wajib diisi.");
        val_numeric($errors,"kode_j",$kode_jurusan,"Kode jurusan harus berupa angka.");
        // validasi nama jurusan
        $nama_jurusan = $_POST["nama_jurusan"];
        val_required($errors,"nama_j",$nama_jurusan,"Nama jurusan wajib diisi.");
        val_alphanumeric($errors,"nama_j",$nama_jurusan,"Nama jurusan harus berupa huruf dan angka.");
        // validasi kouta
        $kuota = $_POST["kuota"];
        val_required($errors,"kuota",$kuota,"Kuota wajib diisi.");
        val_numeric($errors,"kuota",$kuota,"Kuota harus berupa angka.");
        // jika tidak ada error, masukkan data ke database
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
                <td>
                    <a href="jurusan.php">Kembali</a>
                </td>
            </tr>
        </table>
        </form>
     </div>
</div>