<?php
require_once '../database.php';
require_once '../includes/header.php';
require_once '../includes/navbarAdmin.php';
    $id=$_GET["ID_JURUSAN"];
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        edit_kuota($id);
    }
?>
<div class="edit_kouta">
    <div>
        <h2>Edit Kuota</h2>
        <table>
            <tr>
                <td>
                    <label for="">Kuota :</label>
                    <input type="text" name="KUOTA_JURUSAN">
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit">Edit</button>
                </td>
            </tr>
        </table>
     </div>
</div>