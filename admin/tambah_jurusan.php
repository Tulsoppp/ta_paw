<?php
    require_once "../database.php";
    require_once "../includes/header.php";
    require_once "../includes/navbarAdmin.php";


    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $stmnt=$pdo->prepare("INSERT INTO jurusan (NAMA_JURUSAN,KUOTA_JURUSAN) VALUES (:NAMA_JURUSAN,:KUOTA_JURUSAN)");
        $stmnt->execute([
            ":NAMA_JURUSAN"=> $_POST["nama_jurusan"],
            ":KUOTA_JURUSAN"=> $_POST['kuota']
        ]);
        header("Location:jurusan.php");
    }
?>
<div class="tambah_jurusan">
    <div>
        <h2>Tambah jurusan</h2>
        <table>
            <tr>
                <td>
                    <label for="">Nama Jurusan :</label>
                    <input type="text" name="nama_jurusan">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Kouta :</label>
                    <input type="text" name="kuota">
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit">Tambah</button>
                </td>
            </tr>
        </table>
     </div>
</div>