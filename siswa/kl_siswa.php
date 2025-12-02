<?php
    require_once 'cekLoginSiswa.php';
    require_once '../database.php';
    require_once '../includes/header.php';
    require_once '../includes/navbarSiswa.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['keluar'])){
            session_destroy();
            header("Location:../index.php");
            exit();
        }else{
            header("Location:profil_siswa.php");
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