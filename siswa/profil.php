<?php
session_start();
require_once "../includes/header.php";
require_once "../includes/navbarSiswa.php";
require_once "../database.php";

$profil_S = profil($_SESSION['ID_USER']);
?>

<div class="profil_S">
    <div>
        <h2>My Profil</h2>
        <label for="nama_profil">Nama :</label>
        <?= 
            $profil_S["NAMA_AKUN_SISWA"];
        ?>
        <label for="nama_profil">Password :</label>
        <?= 
            $profil_S["PASSWORD_AKUN_SISWA"];
        ?>
        <label for="nama_profil">Email :</label>
        <?= 
            $profil_S["EMAIL_AKUN_SISWA"];
        ?>
    </div>
</div>