<?php 
// session_start();
require_once "../database.php";
require_once "../cekLogin.inc";
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
            <div class="radio-group-horizontal">
                <?php foreach($kebutuhan as $kbth): ?>
                <input type="checkbox" id="id_kebutuhan" name="kebutuhan" value="<?= $kbth['ID_KEBUTUHAN'] ?>"><span> <?= $kbth['NAMA_KEBUTUHAN'] ?></span> 
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

        <h2>Data Wali</h2>
        <hr>

        <div class="form_isi">
            <label for="nama_wali">Nama Wali :</label>
            <input type="text" id="nama_wali" name="nama_wali" placeholder="nama_lengkap_wali">
        </div>

        <div class="form_isi">
            <label>Hubungan Wali :</label>
            <div class="radio-group-horizontal">
                <select id="gaji_wali" name="hubungan">
                    <option value="">-- Pilih Hubungan --</option>
                    <option value="1">Anak Kandung</option>
                    <option value="2">Anak Tiri</option>
                    <option value="3">Anak Angkat</option>
                </select>
            </div>
        </div>
        
        <div class="form_isi">
            <label for="pekerjaan_wali">Pekerjaan Wali :</label>
            <input type="text" id="pekerjaan_wali" name="pekerjaan_wali" placeholder="pekerjaan_wali">
        </div>

        <div class="form_isi">
            <label for="alamat_wali">Alamat Wali :</label>
            <input type="text" id="alamat_wali" name="alamat_wali" placeholder="alamat_wali">
        </div>
        
        <div class="form_isi">
            <label for="hp_wali">No HP Wali :</label>
            <input type="text" id="hp_wali" name="no_hp_wali" placeholder="no_hp_wali">
        </div>
        
        <div class="form_isi">
            <label for="gaji_wali">Gaji Wali :</label>
            <select id="gaji_wali" name="slip_gaji">
                <option value="">-- Pilih Nominal --</option>
                <option value="1">0 Rp - 500.000 Rp</option>
                <option value="2">500.001 Rp - 1.000.000 Rp</option>
                <option value="3">1.000.001 Rp - 1.500.000 Rp</option>
                <option value="4">1.500.001 Rp - 2.000.000 Rp</option>
                <option value="5">2.000.001 Rp - 2.500.000 Rp</option>
                <option value="6">2.500.001 Rp - 3.000.000 Rp</option>
                <option value="7">3.000.001 Rp - 3.500.000 Rp</option>
                <option value="8">3.500.001 Rp - 4.000.000 Rp</option>
                <option value="9">4.000.001 Rp - 4.500.000 Rp</option>
                <option value="10">4.500.001 Rp - 5.000.000 Rp</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit">Kirim Pendaftaran</button>
        </div>
        
    </form>
</div>