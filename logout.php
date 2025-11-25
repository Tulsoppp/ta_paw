<?php 
// halaman untuk logout user
session_start();
session_destroy();
header("Location: ../ta_paw");
 ?>