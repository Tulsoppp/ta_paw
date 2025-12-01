<?php 
 require_once 'cekLoginSiswa.php';
 require_once "../database.php";
// require_once "../cekLogin.inc";
require_once "../includes/header.php";
require_once "../includes/navbarSiswa.php";
require_once '../validasi.php';


$errors = []; 

$nama = '';
$password = '';
$tgl_lahir = '';
$history_kk= '';
$history_akte= '';
$history_ijazah= '';
$history_foto= '';
 if (!empty($_FILES['kk']['name'])) {
        $history_kk = $_FILES['kk']['name'];
    }
if (!empty($_FILES['akte']['name'])) {
        $history_akte = $_FILES['akte']['name'];
    }
 if (!empty($_FILES['ijazah']['name'])) {
        $history_ijazah = $_FILES['ijazah']['name'];
    }
if (!empty($_FILES['foto']['name'])) {
        $history_foto = $_FILES['foto']['name'];
    }

// validasi form pendaftaran siswa 
$nama_siswa = htmlspecialchars( $_POST['nama_siswa'] ?? '');
$nisn = htmlspecialchars( $_POST['nisn'] ?? '');
$jenis_kelamin = htmlspecialchars( $_POST['jenis_kelamin'] ?? '');
$agama = htmlspecialchars( $_POST['agama'] ?? '');
$tgl_lahir = htmlspecialchars( $_POST['tanggal_lahir'] ?? '');
$tempat_lahir = htmlspecialchars( $_POST['tempat_lahir'] ?? '');
$alamat_siswa = htmlspecialchars( $_POST['alamat_siswa'] ?? '');
$id_jurusan = htmlspecialchars( $_POST['id_jurusan'] ?? '');
$no_hp_siswa = htmlspecialchars( $_POST['no_hp_siswa'] ?? '');
$kebutuhan = $_POST['kebutuhan'] ?? [];

$nama_ayah = htmlspecialchars( $_POST['nama_ayah'] ?? '');
$keadaan_ayah = htmlspecialchars( $_POST['keadaan_ayah'] ?? '');
$alamat_ayah = htmlspecialchars( $_POST['alamat_ayah'] ?? '');
$no_hp_ayah = htmlspecialchars( $_POST['no_hp_ayah'] ?? '');
$pekerjaan_ayah = htmlspecialchars( $_POST['pekerjaan_ayah'] ?? '');
$gaji_ayah = htmlspecialchars( $_POST['gaji_ayah'] ?? '');

$nama_ibu = htmlspecialchars( $_POST['nama_ibu'] ?? '');
$keadaan_ibu = htmlspecialchars( $_POST['keadaan_ibu'] ?? '');
$alamat_ibu = htmlspecialchars( $_POST['alamat_ibu'] ?? '');
$no_hp_ibu = htmlspecialchars( $_POST['no_hp_ibu'] ?? '');
$pekerjaan_ibu = htmlspecialchars( $_POST['pekerjaan_ibu'] ?? '');
$gaji_ibu = htmlspecialchars( $_POST['gaji_ibu'] ?? '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $file_kk = $_FILES['kk']['name'] ?? null;
    $file_akte = $_FILES['akte']['name'] ?? null;
    $file_ijazah = $_FILES['ijazah']['name'] ?? null;
    $file_foto = $_FILES['foto']['name'] ?? null;

    // validasi nama(wajib diisi,berupa huruf)
    val_required($errors, 'nama_siswa', $nama_siswa, 'Nama Siswa wajib diisi.');
    val_alpha($errors, 'nama_siswa', $nama_siswa, 'Nama Siswa harus berupa huruf dan spasi.'); 

    //validasi nisn(wajib diisi, berupa numeric dan harus 10 digit)
    val_required($errors, 'nisn', $nisn, 'NISN wajib diisi.');
    if (!isset($errors['nisn'])) {
        val_numeric($errors, 'nisn', $nisn, 'NISN harus berupa angka.');
    }
    if (!isset($errors['nisn'])) {
        val_exact_length($errors, 'nisn', $nisn, 10, 'NISN harus 10 digit.');
    }

    //validasi jenis kelamin(wajib diisi)
    val_required($errors, 'jenis_kelamin', $jenis_kelamin, 'Jenis Kelamin wajib dipilih.');

    //validasi agama(harus diisi dan berupa huruf)
    val_required($errors, 'agama', $agama, 'Agama wajib dipilih.');
    val_alpha($errors, 'agama', $agama, 'Agama harus berupa huruf dan spasi.'); 

    //validasi tanggal(wajib diisi dengan format Year Month Day) 
    val_required($errors, 'tanggal_lahir', $tgl_lahir, 'Tanggal Lahir wajib diisi.');
    val_date_format($errors, 'tanggal_lahir', $tgl_lahir, 'Y-m-d', 'Tanggal Lahir harus dalam format YYYY-MM-DD.');

    //validasi tempat lahir(wajib diisi beerupa huruf)
    val_required($errors, 'tempat_lahir', $tempat_lahir, 'Tempat Lahir wajib diisi.');
    val_alpha($errors, 'tempat_lahir', $tempat_lahir, 'Tempat Lahir harus berupa huruf dan spasi.'); 

     //validasi Aalamat(wajib diisi berupa huruf angka)
    val_required($errors, 'alamat_siswa', $alamat_siswa, 'Alamat Siswa wajib diisi.');
    val_alamat($errors, 'alamat_siswa', $alamat_siswa, 'Alamat harus berupa huruf dan angka.'); 

     //validasi jurusan(wajib diisi)
    val_required($errors, 'id_jurusan', $id_jurusan, 'Jurusan wajib dipilih.');

     //validasi no hp siswa(wajib diisi berupa numeric)
    val_required($errors, 'no_hp_siswa', $no_hp_siswa, 'No HP Siswa wajib diisi.');
    val_numeric($errors, 'no_hp_siswa', $no_hp_siswa, 'No HP Siswa harus berupa angka.');

    //validasi ayah(wajib diisi berupa numeric)
    val_required($errors, 'nama_ayah', $nama_ayah, 'Nama Ayah wajib diisi.');
    val_alpha($errors, 'nama_ayah', $nama_ayah, 'Nama Ayah harus berupa huruf dan spasi.'); 
    
    //validasi keadaan ayah (wajib diisi berupa numeric)
    val_required($errors, 'keadaan_ayah', $keadaan_ayah, 'Keadaan Ayah wajib diisi.');

    //validasi No hp ortu(wajib diisi berupa numeric)
    if (!empty($no_hp_ayah)) {
        val_numeric($errors, 'no_hp_ayah', $no_hp_ayah, 'No Hp harus berupa angka.');
        val_exact_length($errors, 'no_hp_ayah', $no_hp_ayah, 12, 'No Hp harus 12 digit.');
    }
    // validasi alamat ayah (berupa huruf dan angka)
    if (!empty($alamat_ayah)) {
        val_alamat($errors, 'alamat_ayah', $alamat_ayah, 'Alamat Ayah harus berupa huruf dan angka.'); 
    }
    // validasi pekerjaan ayah (berupa huruf)
    if (!empty($pekerjaan_ayah)) {
        val_alpha($errors, 'pekerjaan_ayah', $pekerjaan_ayah, 'Pekerjaan Ayah harus berupa huruf dan spasi.'); 
    }


    //validasi ibu siswa(wajib diisi berupa huruf)
    val_required($errors, 'nama_ibu', $nama_ibu, 'Nama Ibu wajib diisi.');
    val_alpha($errors, 'nama_ibu', $nama_ibu, 'Nama Ibu harus berupa huruf dan spasi.'); 
    
    //validasi keadaan ibu(wajib diisi berupa huruf)
    val_required($errors, 'keadaan_ibu', $keadaan_ibu, 'Keadaan Ibu wajib diisi.');

       //validasi No hp ortu(wajib diisi berupa numeric)
    if (!empty($no_hp_ibu)) {
        val_numeric($errors, 'no_hp_ibu', $no_hp_ibu, 'No Hp harus berupa angka.');
        val_exact_length($errors, 'no_hp_ibu', $no_hp_ibu, 12, 'No Hp harus 12 digit.');
    }
    // validasi alamat ibu (berupa huruf dan angka)
    if (!empty($alamat_ibu)) {
        val_alamat($errors, 'alamat_ibu', $alamat_ibu, 'Alamat Ibu harus berupa huruf dan angka.'); 
    }
    // validasi pekerjaan ibu (berupa huruf)
    if (!empty($pekerjaan_ibu)) {
        val_alpha($errors, 'pekerjaan_ibu', $pekerjaan_ibu, 'Pekerjaan Ibu harus berupa huruf dan spasi.'); 
    }


    //validasi files(wajib diisi dan menerima file jpg,jpeg,png dan pdf dengan ukuran 2 mb)
    val_file($errors,'kk',$_FILES['kk'],['jpg', 'jpeg', 'png', 'pdf'],2,'Format file tidak didukung.');

    val_file($errors,'akte',$_FILES['akte'],['jpg', 'jpeg', 'png', 'pdf'],2,'Format file tidak didukung.');

    val_file($errors,'ijazah',$_FILES['ijazah'],['jpg', 'jpeg', 'png', 'pdf'],2,'Format file tidak didukung.');

   val_file($errors,'foto',$_FILES['foto'],['jpg', 'jpeg', 'png', 'pdf'],2,'Format file tidak didukung.');

    if (empty($errors)) {
        proses_pendaftaran($_POST,$_FILES);
        header("Location: pendaftaran_selesai.php");
        exit();
    }
}

$jurusan=jurusan();
$kebutuhan=kebutuhan();
 ?>

<!-- form pendaftaran siswa  -->
<div class="form_pendaftaran">
    <h1>Form PPDB Sekolah Inklusi</h1>
    <form method="POST" enctype="multipart/form-data" class="isi_pendaftaran">
        
        <h2>Data Pribadi Siswa</h2>
        <hr>
        <div>
            <input type="hidden" value="<?= $_SESSION['ID_USER'] ?>" name="id_akun">
        </div>
        
<!-- Bagian NISN -->
        <div class="form_isi">
            <span class="wajib">( * ) Wajib diisi</span>
            <label for="nisn">NISN : <span class="wajib">*</span></label>
            <input type="text" id="nisn" name="nisn" placeholder="NISN" value="<?= $nisn?>">
            <?php if(!empty($errors['nisn'])): ?>
            <span class="error"><?= $errors['nisn'] ?></span>
            <?php endif; ?>
        </div>
<!-- Nama Lengkap -->
        <div class="form_isi">
            <label for="nama_lengkap">Nama Lengkap : <span class="wajib">*</span></label>
            <input type="text" id="nama_lengkap" name="nama_siswa" placeholder="Nama Lengkap" value="<?= $nama_siswa?>">
            <?php if(!empty($errors['nama_siswa'])): ?>
            <span class="error"><?= $errors['nama_siswa'] ?></span>
            <?php endif; ?>
        </div>
<!-- Jenis Kelamin -->
        <div class="form_isi">
            <label>Jenis Kelamin : <span class="wajib">*</span></label>
            <div class="radio-group-horizontal">
                <input type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-Laki" <?= (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] === 'Laki-Laki') ? 'checked' : '' ?>>
                <label for="laki-laki">Laki-laki</label>
                
                <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan" <?= (isset($_POST['jenis_kelamin']) && $_POST['jenis_kelamin'] === 'Perempuan') ? 'checked' : '' ?>>
                <label for="perempuan">Perempuan</label>
            </div>
            <?php if(!empty($errors['jenis_kelamin'])): ?>
            <span class="error"><?= $errors['jenis_kelamin'] ?></span>
            <?php endif; ?>
        </div>
<!-- Agama -->
        <div class="form_isi">
            <label for="agama">Agama : <span class="wajib">*</span></label>
            <input type="text" id="agama" name="agama" placeholder="Agama" value="<?= $agama?> ">
            <?php if(!empty($errors['agama'])): ?>
                <span class="error"><?= $errors['agama'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form_isi">
            <label for="tempat_lahir">Tempat Lahir : <span class="wajib">*</span></label>
            <input type="text" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= $tempat_lahir?>">
            <?php if(!empty($errors['tempat_lahir'])): ?>
            <span class="error"><?= $errors['tempat_lahir'] ?></span>
            <?php endif; ?>
        </div>
<!-- Tanggal Lahir -->
        <div class="form_isi">
            <label for="tgl_lahir">Tanggal Lahir : <span class="wajib">*</span></label>
            <input type="text" id="tgl_lahir" name="tanggal_lahir" placeholder="Tahun-Bulan-Hari" value="<?= $tgl_lahir?>">
            <?php if(!empty($errors['tanggal_lahir'])): ?>
            <span class="error"><?= $errors['tanggal_lahir'] ?></span>
            <?php endif; ?>
        </div>
        
<!-- Alamat siswa -->
        <div class="form_isi">
            <label for="alamat_siswa">Alamat Siswa : <span class="wajib">*</span></label>
            <input type="text" id="alamat_siswa" name="alamat_siswa" placeholder="Alamat Siswa" value="<?= $alamat_siswa?>">
            <?php if(!empty($errors['alamat_siswa'])): ?>
            <span class="error"><?= $errors['alamat_siswa'] ?></span>
            <?php endif; ?>
        </div>
<!-- No Hp Siswa -->
        <div class="form_isi">
            <label for="hp_siswa">No HP Siswa : <span class="wajib">*</span></label>
            <input type="text" id="hp_siswa" name="no_hp_siswa" placeholder="No Hp Siswa" value="<?= $no_hp_siswa?>">
            <?php if(!empty($errors['no_hp_siswa'])): ?>
                <span class="error"><?= $errors['no_hp_siswa'] ?></span>
            <?php endif; ?>
        </div>
<!-- Jurusan -->
        <div class="form_isi">
            <label for="jurusan">Pilihan Jurusan :<span class="wajib">*</span></label>
            <select id="jurusan" name="id_jurusan">
                <option value="">-- Pilih Jurusan --</option>
                <?php foreach($jurusan as $data): ?>
                    <option value="<?= $data['ID_JURUSAN'] ?>" 
                    <?= ($id_jurusan == $data['ID_JURUSAN']) ? 'selected' : '' ?>>
                    <?= $data['NAMA_JURUSAN'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if(!empty($errors['id_jurusan'])): ?>
            <span class="error"><?= $errors['id_jurusan'] ?></span>
            <?php endif; ?>
        </div>
        
        <h2>Kebutuhan Khusus</h2><hr>
        <div class="form_isi">
            <label for="kebutuhan">Masukan Jika Siswa Memiliki Kebutuhan Khusus : </label>
            <div class="kebutuhan">
                <?php foreach ($kebutuhan as $kbth): ?>
                    <div>
                        <input type="checkbox"
                            id="<?= $kbth['ID_KEBUTUHAN'] ?>"
                            name="kebutuhan[]"
                            value="<?= $kbth['ID_KEBUTUHAN'] ?>" 
                            <?= (!empty($_POST['kebutuhan']) && in_array($kbth['ID_KEBUTUHAN'], $_POST['kebutuhan'])) ? 'checked' : '' ?>
                        >
                        <span><?= $kbth['NAMA_KEBUTUHAN'] ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <h2>Data Dokumen</h2>
        <hr>
        
        <div class="form_isi">
            <label for="kk" >Kartu Keluarga : (Max file 2 mb jpg,jpeg,png, dan pdf)<span class="wajib">*</span></label>
            <input type="file" id="kk" name="kk">
            <?php if(!empty($errors['kk'])): ?>
                <span class="error"><?= $errors['kk'] ?></span>
            <?php endif; ?>
            <?php if (!empty($history_kk)): ?>
                <p>Dipilih: <b><?= htmlspecialchars($history_kk) ?></b></p>
            <?php endif; ?>
        </div>
        
        <div class="form_isi">
            <label for="akta">Akte Kelahiran : (Max file 2 mb jpg,jpeg,png, dan pdf) <span class="wajib">*</span></label>
            <input type="file" id="akta" name="akte">
            <?php if(!empty($errors['akte'])): ?>
                <span class="error"><?= $errors['akte'] ?></span>
                <?php endif; ?>
                <?php if (!empty($history_akte)): ?>
                    <p>Dipilih: <b><?= htmlspecialchars($history_akte) ?></b></p>
                <?php endif; ?>
        </div>
                
            <div class="form_isi">
                <label for="ijazah">Ijazah / SKL (Surat keterangan Lulus) : (Max file 2 mb jpg,jpeg,png, dan pdf) <span class="wajib">*</span></label>
                <input type="file" id="ijazah" name="ijazah">
                <?php if(!empty($errors['ijazah'])): ?>
                    <span class="error"><?= $errors['ijazah'] ?></span>
                <?php endif; ?>
                <?php if (!empty($history_ijazah)): ?>
                    <p>Dipilih: <b><?= htmlspecialchars($history_ijazah) ?></b></p>
                 <?php endif; ?>
        </div>
        
        <div class="form_isi">
            <label for="pas_foto">Foto Pas Siswa (Upload) : (Max ukuran file 2 mb jpg,jpeg,png.) <span class="wajib">*</span></label>
            <input type="file" id="pas_foto" name="foto" accept=".jpg, .jpeg, .png">
            <?php if(!empty($errors['foto'])): ?>
                <span class="error"><?= $errors['foto'] ?></span>
            <?php endif; ?>
            <?php if (!empty($history_foto)): ?>
                <p>Dipilih: <b><?= htmlspecialchars($history_foto) ?></b></p>
            <?php endif; ?>
        </div>
        <h2>Data Ayah & Ibu</h2>
        <hr>
        <div class="form_isi">
            <label for="nama_wali">Nama Ayah : <span class="wajib">*</span></label>
            <input type="text" id="nama_wali" name="nama_ayah" placeholder="Nama Lengkap Ayah" value="<?= $nama_ayah?>">
            <?php if(!empty($errors['nama_ayah'])): ?>
            <span class="error"><?= $errors['nama_ayah'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form_isi">
                <label>Keadaan Ayah : <span class="wajib">*</span></label>
                <div class="radio-group-horizontal">
                    <input type="radio" id="masih_hidup" name="keadaan_ayah" value="Masih Hidup" <?= (isset($_POST['keadaan_ayah']) && $_POST['keadaan_ayah'] === 'Masih Hidup') ? 'checked' : '' ?>>
                    <label for="masih_hidup">Masih Hidup</label>
                    
                    <input type="radio" id="sudah_tidak_ada" name="keadaan_ayah" value="Sudah Tidak Ada" <?= (isset($_POST['keadaan_ayah']) && $_POST['keadaan_ayah'] === 'Sudah Tidak Ada') ? 'checked' : '' ?>>
                    <label for="sta">Sudah Tidak Ada</label>
                    <?php if(!empty($errors['keadaan_ayah'])): ?>
                        <span class="error"><?= $errors['keadaan_ayah'] ?></span>
                    <?php endif; ?>
                </div>
        </div>

        <div class="form_isi">
            <label for="alamat_ayah">Alamat Ayah :</label>
            <input type="text" id="alamat_ayah" name="alamat_ayah" placeholder="Alamat Ayah" value="<?= $alamat_ayah?>">
            <span class="error"><?= $errors['alamat_ayah'] ?? "" ?></span>
        </div>

        <div class="form_isi">
            <label for="no_hp_ayah">No Telepon Ayah :</label>
            <input type="text" id="no_hp_ayah" name="no_hp_ayah" placeholder="No Hp Ayah" value="<?= $no_hp_ayah?>">
            <?php if(!empty($errors['no_hp_ayah'])): ?>
                <span class="error"><?= $errors['no_hp_ayah'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form_isi">
            <label for="pekerjaan_ayah">Pekerjaan Ayah :</label>
            <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah" value="<?= $pekerjaan_ayah?>">
            <span class="error"><?= $errors["pekerjaan_ayah"] ?? "" ?></span>
        </div>

        <div class="form_isi">
            <label for="gaji_ayah">Gaji Ayah :</label>
            <select name="gaji_ayah" id="gaji_ayah">
                <option value="">-- Pilih Gaji Ayah --</option>
                <option value="Kurang Dari Rp 500.000" <?= (isset($_POST['gaji_ayah']) && $_POST['gaji_ayah'] == 'Kurang Dari Rp 500.000') ? 'selected' : '' ?>>-- Kurang Dari Rp 500.000 --</option>
                <option value="Rp 500.001 Sampai Rp 1.000.000" <?= (isset($_POST['gaji_ayah']) && $_POST['gaji_ayah'] == 'Rp 500.001 Sampai Rp 1.000.000') ? 'selected' : '' ?>>-- Rp 500.001 Sampai Rp 1.000.000 --</option>
                <option value="Rp 1.000.001 Sampai Rp 1.500.000" <?= (isset($_POST['gaji_ayah']) && $_POST['gaji_ayah'] == 'Rp 1.000.001 Sampai Rp 1.500.000') ? 'selected' : '' ?>>-- Rp 1.000.001 Sampai Rp 1.500.000 --</option>
                <option value="Rp 1.500.001 Sampai Rp 2.000.000" <?= (isset($_POST['gaji_ayah']) && $_POST['gaji_ayah'] == 'Rp 1.500.001 Sampai Rp 2.000.000') ? 'selected' : '' ?>>-- Rp 1.500.001 Sampai Rp 2.000.000 --</option>
                <option value="Rp 2.000.001 Sampai Rp 2.500.000" <?= (isset($_POST['gaji_ayah']) && $_POST['gaji_ayah'] == 'Rp 2.000.001 Sampai Rp 2.500.000') ? 'selected' : '' ?>>-- Rp 2.000.001 Sampai Rp 2.500.000 --</option>
                <option value="Rp 2.500.001 Sampai Rp 3.000.000" <?= (isset($_POST['gaji_ayah']) && $_POST['gaji_ayah'] == 'Rp 2.500.001 Sampai Rp 3.000.000') ? 'selected' : '' ?>>-- Rp 2.500.001 Sampai Rp 3.000.000 --</option>
                <option value="Rp 3.000.001 Sampai Rp 3.500.000" <?= (isset($_POST['gaji_ayah']) && $_POST['gaji_ayah'] == 'Rp 3.000.001 Sampai Rp 3.500.000') ? 'selected' : '' ?>>-- Rp 3.000.001 Sampai Rp 3.500.000 --</option>
                <option value="Rp 3.500.001 Sampai Rp 4.000.000" <?= (isset($_POST['gaji_ayah']) && $_POST['gaji_ayah'] == 'Rp 3.500.001 Sampai Rp 4.000.000') ? 'selected' : '' ?>>-- Rp 3.500.001 Sampai Rp 4.000.000 --</option>
                <option value="Rp 4.000.001 Sampai Rp 4.500.000" <?= (isset($_POST['gaji_ayah']) && $_POST['gaji_ayah'] == 'Rp 4.000.001 Sampai Rp 4.500.000') ? 'selected' : '' ?>>-- Rp 4.000.001 Sampai Rp 4.500.000 --</option>
                <option value="Rp 4.500.001 Sampai Rp 5.000.000" <?= (isset($_POST['gaji_ayah']) && $_POST['gaji_ayah'] == 'Rp 4.500.001 Sampai Rp 5.000.000') ? 'selected' : '' ?>>-- Rp 4.500.001 Sampai Rp 5.000.000 --</option>
                <option value="Rp 5.000.001 Sampai Rp 5.500.000" <?= (isset($_POST['gaji_ayah']) && $_POST['gaji_ayah'] == 'Rp 5.000.001 Sampai Rp 5.500.000') ? 'selected' : '' ?>>-- Rp 5.000.001 Sampai Rp 5.500.000 --</option>
                <option value="Rp 5.500.001 Sampai Rp 6.000.000" <?= (isset($_POST['gaji_ayah']) && $_POST['gaji_ayah'] == 'Rp 5.500.001 Sampai Rp 6.000.000') ? 'selected' : '' ?>>-- Rp 5.500.001 Sampai Rp 6.000.000 --</option>
                <option value="Rp 6.000.001 Sampai Rp 6.500.000" <?= (isset($_POST['gaji_ayah']) && $_POST['gaji_ayah'] == 'Rp 6.000.001 Sampai Rp 6.500.000') ? 'selected' : '' ?>>-- Rp 6.000.001 Sampai Rp 6.500.000 --</option>
                <option value="Rp 6.500.001 Sampai Rp 7.000.000" <?= (isset($_POST['gaji_ayah']) && $_POST['gaji_ayah'] == 'Rp 6.500.001 Sampai Rp 7.000.000') ? 'selected' : '' ?>>-- Rp 6.500.001 Sampai Rp 7.000.000 --</option>
            </select>
        </div>


        <div class="form_isi">
            <label for="nama_ibu">Nama Ibu : <span class="wajib">*</span></label>
            <input type="text" id="nama_ibu" name="nama_ibu" placeholder="Nama Lengkap Ibu" value="<?= $nama_ibu?>">
            <?php if(!empty($errors['nama_ibu'])): ?>
            <span class="error"><?= $errors['nama_ibu'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form_isi">
            <label>Keadaan Ibu : <span class="wajib">*</span></label>
            <div class="radio-group-horizontal">
                <input type="radio" id="ibu_masih_hidup" name="keadaan_ibu" value="Masih Hidup"
                    <?= (isset($_POST['keadaan_ibu']) && $_POST['keadaan_ibu'] === 'Masih Hidup') ? 'checked' : '' ?>>
                <label for="ibu_masih_hidup">Masih Hidup</label>

                <input type="radio" id="ibu_meninggal" name="keadaan_ibu" value="Sudah Tidak Ada"
                    <?= (isset($_POST['keadaan_ibu']) && $_POST['keadaan_ibu'] === 'Sudah Tidak Ada') ? 'checked' : '' ?>>
                <label for="ibu_meninggal">Sudah Tidak Ada</label>

                <?php if(!empty($errors['keadaan_ibu'])): ?>
                    <span class="error"><?= $errors['keadaan_ibu'] ?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="form_isi">
            <label for="alamat_ibu">Alamat Ibu :</label>
            <input type="text" id="alamat_ibu" name="alamat_ibu" placeholder="Alamat Ibu" value="<?= $alamat_ibu?>">
            <span class="error"><?= $errors['alamat_ibu'] ?? "" ?></span>
        </div>

        <div class="form_isi">
            <label for="no_hp_ibu">No Telepon Ibu :</label>
            <input type="text" id="no_hp_ibu" name="no_hp_ibu" placeholder="No Hp Ibu" value="<?= $no_hp_ibu?>">
            <?php if(!empty($errors['no_hp_ibu'])): ?>
                <span class="error"><?= $errors['no_hp_ibu'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form_isi">
            <label for="pekerjaan_ibu">Pekerjaan Ibu :</label>
            <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu" value="<?= $pekerjaan_ibu?>">
            <span class="error"><?= $errors["pekerjaan_ibu"] ?? "" ?></span>
        </div>

        <div class="form_isi">
            <label for="gaji_ibu">Gaji Ibu : </label>
             <select name="gaji_ibu" id="gaji_ibu">
                <option value="">-- Pilih Gaji Ibu --</option>
                <option value="Kurang Dari Rp 500.000" <?= (isset($_POST['gaji_ibu']) && $_POST['gaji_ibu'] == 'Kurang Dari Rp 500.000') ? 'selected' : '' ?>>-- Kurang Dari Rp 500.000 --</option>
                <option value="Rp 500.001 Sampai Rp 1.000.000" <?= (isset($_POST['gaji_ibu']) && $_POST['gaji_ibu'] == 'Rp 500.001 Sampai Rp 1.000.000') ? 'selected' : '' ?>>-- Rp 500.001 Sampai Rp 1.000.000 --</option>
                <option value="Rp 1.000.001 Sampai Rp 1.500.000" <?= (isset($_POST['gaji_ibu']) && $_POST['gaji_ibu'] == 'Rp 1.000.001 Sampai Rp 1.500.000') ? 'selected' : '' ?>>-- Rp 1.000.001 Sampai Rp 1.500.000 --</option>
                <option value="Rp 1.500.001 Sampai Rp 2.000.000" <?= (isset($_POST['gaji_ibu']) && $_POST['gaji_ibu'] == 'Rp 1.500.001 Sampai Rp 2.000.000') ? 'selected' : '' ?>>-- Rp 1.500.001 Sampai Rp 2.000.000 --</option>
                <option value="Rp 2.000.001 Sampai Rp 2.500.000" <?= (isset($_POST['gaji_ibu']) && $_POST['gaji_ibu'] == 'Rp 2.000.001 Sampai Rp 2.500.000') ? 'selected' : '' ?>>-- Rp 2.000.001 Sampai Rp 2.500.000 --</option>
                <option value="Rp 2.500.001 Sampai Rp 3.000.000" <?= (isset($_POST['gaji_ibu']) && $_POST['gaji_ibu'] == 'Rp 2.500.001 Sampai Rp 3.000.000') ? 'selected' : '' ?>>-- Rp 2.500.001 Sampai Rp 3.000.000 --</option>
                <option value="Rp 3.000.001 Sampai Rp 3.500.000" <?= (isset($_POST['gaji_ibu']) && $_POST['gaji_ibu'] == 'Rp 3.000.001 Sampai Rp 3.500.000') ? 'selected' : '' ?>>-- Rp 3.000.001 Sampai Rp 3.500.000 --</option>
                <option value="Rp 3.500.001 Sampai Rp 4.000.000" <?= (isset($_POST['gaji_ibu']) && $_POST['gaji_ibu'] == 'Rp 3.500.001 Sampai Rp 4.000.000') ? 'selected' : '' ?>>-- Rp 3.500.001 Sampai Rp 4.000.000 --</option>
                <option value="Rp 4.000.001 Sampai Rp 4.500.000" <?= (isset($_POST['gaji_ibu']) && $_POST['gaji_ibu'] == 'Rp 4.000.001 Sampai Rp 4.500.000') ? 'selected' : '' ?>>-- Rp 4.000.001 Sampai Rp 4.500.000 --</option>
                <option value="Rp 4.500.001 Sampai Rp 5.000.000" <?= (isset($_POST['gaji_ibu']) && $_POST['gaji_ibu'] == 'Rp 4.500.001 Sampai Rp 5.000.000') ? 'selected' : '' ?>>-- Rp 4.500.001 Sampai Rp 5.000.000 --</option>
                <option value="Rp 5.000.001 Sampai Rp 5.500.000" <?= (isset($_POST['gaji_ibu']) && $_POST['gaji_ibu'] == 'Rp 5.000.001 Sampai Rp 5.500.000') ? 'selected' : '' ?>>-- Rp 5.000.001 Sampai Rp 5.500.000 --</option>
                <option value="Rp 5.500.001 Sampai Rp 6.000.000" <?= (isset($_POST['gaji_ibu']) && $_POST['gaji_ibu'] == 'Rp 5.500.001 Sampai Rp 6.000.000') ? 'selected' : '' ?>>-- Rp 5.500.001 Sampai Rp 6.000.000 --</option>
                <option value="Rp 6.000.001 Sampai Rp 6.500.000" <?= (isset($_POST['gaji_ibu']) && $_POST['gaji_ibu'] == 'Rp 6.000.001 Sampai Rp 6.500.000') ? 'selected' : '' ?>>-- Rp 6.000.001 Sampai Rp 6.500.000 --</option>
                <option value="Rp 6.500.001 Sampai Rp 7.000.000" <?= (isset($_POST['gaji_ibu']) && $_POST['gaji_ibu'] == 'Rp 6.500.001 Sampai Rp 7.000.000') ? 'selected' : '' ?>>-- Rp 6.500.001 Sampai Rp 7.000.000 --</option>
            </select>
        </div>
        <div class="form-actions">
            <button type="submit">Kirim Pendaftaran</button>
        </div>
    </form>
</div>