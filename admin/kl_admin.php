<?php
    require_once 'cekLoginAdmin.php';
    require_once '../database.php';
    require_once '../includes/header.php';
    require_once '../includes/navbarAdmin.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['keluar'])){
            session_destroy();
            header("Location:../index.php");
            exit();
        }else{
            header("Location:index.php");
            exit();
        }
    }
?>
<form method="post">
    <div>
        <button type="submit" name="keluar">Ya, Logout</button>
        <button type="submit" name="kembali"> batal </button>
    </div>
</form>