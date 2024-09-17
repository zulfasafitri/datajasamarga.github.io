<?php
$bulan = $_POST["bulan"];
$tahun = $_POST["tahun"];

// Query untuk mengambil data angsuran berdasarkan bulan dan tahun
$sql = "SELECT * FROM angsuran WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'";
$result = $koneksi->query($sql);

if ($result->num_rows > 0) {
    $filename = "data_angsuran_" . $bulan . "_" . $tahun . ".csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename=' . $filename);

    $output = fopen('php://output', 'w');
    $header = array('ID Mitra', 'Bulan', 'Tahun', 'Pinjaman', 'Jumlah Angsuran', 'Jumlah Tunggakan', 'Status', 'Omzet', 'Jumlah Tenaga Kerja', 'Keterangan');
    fputcsv($output, $header);

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit();
} else {
    echo "Tidak ada data untuk bulan $bulan tahun $tahun";
}


?>
