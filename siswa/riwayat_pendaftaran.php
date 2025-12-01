<?php
// Mengecek apa siswa sudah login
require_once 'cekLoginSiswa.php';
$idSiswa = $_SESSION['ID_USER'];
require_once "../database.php";
?>

<?php require_once "../includes/header.php";?>
<?php require_once "../includes/navbarSiswa.php";?>

<?php
$stmt = $pdo->prepare("
    SELECT p.*, j.NAMA_JURUSAN,GROUP_CONCAT(k.NAMA_KEBUTUHAN SEPARATOR ',') NAMA_KEBUTUHAN, KET_STATUS
    FROM pendaftaran p
    JOIN jurusan j ON j.ID_JURUSAN = p.ID_JURUSAN
    JOIN kebutuhan_pendaftaran kp ON kp.ID_PENDAFTARAN = p.ID_PENDAFTARAN
    JOIN kebutuhan k ON k.ID_KEBUTUHAN = kp.ID_KEBUTUHAN
    JOIN status s ON s.ID_STATUS = p.ID_STATUS
    WHERE p.ID_SISWA = :id
    GROUP BY p.ID_PENDAFTARAN
    LIMIT 1
");
$stmt->execute([':id' => $idSiswa]);
$list = $stmt->fetchAll(PDO::FETCH_ASSOC);

function e($v){ return htmlspecialchars($v ?? '-', ENT_QUOTES, 'UTF-8');}

if (!$list) {
?>
<div class="riwayat_pendaftaran">
    <h2>Riwayat Pendaftaran</h2>
    <p style="text-align:center;margin-top:10px;">Belum ada data pendaftaran.</p>
    <div class="rp_action" style="margin-top:20px;">
        <a href="pendaftaran.php" class="btn-link">Daftar</a>
        <a href="profil_siswa.php" class="btn-link btn-danger">Kembali</a>
    </div>
</div>
<?php
require_once "../includes/footer.php";
exit();
}
?>

<?php foreach ($list as $r):?>
<div class="riwayat_pendaftaran">
    <h2>Riwayat Pendaftaran <span class="status_pendaftaran"><?= e($r['KET_STATUS']) ?></span></h2>

    <div class="rp_label">Nama Lengkap</div>
    <div class="rp_h"><?= e($r['NAMA_LENGKAP']) ?></div>

    <div class="rp_label">Jenis Kelamin</div>
    <div class="rp_h"><?= e($r['GENDER']) ?></div>

    <div class="rp_label">Tempat, Tanggal Lahir</div>
    <div class="rp_h"><?= e($r['TEMPAT_LAHIR']) ?>, <?= e($r['TANGGAL_LAHIR']) ?></div>

    <div class="rp_label">Agama</div>
    <div class="rp_h"><?= e($r['AGAMA']) ?></div>

    <div class="rp_label">Alamat Siswa</div>
    <div class="rp_h"><?= ($r['ALAMAT_SISWA']) ?></div>

    <div class="rp_label">No HP Siswa</div>
    <div class="rp_h"><?= ($r['NO_HP_SISWA']) ?></div>

    <div class="rp_label">Jurusan</div>
    <div class="rp_h"><?= ($r['NAMA_JURUSAN']) ?></div>

    <div class="rp_label">Kebutuhan</div>
    <div class="rp_h"><?= e($r['NAMA_KEBUTUHAN']) ?></div>

    <h3 style="margin-top:30px;margin-bottom:10px;">Data Ayah</h3>

    <div class="rp_label">Nama Ayah</div>
    <div class="rp_h"><?= e($r['NAMA_AYAH']) ?></div>

    <div class="rp_label">Keadaan Ayah</div>
    <div class="rp_h"><?= e($r['KEADAAN_AYAH']) ?></div>

    <div class="rp_label">Alamat Ayah</div>
    <div class="rp_"><?= e($r['ALAMAT_AYAH']) ?></div>

    <div class="rp_label">No HP Ayah</div>
    <div class="rp_h"><?= e($r['NO_HP_AYAH']) ?></div>

    <div class="rp_label">Pekerjaan Ayah</div>
    <div class="rp_h"><?= e($r['PEKERJAAN_AYAH']) ?></div>

    <div class="rp_label">Gaji Ayah</div>
    <div class="rp_h"><?= e($r['GAJI_AYAH']) ?></div>

    <h3 style="margin-top:30px;margin-bottom:10px;">Data Ibu</h3>

    <div class="rp_label">Nama Ibu</div>
    <div class="rp_h"><?= e($r['NAMA_IBU']) ?></div>

    <div class="rp_label">Keadaan Ibu</div>
    <div class="rp_h"><?= e($r['KEADAAN_IBU']) ?></div>

    <div class="rp_label">Alamat Ibu</div>
    <div class="rp_h"><?= e($r['ALAMAT_IBU']) ?></div>

    <div class="rp_label">No HP Ibu</div>
    <div class="rp_h"><?= e($r['NO_HP_IBU']) ?></div>

    <div class="rp_label">Pekerjaan Ibu</div>
    <div class="rp_h"><?= e($r['PEKERJAAN_IBU']) ?></div>

    <div class="rp_label">Gaji Ibu</div>
    <div class="rp_h"><?= e($r['GAJI_IBU']) ?></div>

    <div class="rp_action" style="margin-top:30px;">
        <a href="../siswa/index.php" class="btn-link btn-danger">Kembali</a>
    </div>
</div>
<?php endforeach;?>

<?php require_once "../includes/footer.php";?>
