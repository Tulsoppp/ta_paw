<!-- halaman untuk edit jurusan -->
<?php
require_once '../database.php';
require_once '../includes/header.php';
require_once '../includes/navbarAdmin.php';

    $id=$_GET["ID_JURUSAN"]; //mengambil id jurusan dari url
    $kuota=$_GET["KUOTA_JURUSAN"]; //mengambil kuota jurusan dari url
    $errors=[];
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        val_required($errors,"kuota",$_POST["KUOTA_JURUSAN"],"Kuota wajib diisi."); //validasi kuota
        val_numeric($errors,"kuota",$_POST["KUOTA_JURUSAN"],"Kuota harus berupa angka."); //validasi kuota
        if(empty($errors)){
            edit_kuota($id);
            header("Location:jurusan.php");
        }
    }
?>
<div class="edit_kouta">
    <div>
        <form method="POST">
        <h2>Edit Kuota</h2>
        <table>
            <tr>
                <td>
                    <label for="">Kuota :</label>
                    <input type="text" name="KUOTA_JURUSAN" value="<?= htmlspecialchars($kuota ?? '') ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit">Edit</button>
                </td>
                <td>
                    <a href="jurusan.php">kembali</a>
                </td>
            </tr>
        </table>
        </form>
     </div>
</div>