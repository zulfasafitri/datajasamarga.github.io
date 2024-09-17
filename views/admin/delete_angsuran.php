<?php 

	$id_angsuran = $_GET['id_angsuran'];

	$sql = mysqli_query($koneksi, "DELETE FROM angsuran WHERE id_angsuran='$id_angsuran'");

 ?>

 <script type="text/javascript">
  window.location ="?page=view_angsuran";
  </script>
