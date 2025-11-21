<?php
require_once '../includes/header.php';
require_once '../includes/navbarAdmin.php';
require_once '../database.php';
$daftar=pendaftar();
?>
<div class="pendaftar">
    <div>
        <h2>Calon Siswa</h2>
        <table>
            <tr>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Jurusan</th>
                <th>Kebutuhan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php foreach($daftar as $row): ?>
            <tr>
                <td><?=$row['TANGGAL_PENDAFTARAN']?></td>
                <td><?=$row['NAMA_LENGKAP']?></td>
                <td><?=$row['NAMA_JURUSAN']?></td>
                <td><?=$row['NAMA_KEBUTUHAN']?></td>
                <td><?=$row['KET_STATUS']?></td>
                <td>
                    <a href="edit_status.php?ID_PENDAFTARAN=<?=$row['ID_PENDAFTARAN']?>&kondisi=lulus">
                        <button name="lulus">
                            Lulus
                        </button>
                    </a>
                    <a href="edit_status.php?ID_PENDAFTARAN=<?=$row['ID_PENDAFTARAN']?>&kondisi=gagal">
                        <button name="gagal">
                            Tidak Lulus
                        </button>
                    </a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>