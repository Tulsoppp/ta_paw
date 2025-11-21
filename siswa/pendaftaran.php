<?php 
session_start();
if(!isset($_SESSION['login'])){
    require_once '../cekLogin.inc';;
}
require_once "../database.php";
// require_once "../cekLogin.inc";
require_once "../includes/header.php";
require_once "../includes/navbarSiswa.php";
require_once '../validasi.php';


$errors = []; // Wadah untuk menampung error
$pesan_sukses = ""; // Pesan jika berhasil

$nama = '';
$nisn = '';
$kode_daftar = '';
$password = '';
$tgl_lahir = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Ambil semua data dari form
    $nama = $_POST['nama'];
    $nisn = $_POST['nisn'];
    $kode_daftar = $_POST['kode_daftar'];
    $password = $_POST['password'];
    $tgl_lahir = $_POST['tgl_lahir'];

    // Nama (Wajib, Alfabet)
    val_required($errors, 'nama_siswa', $nama, 'Nama wajib diisi.');
    val_alpha($errors, 'nama_siswa', $nama, 'Nama harus berupa huruf dan spasi.');

    // Agama (Wajib, Alfabet)
    val_required($errors, 'agama_siswa', $nama, 'Agama wajib diisi.');
    val_alpha($errors, 'agama_siswa', $nama, 'Agama harus berupa huruf dan spasi.');

    // NISN (Wajib, Numerik, Panjang Tepat 10)
    val_required($errors, 'nisn', $nisn, 'NISN wajib diisi.');
    val_numeric($errors, 'nisn', $nisn, 'NISN harus berupa angka.');
    val_exact_length($errors, 'nisn', $nisn, 10, 'NISN harus 10 digit.');

    // (Wajib, Alfanumerik)
    val_required($errors, 'kode_daftar', $kode_daftar, 'Kode Pendaftaran wajib diisi.');
    val_alphanumeric($errors, 'kode_daftar', $kode_daftar, 'Kode Pendaftaran harus alfanumerik (huruf & angka, tanpa spasi).');

    //  Password (Wajib, Format/Panjang Minimal 8)
    val_required($errors, 'password', $password, 'Password wajib diisi.');
    val_password_format($errors, 'password', $password, 8, 'Password minimal 8 karakter.'); 


    if (empty($errors)) {
        $pesan_sukses = "SELAMAT! Semua data yang Anda masukkan VALID.";
    }
}

$jurusan=jurusan();
$kebutuhan=kebutuhan();

 ?>
<div class="form_pendaftaran">
    <h1>Form PPDB Sekolah Inklusi</h1>
    <form action="proses_pendaftaran.php" method="POST" enctype="multipart/form-data" class="isi_pendaftaran">
        
        <h2>Data Pribadi Siswa</h2>
        <hr>
        <div>
            <input type="hidden" value="<?= $_SESSION['ID_USER'] ?>" name="id_akun">
        </div>

        <div class="form_isi">
            <label for="nisn">NISN :</label>
            <input type="text" id="nisn" name="nama_siswa" placeholder="nisn">
        </div>

        <div class="form_isi">
            <label for="nama_lengkap">Nama Lengkap :</label>
            <input type="text" id="nama_lengkap" name="nama_siswa" placeholder="nama_lengkap">
        </div>

        <div class="form_isi">
            <label>Jenis Kelamin :</label>
            <div class="radio-group-horizontal">
                <input type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-Laki">
                <label for="laki-laki">Laki-laki</label>
                
                <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan">
                <label for="perempuan">Perempuan</label>
            </div>
        </div>

        <div class="form_isi">
            <label>Agama :</label>
            <input type="text" id="agama" name="agama" placeholder="agama">
        </div>
        
        <div class="form_isi">
            <label for="tempat_lahir">Tempat Lahir :</label>
            <input type="text" id="tempat_lahir" name="tempat_lahir" placeholder="tempat_lahir">
        </div>
        
        <div class="form_isi">
            <label for="tgl_lahir">Tanggal Lahir :</label>
            <input type="text" id="tgl_lahir" name="tanggal_lahir" placeholder="tahun-bulan-hari">
        </div>
        
        <div class="form_isi">
            <label for="alamat_siswa">Alamat Siswa :</label>
            <input type="text" id="alamat_siswa" name="alamat_siswa" placeholder="alamta-siswa">
        </div>
        
        <div class="form_isi">
            <label for="hp_siswa">No HP Siswa :</label>
            <input type="text" id="hp_siswa" name="no_hp_siswa" placeholder="no_hp_siswa">
        </div>

        <div class="form_isi">
            <label for="jurusan">Pilihan Jurusan :</label>
            <select id="jurusan" name="id_jurusan">
                <option value="">-- Pilih Jurusan --</option>
                <?php foreach($jurusan as $data): ?>
                <option value="<?= $data['ID_JURUSAN'] ?>"><?= $data['NAMA_JURUSAN'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <h2>Kebutuhan Khusus</h2>
        <hr>
        <div class="form_isi">
             <label for="kebutuhan">Masukan Jika Siswa Memiliki Kebutuhan Khusus :</label>
            <div class="kebutuhan">
                <?php foreach($kebutuhan as $kbth): ?>
                    <div>
                        <input type="checkbox" id="id_kebutuhan" name="kebutuhan" value="<?= $kbth['ID_KEBUTUHAN'] ?>"><span> <?= $kbth['NAMA_KEBUTUHAN'] ?></span> 
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- <br>
            <div class="form_isi">
            <label for="kebutuhan">Kebutuhan Lainnya :</label>
            <input type="text" id="id_kebutuhan" name="kebutuhan" placeholder="lainnya">
        </div> -->
        </div>
        <h2>Data Dokumen</h2>
        <hr>
        
        <div class="form_isi">
            <label for="kk" >Kartu Keluarga :</label>
            <input type="file" 
                id="pas_foto" 
                name="kk" 
            >
        </div>

        <div class="form_isi">
            <label for="akta">Akte Kelahiran :</label>
            <input type="file" 
                id="pas_foto" 
                name="akta" 
            >
        </div>

        <div class="form_isi">
            <label for="ijazah">Ijazah / SKL (Surat keterangan Lulus) :</label>
            <input type="file" 
                id="pas_foto" 
                name="ijazah" 
            >
        </div>
        
        <div class="form_isi">
            <label for="pas_foto">Foto Pas Siswa (Upload) : (Max ukuran file 5 mb jpg,png,tiff.)</label>
            <input type="file" 
                id="pas_foto" 
                name="foto" 
                accept=".jpg, .jpeg, .png" 
            >
        </div>
        <h2>Data Ayah & Ibu</h2>
        <hr>
        <div class="form_isi">
            <label for="nama_wali">Nama Ayah :</label>
            <input type="text" id="nama_wali" name="nama_ayah" placeholder="nama_lengkap_ayah">
        </div>

        <div class="form_isi">
                <label for="">Keadaan Ayah :</label>
                <div class="radio-group-horizontal">
                    <input type="radio" id="masih_hidup" name="keadaan" value="masih hidup">
                    <label for="masih hidup">Masih Hidup</label>
                    
                    <input type="radio" id="sudah_tidak_ada" name="keadaan" value="sta">
                    <label for="sta">Sudah Tidak Ada</label>
                </div>
        </div>

        <div class="form_isi">
            <label for="">Alamat Ayah :</label>
            <input type="text" id="alamat_ayah" name="alamat_ayah" placeholder="alamat_ayah">
        </div>

        <div class="form_isi">
            <label for="">No Telepon Ayah : </label>
            <input type="text" id="no_hp_ayah" name="no_hp_ayah" placeholder="no_hp_ayah">
        </div>

        <div class="form_isi">
            <label for="">Pekerjaan Ayah</label>
            <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="pekerjaan_ayah">
        </div>

        <div class="form_isi">
            <label for="">Gaji Ayah : </label>
            <input type="text" id="gaji_ayah" name="gaji_ayah" placeholder="gaji_ayah">
        </div>


        <div class="form_isi">
            <label for="nama_wali">Nama Ibu :</label>
            <input type="text" id="nama_wali" name="keadaan_ibu" placeholder="nama_lengkap_ayah">
        </div>

        <div class="form_isi">
            <label for="">Keadaan Ibu :</label>
                <div class="radio-group-horizontal">
                    <input type="radio" id="masih_hidup" name="keadaan" value="masih hidup">
                    <label for="masih hidup">Masih Hidup</label>
                    
                    <input type="radio" id="sudah_tidak_ada" name="keadaan" value="sta">
                    <label for="sta">Sudah Tidak Ada</label>
                </div>
        </div>

        <div class="form_isi">
            <label for="">Alamat Ibu :</label>
            <input type="text" id="alamat_ayah" name="alamat_ibu" placeholder="alamat_ayah">
        </div>

        <div class="form_isi">
            <label for="">No Telepon Ibu : </label>
            <input type="text" id="no_hp_ayah" name="no_hp_ibu" placeholder="no_hp_ayah">
        </div>

        <div class="form_isi">
            <label for="">Pekerjaan Ibu</label>
            <input type="text" id="pekerjaan_ayah" name="pekerjaan_ibu" placeholder="pekerjaan_ayah">
        </div>

        <div class="form_isi">
            <label for="">Gaji Ibu : </label>
            <input type="text" id="gaji_ayah" name="gaji_ibu" placeholder="gaji_ayah">
        </div>        

        <div class="form-actions">
            <button type="submit">Kirim Pendaftaran</button>
        </div>
        
    </form>
</div>