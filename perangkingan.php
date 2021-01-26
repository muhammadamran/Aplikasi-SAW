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
    header("Location: ./perangkingan.php?ntf=1");  
  } else {
    header("Location: ./perangkingan.php?ntf=6");
  }
}

// EDIT
if(isset($_POST["updateperingkat"]))    
{    
	$id_alternatif     = $_POST['id_alternatif'];
	$hasil_alternatif  = $_POST['hasil_alternatif'];
  $peringkat         = $_POST['peringkat'];
  $bulan             = $_POST['bulan'];
  $tahun             = $_POST['tahun'];

  $query = mysql_query("UPDATE alternatif SET 
    hasil_alternatif ='$hasil_alternatif',
    peringkat ='$peringkat',
    bulan ='$bulan',
    tahun ='$tahun'
    WHERE id_alternatif ='$id_alternatif'");
  if($query){
    header("Location: ./perangkingan.php?ntf=4");                                                  
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
     header("Location: ./perangkingan.php?ntf=3");                     
   } else {
    header("Location: ./perangkingan.php?ntf=6");  
  }
} else {
  header("Location: ./perangkingan.php?ntf=6");  
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
      <h2>RANGKING KARYAWAN PAGE</h2>
    </div>
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>
              Cari Berdasarkan Periode
            </h2>
            <hr>
            <form action="perangkingan.php" method="get">
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
              RANGKING KARYAWAN
            </h2>
          </div>
          <!-- ALERT -->
          <div class="header">
            <!-- <button type="button" class="btn btn-success btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#modal-add"><i class="material-icons">add_circle</i>       </button> -->
          </div>
          <div class="body">
            <div class="table-responsive">
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
                      ORDER BY a.hasil_alternatif DESC");
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
                      // echo "<td>".$hasilakhir. "</td>";
                      // if ($hasilakhir >= 90 OR $hasilakhir >= 100){
                      //   echo "<td>Terbaik 1</td>";
                      // }elseif($hasilakhir >= 80 OR $hasilakhir >= 89){
                      //   echo "<td>Terbaik 2</td>";
                      // }elseif($hasilakhir >= 60 OR $hasilakhir >= 79){
                      //   echo "<td>Terbaik 3</td>";
                      // }elseif($hasilakhir >= 0 OR $hasilakhir >= 59){
                      //   echo "<td>Terbaik 4</td>";
                      // }
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
                      <!-- UPDATE -->
                      <div class="modal fade" id="datacrips<?php echo $row['id_alternatif'];?>">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <div class="modal-header">
                              <label class="modal-title">Update Data Untuk Melihat Rangking Karyawan</label>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="" method="POST">
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Nama Karyawan</label>
                                      <input type="text" class="form-control" value="<?php echo $row['nama_alternatif']; ?>" readonly>
                                      <input type="hidden" class="form-control" name="id_alternatif" value="<?php echo $row['id_alternatif']; ?>" readonly>
                                      <!-- PERINGKAT -->
                                      <input type="hidden" class="form-control" name="hasil_alternatif" value="<?php echo $hasilakhir; ?>">
                                      <!-- KETERANGAN -->
                                      <?php
                                      if ($hasilakhir >= 90 OR $hasilakhir >= 100){
                                        ?>
                                        <input type="hidden" class="form-control" name="peringkat" value="Terbaik 1">
                                        <?php
                                      }elseif($hasilakhir >= 80 OR $hasilakhir >= 89){
                                        ?>
                                        <input type="hidden" class="form-control" name="peringkat" value="Terbaik 2">
                                        <?php
                                      }elseif($hasilakhir >= 60 OR $hasilakhir >= 79){
                                        ?>
                                        <input type="hidden" class="form-control" name="peringkat" value="Terbaik 3">
                                        <?php
                                      }elseif($hasilakhir >= 0 OR $hasilakhir >= 59){
                                        ?>
                                        <input type="hidden" class="form-control" name="peringkat" value="Terbaik 4">
                                      <?php } ?>
                                      <!-- BULAN -->
                                      <input type="hidden" class="form-control" name="bulan" value="<?php echo $row['bulan']; ?>">
                                      <!-- TAHUN -->
                                      <input type="hidden" class="form-control" name="tahun" value="<?php echo $row['tahun']; ?>">
                                    </div>
                                  </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <button type="submit" name="updateperingkat" class="btn btn-block btn-success">Update</button>
                                      <button type="button" class="btn btn-block btn-warning" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                      <!-- END UPDATE -->
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
