    <div class="box box-primary box-solid">
    	<div class="box-header with-border">
              <h3 class="box-title">Tambah Data Mitra</h3>
        </div>
    <div class="box-body">
        <div class="row ">
            <div class="col-md-12">
                
                <form action="proses/proses_kelola_mitra.php" method="POST">
                <div class="form-group">
                        <label>ID Mitra :</label>
                        <input class="form-control" name="id_mitra" required
                        oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong !')" oninput="setCustomValidity('')"/>
                    </div>
                    <div class="form-group">
                        <label>Tahun :</label>
                        <input class="form-control" name="tahun" required
                        oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong !')" oninput="setCustomValidity('')"/>
                    </div>  

                    <div class="form-group">
                        <label>Nama Mitra :</label>
                        <input class="form-control" name="nama" required
                        oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong !')" oninput="setCustomValidity('')"/>
                    </div>


                    <div class="form-group">
                        <label>Alamat :</label>
                        <input class="form-control" type="text" name="alamat" required
                        oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong !')" oninput="setCustomValidity('')"/>
                    </div>

                    <div class="form-group">
                        <label>Pinjaman :</label>
                        <input class="form-control" name="pinjaman" required
                        oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong !')" oninput="setCustomValidity('')"/>
                    </div>
                    
                    <div>
                        <input type="submit" name="simpan"  value="simpan" class="btn btn-primary">
                        <a href="?page=view_mitra&action=insert" class="btn btn-warning">Bersihkan</a>
                        <a href="?page=view_mitra" class="btn btn-danger">Kembali</a>
                    </div>
                   </form>
                </div>
        </div>
    </div>
    </div>