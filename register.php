<?php
// halaman untuk registrasi user baru
    require_once 'database.php';
// Header dan navbar
    require_once 'includes/header.php';
    require_once 'includes/navbar.php';
// fungsi validasi
    require_once 'validasi.php';

$errors = []; // Wadah untuk menampung error

$nama = '';
$password = '';
$email = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = $_POST['nama'];
    $password = $_POST['pass'];
    $email = $_POST['email'];

    // validasi nama
    val_required($errors, 'nama', $nama, 'Username wajib diisi.');
    val_alphanumeric($errors, 'nama', $nama, 'Username harus berupa huruf dan angka.');

    // validasi password
    val_required($errors, 'pass', $password, 'Password wajib diisi.');
    val_password_format($errors, 'pass', $password, 8, 'Password minimal 8 karakter.'); 

    // validasi email
    val_required($errors, 'email', $email, 'Email wajib diisi.');
    val_email($errors, 'email', $email, 'Format email salah.'); 

    // jika tidak ada error, daftarkan user
    if (empty($errors)) {
        register($_POST);
        header("Location: login.php");
    }
}

?>
<div class="register">
    <form method="POST">
            <h1>Register</h1>
            <table>
                <tr>
                    <td>
                         <label for="nama">Username</label>
                        <input type="text" name="nama" id="nama" placeholder="Masukkan username" value="<?php echo htmlspecialchars($nama); ?>"><br>
                        <?php if (!empty($errors['nama'])): ?>
                            <span class="error"><?php echo $errors['nama']; ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" placeholder="Masukkan email" value="<?php echo htmlspecialchars($email); ?>"><br>
                        <?php if (!empty($errors['email'])): ?>
                            <span class="error"><?php echo $errors['email']; ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="pass">Password</label>
                        <input type="password" name="pass" id="pass" placeholder="Password terdiri dari 8 karakter" value="<?php echo htmlspecialchars($password); ?>"><br>
                        <?php if (!empty($errors['pass'])): ?>
                            <span class="error"><?php echo $errors['pass']; ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Sudah punya akun ? <a href="login.php">Login</a></p>
                    </td>
                </tr>
                <tr>
                    <th>
                    <button type="submit" name="submit">Submit</button> 
                    </th> 
                </tr>
            </table> 
    </form>
</div>