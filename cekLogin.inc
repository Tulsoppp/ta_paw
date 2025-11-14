<?php 
	session_start();
	// if (!isset($_SESSION['isUser'])) {
	// 	echo "Harus Login Terlebih Dahulu";
	// 	echo "<a href='login.php'>login</a>";
	// 	exit();
	// }

?>
<?php if(!isset($_SESSION['isUser'])): 
	require_once 'includes/header.php';
	require_once 'includes/navbar.php';
	?>
	<div class="harap_login">
		<p>Harus login Terlebih Dahulu <a href="../login.php">login</a></p>
	</div>

<?php 
exit();
endif;
 ?>