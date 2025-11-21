<?php
$host='localhost';
$user='root';
$password='';
$db='ppdb';
try {
    $pdo=new PDO("mysql:host=$host;dbname=$db",$user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    // echo 'Koneksi Berhasil';
} catch (PDOException $e) {
    echo 'koneksi gagal'.$e->getMessage();
};

function register(array $data){   
    global $pdo; 
    $stmnt=$pdo->prepare("INSERT INTO siswa (USERNAME_SISWA,PASSWORD_SISWA,`EMAIL`)VALUES (:USERNAME,:PASSWORD,:EMAIL)");
    $stmnt->execute([
        ':USERNAME'=>$data['nama'],
        ':PASSWORD'=>md5($data['pass']),
        ':EMAIL'=>$data['email']
    ]);
}
function siswa_daftar(){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT ID_PENDAFTARAN FROM pendaftaran");
    $stmnt->execute();
    $daftar=$stmnt->fetchAll();
    return $daftar;
}

function pendaftar(){
    global $pdo;
    $stmnt=$pdo->prepare
    ("SELECT P.TANGGAL_PENDAFTARAN,P.ID_PENDAFTARAN,P.NAMA_LENGKAP,J.NAMA_JURUSAN,S.KET_STATUS, GROUP_CONCAT(K.NAMA_KEBUTUHAN SEPARATOR ',') NAMA_KEBUTUHAN
    FROM pendaftaran P
    JOIN siswa A ON A.ID_SISWA = P.ID_SISWA
    JOIN status S ON S.ID_STATUS = P.ID_STATUS
    JOIN jurusan J ON J.ID_JURUSAN = P.ID_JURUSAN
    JOIN kebutuhan_pendaftaran PK ON PK.ID_PENDAFTARAN = P.ID_PENDAFTARAN
    JOIN kebutuhan K ON K.ID_KEBUTUHAN = PK.ID_KEBUTUHAN
    WHERE P.ID_STATUS = 1
    GROUP BY P.ID_PENDAFTARAN");
    $stmnt->execute();
    $daftar=$stmnt->fetchAll();
    return $daftar;
}
function lulus(){
    global $pdo;
    $stmnt=$pdo->prepare
    ("SELECT P.ID_PENDAFTARAN,P.NAMA_LENGKAP,J.NAMA_JURUSAN,S.KET_STATUS , GROUP_CONCAT(K.NAMA_KEBUTUHAN SEPARATOR ',') NAMA_KEBUTUHAN
    FROM pendaftaran P
    JOIN siswa A ON A.ID_SISWA = P.ID_SISWA
    JOIN status S ON S.ID_STATUS = P.ID_STATUS
    JOIN jurusan J ON J.ID_JURUSAN = P.ID_JURUSAN
    JOIN kebutuhan_pendaftaran PK ON PK.ID_PENDAFTARAN = P.ID_PENDAFTARAN
    JOIN kebutuhan K ON K.ID_KEBUTUHAN = PK.ID_KEBUTUHAN
    WHERE P.ID_STATUS = 2
    GROUP BY P.ID_PENDAFTARAN");
    $stmnt->execute();
    $daftar=$stmnt->fetchAll();
    return $daftar;
}
function gagal(){
    global $pdo;
    $stmnt=$pdo->prepare
    ("SELECT P.ID_PENDAFTARAN,P.NAMA_LENGKAP,J.NAMA_JURUSAN,S.KET_STATUS , GROUP_CONCAT(K.NAMA_KEBUTUHAN SEPARATOR ',') NAMA_KEBUTUHAN
    FROM pendaftaran P
    JOIN siswa A ON A.ID_SISWA = P.ID_SISWA
    JOIN status S ON S.ID_STATUS = P.ID_STATUS
    JOIN jurusan J ON J.ID_JURUSAN = P.ID_JURUSAN
    JOIN kebutuhan_pendaftaran PK ON PK.ID_PENDAFTARAN = P.ID_PENDAFTARAN
    JOIN kebutuhan K ON K.ID_KEBUTUHAN = PK.ID_KEBUTUHAN
    WHERE P.ID_STATUS = 3
    GROUP BY P.ID_PENDAFTARAN");
    $stmnt->execute();
    $daftar=$stmnt->fetchAll();
    return $daftar;
}
function siswa_jurusan($jurusan){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT ID_PENDAFTARAN 
    FROM pendaftaran P,jurusan J,status S
    WHERE P.ID_JURUSAN = J.ID_JURUSAN
    AND P.ID_STATUS = S.ID_STATUS 
    AND NAMA_JURUSAN=:NAMA_JURUSAN
    AND P.ID_STATUS=2
    ");
    $stmnt->execute([
        ":NAMA_JURUSAN"=>$jurusan
    ]);
    $daftar=$stmnt->fetchAll();
    return $daftar;
}
function edit_kuota($id){
    global $pdo;
    $stmnt=$pdo->prepare("UPDATE jurusan SET KUOTA_JURUSAN = :KUOTA_JURUSAN WHERE ID_JURUSAN = :id");
    $stmnt->execute([
        ":KUOTA_JURUSAN"=>$_POST["KUOTA_JURUSAN"],
        ":id"=>$id
    ]);
    header("Location:jurusan.php");
}
function jurusan(){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT * FROM jurusan");
    $stmnt->execute();
    $jurusan=$stmnt->fetchAll();
    return $jurusan;
}
function kebutuhan(){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT * FROM kebutuhan");
    $stmnt->execute();
    $kebutuhan=$stmnt->fetchAll();
    return $kebutuhan;
}
function lastInsertId(){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT ID_PENDAFTARAN FROM pendaftaran ORDER BY ID_PENDAFTARAN DESC LIMIT 1");
    $stmnt->execute();
    $id=$stmnt->fetch();
    return $id;
}
function login($user,$pass){
    global $pdo;
    $stmnt=$pdo->prepare
    ("SELECT * 
    FROM (SELECT ID_ADMIN AS ID,USERNAME_ADMIN AS NAMA,PASSWORD_ADMIN AS PASS,0 AS ket FROM admin
    UNION
    SELECT ID_SISWA AS ID,USERNAME_SISWA AS NAMA,PASSWORD_SISWA AS PASS,1 AS ket FROM siswa) AS users
    WHERE NAMA=:user AND PASS=:pass");
    $stmnt->execute([
        ':user'=>$user,
        ':pass'=>md5($pass)
    ]);
    $_SESSION['login']=true;
    $data=$stmnt->fetch();
    return $data;
}
// function register(array $data){

//     $stmnt=$pdo
// }

// Profil Siswa
function profil($id) {
    global $pdo;
    $stmnt=$pdo->prepare
    ("SELECT*
    FROM akun_siswa
    WHERE ID_AKUN_SISWA = :id
    ");
    $stmnt->execute([
        ':id'=>$id
    ]);
    $profil=$stmnt->fetch();
    return $profil;
}