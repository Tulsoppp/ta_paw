<?php
    require_once 'cekLoginAdmin.php';
    require_once '../database.php';
    require_once '../includes/header.php';
    require_once '../includes/navbarAdmin.php';
    $kebutuhan=kebutuhan();
?>

<div class="kh_kebutuhan">
  <div>
    <th>
      <h1>Apakah Anda Yakin Untuk Menghapus Kebutuhan Siswa Ini?</h1>
    </th>
    <table>
      <tr>
        <?php foreach($kebutuhan as $data):?>
            <tr>  
                <td><?php echo $data['NAMA_KEBUTUHAN']?></td>
                <td class="khk_gap">
                    <a href="hapus_kebutuhan.php?ID_KEBUTUHAN=<?=$data['ID_KEBUTUHAN']?>" class="khk_hapus">
                        Hapus
                    </a>
                    <a href="kebutuhan.php?ID_KEBUTUHAN=<?=$data['ID_KEBUTUHAN']?>" class="khk_tidak">
                        Tidak
                    </a>
                </td>
            </tr>
          <?php endforeach; ?>
      </tr>
    </table>
  </div>
</div>