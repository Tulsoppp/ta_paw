<!-- halaman untuk menampilkan daftar jurusan -->
<?php
// Mengecek apakah admin sudah login
    require_once 'cekLoginAdmin.php';
// Koneksi ke database dan fungsi
    require_once '../database.php';
// Header dan navbar admin
    require_once '../includes/header.php';
    require_once '../includes/navbarAdmin.php';
    $jurusan=jurusan();
?>
<!--  -->
<div class="jurusan">
    <div>
    <h1>Daftar Jurusan</h1>
    <table>
        <tr>
            <th>Kode</th>
            <th>Nama Jurusan</th>
            <th>Kouta</th>
            <th>Aksi</th>
        </tr>
        <?php foreach($jurusan as $data):?>
        <tr>
            <td><?= $data['ID_JURUSAN'] ?></td>
            <td><?= $data['NAMA_JURUSAN'] ?></td>
            <td><?= $data['KUOTA_JURUSAN'] ?></td>
            <td>
                <a href="edit_jurusan.php?ID_JURUSAN=<?=$data['ID_JURUSAN']?>&KUOTA_JURUSAN=<?=$data['KUOTA_JURUSAN']?>" class="btn_a">
                    Edit
                </a>
                <a href="kh_jurusan.php?ID_JURUSAN=<?=$data['ID_JURUSAN']?>" class="btn_a hapus">
                    Hapus
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="tambah_jurusan.php" class="btn_a">Tambah Jurusan</a>
    </div>
</div>