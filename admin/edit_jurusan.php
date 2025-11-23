<?php
require_once '../database.php';
require_once '../includes/header.php';
require_once '../includes/navbarAdmin.php';
    $id=$_GET["ID_JURUSAN"];
    $kuota=$_GET["KUOTA_JURUSAN"];
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        edit_kuota($id);
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
                    <a href="jurusan.php"><button>kembali</button></a>
                </td>
            </tr>
        </table>
        </form>
     </div>
</div>