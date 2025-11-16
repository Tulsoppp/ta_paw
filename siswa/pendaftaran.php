<?php 
// session_start();
require_once "../cekLogin.inc";
require_once "../includes/header.php";
require_once "../includes/navbarSiswa.php";
 ?>
<div class="form_pendaftaran">
    <h1>Form Pendaftaran Siswa Baru PPDB Sekolah Inklusi</h1>
    <form action="proses_pendaftaran.php" method="POST" enctype="multipart/form-data" class="isi_pendaftaran">
        
        <h2>Data Pribadi Siswa</h2>
        <hr>

        <div class="form_isi">
            <label for="nama_lengkap">Nama Lengkap :</label>
            <input type="text" id="nama_lengkap" name="nama_siswa">
        </div>

        <div class="form_isi">
            <label>Jenis Kelamin :</label>
            <div class="radio-group-horizontal">
                <input type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-laki">
                <label for="laki-laki">Laki-laki</label>
                
                <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan">
                <label for="perempuan">Perempuan</label>
            </div>
        </div>

        <div class="form_isi">
            <label>Agama :</label>
            <input type="text" id="agama" name="agama_siswa">
        </div>
        
        <div class="form_isi">
            <label for="tempat_lahir">Tempat Lahir :</label>
            <input type="text" id="tempat_lahir" name="tempat_lahir">
        </div>
        
        <div class="form_isi">
            <label for="tgl_lahir">Tanggal Lahir :</label>
            <input type="date" id="tgl_lahir" name="tanggal_lahir">
        </div>
        
        <div class="form_isi">
            <label for="alamat_siswa">Alamat Siswa :</label>
            <input type="text" id="alamat_siswa" name="alamat_siswa">
        </div>
        
        <div class="form_isi">
            <label for="hp_siswa">No HP Siswa :</label>
            <input type="text" id="hp_siswa" name="no_hp_siswa">
        </div>

        <div class="form_isi">
            <label for="jurusan">Pilihan Jurusan:</label>
            <select id="jurusan" name="id_jurusan">
                <option value="">-- Pilih Jurusan --</option>
                <option value="1">IPA (Ilmu Pengetahuan Alam)</option>
                <option value="2">IPS (Ilmu Pengetahuan Sosial)</option>
            </select>
        </div>
        
        <h2>Kebutuhan Khusus</h2>
        <hr>
        <div class="form_isi">
            <label for="kebutuhan">Pilih jika siswa memiliki kebutuhan khusus/kekurangan:</label>
            <select id="kebutuhan" name="id_kebutuhan">
                <option value="">-- Pilih Kebutuhan --</option>
                <option value="1">Normal</option>
                <option value="2">Tunanetra</option>
                <option value="3">Tunarungu</option>
                <option value="4">Kesulitan Belajar</option>
            </select>
        </div>
        <h2>Data Dokumen</h2>
        <hr>
        
        <div class="form_isi">
            <label for="kk">Nomor Kartu Keluarga :</label>
            <input type="file" 
                id="pas_foto" 
                name="foto_siswa" 
                accept=".jpg, .jpeg, .png" 
            >
        </div>

        <div class="form_isi">
            <label for="akta">Nomor Akte Kelahiran :</label>
            <input type="file" 
                id="pas_foto" 
                name="foto_siswa" 
                accept=".jpg, .jpeg, .png" 
            >
        </div>

        <div class="form_isi">
            <label for="ijazah">Nomor Ijazah :</label>
            <input type="file" 
                id="pas_foto" 
                name="foto_siswa" 
                accept=".jpg, .jpeg, .png" 
            >
        </div>
        
        <div class="form_isi">
            <label for="pas_foto">Foto Pas Siswa (Upload) :</label>
            <input type="file" 
                id="pas_foto" 
                name="foto_siswa" 
                accept=".jpg, .jpeg, .png" 
            >
        </div>

        <h2>Data Wali</h2>
        <hr>

        <div class="form_isi">
            <label for="nama_wali">Nama Wali :</label>
            <input type="text" id="nama_wali" name="nama_wali">
        </div>

        <div class="form_isi">
            <label>Status Wali (Orang Tua) :</label>
            <div class="radio-group-horizontal">
                <input type="radio" id="hidup" name="status_wali" value="Hidup">
                <label for="hidup">Masih Hidup</label>
                
                <input type="radio" id="wafat" name="status_wali" value="Wafat">
                <label for="wafat">Sudah Tidak Ada</label>
            </div>
        </div>

        <div class="form_isi">
            <label>Hubungan Wali :</label>
            <div class="radio-group-horizontal">
                <input type="radio" id="kandung" name="hubungan" value="Kandung">
                <label for="kandung">Anak Kandung</label>
                
                <input type="radio" id="angkat" name="hubungan" value="Angkat">
                <label for="angkat">Anak Angkat</label>
                
                <input type="radio" id="tiri" name="hubungan" value="Tiri">
                <label for="tiri">Anak Tiri</label>
            </div>
        </div>
        
        <div class="form_isi">
            <label for="pekerjaan_wali">Pekerjaan Wali :</label>
            <input type="text" id="pekerjaan_wali" name="pekerjaan_wali">
        </div>

        <div class="form_isi">
            <label for="alamat_wali">Alamat Wali :</label>
            <input type="text" id="alamat_wali" name="alamat_wali">
        </div>
        
        <div class="form_isi">
            <label for="hp_wali">No HP Wali :</label>
            <input type="text" id="hp_wali" name="no_hp_wali">
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