<?php 

	$id_mitra = $_GET['id_mitra'];

	$sql = mysqli_query($koneksi, "DELETE FROM mitra WHERE id_mitra='$id_mitra'");

 ?>

 <script type="text/javascript">
  window.location ="?page=view_mitra";
  </script>
