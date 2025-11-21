<?php 
    session_start();
    require_once '../database.php';
$lastIdPendaftar=lastInsertId();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $kk=$_FILES['kk'];
    $name_kk=$kk['name'];
    $tmp_kk=$kk['tmp_name'];
    $tujuan_kk="../kk/".$name_kk;
    move_uploaded_file($tmp_kk,$tujuan_kk);

    $akta=$_FILES['akta'];
    $name_akta=$akta['name'];
    $tmp_akta=$akta['tmp_name'];
    $tujuan_akta="../akta/".$name_akta;
    move_uploaded_file($tmp_akta,$tujuan_akta);

    $ijazah=$_FILES['ijazah'];
    $name_ijazah=$ijazah['name'];
    $tmp_ijazah=$ijazah['tmp_name'];
    $tujuan_ijazah="../ijazah/".$name_ijazah;
    move_uploaded_file($tmp_ijazah,$tujuan_ijazah);

    $foto=$_FILES['foto'];
    $name_foto=$foto['name'];
    $tmp_foto=$foto['tmp_name'];
    $tujuan_foto="../foto_pas/".$name_foto;
    move_uploaded_file($tmp_foto,$tujuan_foto);

    $stmnt=$pdo->prepare
    ("INSERT INTO 
    pendaftaran (ID_STATUS,ID_JURUSAN,ID_SISWA,NAMA_LENGKAP,KARTU_KELUARGA,AKTA_KELAHIRAN,IJAZAH,GENDER,ALAMAT_SISWA,TEMPAT_LAHIR,TANGGAL_LAHIR,AGAMA,FOTO_SISWA,NO_HP_SISWA,NAMA_AYAH,KEADAAN_AYAH,ALAMAT_AYAH,NO_HP_AYAH,PEKERJAAN_AYAH,GAJI_AYAH,NAMA_IBU,KEADAAN_IBU,ALAMAT_IBU,NO_HP_IBU,PEKERJAAN_IBU,GAJI_IBU)
    VALUES
    (:ID_STATUS,:ID_JURUSAN,:ID_SISWA,:NAMA_LENGKAP,:KARTU_KELUARGA,:AKTA_KELAHIRAN,:IJAZAH,:GENDER,:ALAMAT_SISWA,:TEMPAT_LAHIR,:TANGGAL_LAHIR,:AGAMA,:FOTO_SISWA,:NO_HP_SISWA,:NAMA_AYAH,:KEADAAN_AYAH,:ALAMAT_AYAH,:NO_HP_AYAH,:PEKERJAAN_AYAH,:GAJI_AYAH,:NAMA_IBU,:KEADAAN_IBU,:ALAMAT_IBU,:NO_HP_IBU,:PEKERJAAN_IBU,:GAJI_IBU)");
    $stmnt->execute([
        ':ID_STATUS'=>1,
        ':ID_JURUSAN'=>$_POST['id_jurusan'],
        ':ID_AKUN_SISWA'=> $_POST['id_akun'],
        ':ID_SISWA'=> $_POST['id_akun'],
        ':NAMA_LENGKAP'=> $_POST['nama_lengkap'],
        ':KARTU_KELUARGA'=>$name_kk,
        ':AKTA_KELAHIRAN'=>$name_akta,
        ':IJAZAH'=>$name_ijazah,
        ':GENDER'=>$_POST['jenis_kelamin'],
        ':ALAMAT_SISWA'=>$_POST['alamat_siswa'],
        ':TEMPAT_LAHIR'=>$_POST['tempat_lahir'],
        ':TANGGAL_LAHIR'=>$_POST['tanggal_lahir'],
        ':AGAMA'=>$_POST['agama'],
        ':FOTO_SISWA'=>$name_foto,
        ':NO_HP_SISWA'=>$_POST['no_hp_siswa'],
        ':NAMA_WALI'=>$_POST['nama_wali'],
        ':ALAMAT_WALI'=>$_POST['alamat_wali'],
        ':NO_HP_WALI'=>$_POST['no_hp_wali'],
        ':HUBUNGAN'=>$_POST['hubungan'],
        ':PEKERJAAN_WALI'=>$_POST['pekerjaan_wali'],
        ':SLIP_GAJI'=>$_POST['slip_gaji']

        ':NAMA_AYAH'=>$_POST['nama_ayah'],
        ':KEADAAN_AYAH'=>$_POST['keadaan_ayah'],
        ':ALAMAT_AYAH'=>$_POST['alamat_ayah'],
        ':NO_HP_AYAH'=>$_POST['no_hp_ayah'],
        ':PEKERJAAN_AYAH'=>$_POST['pekerjaan_ayah'],
        ':GAJI_AYAH'=>$_POST['gaji_ayah'],
        ':NAMA_IBU'=>$_POST['nama_ibu'],
        ':KEADAAN_IBU'=>$_POST['keadaan_ibu'],
        ':ALAMAT_IBU'=>$_POST['alamat_ibu'],
        ':NO_HP_IBU'=>$_POST['no_hp_ibu'],
        ':PEKERJAAN_IBU'=>$_POST['pekerjaan_ibu'],
        ':GAJI_IBU'=>$_POST['gaji_ibu']
    ]);
    $stmnt2=$pdo->prepare
    ("INSERT INTO kebutuhan_pendaftaran (ID_PENDAFTARAN,ID_KEBUTUHAN) 
    VALUES (:ID_PENDAFTARAN,:ID_KEBUTUHAN)");
    $stmnt2->execute([
        ':ID_PENDAFTARAN'=>$lastIdPendaftar['ID_PENDAFTARAN'],
        ':ID_KEBUTUHAN'=>$_POST['kebutuhan']
    ]);
}
header("Location: index.php");