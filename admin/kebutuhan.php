<?php
    require_once '../database.php';
    require_once '../includes/header.php';
    require_once '../includes/navbarAdmin.php';
    $kebutuhan=kebutuhan();
?>
<div class="jurusan">
    <h1>Daftar Jurusan</h1>
    <table>
        <tr>
            <th>No</th>
            <th>Kebutuhan</th>
            <th>Aksi</th>
        </tr>
        <?php foreach($kebutuhan as $data):?>
        <tr>
            <td><?php echo $data['ID_KEBUTUHAN']?></td>
            <td><?php echo $data['NAMA_KEBUTUHAN']?></td>
            <td>
                <a href="hapus_kebutuhan.php?ID_KEBUTUHAN=<?=$data['ID_KEBUTUHAN']?>">
                    <button name="hapus">
                        Hapus
                    </button>
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="tambah_kebutuhan.php"><button>Tambah Kebutuhan</button></a>
</div>