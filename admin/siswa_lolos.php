<?php
require_once '../includes/header.php';
require_once '../includes/navbarAdmin.php';
require_once '../database.php';
$daftar=lulus();
?>
<div class="pendaftar">
    <div>
        <h2>Siswa Diterima</h2>
        <table>
            <tr>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Kebutuhan</th>
                <th>Status</th>
            </tr>
            <?php 
            foreach($daftar as $row): 
            ?>
            <tr>
                <td><?=$row['NAMA_AKUN_SISWA']?></td>
                <td><?=$row['NAMA_JURUSAN']?></td>
                <td><?=$row['NAMA_KEBUTUHAN']?></td>
                <td><?=$row['JENIS_STATUS_SISWA']?></td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>