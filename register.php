<?php
    require_once 'database.php';
    require_once 'includes/header.php';
    require_once 'includes/navbar.php';
?>
<div class="register">
    <form action="" method="POST">
        <br>
            <h1>Register</h1>
            <br>
            <br>
            <table>
                <tr>
                    <td>
                        <label for="">Nama Lengkap</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="nama">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Email</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="email">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Password</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="pass">
                    </td>
                </tr>
                <tr>
                    <th>
                    <button type="submit" name="submit">Submit</button> 
                    </th> 
                </tr>
            </table>
            <br>
    </form>
</div>
<?php
if(isset($_POST['submit'])){
    register($_POST);
    header("Location:login.php");
}