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
<div class="kl_S">
    <div>
        <h2>Apakah Anda Yakin Mau Keluar Dari Akun Ini</h2>
        <div class="kl_gap">
            <a href="../index.php" class="ya_kl_s" name="keluar">Ya Laogut</a>
            <a href="profil_siswa.php" class="tdk_kl_s" name="tidak">Tidak</a>
        </div>
    </div>
</div>