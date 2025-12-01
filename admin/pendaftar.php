<!-- halaman untuk menampilkan pendaftar -->
<?php
// Mengecek apakah admin sudah login
require_once 'cekLoginAdmin.php';
// Header dan Navbar admin
require_once '../includes/header.php';
require_once '../includes/navbarAdmin.php';
// Koneksi ke database dan fungsi
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
                <th>Dokumen</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php foreach($daftar as $row): ?>
            <tr>
                <td><?=$row['TANGGAL_PENDAFTARAN']?></td>
                <td><?=$row['NAMA_LENGKAP']?></td>
                <td><?=$row['NAMA_JURUSAN']?></td>
                <td><?=$row['NAMA_KEBUTUHAN']?></td>
                <td>
                    <ul>
                        <li><a target="_blank" href="../kk/<?=$row['KARTU_KELUARGA'] ?>"><?=$row['KARTU_KELUARGA'] ?></a></li>
                        <li><a target="_blank" href="../akta/<?=$row['AKTA_KELAHIRAN'] ?>"><?=$row['AKTA_KELAHIRAN'] ?></a></li>
                        <li><a target="_blank" href="../ijazah/<?=$row['IJAZAH'] ?>"><?=$row['IJAZAH'] ?></a></li>
                        <li><a target="_blank" href="../foto_pas/<?=$row['FOTO_SISWA'] ?>"><?=$row['FOTO_SISWA'] ?></a></li>
                    </ul>
                </td>
                <td><?=$row['KET_STATUS']?></td>
                <td>
                    <a href="edit_status.php?ID_PENDAFTARAN=<?=$row['ID_PENDAFTARAN']?>&kondisi=lulus" class="btn_a">
                            Lolos
                    </a>
                    <a href="edit_status.php?ID_PENDAFTARAN=<?=$row['ID_PENDAFTARAN']?>&kondisi=gagal" class="btn_a hapus">
                            Tidak Lolos
                    </a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>