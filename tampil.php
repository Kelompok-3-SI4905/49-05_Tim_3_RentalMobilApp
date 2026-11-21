<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_tubeswad");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Driver Tersimpan</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>

    <div class="container">
        <h1>Data Driver / Pengemudi</h1>

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

        <a href="tambah.html" style="background-color: #3498db; color: white; padding: 10px 15px; border-radius: 4px; text-decoration: none; display: inline-block; font-weight: 500;">+ Tambah Driver Baru</a>
    </div>

</body>
</html>