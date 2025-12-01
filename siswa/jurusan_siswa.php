<?php
// Mengecek apakah siswa sudah login 
    require_once 'cekLoginSiswa.php';
// Koneksi database dan fungsi
    require_once '../database.php';
// Header & navbar siswa
    require_once '../includes/header.php';
    require_once '../includes/navbarSiswa.php';
    $jurusan=jurusan();
?>
<div class="jurusan_siswa">
    <h1>Daftar Jurusan SMA Bakti Wiyata</h1>
    <table>
        <tr>
            <th>Nomor</th>
            <th>Nama Jurusan</th>
            <th>Kouta</th>
        </tr>
        <?php $no=1;foreach($jurusan as $data):?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $data['NAMA_JURUSAN'] ?></td>
            <td><?= $data['KUOTA_JURUSAN'] ?></td>
        </tr>
        <?php 
        $no+=1;
        endforeach; ?>
    </table>
</div>