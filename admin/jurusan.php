<?php
    require_once '../database.php';
    require_once '../includes/header.php';
    require_once '../includes/navbarAdmin.php';
    $jurusan=jurusan();
?>
<div class="jurusan">
    <h1>Daftar Jurusan</h1>
    <table>
        <tr>
            <th>Nama Jurusan</th>
            <th>Kouta</th>
            <th>Aksi</th>
        </tr>
        <?php foreach($jurusan as $data):?>
        <tr>
            <td><?php echo $data['NAMA_JURUSAN']?></td>
            <td><?php echo $data['KUOTA_JURUSAN']?></td>
            <td>
                <a href="edit_jurusan.php?ID_JURUSAN=<?=$data['ID_JURUSAN']?>">
                    <button name="edit">
                        Edit
                    </button>
                </a>
                <a href="hapus_jurusan.php?ID_JURUSAN=<?=$data['ID_JURUSAN']?>">
                    <button name="hapus">
                        Hapus
                    </button>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="tambah_jurusan.php"><button>Tambah Jurusan</button></a>
</div>