<?php
    require_once "../database.php";
    require_once "../includes/header.php";
    require_once "../includes/navbarAdmin.php";


    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $stmnt=$pdo->prepare("INSERT INTO kebutuhan VALUES (NULL,:NAMA_KEBUTUHAN)");
        $stmnt->execute([
            ":NAMA_KEBUTUHAN"=> $_POST["nama_kebutuhan"]
        ]);
        header("Location:kebutuhan.php");
    }
?>
<div class="tambah_jurusan">
    <div>
        <form method="POST">
        <h2>Tambah jurusan</h2>
        <table>
            <tr>
                <td>
                    <label for="">Nama Kebutuhan :</label>
                    <input type="text" name="nama_kebutuhan">
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