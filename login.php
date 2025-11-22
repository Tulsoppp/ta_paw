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

    if (empty($nama)) {
        $errors['user'] = "Username wajib diisi.";
    }

    if (empty($password)) {
        $errors['pass'] = "Password wajib diisi.";
    }

    if (empty($errors)) {

        $data = login($nama, $password);

        if ($data) {

            $_SESSION['login'] = true;
            $_SESSION['ID_USER'] = $data['ID'];

            if ($data['ket'] == 0) {
                $_SESSION['isAdmin'] = true;
                header("Location: admin/");
                exit();
            }

            if ($data['ket'] == 1) {
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

<div class="login">
	<form action="" method="POST">
			<h1>Login</h1>
            <table>
                <tr>
                    <td><label for="user">Username</label></td>
                </tr>
                <tr>    
                    <td>
                        <input type="text" id="user" name="user" placeholder="Masukkan username" 
                        value="<?php echo htmlspecialchars($nama); ?>">

                        <?php if (!empty($errors['user'])): ?>
                            <span class="error"><?php echo $errors['user']; ?></span>
                        <?php endif; ?>
                    </td>
                </tr>

                <tr>
                    <td><label for="pass">Password</label></td>
                </tr>
                <tr>
                    <td>
                        <input type="password" id="pass" name="pass" placeholder="Password terdiri dari 8 karakter">

                        <?php if (!empty($errors['pass'])): ?>
                            <span class="error"><?php echo $errors['pass']; ?></span>
                        <?php endif; ?>
                        <?php if (!empty($errors['salah'])): ?>
                            <span class="error"><?php echo $errors['salah']; ?></span>
                        <?php endif; ?>
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
