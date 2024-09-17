<head>
<script src="js/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" href="resources/css/style.css">

<script>
        $(document).ready(function() {
            var availableMitra = [
                <?php
                $sql_mitra = "SELECT id_mitra, nama, alamat, tahun, pinjaman FROM mitra";
                $result_mitra = $koneksi->query($sql_mitra);

                if ($result_mitra->num_rows > 0) {
                    while ($row_mitra = $result_mitra->fetch_assoc()) {
                        echo "{ value: '" . $row_mitra['id_mitra'] . "', label: '" . $row_mitra['id_mitra'] . ' - ' . $row_mitra['nama'] . ' - ' . $row_mitra['alamat'] . ' - ' . $row_mitra['tahun'] . "', pinjaman: '" . $row_mitra['pinjaman'] . "' },";
                    }
                }
                ?>
            ];

            $("#nama_mitra").on('input', function() {
                var currentInput = $(this).val().toLowerCase();
                var suggestions = [];

                for (var i = 0; i < availableMitra.length; i++) {
                    if (availableMitra[i].label.toLowerCase().includes(currentInput)) {
                        suggestions.push(availableMitra[i].label);
                    }
                }

                var suggestionsHtml = '';
                for (var i = 0; i < suggestions.length; i++) {
                    suggestionsHtml += '<span>' + suggestions[i] + '</span><br>';
                }
                $('#saran_nama_mitra').html(suggestionsHtml).show();
            });

            $(document).on('click', function(event) {
                if (!$(event.target).closest('#nama_mitra, #saran_nama_mitra').length) {
                    $('#saran_nama_mitra').hide();
                } else {
                    $('#saran_nama_mitra').show();
                }
            });

            $('#saran_nama_mitra').on('click', 'span', function() {
            var selectedName = $(this).text().trim();
            $('#nama_mitra').val(selectedName);
            $('#saran_nama_mitra').hide();

            var pinjamanValue = '';
            var idMitraValue = '';
            for (var i = 0; i < availableMitra.length; i++) {
                if (availableMitra[i].label.toLowerCase() === selectedName.toLowerCase()) {
                    pinjamanValue = availableMitra[i].pinjaman;
                    idMitraValue = availableMitra[i].value; // Ambil ID Mitra
                    break;
                }
            }
            $('#pinjaman').val(pinjamanValue);
            $('#id_mitra').val(idMitraValue); // Set ID Mitra
            });


            document.getElementById('jumlah_angsuran').addEventListener('input', function() {
                var jumlahAngsuran = parseFloat(this.value) || 0;
                var pinjaman = parseFloat($('#pinjaman').val()) || 0;
                var jumlahTunggakan = pinjaman - jumlahAngsuran;
                document.getElementById('jumlah_tunggakan').value = jumlahTunggakan;
            });
        });
    </script>
</head>

<body>
<div class="box box-primary box-solid">
    <div class="box-header with-border">
        <h3 class="box-title">Tambah Data Angsuran</h3>
        </div>
            <div class="box-body">
                <div class="row ">
                        <div class="col-md-12">                
                            <form action="proses/proses_kelola_angsuran.php" method="POST">
                            <div class="form-group">
        <label for="nama_mitra">Nama Mitra:</label>
        <input type="text" class="form-control" id="nama_mitra" name="nama_mitra" required>
        <input type="hidden" id="id_mitra" name="id_mitra">
        <div id="saran_nama_mitra" class="suggestions-box"></div>
    </div>


                    <!-- Dropdown untuk Bulan -->
                    <div class="form-group">
                        <label>Bulan :</label>
                        <select class="form-control" name="bulan" required>
                            <?php
                            // Ambil nilai ENUM dari database untuk kolom 'bulan'
                            $sql_bulan = "SHOW COLUMNS FROM angsuran LIKE 'bulan'";
                            $result_bulan = $koneksi->query($sql_bulan);
                            
                            if ($result_bulan) {
                                $row_bulan = $result_bulan->fetch_assoc();
                                // Ambil nilai ENUM dari kolom 'bulan'
                                $enum_bulan = explode("','", substr($row_bulan['Type'], 6, -2));

                                // Tampilkan nilai-nilai ENUM sebagai pilihan dropdown
                                foreach ($enum_bulan as $option_bulan) {
                                    echo "<option value='$option_bulan'>$option_bulan</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Dropdown untuk Tahun -->
                    <div class="form-group">
                        <label>Tahun Monitoring :</label>
                        <select class="form-control" name="tahun_rekap" required>
                            <?php
                            // Ambil nilai ENUM dari database untuk kolom 'tahun'
                            $sql_tahun_rekap = "SHOW COLUMNS FROM angsuran LIKE 'tahun_rekap'";
                            $result_tahun_rekap = $koneksi->query($sql_tahun_rekap);
                            
                            if ($result_tahun_rekap) {
                                $row_tahun_rekap = $result_tahun_rekap->fetch_assoc();
                                // Ambil nilai ENUM dari kolom 'tahun_rekap'
                                $enum_tahun_rekap = explode("','", substr($row_tahun_rekap['Type'], 6, -2));

                                // Tampilkan nilai-nilai ENUM sebagai pilihan dropdown
                                foreach ($enum_tahun_rekap as $option_tahun_rekap) {
                                    echo "<option value='$option_tahun_rekap'>$option_tahun_rekap</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="pinjaman">Jumlah Pinjaman :</label>
                        <input class="form-control" name="pinjaman" id="pinjaman" value="<?php echo $pinjaman; ?>" readonly />
                    </div>

                    <div class="form-group">
                        <label for="jumlah_angsuran">Jumlah Angsuran :</label>
                        <input class="form-control" type="text" id="jumlah_angsuran" name="jumlah_angsuran" required />
                    </div>

                    <div class="form-group">
                        <label for="jumlah_tunggakan">Jumlah Tunggakan :</label>
                        <input class="form-control" name="jumlah_tunggakan" id="jumlah_tunggakan" readonly />
                    </div>

                    <!-- Dropdown untuk Status -->
                    <div class="form-group">
                        <label>Status :</label>
                        <select class="form-control" name="status" required>
                            <?php
                            // Ambil nilai ENUM dari database untuk kolom 'status'
                            $sql_status = "SHOW COLUMNS FROM angsuran LIKE 'status'";
                            $result_status = $koneksi->query($sql_status);
                            
                            if ($result_status) {
                                $row_status = $result_status->fetch_assoc();
                                // Ambil nilai ENUM dari kolom 'status'
                                $enum_status = explode("','", substr($row_status['Type'], 6, -2));

                                // Tampilkan nilai-nilai ENUM sebagai pilihan dropdown
                                foreach ($enum_status as $option_status) {
                                    echo "<option value='$option_status'>$option_status</option>";
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
                            // Ambil nilai ENUM dari database untuk kolom 'omzet'
                            $sql_omzet = "SHOW COLUMNS FROM angsuran LIKE 'omzet'";
                            $result_omzet = $koneksi->query($sql_omzet);
                            
                            if ($result_omzet) {
                                $row_omzet = $result_omzet->fetch_assoc();
                                // Ambil nilai ENUM dari kolom 'omzet'
                                $enum_omzet = explode("','", substr($row_omzet['Type'], 6, -2));

                                // Tampilkan nilai-nilai ENUM sebagai pilihan dropdown
                                foreach ($enum_omzet as $option_omzet) {
                                    echo "<option value='$option_omzet'>$option_omzet</option>";
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
                            // Ambil nilai ENUM dari database untuk kolom 'jumlah_tenaga_kerja'
                            $sql_jumlah_tenaga_kerja = "SHOW COLUMNS FROM angsuran LIKE 'jumlah_tenaga_kerja'";
                            $result_jumlah_tenaga_kerja = $koneksi->query($sql_jumlah_tenaga_kerja);
                            
                            if ($result_jumlah_tenaga_kerja) {
                                $row_jumlah_tenaga_kerja = $result_jumlah_tenaga_kerja->fetch_assoc();
                                // Ambil nilai ENUM dari kolom 'jumlah_tenaga_kerja'
                                $enum_jumlah_tenaga_kerja = explode("','", substr($row_jumlah_tenaga_kerja['Type'], 6, -2));

                                // Tampilkan nilai-nilai ENUM sebagai pilihan dropdown
                                foreach ($enum_jumlah_tenaga_kerja as $option_jumlah_tenaga_kerja) {
                                    echo "<option value='$option_jumlah_tenaga_kerja'>$option_jumlah_tenaga_kerja</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan :</label>
                        <input class="form-control" type="text" name="keterangan" required />
                    </div>

                    <div>
                        <input type="submit" name="simpan" value="simpan" class="btn btn-primary">
                        <a href="?page=view_angsuran&action=insert" class="btn btn-warning">Bersihkan</a>
                        <a href="?page=view_angsuran" class="btn btn-danger">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>