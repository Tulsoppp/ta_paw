<!-- halaman untuk menampilkan siswa yang ditolak -->
<?php
// Mengecek apakah admin sudah login
require_once 'cekLoginAdmin.php';
// header dan navbar admin
require_once '../includes/header.php';
require_once '../includes/navbarAdmin.php';
// Koneksi ke databse
require_once '../database.php';
$daftar=gagal();
?>
<div class="pendaftar">
    <div>
        <h2>Siswa Ditolak</h2>
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
                <td><?=$row['NAMA_LENGKAP']?></td>
                <td><?=$row['NAMA_JURUSAN']?></td>
                <td><?=$row['NAMA_KEBUTUHAN']?></td>
                <td><?=$row['KET_STATUS']?></td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>
