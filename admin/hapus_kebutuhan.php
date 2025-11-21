<?php
require_once "../database.php";
    $id=$_GET["ID_KEBUTUHAN"];
        $stmnt=$pdo->prepare("DELETE FROM jurusan WHERE ID_KEBUTUHAN=:id");
        $stmnt->bindValue(':id',$id);
        $stmnt->execute();
    header("Location:kebutuhan.php");