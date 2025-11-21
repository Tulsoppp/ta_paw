<?php
    require_once "../database.php";
    $id=$_GET["ID_PENDAFTARAN"];
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        if ($_GET["kondisi"]=="lulus") {
            $stmnt=$pdo->prepare("UPDATE pendaftaran SET ID_STATUS='2' WHERE ID_PENDAFTARAN=:ID_PENDAFTARAN");
            $stmnt->execute([
                ":ID_PENDAFTARAN"=>$id
            ]);
        }
        elseif ($_GET["kondisi"]=="gagal") {
            $stmnt=$pdo->prepare("UPDATE pendaftaran SET ID_STATUS='3' WHERE ID_PENDAFTARAN=:ID_PENDAFTARAN");
            $stmnt->execute([
                ":ID_PENDAFTARAN"=>$id
            ]);;
        }
        else{
            echo "gagaal";
        }
    }
    header("Location:pendaftar.php");