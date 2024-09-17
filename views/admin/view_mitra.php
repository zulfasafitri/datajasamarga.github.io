<a href="?page=view_mitra&action=insert" class="btn btn-primary " style="margin-bottom: 5px;">
    Tambah Data
</a>

<div class="box box-primary box-solid">
    <div class="box-header with-border">
         <h3 class="box-title">Data Mitra</h3>
    </div>
        <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="example1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tahun</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Pinjaman</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                      <?php


                                    $sql = mysqli_query($koneksi, "SELECT * FROM mitra");
                                    $no=1;
                                    while ($data=mysqli_fetch_assoc($sql)) {
                                        
                                     ?> 
                                    

                                      <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $data['tahun'];?></td>
                                        <td><?php echo $data['nama']; ?></td>
                                        <td><?php echo $data['alamat'];?></td>
                                        <td><?php echo $data['pinjaman'];?></td>
                                        <td>
                                          <a href="index.php?page=view_mitra&action=edit&id_mitra=<?php echo $data ['id_mitra']; ?>" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                                          <a href="index.php?page=view_mitra&action=delete&id_mitra=<?php echo $data ['id_mitra']; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                      </tr>
                                    
                                    <?php $no++;} ?>
                                  </tbody>
                                </table>
                            </div>
                      </div>
               </div>
        </div>
    </div>

