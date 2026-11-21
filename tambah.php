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

</body>
</html>