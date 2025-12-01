<?php
require_once 'cekLoginSiswa.php';

$idSiswa = $_SESSION['ID_USER'];

require_once "../database.php";
require_once "../includes/header.php";
require_once "../includes/navbarSiswa.php";

// Ambil data siswa dari database (hanya data yang masih ada di database)
try {
    $stmt = $pdo->prepare("SELECT ID_SISWA, USERNAME_SISWA, EMAIL FROM siswa WHERE ID_SISWA = :id LIMIT 1");
    $stmt->execute([':id' => $idSiswa]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p>Terjadi kesalahan saat mengambil data siswa: " . htmlspecialchars($e->getMessage()) . "</p>";
    exit();
}

// Kalau data tidak ditemukan
if (!$user) {
    echo "<p>Data siswa tidak ditemukan di database.</p>";
    exit();
}

$nama  = htmlspecialchars($user['USERNAME_SISWA'] ?? '-');
$email = htmlspecialchars($user['EMAIL'] ?? '-');
$foundFoto = false;
$displayFotoName = null;
$extensions = ['jpg', 'jpeg', 'png', 'gif'];

foreach ($extensions as $ext) {
    $testName = "siswa_" . $idSiswa . "." . $ext;
    if (file_exists(__DIR__ . "/uploads/" . $testName)) { 
        $displayFotoName = $testName;
        $foundFoto = true;
        break;
    }
}
?>
<!-- Section menampilkan halaman profil -->
<div class="profil_siswa">
    <div class="p_s">

        <div class="avatar-wrap">
            <?php if ($foundFoto): ?>
                <img src="uploads/<?php echo htmlspecialchars($displayFotoName); ?>" class="avatar" alt="Foto Profil">
            <?php else: ?>
                <div class="avatar_placeholder">
                    <?php echo strtoupper(substr($nama, 0, 1)); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="ps_label">Username</div>
        <div class="ps_h"><?php echo htmlspecialchars($nama); ?></div>

        <div class="ps_label">Email</div>
        <div class="ps_h"><?php echo htmlspecialchars($email); ?></div>

        <div class="ps_label">Password</div>
        <div class="ps_h">******</div>

        <div class="profile-actions">
            <a href="edit_siswa.php" class="btn-link">Edit Profil</a>
            <a href="../logout.php" class="btn-link btn-danger">Logout</a>
        </div>

    </div>
</div>