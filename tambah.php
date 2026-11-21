<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_tubeswad");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Driver / Pengemudi</title>
    <!-- Menghubungkan ke file CSS terpisah -->
    <link rel="stylesheet" href="css.css">
</head>
<body>

    <div class="container">
        <h1>Data Driver / Pengemudi</h1>

        <!-- Tabel Data -->
        <h3>Daftar Driver Tersimpan</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Driver</th>
                    <th>Nomor SIM</th>
                    <th>Status</th>
                    <th>Kontak</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $ambil_data = mysqli_query($koneksi, "SELECT * FROM driver");
                if(mysqli_num_rows($ambil_data) > 0) {
                    while($d = mysqli_fetch_array($ambil_data)){
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $d['nama_driver']; ?></td>
                    <td><?php echo $d['nomor_sim']; ?></td>
                    <td><?php echo $d['status']; ?></td>
                    <td><?php echo $d['kontak']; ?></td>
                </tr>
                <?php 
                    }
                } else {
                ?>
                <tr>
                    <td colspan="5" style="text-align: center; color: #718096;">Belum ada data driver.</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Form Input -->
        <div class="form-card">
            <h2>Tambah Data Driver Baru</h2>
            <form action="simpan.php" method="POST">
                <div class="form-group">
                    <label>Nama Driver</label>
                    <input type="text" name="nama_driver" placeholder="Masukkan nama lengkap..." required>
                </div>

                <div class="form-group">
                    <label>Nomor SIM</label>
                    <input type="text" name="nomor_sim" placeholder="Masukkan nomor SIM..." required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Kontak</label>
                    <input type="text" name="kontak" placeholder="Masukkan nomor telepon/kontak..." required>
                </div>

                <button type="submit">Simpan Data</button>
            </form>
        </div>
    </div>

require "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jenis = $_POST["jenis"];
    $durasi = $_POST["durasi"];
    $ketentuan = $_POST["ketentuan"];

    $sql = "INSERT INTO daftar_paket_rental (jenis_paket, durasi, ketentuan)
            VALUES (?, ?, ?)";
    mysqli_execute_query($koneksi, $sql, [$jenis, $durasi, $ketentuan]);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formulir Tambah Paket Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand navbar-dark menu-atas">
        <div class="container">
            <span class="navbar-brand">Rental Mobil</span>
            <div class="navbar-nav">
                <a class="nav-link" href="index.php">Daftar Paket</a>
                <a class="nav-link" href="tambah.php">Tambah Paket</a>
            </div>
        </div>
    </nav>

    <div class="container konten">
        <h1>Tambah Paket Rental</h1>

        <form method="post">
            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis Paket</label>
                <select class="form-select" id="jenis" name="jenis">
                    <option value="Lepas Kunci">Lepas Kunci</option>
                    <option value="All-in">All-in</option>
                    <option value="Luar Kota">Luar Kota</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="durasi" class="form-label">Durasi (hari)</label>
                <input type="number" class="form-control" id="durasi" name="durasi" required>
            </div>

            <div class="mb-3">
                <label for="ketentuan" class="form-label">Ketentuan</label>
                <textarea class="form-control" id="ketentuan" name="ketentuan" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>