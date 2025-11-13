<?php
session_start();
require_once 'database.php';

if (isset($_POST['submit'])) {
    $user=$_POST['user'];
    $pass=$_POST['pass'];

    $stmnt = $pdo->prepare
    ("SELECT * FROM 
        (SELECT 0 ket,a.NAMA_ADMIN username,a.PASSWORD_ADMIN password FROM `admin` AS a 
    UNION ALL
    SELECT 1 ket,cs.NAMA_AKUN_SISWA username,cs.PASSWORD_AKUN_SISWA password FROM `akun_siswa` AS cs ) AS combind 
    WHERE combind.username = :user AND combind.password = :pass LIMIT 1");
    $stmnt->execute([
        ':user'=>$_POST["user"],
        ':pass'=>md5($_POST["pass"])
    ]);
    $data=$stmnt->fetch();

    if ($stmnt->rowCount()>0) {
        $_SESSION['isUser']=true;
        if ($data["ket"]===0) {
            echo 'admin';
            header('Location: admin');
        }elseif($data["ket"]===1){
            echo 'calon siswa';
            header('Location: siswa');
        }
    }else{
            echo "username atau password ada yang salah";
        }
}

 require_once 'includes/header.php';
 require_once 'includes/navbar.php';
?>

<div class="login">
	<form action="" method="POST">
        <br>
			<h1>Login</h1>
            <br>
            <table>
                <tr>
                    <td><label for="user">Username</label></td>
                </tr>
                <tr>    
                    <td><input type="text" id="user" name="user"></td>
                </tr>
                <tr>
                    <td><label for="pass">Password</label></td>
                </tr>
                <tr>
                    <td><input type="text" id="pass" name="pass"></td>
                </tr>
                <tr>
                    <th>
                        <button type="submit" name="submit">Submit</button>
                    </th>
                </tr>
                <tr>
                    <td>
                        <p>Belum Punya Akun? <a href="register.php"> Register    </a></p>
                    </td>
                </tr>
            </table>
            <br>

	</form>
</div>
