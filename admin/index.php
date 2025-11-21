<?php
// require_once '../cekLogin.inc';
session_start();
if(!isset($_SESSION['isAdmin'])){
    require_once '../cekLogin.inc';
    exit();
}
require_once '../includes/header.php';
require_once '../includes/navbarAdmin.php';
require_once '../database.php';
$daftar=pendaftar();
$lolos=lulus();
$gagal=gagal();
$pendaftar=siswa_daftar();
$jurusan=jurusan();
?>
<div class="container_admin">
    <h1>Informasi Siswa</h1>
    <div class="dashboard_admin">
        <div>
            <h3>Jumlah Pendaftar</h3><hr>
            <h4><?= count($pendaftar) ?></h4>
        </div>    
        <div>
            <h3>Jumlah Diterima</h3><hr>
            <h4><?= count($lolos) ?></h4>
        </div>
        <div>
            <h3>Jumlah Ditolak</h3><hr>
            <h4><?=count($gagal)?></h4>
        </div>
    </div>
    <h1>Jurusan</h1>
    <div class="admin_jurusan">
        <?php foreach($jurusan as $data): ?>
        <div>
            <h3><?=$data['NAMA_JURUSAN']?></h3><hr>

            <h4><?= count(siswa_jurusan($data['NAMA_JURUSAN'])) ?> Siswa</h4>
        </div>
        <?php endforeach; ?>
    </div>
</div>
