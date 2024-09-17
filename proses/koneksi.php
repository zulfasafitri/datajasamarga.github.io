<?php
// Menggunakan koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "jasamargadb");

// Pastikan koneksi berhasil
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}
?>


