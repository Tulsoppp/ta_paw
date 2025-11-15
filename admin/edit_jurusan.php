<?php
require_once '../database.php';
require_once '../includes/header.php';
require_once '../includes/navbarAdmin.php';
    $id=$_GET["ID_JURUSAN"];
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        $stmnt=$pdo->prepare("UPDATE jurusan SET KUOTA_JURUSAN = :KUOTA_JURUSAN WHERE ID_JURUSAN = :id");
        $stmnt->execute([
            ":KUOTA_JURUSAN"=>$_POST["KUOTA_JURUSAN"],
            ":id"=>$id
        ]);

        header("Location:jurusan.php");
    }
?>
<div>
    <form action="" method="POST">
        <fieldset>
            <legend>Edit Jurusan</legend>
            <label for="">Kuota :</label>
            <input type="text" name="KUOTA_JURUSAN">
            <button type="submit">Submit</button>
        </fieldset>
    </form>
</div>