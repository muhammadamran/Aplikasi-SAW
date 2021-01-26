<?php 
if(isset($_GET['cari'])){
  $bcari = $_GET['bulan'];
  $tcari = $_GET['tahun'];
  echo "<b>Hasil pencarian : ".$cari."</b>";
}
?>
<?php 
include "include/connection.php";
?>
<style type="text/css">
  .lingkaran1{
    width: 40px;
    height: 40px;
    background: #ffffff;
    border-radius: 100%;
  }

  .lingkaran2{
    width: 50px;
    height: 50px;
    background: #ffffff;
    border-radius: 100%;
  }

  .lingkaran3{
    width: 150px;
    height: 150px;
    background: #ffffff;
    border-radius: 100%;
  }
</style>
<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/sidebar.php" ?>
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <h2>LAPORAN PENILAIAN KARYAWAN PAGE</h2>
    </div>
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>
              Cari Berdasarkan Periode
            </h2>
            <hr>
            <form action="laporan.php" method="get">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Bulan</label>
                  <select class="form-control" name="bulan" required="required">
                    <option value="">-- Pilih Bulan --</option>
                    <option value="Januari">Januari</option>
                    <option value="Februari">Februari</option>
                    <option value="Maret">Maret</option>
                    <option value="April">April</option>
                    <option value="Mei">Mei</option>
                    <option value="Juni">Juni</option>
                    <option value="Juli">Juli</option>
                    <option value="Agustus">Agustus</option>
                    <option value="September">September</option>
                    <option value="Oktober">Oktober</option>
                    <option value="November">November</option>
                    <option value="Desember">Desember</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Tahun</label>
                  <select class="form-control" name="tahun" required="required">
                    <option value="">-- Pilih Tahun --</option>
                    <option value="2010">2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                  </select>
                </div>
              </div>
              <input type="submit" class="btn btn-sm btn-danger btn-block" value="Cari">
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
        <div class="card">
          <div class="header">
            <h2>
              LAPORAN PENILAIAN KARYAWAN
            </h2>
          </div>
          <div class="header">
            <a href="laporan-cetak.php" type="button" target="_blank"><i class="material-icons">print</i></a>
          </div>
          <div class="body">
            <div class="table-responsive">
             <h5>DATA HASIL KRITERIA</h5>
             <table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th rowspan="2">Inisial Karyawan</th>
                  <th rowspan="2">Nama Karyawan</th>
                  <th rowspan="2">C1</th>
                  <th rowspan="2">C2</th>
                  <th rowspan="2">C3</th>
                  <th rowspan="2">C4</th>
                  <th rowspan="2">C5</th>
                  <th colspan="2">Periode</th>
                </tr>
                <tr>
                  <th>Bulan</th>
                  <th>Tahun</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $con=mysqli_connect($conhost,$conuser,$conpassword,$dbname);
                if (mysqli_connect_errno())
                {
                  echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
                if(isset($_GET['bulan']) && ($_GET['tahun'] )){
                  $bcari = $_GET['bulan'];
                  $tcari = $_GET['tahun'];
                  $result = mysqli_query($con,"SELECT a.id_alternatif,a.inisial_alternatif,a.nama_alternatif,a.hasil_alternatif,a.peringkat,a.bulan AS Abulan,a.tahun AS Atahun,
                    b.id_kehadiran,b.id_alternatif,b.nilai_crips AS C1,b.bulan,b.tahun,
                    c.id_kerjasama,c.id_alternatif,c.nilai_crips AS C2,c.bulan,c.tahun,
                    d.id_sikap,d.id_alternatif,d.nilai_crips AS C3,d.bulan,d.tahun,
                    e.id_kualitas,e.id_alternatif,e.nilai_crips AS C4,e.bulan,e.tahun,
                    f.id_kuantitas,f.id_alternatif,f.nilai_crips AS C5,f.bulan,f.tahun
                    FROM alternatif a 
                    JOIN kehadiran b
                    ON a.id_alternatif=b.id_alternatif
                    JOIN kerjasama c
                    ON a.id_alternatif=c.id_alternatif
                    JOIN sikap d
                    ON a.id_alternatif=d.id_alternatif
                    JOIN kualitas e
                    ON a.id_alternatif=e.id_alternatif
                    JOIN kuantitas f
                    ON a.id_alternatif=f.id_alternatif
                    WHERE b.bulan='".$_GET['bulan']."' AND b.tahun='".$_GET['tahun']."'
                    ORDER BY a.hasil_alternatif DESC LIMIT 1");
                }else{
                  $result = mysqli_query($con,"SELECT a.id_alternatif,a.inisial_alternatif,a.nama_alternatif,
                    b.id_kehadiran,b.id_alternatif,b.nilai_crips AS C1,b.bulan,b.tahun,
                    c.id_kerjasama,c.id_alternatif,c.nilai_crips AS C2,c.bulan,c.tahun,
                    d.id_sikap,d.id_alternatif,d.nilai_crips AS C3,d.bulan,d.tahun,
                    e.id_kualitas,e.id_alternatif,e.nilai_crips AS C4,e.bulan,e.tahun,
                    f.id_kuantitas,f.id_alternatif,f.nilai_crips AS C5,f.bulan,f.tahun
                    FROM alternatif a 
                    JOIN kehadiran b
                    ON a.id_alternatif=b.id_alternatif
                    JOIN kerjasama c
                    ON a.id_alternatif=c.id_alternatif
                    JOIN sikap d
                    ON a.id_alternatif=d.id_alternatif
                    JOIN kualitas e
                    ON a.id_alternatif=e.id_alternatif
                    JOIN kuantitas f
                    ON a.id_alternatif=f.id_alternatif
                    ORDER BY a.id_alternatif ASC");
                }
                if(mysqli_num_rows($result)>0){
                  while($row = mysqli_fetch_array($result))
                  {
                    echo "<tr>";
                    echo "<td>".$row['inisial_alternatif'] . "</td>";
                    echo "<td>".$row['nama_alternatif'] . "</td>";
                    echo "<td>".$row['C1'] . "</td>";
                    echo "<td>".$row['C2'] . "</td>";
                    echo "<td>".$row['C3'] . "</td>";
                    echo "<td>".$row['C4'] . "</td>";
                    echo "<td>".$row['C5'] . "</td>";
                    echo "<td>".$row['bulan'] . "</td>";
                    echo "<td>".$row['tahun'] . "</td>";
                    echo "</tr>";
                    ?>
                  <?php } } mysqli_close($con); ?>
                </tbody>
              </table>
              <br>
              <hr>
              <h5>NORMALISASI</h5>
              <table class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th rowspan="2">Inisial Karyawan</th>
                    <th rowspan="2">Nama Karyawan</th>
                    <th rowspan="2">C1</th>
                    <th rowspan="2">C2</th>
                    <th rowspan="2">C3</th>
                    <th rowspan="2">C4</th>
                    <th rowspan="2">C5</th>
                    <th colspan="2">Periode</th>
                  </tr>
                  <tr>
                    <th>Bulan</th>
                    <th>Tahun</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $con=mysqli_connect($conhost,$conuser,$conpassword,$dbname);
                  if (mysqli_connect_errno())
                  {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  }
                  if(isset($_GET['bulan']) && ($_GET['tahun'] )){
                    $bcari = $_GET['bulan'];
                    $tcari = $_GET['tahun'];
                    $result = mysqli_query($con,"SELECT a.id_alternatif,a.inisial_alternatif,a.nama_alternatif,a.hasil_alternatif,a.peringkat,a.bulan AS Abulan,a.tahun AS Atahun,
                      b.id_kehadiran,b.id_alternatif,b.nilai_crips AS C1,b.bulan,b.tahun,
                      c.id_kerjasama,c.id_alternatif,c.nilai_crips AS C2,c.bulan,c.tahun,
                      d.id_sikap,d.id_alternatif,d.nilai_crips AS C3,d.bulan,d.tahun,
                      e.id_kualitas,e.id_alternatif,e.nilai_crips AS C4,e.bulan,e.tahun,
                      f.id_kuantitas,f.id_alternatif,f.nilai_crips AS C5,f.bulan,f.tahun
                      FROM alternatif a 
                      JOIN kehadiran b
                      ON a.id_alternatif=b.id_alternatif
                      JOIN kerjasama c
                      ON a.id_alternatif=c.id_alternatif
                      JOIN sikap d
                      ON a.id_alternatif=d.id_alternatif
                      JOIN kualitas e
                      ON a.id_alternatif=e.id_alternatif
                      JOIN kuantitas f
                      ON a.id_alternatif=f.id_alternatif
                      WHERE b.bulan='".$_GET['bulan']."' AND b.tahun='".$_GET['tahun']."'
                      ORDER BY a.hasil_alternatif DESC LIMIT 1");
                  }else{
                    $result = mysqli_query($con,"SELECT a.id_alternatif,a.inisial_alternatif,a.nama_alternatif,
                      b.id_kehadiran,b.id_alternatif,b.nilai_crips AS C1,b.bulan,b.tahun,
                      c.id_kerjasama,c.id_alternatif,c.nilai_crips AS C2,c.bulan,c.tahun,
                      d.id_sikap,d.id_alternatif,d.nilai_crips AS C3,d.bulan,d.tahun,
                      e.id_kualitas,e.id_alternatif,e.nilai_crips AS C4,e.bulan,e.tahun,
                      f.id_kuantitas,f.id_alternatif,f.nilai_crips AS C5,f.bulan,f.tahun
                      FROM alternatif a 
                      JOIN kehadiran b
                      ON a.id_alternatif=b.id_alternatif
                      JOIN kerjasama c
                      ON a.id_alternatif=c.id_alternatif
                      JOIN sikap d
                      ON a.id_alternatif=d.id_alternatif
                      JOIN kualitas e
                      ON a.id_alternatif=e.id_alternatif
                      JOIN kuantitas f
                      ON a.id_alternatif=f.id_alternatif
                      ORDER BY a.id_alternatif ASC");
                  }
                  if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_array($result))
                    {   
                      $csatu= $row['C1'] / 4;
                      $cdua= $row['C2'] / 4;
                      $ctiga= $row['C3'] / 4;
                      $cempat= $row['C4'] / 4;
                      $clima= $row['C5'] / 4;
                      
                      echo "<tr>";
                      echo "<td>".$row['inisial_alternatif'] . "</td>";
                      echo "<td>".$row['nama_alternatif'] . "</td>";
                      echo "<td>".$csatu. "</td>";
                      echo "<td>".$cdua. "</td>";
                      echo "<td>".$ctiga. "</td>";
                      echo "<td>".$cempat. "</td>";
                      echo "<td>".$clima. "</td>";
                      echo "<td>".$row['bulan'] . "</td>";
                      echo "<td>".$row['tahun'] . "</td>";
                      echo "</tr>";
                      ?>
                    <?php } } mysqli_close($con); ?>
                  </tbody>
                </table>
                <br>
                <hr>
                <h5>RANGKING</h5>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th rowspan="2">Inisial Karyawan</th>
                      <th rowspan="2">Nama Karyawan</th>
                      <th rowspan="2">Peringkat </th>
                      <th rowspan="2">Keterangan </th>
                      <th colspan="2">Periode </th>
                    </tr>
                    <tr>
                      <th>Bulan</th>
                      <th>Tahun</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $con=mysqli_connect($conhost,$conuser,$conpassword,$dbname);
                    if (mysqli_connect_errno())
                    {
                      echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }
                    if(isset($_GET['bulan']) && ($_GET['tahun'] )){
                      $bcari = $_GET['bulan'];
                      $tcari = $_GET['tahun'];
                      $result = mysqli_query($con,"SELECT a.id_alternatif,a.inisial_alternatif,a.nama_alternatif,a.hasil_alternatif,a.peringkat,a.bulan AS Abulan,a.tahun AS Atahun,
                        b.id_kehadiran,b.id_alternatif,b.nilai_crips AS C1,b.bulan,b.tahun,
                        c.id_kerjasama,c.id_alternatif,c.nilai_crips AS C2,c.bulan,c.tahun,
                        d.id_sikap,d.id_alternatif,d.nilai_crips AS C3,d.bulan,d.tahun,
                        e.id_kualitas,e.id_alternatif,e.nilai_crips AS C4,e.bulan,e.tahun,
                        f.id_kuantitas,f.id_alternatif,f.nilai_crips AS C5,f.bulan,f.tahun
                        FROM alternatif a 
                        JOIN kehadiran b
                        ON a.id_alternatif=b.id_alternatif
                        JOIN kerjasama c
                        ON a.id_alternatif=c.id_alternatif
                        JOIN sikap d
                        ON a.id_alternatif=d.id_alternatif
                        JOIN kualitas e
                        ON a.id_alternatif=e.id_alternatif
                        JOIN kuantitas f
                        ON a.id_alternatif=f.id_alternatif
                        WHERE b.bulan='".$_GET['bulan']."' AND b.tahun='".$_GET['tahun']."'
                        ORDER BY a.hasil_alternatif DESC LIMIT 1");
                    }else{
                      $result = mysqli_query($con,"SELECT a.id_alternatif,a.inisial_alternatif,a.nama_alternatif,a.hasil_alternatif,a.peringkat,a.bulan AS Abulan,a.tahun AS Atahun,
                        b.id_kehadiran,b.id_alternatif,b.nilai_crips AS C1,b.bulan,b.tahun,
                        c.id_kerjasama,c.id_alternatif,c.nilai_crips AS C2,c.bulan,c.tahun,
                        d.id_sikap,d.id_alternatif,d.nilai_crips AS C3,d.bulan,d.tahun,
                        e.id_kualitas,e.id_alternatif,e.nilai_crips AS C4,e.bulan,e.tahun,
                        f.id_kuantitas,f.id_alternatif,f.nilai_crips AS C5,f.bulan,f.tahun
                        FROM alternatif a 
                        JOIN kehadiran b
                        ON a.id_alternatif=b.id_alternatif
                        JOIN kerjasama c
                        ON a.id_alternatif=c.id_alternatif
                        JOIN sikap d
                        ON a.id_alternatif=d.id_alternatif
                        JOIN kualitas e
                        ON a.id_alternatif=e.id_alternatif
                        JOIN kuantitas f
                        ON a.id_alternatif=f.id_alternatif
                        ORDER BY a.hasil_alternatif DESC");
                    }
                    if(mysqli_num_rows($result)>0){
                      while($row = mysqli_fetch_array($result))
                      {   
                        $csatu= $row['C1'] / 4;
                        $cdua= $row['C2'] / 4;
                        $ctiga= $row['C3'] / 4;
                        $cempat= $row['C4'] / 4;
                        $clima= $row['C5'] / 4;

                        $dd1 = $csatu * 25;
                        $dd2 = $cdua * 20;
                        $dd3 = $ctiga * 25;
                        $dd4 = $cempat * 15;
                        $dd5 = $clima * 15;

                        $hasilakhir = ($dd1) + ($dd2) + ($dd3) + ($dd4) + ($dd5);
                        echo "<tr>";
                        echo "<td>".$row['inisial_alternatif'] . "</td>";
                        echo "<td>".$row['nama_alternatif'] . "</td>";
                        if($row['hasil_alternatif']==NULL){
                          echo "<td align='center' width='150px'>
                          <button type='button' data-toggle='modal' data-target='#datacrips$row[id_alternatif]' title='Delete'class='btn btn-warning btn-circle waves-effect waves-circle waves-float btn-sm'><i class='material-icons'>loop</i></button>
                          </td>";
                        }else{
                          echo "<td>".$row['hasil_alternatif'] . "</td>";
                        }      
                        if($row['peringkat']==NULL){
                          echo "<td><b><i><small>Klik untuk Update di Icon Peringkat</small></i></b></td>";
                        }else{
                          echo "<td>".$row['peringkat'] . "</td>";
                        }
                        if($row['Abulan']==NULL){
                          echo "<td><b><i><small>Klik untuk Update di Icon Peringkat</small></i></b></td>";
                        }else{
                          echo "<td>".$row['Abulan'] . "</td>";
                        }
                        if($row['Atahun']==NULL){
                          echo "<td><b><i><small>Klik untuk Update di Icon Peringkat</small></i></b></td>";
                        }else{
                          echo "<td>".$row['Atahun'] . "</td>";
                        }
                        echo "</tr>";
                        ?>
                      <?php } } mysqli_close($con); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="card">
              <div class="header">
                <h2>
                  KARYAWAN TERBAIK
                </h2>
              </div>
              <div class="body">
                <div class="table-responsive">
                  <?php
                  $con=mysqli_connect($conhost,$conuser,$conpassword,$dbname);
                  if (mysqli_connect_errno())
                  {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  }
                  if(isset($_GET['bulan']) && ($_GET['tahun'] )){
                    $bcari = $_GET['bulan'];
                    $tcari = $_GET['tahun'];
                    $result = mysqli_query($con,"SELECT a.id_alternatif,a.inisial_alternatif,a.nama_alternatif,a.hasil_alternatif,a.peringkat,a.bulan AS Abulan,a.tahun AS Atahun,
                      b.id_kehadiran,b.id_alternatif,b.nilai_crips AS C1,b.bulan,b.tahun,
                      c.id_kerjasama,c.id_alternatif,c.nilai_crips AS C2,c.bulan,c.tahun,
                      d.id_sikap,d.id_alternatif,d.nilai_crips AS C3,d.bulan,d.tahun,
                      e.id_kualitas,e.id_alternatif,e.nilai_crips AS C4,e.bulan,e.tahun,
                      f.id_kuantitas,f.id_alternatif,f.nilai_crips AS C5,f.bulan,f.tahun
                      FROM alternatif a 
                      JOIN kehadiran b
                      ON a.id_alternatif=b.id_alternatif
                      JOIN kerjasama c
                      ON a.id_alternatif=c.id_alternatif
                      JOIN sikap d
                      ON a.id_alternatif=d.id_alternatif
                      JOIN kualitas e
                      ON a.id_alternatif=e.id_alternatif
                      JOIN kuantitas f
                      ON a.id_alternatif=f.id_alternatif
                      WHERE b.bulan='".$_GET['bulan']."' AND b.tahun='".$_GET['tahun']."'
                      ORDER BY a.hasil_alternatif DESC LIMIT 1");
                  }else{
                    $result = mysqli_query($con,"SELECT a.id_alternatif,a.inisial_alternatif,a.nama_alternatif,a.hasil_alternatif,a.peringkat,a.bulan AS Abulan,a.tahun AS Atahun,
                      b.id_kehadiran,b.id_alternatif,b.nilai_crips AS C1,b.bulan,b.tahun,
                      c.id_kerjasama,c.id_alternatif,c.nilai_crips AS C2,c.bulan,c.tahun,
                      d.id_sikap,d.id_alternatif,d.nilai_crips AS C3,d.bulan,d.tahun,
                      e.id_kualitas,e.id_alternatif,e.nilai_crips AS C4,e.bulan,e.tahun,
                      f.id_kuantitas,f.id_alternatif,f.nilai_crips AS C5,f.bulan,f.tahun
                      FROM alternatif a 
                      JOIN kehadiran b
                      ON a.id_alternatif=b.id_alternatif
                      JOIN kerjasama c
                      ON a.id_alternatif=c.id_alternatif
                      JOIN sikap d
                      ON a.id_alternatif=d.id_alternatif
                      JOIN kualitas e
                      ON a.id_alternatif=e.id_alternatif
                      JOIN kuantitas f
                      ON a.id_alternatif=f.id_alternatif
                      ORDER BY a.hasil_alternatif DESC LIMIT 1");
                  }
                  if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_array($result))
                    {   
                      $csatu= $row['C1'] / 4;
                      $cdua= $row['C2'] / 4;
                      $ctiga= $row['C3'] / 4;
                      $cempat= $row['C4'] / 4;
                      $clima= $row['C5'] / 4;

                      $dd1 = $csatu * 25;
                      $dd2 = $cdua * 20;
                      $dd3 = $ctiga * 25;
                      $dd4 = $cempat * 15;
                      $dd5 = $clima * 15;

                      $hasilakhir = ($dd1) + ($dd2) + ($dd3) + ($dd4) + ($dd5);
                      ?>
                      <p align="justify">“Dalam penilaian kinerja karyawan di Kandatel Bone periode <b><?= $row['bulan']; ?> <?= $row['tahun']; ?></b> yang menempati peringkat pertama atau yang memperoleh skor tertinggi adalah <b><?= $row['nama_alternatif']; ?></b>”</p>
                    <?php } } mysqli_close($con); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <?php include "include/thirdparty.php" ?>
      <?php include "include/footer.php" ?>
