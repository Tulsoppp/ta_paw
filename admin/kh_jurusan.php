<?php
    require_once 'cekLoginAdmin.php';
    require_once '../database.php';
    require_once '../includes/header.php';
    require_once '../includes/navbarAdmin.php';
    $jurusan=jurusan();
?>

<div class="kh_kebutuhan">
  <div>
    <th>
      <h1>Apakah Anda Yakin Untuk Menghapus Jurusan Ini?</h1>
    </th>
    <table>
      <tr>
        <?php foreach($jurusan as $data):?>
            <tr>  
                <td><?php echo $data['NAMA_JURUSAN']?></td>
                <td class="khk_gap">
                    <a href="hapus_jurusan.php?D_JURUSAN=<?=$data['ID_JURUSAN']?>" class="khk_hapus">
                        Hapus
                    </a>
                    <a href="jurusan.php?D_JURUSAN=<?=$data['ID_JURUSAN']?>" class="khk_tidak">
                        Tidak
                    </a>
                </td>
            </tr>
          <?php endforeach; ?>
      </tr>
    </table>
  </div>
</div>