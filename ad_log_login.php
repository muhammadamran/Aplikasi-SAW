<?php 
include "include/connection.php";

// KODE AUTO TICKET
function kdauto($tabel, $no_tick){
  $struktur   = mysql_query("SELECT * FROM $tabel");
  $field      = mysql_field_name($struktur,0);
  $panjang    = mysql_field_len($struktur,0);
  $qry  = mysql_query("SELECT max(".$field.") FROM ".$tabel);
  $row  = mysql_fetch_array($qry);
  if ($row[0]=="") {
    $angka=1000;
  }
  else {
    $angka= substr($row[0], strlen($no_tick));
  }
  $angka++;
  $angka      =strval($angka);
  $tmp  ="";
  for($i=1; $i<=($panjang-strlen($no_tick)-strlen($angka)); $i++) {
    $tmp=$tmp."0";
  }
  return $no_tick.$tmp.$angka;
}
// DATE
function tanggal_indo($tanggal, $cetak_hari = false)
{
  $hari = array ( 1 =>    
    'Senin',
    'Selasa',
    'Rabu',
    'Kamis',
    'Jumat',
    'Sabtu',
    'Minggu'
  );
  $bulan = array (1 =>   
    'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $split    = explode('-', $tanggal);
  $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
  
  if ($cetak_hari) {
    $num = date('N', strtotime($tanggal));
    return $hari[$num] . ', ' . $tgl_indo;
  }
  return $tgl_indo;
}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
  <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/libs/css/style.css">
  <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/dataTables.bootstrap4.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/buttons.bootstrap4.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/select.bootstrap4.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/datatables/css/fixedHeader.bootstrap4.css">
  <title>OHC - Log Login</title>
  <link rel="icon" type="assets/image/png" href="assets/img/logo/xyz.jpg"/>
</head>
<style type="text/css">
  .lingkaran1{
    width: 40px;
    height: 40px;
    background: #ffffff;
    border-radius: 100%;
  }

  .lingkaran{
    width: 200px;
    height: 200px;
    background: #ffffff;
    border-radius: 100%;
  }

  .responsive img {
    max-width:100%;
    /*width:100%;*/
    height: auto;
  }
</style>
<body>
  <div class="dashboard-main-wrapper">
   <div class="dashboard-header">
    <?php include "include/header.php" ?>
  </div>
  <?php include "include/sidebar.php" ?>
  <div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="page-header">
            <h2 class="pageheader-title">Log Login Page</h2>
            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
            <div class="page-breadcrumb">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php?ntf=0" class="breadcrumb-link">Log Aktifitas</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Log Login Page</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <!-- ALERT -->
      <?php include 'include/alert/success.php' ?>
      <!-- END ALERT -->
      <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="card">
            <div class="card-header">
              <!-- <img src="assets/img/logo/xyz.jpg" width="100px"> -->
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered second" style="width:100%">
                  <thead>
                    <tr>
                      <th>LOG ID</th>
                      <th>USER</th>
                      <th>LOG TYPE</th>
                      <th>LOG DATE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $con=mysqli_connect("localhost","root","","db_riki");
                    if (mysqli_connect_errno())
                    {
                      echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }
                    $datax = $_SESSION['username'];
                    $data = mysqli_query($con,"SELECT * FROM tb_log ORDER BY log_id ASC");   
                    while($row = mysqli_fetch_array($data)){
                      echo "<td>".$row['log_id'] . "</td>";
                      echo "<td>".$row['log_user'] . "</td>";
                      echo "<td>".$row['log_type'] . "</td>";
                      echo "<td>".$row['log_date'] . "</td>";
                      echo "</tr>";
                      ?>
                    <?php } mysqli_close($con); ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include "include/footer.php" ?>
<?php include 'include/thirdparty.php'; ?>
</body>
</html>