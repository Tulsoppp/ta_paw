<?php session_start(); if(!isset($_SESSION['login']))
{ require_once '../cekLogin.inc';; } require_once "../database.php";
// require_once "../cekLogin.inc";
require_once "../includes/header.php";
require_once "../includes/navbarSiswa.php";
require_once '../validasi.php';


$errors = []; 

$nama = '';
$nisn = '';
$password = '';
$tgl_lahir = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama_siswa = $_POST['nama_siswa'] ?? '';
    $nisn = $_POST['nisn'] ?? '';
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
    $agama = $_POST['agama'] ?? '';
    $tgl_lahir = $_POST['tanggal_lahir'] ?? '';
    $tempat_lahir = $_POST['tempat_lahir'] ?? '';
    $alamat_siswa = $_POST['alamat_siswa'] ?? '';
    $id_jurusan = $_POST['id_jurusan'] ?? '';
    $no_hp_siswa = $_POST['no_hp_siswa'] ?? '';
    $kebutuhan = $_POST['kebutuhan'] ?? '';

    $nama_ayah = $_POST['nama_ayah'] ?? '';
    $keadaan_ayah = $_POST['keadaan_ayah'] ?? '';
    $alamat_ayah = $_POST['alamat_ayah'] ?? '';
    $no_hp_ayah = $_POST['no_hp_ayah'] ?? '';
    $pekerjaan_ayah = $_POST['pekerjaan_ayah'] ?? '';
    $gaji_ayah = $_POST['gaji_ayah'] ?? '';

    $nama_ibu = $_POST['nama_ibu'] ?? '';
    $keadaan_ibu = $_POST['keadaan_ibu'] ?? '';
    $alamat_ibu = $_POST['alamat_ibu'] ?? '';
    $no_hp_ibu = $_POST['no_hp_ibu'] ?? '';
    $pekerjaan_ibu = $_POST['pekerjaan_ibu'] ?? '';
    $gaji_ibu = $_POST['gaji_ibu'] ?? '';

    $file_kk = $_FILES['kk']['name'] ?? null;
    $file_akte = $_FILES['akte']['name'] ?? null;
    $file_ijazah = $_FILES['ijazah']['name'] ?? null;
    $file_foto = $_FILES['foto']['name'] ?? null;

    val_required($errors, 'nama_siswa', $nama_siswa, 'Nama Siswa wajib diisi.');
    val_alpha($errors, 'nama_siswa', $nama_siswa, 'Nama Siswa harus berupa huruf dan spasi.'); 

    val_required($errors, 'nisn', $nisn, 'NISN wajib diisi.');
    val_numeric($errors, 'nisn', $nisn, 'NISN harus berupa angka.');
    val_exact_length($errors, 'nisn', $nisn, 10, 'NISN harus 10 digit.');

    val_required($errors, 'jenis_kelamin', $jenis_kelamin, 'Jenis Kelamin wajib dipilih.');

    val_required($errors, 'agama', $agama, 'Agama wajib dipilih.');
    val_alpha($errors, 'agama', $agama, 'Agama harus berupa huruf dan spasi.'); 

    val_required($errors, 'tanggal_lahir', $tgl_lahir, 'Tanggal Lahir wajib diisi.');
    val_date_format($errors, 'tanggal_lahir', $tgl_lahir, 'Y-m-d', 'Tanggal Lahir harus dalam format YYYY-MM-DD.');

    val_required($errors, 'tempat_lahir', $tempat_lahir, 'Tempat Lahir wajib diisi.');
    val_alpha($errors, 'tempat_lahir', $tempat_lahir, 'Tempat Lahir harus berupa huruf dan spasi.'); 

    val_required($errors, 'alamat_siswa', $alamat_siswa, 'Alamat Siswa wajib diisi.');
    val_alphanumeric($errors, 'alamat_siswa', $alamat_siswa, 'Alamat harus berupa huruf dan spasi.'); 

    val_required($errors, 'id_jurusan', $id_jurusan, 'Jurusan wajib dipilih.');

    val_required($errors, 'no_hp_siswa', $no_hp_siswa, 'No HP Siswa wajib diisi.');
    val_numeric($errors, 'no_hp_siswa', $no_hp_siswa, 'No HP Siswa harus berupa angka.');

    val_required($errors, 'jurusan', $id_jurusan, 'Jurusan  wajib diisi.');

    val_required($errors, 'kebutuhan', $kebutuhan, 'kebutuhan wajib diisi.');

    val_required($errors, 'kebutuhan', $kebutuhan, 'Kebutuhan wajib dipilih.');

    val_required($errors, 'nama_ayah', $nama_ayah, 'Nama Ayah wajib diisi.');
    val_alpha($errors, 'nama_ayah', $nama_ayah, 'Nama Ayah harus berupa huruf dan spasi.'); 

    val_required($errors, 'keadaan_ayah', $keadaan_ayah, 'Keadaan Ayah wajib dipilih.');

    val_required($errors, 'alamat_ayah', $alamat_ayah, 'Alamat Ayah wajib diisi.');
    val_alphanumeric($errors, 'alamat_ayah', $alamat_ayah, 'Alamat Ayah harus berupa huruf dan spasi.'); 

    val_required($errors, 'no_hp_ayah', $no_hp_ayah, 'No HP Ayah wajib diisi.');
    val_numeric($errors, 'no_hp_ayah', $no_hp_ayah, 'No HP Ayah harus berupa angka.');

    val_required($errors, 'pekerjaan_ayah', $pekerjaan_ayah, 'Pekerjaan Ayah wajib diisi.');
    val_alpha($errors, 'pekerjaan_ayah', $pekerjaan_ayah, 'Pekerjaan Ayah harus berupa huruf dan spasi.');

    val_required($errors, 'gaji_ayah', $gaji_ayah, 'Gaji Ayah wajib dipilih.');

    val_required($errors, 'nama_ibu', $nama_ibu, 'Nama Ibu wajib diisi.');
    val_alpha($errors, 'nama_ibu', $nama_ibu, 'Nama Ibu harus berupa huruf dan spasi.'); 

    val_required($errors, 'keadaan_ibu', $keadaan_ibu, 'Keadaan Ibu wajib dipilih.');

    val_required($errors, 'alamat_ibu', $alamat_ibu, 'Alamat Ibu wajib diisi.');
    val_alphanumeric($errors, 'alamat_ibu', $alamat_ibu, 'Alamat Ibu harus berupa huruf dan spasi.'); 

    val_required($errors, 'no_hp_ibu', $no_hp_ibu, 'No HP Ibu wajib diisi.');
    val_numeric($errors, 'no_hp_ibu', $no_hp_ibu, 'No HP Ibu harus berupa angka.');

    val_required($errors, 'pekerjaan_ibu', $pekerjaan_ibu, 'Pekerjaan Ibu wajib diisi.');

    val_required($errors, 'gaji_ibu', $gaji_ibu, 'Gaji Ibu wajib dipilih.');

    val_file($errors,'kk',$_FILES['kk'],['jpg', 'jpeg', 'png', 'pdf'],2,'Format file tidak didukung.');

    val_file($errors,'akte',$_FILES['akte'],['jpg', 'jpeg', 'png', 'pdf'],2,'Format file tidak didukung.');

    val_file($errors,'ijazah',$_FILES['ijazah'],['jpg', 'jpeg', 'png', 'pdf'],2,'Format file tidak didukung.');

   val_file($errors,'foto',$_FILES['foto'],['jpg', 'jpeg', 'png', 'pdf'],5,'Format file tidak didukung.');

    if (empty($errors)) {
        $pesan_sukses = "SELAMAT! Semua data yang Anda masukkan VALID.";
        proses_pendaftaran($_POST);
        header("Location: siswa/");
    }
}

$jurusan=jurusan();
$kebutuhan=kebutuhan();

 ?>
<div class="form_pendaftaran">
    <h1>Form PPDB Sekolah Inklusi</h1>
    <form method="POST" enctype="multipart/form-data" class="isi_pendaftaran">
        
        <h2>Data Pribadi Siswa</h2>
        <hr>
        <div>
            <input type="hidden" value="<?= $_SESSION['ID_USER'] ?>" name="id_akun">
        </div>

        <div class="form_isi">
            <label for="nisn">NISN : <span class="wajib">*</span></label>
            <input type="text" id="nisn" name="nisn" placeholder="NISN">
            <?php if(!empty($errors['nisn'])): ?>
            <span class="error"><?= $errors['nisn'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form_isi">
            <label for="nama_lengkap">Nama Lengkap : <span class="wajib">*</span></label>
            <input type="text" id="nama_lengkap" name="nama_siswa" placeholder="Nama Lengkap">
            <?php if(!empty($errors['nama_siswa'])): ?>
            <span class="error"><?= $errors['nama_siswa'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form_isi">
            <label>Jenis Kelamin : <span class="wajib">*</span></label>
            <div class="radio-group-horizontal">
                <input type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-Laki">
                <label for="laki-laki">Laki-laki</label>
                
                <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan">
                <label for="perempuan">Perempuan</label>
            </div>
            <?php if(!empty($errors['jenis_kelamin'])): ?>
            <span class="error"><?= $errors['jenis_kelamin'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form_isi">
            <label>Agama : <span class="wajib">*</span></label>
            <input type="text" id="agama" name="agama" placeholder="Agama">
            <?php if(!empty($errors['agama'])): ?>
            <span class="error"><?= $errors['agama'] ?></span>
            <?php endif; ?>
        </div>
        
        <div class="form_isi">
            <label for="tempat_lahir">Tempat Lahir : <span class="wajib">*</span></label>
            <input type="text" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir">
            <?php if(!empty($errors['tempat_lahir'])): ?>
            <span class="error"><?= $errors['tempat_lahir'] ?></span>
            <?php endif; ?>
        </div>
        
        <div class="form_isi">
            <label for="tgl_lahir">Tanggal Lahir : <span class="wajib">*</span></label>
            <input type="text" id="tgl_lahir" name="tanggal_lahir" placeholder="Tahun-Bulan-Hari">
            <?php if(!empty($errors['tanggal_lahir'])): ?>
            <span class="error"><?= $errors['tanggal_lahir'] ?></span>
            <?php endif; ?>
        </div>
        
        <div class="form_isi">
            <label for="alamat_siswa">Alamat Siswa : <span class="wajib">*</span></label>
            <input type="text" id="alamat_siswa" name="alamat_siswa" placeholder="Alamat Siswa">
            <?php if(!empty($errors['alamat_siswa'])): ?>
            <span class="error"><?= $errors['alamat_siswa'] ?></span>
            <?php endif; ?>
        </div>
        
        <div class="form_isi">
            <label for="hp_siswa">No HP Siswa : <span class="wajib">*</span></label>
            <input type="text" id="hp_siswa" name="no_hp_siswa" placeholder="No Hp Siswa">
            <?php if(!empty($errors['no_hp_siswa'])): ?>
            <span class="error"><?= $errors['no_hp_siswa'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form_isi">
            <label for="jurusan">Pilihan Jurusan :<span class="wajib">*</span></label>
            <select id="jurusan" name="id_jurusan">
                <option value="">-- Pilih Jurusan --</option>
                <?php foreach($jurusan as $data): ?>
                <option value="<?= $data['ID_JURUSAN'] ?>"><?= $data['NAMA_JURUSAN'] ?></option>
                <?php endforeach; ?>
            </select>
            <?php if(!empty($errors['jurusan'])): ?>
            <span class="error"><?= $errors['jurusan'] ?></span>
            <?php endif; ?>
        </div>
        
        <h2>Kebutuhan Khusus</h2>
        <hr>
        <div class="form_isi">
             <label for="kebutuhan">Masukan Jika Siswa Memiliki Kebutuhan Khusus : <span class="wajib">*</span></label>
            <div class="kebutuhan">
                <?php foreach($kebutuhan as $kbth): ?>
                    <div>
                        <input type="checkbox" id="id_kebutuhan" name="kebutuhan" value="<?= $kbth['ID_KEBUTUHAN'] ?>"><span> <?= $kbth['NAMA_KEBUTUHAN'] ?></span> 
                    </div>
                <?php endforeach; ?>
                <?php if(!empty($errors['kebutuhan'])): ?>
            <span class="error"><?= $errors['kebutuhan'] ?></span>
            <?php endif; ?>
            </div>
        </div>
        <h2>Data Dokumen</h2>
        <hr>
        
        <div class="form_isi">
            <label for="kk" >Kartu Keluarga : <span class="wajib">*</span></label>
            <input type="file" 
                id="pas_foto" 
                name="kk" 
            >
            <?php if(!empty($errors['kk'])): ?>
            <span class="error"><?= $errors['kk'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form_isi">
            <label for="akta">Akte Kelahiran : <span class="wajib">*</span></label>
            <input type="file" 
                id="pas_foto" 
                name="akte" 
            >
            <?php if(!empty($errors['akte'])): ?>
            <span class="error"><?= $errors['akte'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form_isi">
            <label for="ijazah">Ijazah / SKL (Surat keterangan Lulus) : <span class="wajib">*</span></label>
            <input type="file" 
                id="pas_foto" 
                name="ijazah" 
            >
            <?php if(!empty($errors['ijazah'])): ?>
            <span class="error"><?= $errors['ijazah'] ?></span>
            <?php endif; ?>
        </div>
        
        <div class="form_isi">
            <label for="pas_foto">Foto Pas Siswa (Upload) : (Max ukuran file 5 mb jpg,png,tiff.) <span class="wajib">*</span></label>
            <input type="file" 
                id="pas_foto" 
                name="foto" 
                accept=".jpg, .jpeg, .png" 
            >
            <?php if(!empty($errors['foto'])): ?>
            <span class="error"><?= $errors['foto'] ?></span>
            <?php endif; ?>
        </div>
        <h2>Data Ayah & Ibu</h2>
        <hr>
        <div class="form_isi">
            <label for="nama_wali">Nama Ayah : <span class="wajib">*</span></label>
            <input type="text" id="nama_wali" name="nama_ayah" placeholder="Nama Lengkap Ayah">
            <?php if(!empty($errors['nama_ayah'])): ?>
            <span class="error"><?= $errors['nama_ayah'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form_isi">
                <label for="">Keadaan Ayah : <span class="wajib">*</span></label>
                <div class="radio-group-horizontal">
                    <input type="radio" id="masih_hidup" name="keadaan_ayah" value="masih hidup">
                    <label for="masih hidup">Masih Hidup</label>
                    
                    <input type="radio" id="sudah_tidak_ada" name="keadaan_ayaha">
                    <label for="sta">Sudah Tidak Ada</label>
                    <?php if(!empty($errors['keadaan'])): ?>
            <span class="error"><?= $errors['keadaan'] ?></span>
            <?php endif; ?>
                </div>
        </div>

        <div class="form_isi">
            <label for="">Alamat Ayah : <span class="wajib">*</span></label>
            <input type="text" id="alamat_ayah" name="alamat_ayah" placeholder="Alamat Ayah">
            <?php if(!empty($errors['alamat_ayah'])): ?>
            <span class="error"><?= $errors['alamat_ayah'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form_isi">
            <label for="">No Telepon Ayah : <span class="wajib">*</span></label>
            <input type="text" id="no_hp_ayah" name="no_hp_ayah" placeholder="No Hp Ayah">
            <?php if(!empty($errors['no_hp_ayah'])): ?>
            <span class="error"><?= $errors['no_hp_ayah'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form_isi">
            <label for="">Pekerjaan Ayah <span class="wajib">*</span></label>
            <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah">
            <?php if(!empty($errors['pekerjaan_ayah'])): ?>
            <span class="error"><?= $errors['pekerjaan_ayah'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form_isi">
            <label for="">Gaji Ayah : <span class="wajib">*</span></label>
            <select name="gaji" id="gaji_ayah">
                <option value="0">-- Pilih Gaji Ayah --</option>
                <option value="1">-- Kurang Dari Rp 500.000 --</option>
                <option value="2">-- Rp 500.001 Sampai Rp 1.000.000 --</option>
                <option value="3">-- Rp 1.000.001 Sampai Rp 1.500.000 --</option>
                <option value="4">-- Rp 1.500.001 Sampai Rp 2.000.000 --</option>
                <option value="5">-- Rp 2.000.001 Sampai Rp 2.500.000 --</option>
                <option value="6">-- Rp 2.500.001 Sampai Rp 3.000.000 --</option>
                <option value="6">-- Rp 3.000.001 Sampai Rp 3.500.000 --</option>
                <option value="6">-- Rp 3.500.001 Sampai Rp 4.000.000 --</option>
                <option value="6">-- Rp 4.000.001 Sampai Rp 4.500.000 --</option>
                <option value="6">-- Rp 4.500.001 Sampai Rp 5.000.000 --</option>
                <option value="6">-- Rp 5.000.001 Sampai Rp 5.500.000 --</option>
                <option value="6">-- Rp 5.500.001 Sampai Rp 6.000.000 --</option>
                <option value="6">-- Rp 6.000.001 Sampai Rp 6.500.000 --</option>
                <option value="6">-- Rp 6.500.001 Sampai Rp 7.000.000 --</option>
            </select>
            <?php if(!empty($errors['gaji_ayah'])): ?>
            <span class="error"><?= $errors['gaji_ayah'] ?></span>
            <?php endif; ?>
        </div>


        <div class="form_isi">
            <label for="nama_wali">Nama Ibu : <span class="wajib">*</span></label>
            <input type="text" id="nama_ibu" name="nama_ibu" placeholder="Nama Lengkap Ibu">
            <?php if(!empty($errors['nama_ibu'])): ?>
            <span class="error"><?= $errors['nama_ibu'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form_isi">
            <label for="">Keadaan Ibu : <span class="wajib">*</span></label>
                <div class="radio-group-horizontal">
                    <input type="radio" id="masih_hidup" name="kedaan_ibu" value="masih hidup">
                    <label for="masih hidup">Masih Hidup</label>
                    <input type="radio" id="sudah_tidak_ada" name="keadaan_ibu" value="sta">
                    <label for="sta">Sudah Tidak Ada</label>
                    <?php if(!empty($errors['keadaan_ibu'])): ?>
            <span class="error"><?= $errors['keadaan_ibu'] ?></span>
            <?php endif; ?>
                </div>
        </div>

        <div class="form_isi">
            <label for="">Alamat Ibu : <span class="wajib">*</span></label>
            <input type="text" id="alamat_ibu" name="alamat_ibu" placeholder="Alamat Ibu">
            <?php if(!empty($errors['alamat_ibu'])): ?>
            <span class="error"><?= $errors['alamat_ibu'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form_isi">
            <label for="">No Telepon Ibu : <span class="wajib">*</span></label>
            <input type="text" id="no_hp_ibu" name="no_hp_ibu" placeholder="No Hp Ibu">
            <?php if(!empty($errors['no_hp_ibu'])): ?>
            <span class="error"><?= $errors['no_hp_ibu'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form_isi">
            <label for="">Pekerjaan Ibu <span class="wajib">*</span></label>
            <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu">
            <?php if(!empty($errors['pekerjaan_ibu'])): ?>
            <span class="error"><?= $errors['pekerjaan_ibu'] ?></span>
            <?php endif; ?>
        </div>

        <div class="form_isi">
            <label for="">Gaji Ibu : <span class="wajib">*</span> </label>
            <select name="gaji" id="gaji_ibu">
                <option value="0">-- Pilih Gaji Ibu --</option>
                <option value="1">-- Kurang Dari Rp 500.000 --</option>
                <option value="2">-- Rp 500.001 Sampai Rp 1.000.000 --</option>
                <option value="3">-- Rp 1.000.001 Sampai Rp 1.500.000 --</option>
                <option value="4">-- Rp 1.500.001 Sampai Rp 2.000.000 --</option>
                <option value="5">-- Rp 2.000.001 Sampai Rp 2.500.000 --</option>
                <option value="6">-- Rp 2.500.001 Sampai Rp 3.000.000 --</option>
                <option value="6">-- Rp 3.000.001 Sampai Rp 3.500.000 --</option>
                <option value="6">-- Rp 3.500.001 Sampai Rp 4.000.000 --</option>
                <option value="6">-- Rp 4.000.001 Sampai Rp 4.500.000 --</option>
                <option value="6">-- Rp 4.500.001 Sampai Rp 5.000.000 --</option>
                <option value="6">-- Rp 5.000.001 Sampai Rp 5.500.000 --</option>
                <option value="6">-- Rp 5.500.001 Sampai Rp 6.000.000 --</option>
                <option value="6">-- Rp 6.000.001 Sampai Rp 6.500.000 --</option>
                <option value="6">-- Rp 6.500.001 Sampai Rp 7.000.000 --</option>
            </select>
            <?php if(!empty($errors['gaji_ibu'])): ?>
            <span class="error"><?= $errors['gaji_ibu'] ?></span>
            <?php endif; ?>
        </div>        

        <div class="form-actions">
            <button type="submit">Kirim Pendaftaran</button>
        </div>
        
    </form>
</div>