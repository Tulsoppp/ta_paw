<?php
$host='localhost';
$user='root';
$password='';
$db='ppdb';
try {
    $pdo=new PDO("mysql:host=$host;dbname=$db",$user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'koneksi gagal'.$e->getMessage();
};
// register function
function register(array $data){   
    global $pdo; 
    $stmnt=$pdo->prepare("INSERT INTO siswa (USERNAME_SISWA,PASSWORD_SISWA,`EMAIL`)VALUES (:USERNAME,:PASSWORD,:EMAIL)");
    $stmnt->execute([
        ':USERNAME'=>$data['nama'],
        ':PASSWORD'=>md5($data['pass']),
        ':EMAIL'=>$data['email']
    ]);
}
// fungsi jumlah pendaftar
function siswa_daftar(){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT ID_PENDAFTARAN FROM pendaftaran");
    $stmnt->execute();
    $daftar=$stmnt->fetchAll();
    return $daftar;
}
// data pendaftar
function pendaftar(){
    global $pdo;
    $stmnt=$pdo->prepare
    ("SELECT P.TANGGAL_PENDAFTARAN,P.KARTU_KELUARGA,P.AKTA_KELAHIRAN,P.IJAZAH,P.FOTO_SISWA,P.ID_PENDAFTARAN,P.NAMA_LENGKAP,J.NAMA_JURUSAN,S.KET_STATUS, GROUP_CONCAT(K.NAMA_KEBUTUHAN SEPARATOR ',') NAMA_KEBUTUHAN
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
// fungsi lulus
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
// fungsi gagal
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
// fungsi siswa per jurusan
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
// fungsi edit kuota
function edit_kuota($id,$data){
    global $pdo;
    $stmnt=$pdo->prepare("UPDATE jurusan SET KUOTA_JURUSAN = :KUOTA_JURUSAN WHERE ID_JURUSAN = :id");
    $stmnt->execute([
        ":KUOTA_JURUSAN"=>$data,
        ":id"=>$id
    ]);
    header("Location:jurusan.php");

}

function edit_namaJurusan($id,$data){
    global $pdo;
    $stmnt=$pdo->prepare("UPDATE jurusan SET NAMA_JURUSAN = :NAMA_JURUSAN WHERE ID_JURUSAN = :id");
    $stmnt->execute([
        ":NAMA_JURUSAN"=>$data,
        ":id"=>$id
    ]);
    header("Location:jurusan.php");
}

// fungsi menampilkan jurusan
function jurusan(){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT * FROM jurusan");
    $stmnt->execute();
    $jurusan=$stmnt->fetchAll();
    return $jurusan;
}
// fungsi menampilkan kebutuhan
function kebutuhan(){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT * FROM kebutuhan WHERE NAMA_KEBUTUHAN != 'Tidak Ada'");
    $stmnt->execute();
    $kebutuhan=$stmnt->fetchAll();
    return $kebutuhan;
}
// fungsi mendapatkan last insert id pendaftraan
function lastInsertId(){
    global $pdo;
    $stmnt=$pdo->prepare("SELECT ID_PENDAFTARAN FROM pendaftaran ORDER BY ID_PENDAFTARAN DESC LIMIT 1");
    $stmnt->execute();
    $id=$stmnt->fetch();
    return $id;
}
// fungsi login
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
    $data=$stmnt->fetch();
    return $data;
}
// fungsi proses pendaftaran
function proses_pendaftaran( array $data,$file){
    global $pdo;
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $kk=$file['kk'];
        $name_kk=$kk['name'];
        $ext = pathinfo($name_kk, PATHINFO_EXTENSION);
        $name_kk_new="siswa_".$data['id_akun']."_kk_.".$ext;
        $tmp_kk=$kk['tmp_name'];
        $tujuan_kk="../kk/".$name_kk_new;
        move_uploaded_file($tmp_kk,$tujuan_kk);
        
        $akta=$file['akte'];
        $name_akta=$akta['name'];
        $ext = pathinfo($name_akta, PATHINFO_EXTENSION);
        $name_akta_new="siswa_".$data['id_akun']."_akta_.".$ext;
        $tmp_akta=$akta['tmp_name'];
        $tujuan_akta="../akta/".$name_akta_new;
        move_uploaded_file($tmp_akta,$tujuan_akta);
        
        $ijazah=$file['ijazah'];
        $name_ijazah=$ijazah['name'];
        $ext = pathinfo($name_ijazah, PATHINFO_EXTENSION);
        $name_ijazah_new="siswa_".$data['id_akun']."_ijazah_.".$ext;
        $tmp_ijazah=$ijazah['tmp_name'];
        $tujuan_ijazah="../ijazah/".$name_ijazah_new;
        move_uploaded_file($tmp_ijazah,$tujuan_ijazah);
        
        $foto=$file['foto'];
        $name_foto=$foto['name'];
        $ext = pathinfo($name_foto, PATHINFO_EXTENSION);
        $name_foto_new="siswa_".$data['id_akun']."_foto_.".$ext;
        $tmp_foto=$foto['tmp_name'];
        $tujuan_foto="../foto_pas/".$name_foto_new;
        $type = $foto['kk']['type'];
        move_uploaded_file($tmp_foto,$tujuan_foto);
        
        $stmnt=$pdo->prepare
        ("INSERT INTO 
        pendaftaran (ID_STATUS,ID_JURUSAN,ID_SISWA,NAMA_LENGKAP,KARTU_KELUARGA,AKTA_KELAHIRAN,IJAZAH,GENDER,ALAMAT_SISWA,TEMPAT_LAHIR,TANGGAL_LAHIR,AGAMA,FOTO_SISWA,NO_HP_SISWA,NAMA_AYAH,KEADAAN_AYAH,ALAMAT_AYAH,NO_HP_AYAH,PEKERJAAN_AYAH,GAJI_AYAH,NAMA_IBU,KEADAAN_IBU,ALAMAT_IBU,NO_HP_IBU,PEKERJAAN_IBU,GAJI_IBU)
        VALUES
        (:ID_STATUS,:ID_JURUSAN,:ID_SISWA,:NAMA_LENGKAP,:KARTU_KELUARGA,:AKTA_KELAHIRAN,:IJAZAH,:GENDER,:ALAMAT_SISWA,:TEMPAT_LAHIR,:TANGGAL_LAHIR,:AGAMA,:FOTO_SISWA,:NO_HP_SISWA,:NAMA_AYAH,:KEADAAN_AYAH,:ALAMAT_AYAH,:NO_HP_AYAH,:PEKERJAAN_AYAH,:GAJI_AYAH,:NAMA_IBU,:KEADAAN_IBU,:ALAMAT_IBU,:NO_HP_IBU,:PEKERJAAN_IBU,:GAJI_IBU)");
        $stmnt->execute([
            ':ID_STATUS'=>1,
            ':ID_JURUSAN'=>$_POST['id_jurusan'],
            ':ID_SISWA'=> $_POST['id_akun'],
            ':NAMA_LENGKAP'=> $_POST['nama_siswa'],
            ':KARTU_KELUARGA'=>$name_kk_new,
            ':AKTA_KELAHIRAN'=>$name_akta_new,
            ':IJAZAH'=>$name_ijazah_new,
            ':GENDER'=>$_POST['jenis_kelamin'],
            ':ALAMAT_SISWA'=>$_POST['alamat_siswa'],
            ':TEMPAT_LAHIR'=>$_POST['tempat_lahir'],
            ':TANGGAL_LAHIR'=>$_POST['tanggal_lahir'],
            ':AGAMA'=>$_POST['agama'],
            ':FOTO_SISWA'=>$name_foto_new,
            ':NO_HP_SISWA'=>$_POST['no_hp_siswa'],
            ':NAMA_AYAH'=>$_POST['nama_ayah'],
            ':KEADAAN_AYAH'=>$_POST['keadaan_ayah'],
            ':ALAMAT_AYAH'=>$_POST['alamat_ayah'],
            ':NO_HP_AYAH'=>$_POST['no_hp_ayah'],
            ':PEKERJAAN_AYAH'=>$_POST['pekerjaan_ayah'],
            ':GAJI_AYAH'=>$_POST['gaji_ayah'] === "" ? null : $_POST['gaji_ayah'],
            ':NAMA_IBU'=>$_POST['nama_ibu'],
            ':KEADAAN_IBU'=>$_POST['keadaan_ibu'],
            ':ALAMAT_IBU'=>$_POST['alamat_ibu'],
            ':NO_HP_IBU'=>$_POST['no_hp_ibu'],
            ':PEKERJAAN_IBU'=>$_POST['pekerjaan_ibu'],
            ':GAJI_IBU'=>$_POST['gaji_ibu'] === "" ? null : $_POST['gaji_ibu']
            ]);
            $lastIdPendaftar = lastInsertId();

            if (isset($_POST['kebutuhan'])) {
                foreach ($_POST['kebutuhan'] as $idKebutuhan) {
                    $stmnt2 = $pdo->prepare("
                        INSERT INTO kebutuhan_pendaftaran (ID_PENDAFTARAN, ID_KEBUTUHAN)
                        VALUES (:ID_PENDAFTARAN, :ID_KEBUTUHAN)
                    ");
                    $stmnt2->execute([
                        ':ID_PENDAFTARAN' => $lastIdPendaftar["ID_PENDAFTARAN"],
                        ':ID_KEBUTUHAN' => $idKebutuhan
                    ]);
                }
            } else {
                // Jika tidak memilih kebutuhan sama sekali
                $stmnt2 = $pdo->prepare("
                    INSERT INTO kebutuhan_pendaftaran (ID_PENDAFTARAN, ID_KEBUTUHAN)
                    VALUES (:ID_PENDAFTARAN, :ID_KEBUTUHAN)
                ");
                $stmnt2->execute([
                    ':ID_PENDAFTARAN' => $lastIdPendaftar["ID_PENDAFTARAN"],
                    ':ID_KEBUTUHAN' => 1
                ]);
            }
    }
}
