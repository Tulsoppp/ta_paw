<!-- halaman untuk menampilkan daftar kebutuhan -->
<?php
    require_once 'cekLoginAdmin.php';
    require_once '../database.php';
    require_once '../includes/header.php';
    require_once '../includes/navbarAdmin.php';
    $kebutuhan=kebutuhan();
?>
<div class="kebutuhan">
    <div>
    <h1>Daftar Kebutuhan</h1>
    <table>
        <tr>
            <th>Kode</th>
            <th>Kebutuhan</th>
            <th>Aksi</th>
        </tr>
        <?php foreach($kebutuhan as $data):?>
        <tr>
            <td><?php echo $data['ID_KEBUTUHAN']?></td>
            <td><?php echo $data['NAMA_KEBUTUHAN']?></td>
            <td>
                <a href="kh_kebutuhan.php?ID_KEBUTUHAN=<?=$data['ID_KEBUTUHAN']?>" class="btn_a hapus">
                    Hapus
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="tambah_kebutuhan.php" class="btn_a">Tambah Kebutuhan</a>
    </div>
</div>