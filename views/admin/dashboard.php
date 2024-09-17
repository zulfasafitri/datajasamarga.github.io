<?php 
    $result=mysqli_query($koneksi, "SELECT count(*) as total from mitra");
    $data=mysqli_fetch_assoc($result);

    $result1=mysqli_query($koneksi, "SELECT count(*) as total from angsuran");
    $data1=mysqli_fetch_assoc($result1);
 ?>
<section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$data['total']?></h3>

              <p>Total Data Mitra</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="?page=view_mitra" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$data1['total']?><sup style="font-size: 20px"></sup></h3>

              
              <p>Jumlah Rekap Angsuran</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="?page=view_angsuran" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          
        <!-- ./col -->
      <!-- </div> -->
    </section>
    <!-- /.content -->