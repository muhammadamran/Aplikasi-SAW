<?php 
include "include/connection.php";
// $result = mysql_query("SELECT * FROM pengguna WHERE username = '$user'");
$result = mysql_query("SELECT * FROM pengguna");
$data = mysql_fetch_array($result);

// CHANGE PASSWORD
if(isset($_POST["changepassword"]))    
{    
  $id          = $_POST['id'];
  $password    = $_POST['password'];

  $query = mysql_query("UPDATE pengguna SET 
    password = md5('$password')
    WHERE id ='$id'");
  if($query){
    header("Location: ./logout.php");                                                  
  } else {
    echo "Updated Failed - Please contact your Administrator";
  }
} 

// UBAH DATA
if(isset($_POST["update"]))    
{    
  $id      = $_POST['id'];
  $username     = $_POST['username'];
  $nama_lengkap    = $_POST['nama_lengkap'];
  
  $query = mysql_query("UPDATE pengguna SET 
    username = '$username',
    nama_lengkap = '$nama_lengkap'
    WHERE id ='$id'");
  if($query){
    header("Location: ./index.php?ntf=0");                                                  
  } else {
    header("Location: ./index.php?ntf=6");  
  }
}

// UBAH FOTO
if(isset($_POST["updatefoto"]))    
{    
  $id      = $_POST['id'];

  $oke = $_FILES['foto']['name'];
  $file_tmp = $_FILES['foto']['tmp_name'];

  move_uploaded_file($file_tmp, './assets/images/user/'.$oke);
  
  $query = mysql_query("UPDATE pengguna SET 
    foto = '$oke'
    WHERE id ='$id'");
  // var_dump(expression)
  if($query){
    header("Location: ./index.php?ntf=5");                                                  
  } else {
    header("Location: ./index.php?ntf=6");  
  }
}
?>

<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/sidebar.php" ?>
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <h2>HOME</h2>
    </div>
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h1>Aplikasi SPK-SAW</h1>
            <hr>
            <p align="justify">
              SPK-SAW Penilaian Kinerja Karyawan adalah salah satu Sistem Pendukung Keputusan Penilaian Kinerja Karyawan yang menggunakan metode Simple Additive Weighting (SAW) dalam mengambil suatu keputusan yaitu mencari karyawan terbaik setiap bulan nya di Kandatel Bone guna memberikan reward kepada karyawan terbaik.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="row clearfix">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <div class="card">
          <div class="header">
            <h2>
              Cari Berdasarkan Periode
            </h2>
            <hr>
            <form action="index.php" method="get">
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
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <div class="card">
          <div class="header">
            <h2>
              Karyawan Terbaik
            </h2>
            <hr>
            <?php
            $con=mysqli_connect($conhost,$conuser,$conpassword,$dbname);
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            if(isset($_GET['bulan']) && ($_GET['tahun'] )){
              $bcari = $_GET['bulan'];
              $tcari = $_GET['tahun'];
              $result = mysqli_query($con,"SELECT * FROM alternatif WHERE bulan='".$_GET['bulan']."' AND tahun='".$_GET['tahun']."' ORDER BY hasil_alternatif DESC LIMIT 1");
            }else{
              $result = mysqli_query($con,"SELECT * FROM alternatif ORDER BY hasil_alternatif DESC LIMIT 1");
            }
            if(mysqli_num_rows($result)>0){
              while($row = mysqli_fetch_array($result))
              {
                ?>
                <p align="justify">“Dalam penilaian kinerja karyawan di Kandatel Bone periode <b><?= $row['bulan']; ?> <?= $row['tahun']; ?></b> yang menempati peringkat pertama atau yang memperoleh skor tertinggi adalah <b><?= $row['nama_alternatif']; ?></b>”</p>
              <?php } } mysqli_close($con); ?>
            </div>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
            <div class="header">
              <h2>
                Grafik Karyawan Kandatel Bone
              </h2>
              <hr>
              <canvas id="myChart"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4">
       <div class="page-header">
        <h5>Nilai Preferensi/Crips</h5>
      </div>
      <div class="panel panel-default">
        <div class="panel-body">
         <ol>
          <?php
          $con=mysqli_connect($conhost,$conuser,$conpassword,$dbname);
          if (mysqli_connect_errno())
          {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }
          $result = mysqli_query($con,"SELECT * FROM nilai ORDER BY id_nilai ASC");

          if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result))
            {
              echo "<li>".$row['ket_nilai'] . " (".$row['ket_nilai'] . ")</li>";
              ?>
            <?php } } mysqli_close($con); ?>
          </ol>
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4">
     <div class="page-header">
      <h5>Kriteria-Kriteria</h5>
    </div>
    <div class="panel panel-default">
      <div class="panel-body">
       <ol>
        <?php
        $con=mysqli_connect($conhost,$conuser,$conpassword,$dbname);
        if (mysqli_connect_errno())
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $result = mysqli_query($con,"SELECT * FROM kriteria ORDER BY id_kriteria ASC");

        if(mysqli_num_rows($result)>0){
          while($row = mysqli_fetch_array($result))
          {
            echo "<li>".$row['inisial_kriteria'] . " (".$row['nama_kriteria'] . ")</li>";
            ?>
          <?php } } mysqli_close($con); ?>
        </ol>
      </div>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-4">
   <div class="page-header">
    <h5>Data Karyawan</h5>
  </div>
  <div class="panel panel-default">
    <div class="panel-body">
     <ol>
      <?php
      $con=mysqli_connect($conhost,$conuser,$conpassword,$dbname);
      if (mysqli_connect_errno())
      {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      $result = mysqli_query($con,"SELECT * FROM alternatif ORDER BY id_alternatif ASC");

      if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_array($result))
        {
          echo "<li>".$row['inisial_alternatif'] . " (".$row['nama_alternatif'] . ")</li>";
          ?>
        <?php } } mysqli_close($con); ?>
      </ol>
    </div>
  </div>
</div>
<div id="container2" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
  var ctx = document.getElementById("myChart").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
      <?php
      $con=mysqli_connect($conhost,$conuser,$conpassword,$dbname);
      if (mysqli_connect_errno())
      {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      if(isset($_GET['bulan']) && ($_GET['tahun'] )){
        $bcari = $_GET['bulan'];
        $tcari = $_GET['tahun'];
        $result = mysqli_query($con,"SELECT * FROM alternatif WHERE bulan='".$_GET['bulan']."' AND tahun='".$_GET['tahun']."' ORDER BY nama_alternatif DESC");
      }else{
        $result = mysqli_query($con,"SELECT * FROM alternatif ORDER BY nama_alternatif DESC");
      }
      if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_array($result))
        {
          ?>
          "<?= $row['nama_alternatif'] ;?>",
        <?php } } mysqli_close($con); ?>
        ],
        datasets: [{
          label: '',
          data: [
          <?php
          $con=mysqli_connect($conhost,$conuser,$conpassword,$dbname);
          if (mysqli_connect_errno())
          {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }
          if(isset($_GET['bulan']) && ($_GET['tahun'] )){
            $bcari = $_GET['bulan'];
            $tcari = $_GET['tahun'];
            $result = mysqli_query($con,"SELECT * FROM alternatif WHERE bulan='".$_GET['bulan']."' AND tahun='".$_GET['tahun']."' ORDER BY nama_alternatif DESC");
          }else{
            $result = mysqli_query($con,"SELECT * FROM alternatif ORDER BY nama_alternatif DESC");
          }
          if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result))
            {
              echo "".$row['hasil_alternatif'] . ",";
              ?>
            <?php } } mysqli_close($con); ?>
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero:true
              }
            }]
          }
        }
      });
    </script>
  </div>
</section>
<?php include "include/thirdparty.php" ?>
<?php include "include/footer.php" ?>

