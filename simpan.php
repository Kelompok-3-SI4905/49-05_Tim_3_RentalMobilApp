<?php
// Koneksi ke database MySQL
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_tubeswad";

$koneksi = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Ambil data dari form
$nama_driver = $_POST['nama_driver'];
$nomor_sim   = $_POST['nomor_sim'];
$status      = $_POST['status'];
$kontak      = $_POST['kontak'];

// Masukkan data ke tabel 'driver'
$query = "INSERT INTO driver (nama_driver, nomor_sim, status, kontak) VALUES ('$nama_driver', '$nomor_sim', '$status', '$kontak')";

if (mysqli_query($koneksi, $query)) {
    // Jika berhasil, kembali ke halaman tambah.php
    header("location: tambah.php");
} else {
    echo "Gagal menyimpan data: " . mysqli_error($koneksi);
}
?>