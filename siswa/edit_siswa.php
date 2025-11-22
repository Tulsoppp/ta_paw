<?php
session_start();

// Pastikan yang login adalah siswa
if (!isset($_SESSION['login']) || empty($_SESSION['isSiswa'])) {
    header("Location: ../login.php");
    exit();
}

// Ambil ID siswa dari session
if (!isset($_SESSION['ID_USER'])) {
    echo "Session ID siswa tidak ditemukan. Silakan login ulang.";
    exit();
}
$idSiswa = $_SESSION['ID_USER'];

require_once "../database.php";
require_once "../includes/header.php";
require_once "../includes/navbarSiswa.php";

$errors  = [];
$success = "";

// Ambil data siswa saat ini
try {
    $stmt = $pdo->prepare("SELECT * FROM siswa WHERE ID_SISWA = :id LIMIT 1");
    $stmt->execute([':id' => $idSiswa]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p>Terjadi kesalahan saat mengambil data siswa: " . htmlspecialchars($e->getMessage()) . "</p>";
    exit();
}

if (!$user) {
    echo "<p>Data siswa tidak ditemukan di database.</p>";
    exit();
}

// Nilai awal untuk form
$currentUsername = $user['USERNAME_SISWA'] ?? "";
$currentEmail    = $user['EMAIL'] ?? "";
$currentFoto     = $user['FOTO'] ?? "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $pass     = $_POST['password'] ?? '';
    $pass2    = $_POST['password_confirm'] ?? '';

    // Validasi sederhana
    if ($username === '') {
        $errors['username'] = "Username tidak boleh kosong.";
    }

    if ($email === '') {
        $errors['email'] = "Email tidak boleh kosong.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid.";
    }

    if ($pass !== '' || $pass2 !== '') {
        if ($pass !== $pass2) {
            $errors['password'] = "Password dan konfirmasi password tidak sama.";
        } elseif (strlen($pass) < 8) {
            $errors['password'] = "Password minimal 8 karakter.";
        }
    }

    // Upload foto (opsional)
    $newFotoName = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['foto']['tmp_name'];
        $origName = $_FILES['foto']['name'];
        $size = $_FILES['foto']['size'];

        // Batasi ukuran misalnya 2MB
        if ($size > 2 * 1024 * 1024) {
            $errors['foto'] = "Ukuran foto maksimal 2MB.";
        } else {
            $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($ext, $allowed)) {
                $errors['foto'] = "Format foto harus jpg, jpeg, png, atau gif.";
            } else {
                // Buat nama file baru
                $newFotoName = "siswa_" . $idSiswa . "_" . time() . "." . $ext;
                $dest = __DIR__ . "/uploads/" . $newFotoName;

                if (!is_dir(__DIR__ . "/uploads")) {
                    mkdir(__DIR__ . "/uploads", 0777, true);
                }

                if (!move_uploaded_file($tmpName, $dest)) {
                    $errors['foto'] = "Gagal mengupload foto.";
                }
            }
        }
    }

    // Jika tidak ada error, update database
    if (empty($errors)) {
        $fields = [
            'USERNAME_SISWA' => $username,
            'EMAIL'          => $email,
        ];

        if ($pass !== '' && $pass === $pass2) {
            $fields['PASSWORD_SISWA'] = md5($pass); // samakan dengan register/login
        }

        if ($newFotoName !== null) {
            $fields['FOTO'] = $newFotoName;
        }

        // Susun query UPDATE dinamis
        $setParts = [];
        $params   = [':id' => $idSiswa];

        foreach ($fields as $col => $val) {
            $setParts[] = "$col = :$col";
            $params[":$col"] = $val;
        }

        $sql = "UPDATE siswa SET " . implode(", ", $setParts) . " WHERE ID_SISWA = :id";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);

            // Hapus foto lama jika ada foto baru
            if ($newFotoName !== null && !empty($currentFoto)) {
                $oldPath = __DIR__ . "/uploads/" . $currentFoto;
                if (is_file($oldPath)) {
                    @unlink($oldPath);
                }
                $currentFoto = $newFotoName;
            }

            // Update nilai yang ditampilkan
            $currentUsername = $username;
            $currentEmail    = $email;

            $success = "Profil berhasil diperbarui.";
        } catch (PDOException $e) {
            $errors['global'] = "Gagal memperbarui profil: " . htmlspecialchars($e->getMessage());
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Edit Profil</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- style.css utama situsmu -->
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<div class="profile-card"><!-- pakai card penuh layar putih yang sudah kamu buat -->
    <div class="avatar-wrap">
        <?php if ($currentFoto && file_exists(__DIR__ . "/uploads/" . $currentFoto)): ?>
            <img src="uploads/<?php echo htmlspecialchars($currentFoto); ?>" class="avatar" alt="Foto Profil">
        <?php else: ?>
            <div class="avatar-placeholder">
                <?php echo strtoupper(substr($currentUsername, 0, 1)); ?>
            </div>
        <?php endif; ?>
    </div>
    <h2 style="margin-bottom: 10px;">Edit Profil</h2>
            <!-- Foto profil -->
    <div class="profile-label">Foto Profil</div>
    <input type="file" name="foto" style="margin:8px auto 16px auto;">
    <?php if (!empty($errors['foto'])): ?>
        <span class="error"><?php echo $errors['foto']; ?></span>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="sukses" style="margin-bottom:10px;"><?php echo $success; ?></div>
    <?php endif; ?>

    <?php if (!empty($errors['global'])): ?>
        <div class="error" style="margin-bottom:10px;"><?php echo $errors['global']; ?></div>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data" style="width:100%;display:flex;flex-direction:column;align-items:center;">

        <!-- Username -->
        <div class="profile-label">Username</div>
        <input
            type="text"
            name="username"
            class="profile-field"
            value="<?php echo htmlspecialchars($currentUsername); ?>"
        >
        <?php if (!empty($errors['username'])): ?>
            <span class="error"><?php echo $errors['username']; ?></span>
        <?php endif; ?>

        <!-- Email -->
        <div class="profile-label">Email</div>
        <input
            type="text"
            name="email"
            class="profile-field"
            value="<?php echo htmlspecialchars($currentEmail); ?>"
        >
        <?php if (!empty($errors['email'])): ?>
            <span class="error"><?php echo $errors['email']; ?></span>
        <?php endif; ?>

        <!-- Password baru (opsional) -->
        <div class="profile-label">Password Baru </div>
        <input
            type="password"
            name="password"
            class="profile-field"
            placeholder="Kosongkan jika tidak ingin mengganti password"
        >

        <div class="profile-label">Konfirmasi Password Baru</div>
        <input
            type="password"
            name="password_confirm"
            class="profile-field"
            placeholder="Ulangi password baru"
        >
        <?php if (!empty($errors['password'])): ?>
            <span class="error"><?php echo $errors['password']; ?></span>
        <?php endif; ?>

        <div class="profile-actions" style="margin-top:20px;">
            <button type="submit" class="btn-link">Simpan Perubahan</button>
            <a href="profil_siswa.php" class="btn-link btn-danger">Batal</a>
        </div>
    </form>
</div>

</body>
</html>
