<?php 
include "include/connection.php";

// ADD
if(isset($_POST["submit"]))    
{    
	$id_sikap            = $_POST['id_sikap'];
	$id_alternatif       = $_POST['id_alternatif'];
	$penampilan          = $_POST['penampilan'];
	$disiplin            = $_POST['disiplin'];
	$jujur               = $_POST['jujur'];
	$jawab               = $_POST['jawab'];

  $query = mysql_query("INSERT INTO sikap 
    (id_sikap,id_alternatif,penampilan,disiplin,jujur,jawab)
    VALUES 
    ('','$id_alternatif','$penampilan','$disiplin','$jujur','$jawab')
    ");
  if ($query) {
    header("Location: ./sikap-karyawan.php?ntf=1");  
  } else {
    header("Location: ./sikap-karyawan.php?ntf=6");
  }
}

// EDIT
if(isset($_POST["updatedatacrips"]))    
{    
	$id_sikap        = $_POST['id_sikap'];
	$ket_crips       = $_POST['ket_crips'];
	$nilai_crips     = $_POST['nilai_crips'];

  $query = mysql_query("UPDATE sikap SET 
    ket_crips ='$ket_crips',
    nilai_crips ='$nilai_crips'
    WHERE id_sikap ='$id_sikap'");
  if($query){
    header("Location: ./sikap-karyawan.php?ntf=4");                                                  
  } else {
    echo "Updated Failed - Please contact your Administrator";
  }
}

// DELETE
if(isset($_POST['delete']))
{
  $id_sikap    = $_POST['id_sikap'];

  if($id_sikap){
    $query = mysql_query("DELETE FROM sikap WHERE id_sikap = '$id_sikap'");
    if($query){
     header("Location: ./sikap-karyawan.php?ntf=3");                     
   } else {
    header("Location: ./sikap-karyawan.php?ntf=6");  
  }
} else {
  header("Location: ./sikap-karyawan.php?ntf=6");  
}
}
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
<?php 
if(isset($_GET['cari'])){
  $bcari = $_GET['bulan'];
  $tcari = $_GET['tahun'];
}
?>
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <h2>DATA HASIL ALTERNATIF KARYAWAN PAGE</h2>
    </div>
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>
              Cari Berdasarkan Periode
            </h2>
            <hr>
            <form action="data-hasil.php" method="get">
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
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>
              DATA HASIL ALTERNATIF KARYAWAN
            </h2>
          </div>
          <!-- ALERT -->
          <div class="header">
            <!-- <button type="button" class="btn btn-success btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#modal-add"><i class="material-icons">add_circle</i>       </button> -->
          </div>
          <div class="body">
            <div class="table-responsive">
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
                      WHERE b.bulan='".$_GET['bulan']."' AND b.tahun='".$_GET['tahun']."'
                      ORDER BY a.id_alternatif ASC");
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php include "include/thirdparty.php" ?>
  <?php include "include/footer.php" ?>
