<?php
    require_once 'cekLoginAdmin.php';
    require_once '../database.php';
    require_once '../includes/header.php';
    require_once '../includes/navbarAdmin.php';
    $id_kebutuhan=$_GET['ID_KEBUTUHAN'];
    $stmnt=$pdo->prepare("SELECT NAMA_KEBUTUHAN FROM kebutuhan WHERE ID_KEBUTUHAN = :ID_KEBUTUHAN");
    $stmnt->execute([
      ':ID_KEBUTUHAN'=>$id_kebutuhan
    ]);
    $kebutuhan=$stmnt->fetch();

    // pengecekan jika ada siswa yang terdaftar yang memliki kebutuhan maka kebutuhan tidak bisa di hapus

    $stmnt2=$pdo->prepare
    ("SELECT P.ID_PENDAFTARAN FROM kebutuhan_pendaftaran KP,pendaftaran P WHERE KP.ID_PENDAFTARAN = P.ID_PENDAFTARAN AND ID_KEBUTUHAN = :ID_KEBUTUHAN");
    $stmnt2->execute([
      ':ID_KEBUTUHAN'=>$id_kebutuhan
    ]);
    $jumlah=$stmnt2->rowCount();
    if ($jumlah > 0):
?>
<div class="kh_kebutuhan">
  <div>
    <th>
      <h1>Ada Siswa yang memiliki kebutuhan ini ?</h1>
    </th>
    <table>
      <tr>
          <td class="khk_gap">
            <a href="kebutuhan.php" class="khk_tidak">
              Kembali
            </a>
          </td>
      </tr>
    </table>
  </div>
</div>

<?php else: ?>

<div class="kh_kebutuhan">
  <div>
    <th>
      <h1>Apakah Anda Yakin Untuk Menghapus Kebutuhan Ini?</h1>
    </th>
    <table>
      <tr>
          <td><?= $kebutuhan["NAMA_KEBUTUHAN"] ?></td>
          <td class="khk_gap">
            <a href="hapus_kebutuhan.php?ID_KEBUTUHAN=<?=$id_kebutuhan?>" class="khk_hapus">
              Hapus
            </a>
            <a href="kebutuhan.php" class="khk_tidak">
              Tidak
            </a>
          </td>
      </tr>
    </table>
  </div>
</div>
<?php endif; ?>