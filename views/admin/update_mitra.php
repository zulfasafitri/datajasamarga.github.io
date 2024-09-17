<?php 
    $id_mitra = $_GET["id_mitra"];
    $sql = mysqli_query($koneksi, "SELECT * FROM mitra WHERE id_mitra='$id_mitra'");
    $row = mysqli_fetch_assoc($sql);
 ?>

<div class="box box-primary box-solid">
	<div class="box-header with-border">
          <h3 class="box-title">Update Data Mitra</h3>
    </div>
      <div class="box-body">
        <div class="row ">
            <div class="col-md-12">
                
                <form action="proses/proses_kelola_mitra.php" method="POST">
                    <div class="form-group">
                        <label>ID Mitra :</label>
                        <input class="form-control" name="id_mitra" value="<?php echo $row['id_mitra'] ; ?>" readonly />
                    </div>  

                    <div class="form-group">
                        <label>Tahun :</label>
                        <input class="form-control" name="tahun" value="<?php echo $row['tahun'] ; ?>" />
                    </div>

                    <div class="form-group">
                        <label>Nama Mitra :</label>
                        <input class="form-control" name="nama" value="<?php echo $row['nama'] ; ?>" />
                    </div>
                     
                    <div class="form-group">
                        <label>Alamat :</label>
                        <textarea name="alamat" class="form-control"><?php echo $row['alamat'] ; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Pinjaman :</label>
                        <input class="form-control" name="pinjaman" value="<?php echo $row['pinjaman'] ; ?>" />
                    </div>

                    <div>
                        <input type="submit" name="simpan"  value="ubah" class="btn btn-primary">
                        <a href="?page=view_mitra" class="btn btn-danger">Kembali</a>
                    </div>
                   </form>
                </div>
        </div>
    </div>
    </div>