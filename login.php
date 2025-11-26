<?php
session_start();
require_once 'validasi.php';
require_once 'database.php';

$errors = [];
$nama = '';
$password = '';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $nama = trim($_POST['user']);
    $password = $_POST['pass'];
    // validasi username dan password
    val_required($errors, 'user', $nama, 'Username wajib diisi.');
    val_required($errors, 'pass', $password, 'Password wajib diisi.');
    // pengecekan session
    if (empty($errors)) {
        $data = login($nama, $password);
        if ($data) {
            $_SESSION['ID_USER'] = $data['ID'];
            if ($data['ket'] == 0) {
                $_SESSION['isAdmin'] = true;
                header("Location: admin/");
                exit();
            }if ($data['ket'] == 1) {
                $_SESSION['isSiswa'] = true;
                header("Location: siswa/");
                exit();
            }
        } else {
            $errors['salah'] = "Username atau Password salah.";
        }
    }
}

require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>
<!-- form login -->
<div class="login">
	<form method="POST">
			<h1>Login</h1>
            <table>
                <tr>
                    <td><label for="user">Username</label></td>
                </tr>
                <tr>    
                    <td>
                        <input type="text" id="user" name="user" placeholder="Masukkan username" 
                        value="<?php echo htmlspecialchars($nama); ?>">
                        <span class="error_login"><?= $errors['user'] ?? ""; ?></span>
                    </td>
                </tr>

                <tr>
                    <td><label for="pass">Password</label></td>
                </tr>
                <tr>
                    <td>
                        <input type="password" id="pass" name="pass" placeholder="Password terdiri dari 8 karakter"
                        value="<?php echo htmlspecialchars($password); ?>">
                        <span class="error_login"><?= $errors['pass'] ?? ""; ?></span>
                        <span class="error_login"><?= $errors['salah'] ?? ""; ?></span>
                    </td>
                </tr>

                <tr>
                    <th>
                        <button type="submit" name="submit">Login</button>
                    </th>
                </tr>

                <tr>
                    <td>
                        <p>Belum Punya Akun? <a href="register.php">Register</a></p>
                    </td>
                </tr>
            </table>
	</form>
</div>
