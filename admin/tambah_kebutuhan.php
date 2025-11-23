<?php
    require_once "../database.php";
    require_once "../validasi.php";
    require_once "../includes/header.php";
    require_once "../includes/navbarAdmin.php";

    $errors=[];
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        val_required($errors,"kode_k",$_POST["kode_kebutuhan"],"Kode kebutuhan wajib diisi.");
        val_required($errors,"nama_k",$_POST["nama_kebutuhan"],"Nama kebutuhan wajib diisi.");
        if(empty($errors)){
            $stmnt=$pdo->prepare("INSERT INTO kebutuhan VALUES (:KODE_KEBUTUHAN,:NAMA_KEBUTUHAN)");
            $stmnt->execute([
                ":NAMA_KEBUTUHAN"=> $_POST["nama_kebutuhan"],
                ":KODE_KEBUTUHAN"=> $_POST["kode_kebutuhan"]
            ]);
            header("Location:kebutuhan.php");
        }
    }
?>
<div class="tambah_jurusan">
    <div>
        <form method="POST">
        <h2>Tambah jurusan</h2>
        <table>
            <tr>
                <td>
                    <label for="">Kode Kebutuhan :</label>
                    <input type="text" name="kode_kebutuhan" value="<?= htmlspecialchars($_POST["kode_kebutuhan"] ?? '') ?>">
                    <span><?= $errors["kode_k"] ?? ""; ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Nama Kebutuhan :</label>
                    <input type="text" name="nama_kebutuhan" value="<?= htmlspecialchars($_POST["nama_kebutuhan"] ?? '') ?>"> 
                    <span><?= $errors["nama_k"] ?? ""; ?></span>
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