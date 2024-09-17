<?php 
	include_once "koneksi.php";

	$id_mitra = isset($_POST["id_mitra"]) ? $_POST["id_mitra"] : "";
	$tahun = isset($_POST["tahun"]) ? $_POST["tahun"] : "";
	$nama = isset($_POST["nama"]) ? $_POST["nama"] : "";
	$alamat = isset($_POST["alamat"]) ? $_POST["alamat"] : "";
	$pinjaman = isset($_POST["pinjaman"]) ? $_POST["pinjaman"] : "";
	$button = isset($_POST["simpan"]) ? $_POST["simpan"] : "";

	if ($button == "simpan") {
    	$sql = mysqli_query($koneksi, "INSERT INTO mitra (Tahun, Nama, Alamat, Pinjaman) 
                                	   VALUES ('$tahun', '$nama', '$alamat', '$pinjaman')");
    
    	header("location:../index.php?page=view_mitra"); 
	}
	elseif ($button == "ubah"){
    	$sql = mysqli_query($koneksi, "UPDATE mitra SET Tahun='$tahun', Nama='$nama', Alamat='$alamat', Pinjaman='$pinjaman' WHERE id_mitra='$id_mitra'");

    	header("location:../index.php?page=view_mitra");
	}
?>
