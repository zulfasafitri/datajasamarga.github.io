<?php 
    // Ambil nilai id_angsuran dari URL
    $id_angsuran = $_GET["id_angsuran"];

    // Lakukan query dengan JOIN untuk mendapatkan informasi dari kedua tabel
    $sql = mysqli_query($koneksi, "SELECT angsuran.*, mitra.* FROM angsuran JOIN mitra ON angsuran.id_mitra = mitra.id_mitra WHERE angsuran.id_angsuran='$id_angsuran'");
    $row = mysqli_fetch_assoc($sql);
?>


<div class="box box-primary box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Update Data Angsuran</h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <form action="proses/proses_kelola_angsuran.php" method="POST">
                    <div class="form-group">
                        <label>ID Angsuran :</label>
                        <input class="form-control" name="id_angsuran" value="<?php echo $row['id_angsuran']; ?>" readonly />
                    </div>

                    <!-- Tampilkan informasi angsuran yang ingin diubah -->
                    <!-- Dropdown untuk Bulan -->
                    <div class="form-group">
                        <label>Bulan :</label>
                        <select class="form-control" name="bulan" required>
                            <?php
                            // Ambil nilai unik dari kolom 'bulan' di tabel 'angsuran'
                            $sql_bulan = "SELECT DISTINCT bulan FROM angsuran";
                            $result_bulan = $koneksi->query($sql_bulan);
                            
                            if ($result_bulan->num_rows > 0) {
                                while ($row_bulan = $result_bulan->fetch_assoc()) {
                                    $bulan = $row_bulan['bulan'];
                                    echo "<option value='$bulan'>$bulan</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Dropdown untuk Tahun Rekap -->
                    <div class="form-group">
                        <label>Tahun Rekap :</label>
                        <select class="form-control" name="tahun_rekap" required>
                            <?php
                            // Ambil nilai unik dari kolom 'tahun_rekap' di tabel 'angsuran'
                            $sql_tahun = "SELECT DISTINCT tahun_rekap FROM angsuran";
                            $result_tahun = $koneksi->query($sql_tahun);
                            
                            if ($result_tahun->num_rows > 0) {
                                while ($row_tahun = $result_tahun->fetch_assoc()) {
                                    $tahun = $row_tahun['tahun_rekap'];
                                    echo "<option value='$tahun'>$tahun</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Pinjaman :</label>
                        <input class="form-control" name="pinjaman" id="pinjaman" value="<?php echo $pinjaman; ?>" readonly />
                    </div>

                    <div class="form-group">
                        <label>Jumlah Angsuran :</label>
                        <input class="form-control" type="text" id="jumlah_angsuran" name="jumlah_angsuran" required/>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Tunggakan :</label>
                        <input class="form-control" name="jumlah_tunggakan" id="jumlah_tunggakan" readonly />
                    </div>

                    <script>
                        // Menambahkan event listener untuk input jumlah angsuran
                        document.getElementById('jumlah_angsuran').addEventListener('input', function() {
                            // Mengambil nilai pinjaman dari PHP (dapat disesuaikan)
                            var pinjaman = <?php echo $pinjaman; ?>;
                            
                            // Mengambil nilai jumlah angsuran dari input
                            var jumlahAngsuran = parseFloat(this.value) || 0; // Mengonversi ke angka, default ke 0 jika tidak valid

                            // Melakukan perhitungan untuk mendapatkan jumlah tunggakan
                            var jumlahTunggakan = pinjaman - jumlahAngsuran;

                            // Menyimpan hasil perhitungan ke input jumlah tunggakan
                            document.getElementById('jumlah_tunggakan').value = jumlahTunggakan;
                        });
                    </script>
                    <!-- Dropdown untuk Status -->
                    <div class="form-group">
                        <label>Status :</label>
                        <select class="form-control" name="status" required>
                            <?php
                            // Ambil nilai unik dari kolom 'status' di tabel 'angsuran'
                            $sql_status = "SELECT DISTINCT status FROM angsuran";
                            $result_status = $koneksi->query($sql_status);
                            
                            if ($result_status->num_rows > 0) {
                                while ($row_status = $result_status->fetch_assoc()) {
                                    $status = $row_status['status'];
                                    echo "<option value='$status'>$status</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Dropdown untuk Omzet -->
                    <div class="form-group">
                        <label>Omzet :</label>
                        <select class="form-control" name="omzet" required>
                            <?php
                            // Ambil nilai unik dari kolom 'omzet' di tabel 'angsuran'
                            $sql_omzet = "SELECT DISTINCT omzet FROM angsuran";
                            $result_omzet = $koneksi->query($sql_omzet);
                            
                            if ($result_omzet->num_rows > 0) {
                                while ($row_omzet = $result_omzet->fetch_assoc()) {
                                    $omzet = $row_omzet['omzet'];
                                    echo "<option value='$omzet'>$omzet</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Dropdown untuk Jumlah Tenaga Kerja -->
                    <div class="form-group">
                        <label>Jumlah Tenaga Kerja :</label>
                        <select class="form-control" name="jumlah_tenaga_kerja" required>
                            <?php
                            // Ambil nilai unik dari kolom 'jumlah_tenaga_kerja' di tabel 'angsuran'
                            $sql_tenaga_kerja = "SELECT DISTINCT jumlah_tenaga_kerja FROM angsuran";
                            $result_tenaga_kerja = $koneksi->query($sql_tenaga_kerja);
                            
                            if ($result_tenaga_kerja->num_rows > 0) {
                                while ($row_tenaga_kerja = $result_tenaga_kerja->fetch_assoc()) {
                                    $jumlah_tenaga_kerja = $row_tenaga_kerja['jumlah_tenaga_kerja'];
                                    echo "<option value='$jumlah_tenaga_kerja'>$jumlah_tenaga_kerja</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Keterangan :</label>
                        <input class="form-control" name="keterangan" value="<?php echo $row['keterangan']; ?>" />
                    </div>

                    <div>
                        <input type="submit" name="simpan"  value="ubah" class="btn btn-primary">
                        <a href="?page=view_angsuran" class="btn btn-danger">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
