<?php

require_once 'validtest.php';


$errors = []; // Wadah untuk menampung error
$pesan_sukses = ""; // Pesan jika berhasil

$nama = '';
$nisn = '';
$kode_daftar = '';
$password = '';
$tgl_lahir = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Ambil semua data dari form
    $nama = $_POST['nama'];
    $nisn = $_POST['nisn'];
    $kode_daftar = $_POST['kode_daftar'];
    $password = $_POST['password'];
    $tgl_lahir = $_POST['tgl_lahir'];

    // Nama (Wajib, Alfabet)
    val_required($errors, 'nama', $nama, 'Nama wajib diisi.');
    val_alpha($errors, 'nama', $nama, 'Nama harus berupa huruf dan spasi.');

    // NISN (Wajib, Numerik, Panjang Tepat 10)
    val_required($errors, 'nisn', $nisn, 'NISN wajib diisi.');
    val_numeric($errors, 'nisn', $nisn, 'NISN harus berupa angka.');
    val_exact_length($errors, 'nisn', $nisn, 10, 'NISN harus 10 digit.');

    // (Wajib, Alfanumerik)
    val_required($errors, 'kode_daftar', $kode_daftar, 'Kode Pendaftaran wajib diisi.');
    val_alphanumeric($errors, 'kode_daftar', $kode_daftar, 'Kode Pendaftaran harus alfanumerik (huruf & angka, tanpa spasi).');

    //  Password (Wajib, Format/Panjang Minimal 8)
    val_required($errors, 'password', $password, 'Password wajib diisi.');
    val_password_format($errors, 'password', $password, 8, 'Password minimal 8 karakter.'); 

    // Tgl Lahir (Wajib, Format Tanggal Y-m-d)
    val_required($errors, 'tgl_lahir', $tgl_lahir, 'Tanggal Lahir wajib diisi.');
    val_date_format($errors, 'tgl_lahir', $tgl_lahir, 'Y-m-d', 'Format tanggal harus YYYY-MM-DD.');

    if (empty($errors)) {
        $pesan_sukses = "SELAMAT! Semua data yang Anda masukkan VALID.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Halaman Tes Validasi</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; margin: 20px; background-color: #f4f4f4; }
        h1 { color: #333; }
        form { background-color: #fff; border: 1px solid #ccc; padding: 20px; border-radius: 8px; max-width: 500px; }
        form div { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; color: #555; }
        input[type="text"], input[type="password"] { width: 95%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
        .error { color: #D8000C; font-size: 0.9em; display: block; margin-top: 5px; }
        .sukses { color: #4F8A10; font-weight: bold; border: 1px solid #4F8A10; background-color: #DFF2BF; padding: 10px; border-radius: 5px; margin-bottom: 15px; }
        button { background-color: #007BFF; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>

    <?php
    if (!empty($pesan_sukses)) {
        echo "<div class'sukses'>$pesan_sukses</div>";
    }
    ?>

    <form action="" method="POST" novalidate>
        
        <div>
            <label for="nama">Nama (Wajib, Alfabet):</label>
            <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>">
            <?php if (!empty($errors['nama'])): ?>
                <span class="error"><?php echo $errors['nama']; ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="nisn">NISN (Wajib, Numerik, Tepat 10 digit):</label>
            <input type="text" id="nisn" name="nisn" value="<?php echo htmlspecialchars($nisn); ?>">
            <?php if (!empty($errors['nisn'])): ?>
                <span class="error"><?php echo $errors['nisn']; ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="kode_daftar">Kode Pendaftaran (Wajib, Alfanumerik):</label>
            <input type="text" id="kode_daftar" name="kode_daftar" value="<?php echo htmlspecialchars($kode_daftar); ?>">
            <?php if (!empty($errors['kode_daftar'])): ?>
                <span class="error"><?php echo $errors['kode_daftar']; ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="password">Password (Wajib, min 8 karakter):</label>
            <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
            <?php if (!empty($errors['password'])): ?>
                <span class="error"><?php echo $errors['password']; ?></span>
            <?php endif; ?>
        </div>

        <div>
            <label for="tgl_lahir">Tgl Lahir (Wajib, Format YYYY-MM-DD):</label>
            <input type="text" id="tgl_lahir" name="tgl_lahir" value="<?php echo htmlspecialchars($tgl_lahir); ?>" placeholder="Contoh: 2005-12-31">
            <?php if (!empty($errors['tgl_lahir'])): ?>
                <span class="error"><?php echo $errors['tgl_lahir']; ?></span>
            <?php endif; ?>
        </div>

        <div>
            <button type="submit">Submit</button>
        </div>
    </form>

</body>
</html>