<?php
include 'proses/proses_kelola_angsuran.php';

// Query untuk mengambil data angsuran dan informasi mitra dari database
$sql = "SELECT angsuran.*, mitra.nama, mitra.alamat, mitra.tahun, mitra.pinjaman
        FROM angsuran 
        INNER JOIN mitra ON angsuran.id_mitra = mitra.id_mitra";
$result = $koneksi->query($sql);

$data_angsuran = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data_angsuran[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Angsuran</title>
    <!-- Tambahkan link ke CSS jika diperlukan -->
</head>
<body>

<form action="proses/proses_kelola_angsuran.php" method="POST">
    <div class="form-group">
        <label>Bulan :</label>
        <select class="form-control" name="bulan" required>
            <?php
            // Ambil data bulan yang unik dari tabel angsuran
            $sql = "SELECT DISTINCT bulan FROM angsuran";
            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $bulan = $row['bulan'];
                    // Tampilkan sebagai pilihan dropdown
                    echo "<option value='$bulan'>$bulan</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Tahun :</label>
        <select class="form-control" name="tahun_rekap" required>
            <?php
            // Ambil data tahun yang unik dari tabel angsuran
            $sql = "SELECT DISTINCT tahun_rekap FROM angsuran";
            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tahun_rekap = $row['tahun_rekap'];
                    // Tampilkan sebagai pilihan dropdown
                    echo "<option value='$tahun_rekap'>$tahun_rekap</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="download_csv" value="Download CSV" class="btn btn-success">
    </div>
</form>



    <a href="?page=view_angsuran&action=insert" class="btn btn-primary" style="margin-bottom: 5px;">
        Tambah Data
    </a>

    <!-- Table yang menampilkan data angsuran -->
    <div class="box box-primary box-solid">


    <div class="box box-primary box-solid">
        <div class="box-header with-border">
             <h3 class="box-title">Data Angsuran</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="example1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Bulan</th>
                                    <th>Tahun Monitoring</th>
                                    <th>Pinjaman</th>
                                    <th>Jumlah Angsuran</th>
                                    <th>Jumlah Tunggakan</th>
                                    <th>Status</th>
                                    <th>Omzet</th>
                                    <th>Jumlah Tenaga Kerja</th>
                                    <th>Keterangan</th>
                                    <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $nomor = 1; // Inisialisasi nomor
                                foreach ($data_angsuran as $angsuran) : ?>
                                    <tr>
                                        <td><?php echo $nomor; ?></td>
                                        <td><?php echo $angsuran['tahun']; ?></td>
                                        <td><?php echo $angsuran['nama']; ?></td>
                                        <td><?php echo $angsuran['alamat']; ?></td>
                                        <td><?php echo $angsuran['bulan']; ?></td>
                                        <td><?php echo $angsuran['tahun_rekap']; ?></td>
                                        <td><?php echo $angsuran['pinjaman']; ?></td>
                                        <td><?php echo $angsuran['jumlah_angsuran']; ?></td>
                                        <td><?php echo $angsuran['jumlah_tunggakan']; ?></td>
                                        <td><?php echo $angsuran['status']; ?></td>
                                        <td><?php echo $angsuran['omzet']; ?></td>
                                        <td><?php echo $angsuran['jumlah_tenaga_kerja']; ?></td>
                                        <td><?php echo $angsuran['keterangan']; ?></td>
                                        <!-- Tampilkan kolom lainnya sesuai kebutuhan -->
                                        <td>
                                            <a href="index.php?page=view_angsuran&action=delete&id_angsuran=<?php echo $angsuran['id_angsuran']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                <?php $nomor++; // Tingkatkan nomor untuk setiap iterasi
                             endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambahkan skrip JavaScript jika diperlukan -->
</body>
</html>
