
<?php
//halaman utama ketika user mengakses website
session_start();
?>
<div class="top-sticky">
    <?php require_once "includes/header.php"; ?>
    <?php require_once "includes/navbar.php"; ?>
</div>
<?php
require_once 'database.php';
require_once 'includes/header.php';
require_once 'database.php';
require_once 'includes/navbar.php';
require_once "homePage.php";
require_once "includes/footer.php";