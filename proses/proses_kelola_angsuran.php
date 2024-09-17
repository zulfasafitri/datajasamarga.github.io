<?php
include_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["simpan"]) && $_POST["simpan"] == "simpan") {
    $id_mitra = $_POST["id_mitra"];
    $nama_mitra = $_POST["nama_mitra"];
    $bulan = $_POST["bulan"];
    $tahun_rekap = $_POST["tahun_rekap"];
    $jumlah_angsuran = $_POST["jumlah_angsuran"];
    $jumlah_tunggakan = $_POST["jumlah_tunggakan"];
    $status = $_POST["status"];
    $omzet = $_POST["omzet"];
    $jumlah_tenaga_kerja = $_POST["jumlah_tenaga_kerja"];
    $keterangan = $_POST["keterangan"];

    // Ambil data tambahan dari tabel mitra
    $stmt_mitra = $koneksi->prepare("SELECT tahun, alamat, pinjaman FROM mitra WHERE id_mitra = ?");
    $stmt_mitra->bind_param("i", $id_mitra);
    $stmt_mitra->execute();
    $stmt_mitra->bind_result($tahun, $alamat, $pinjaman);
    $stmt_mitra->fetch();
    $stmt_mitra->close();

    // Masukkan data ke dalam tabel angsuran
    $stmt = $koneksi->prepare("INSERT INTO angsuran (id_mitra, bulan, tahun_rekap, jumlah_angsuran, jumlah_tunggakan, status, omzet, jumlah_tenaga_kerja, keterangan) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssss", $id_mitra, $bulan, $tahun_rekap, $jumlah_angsuran, $jumlah_tunggakan, $status, $omzet, $jumlah_tenaga_kerja, $keterangan);

    if ($stmt->execute()) {
        header("location:../index.php?page=view_angsuran");
        exit();
    } else {
        // Tampilkan pesan kesalahan jika query gagal
        echo "Error: " . $stmt->error;
    }
}
?>
