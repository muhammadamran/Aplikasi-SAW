<?php 
include "include/connection.php";

// ADD
if(isset($_POST["submit"]))    
{    
	$id_kualitas         = $_POST['id_kualitas'];
	$id_alternatif       = $_POST['id_alternatif'];
	$keandalan           = $_POST['keandalan'];
	$inisiatif           = $_POST['inisiatif'];
	$kreatif             = $_POST['kreatif'];
	$motivasi            = $_POST['motivasi'];
  $bulan               = $_POST['bulan'];
  $tahun               = $_POST['tahun'];

  $query = mysql_query("INSERT INTO kualitas 
    (id_kualitas,id_alternatif,keandalan,inisiatif,kreatif,motivasi,bulan,tahun)
    VALUES 
    ('','$id_alternatif','$keandalan','$inisiatif','$kreatif','$motivasi','$bulan','$tahun')
    ");
  if ($query) {
    header("Location: ./kualitas-karyawan.php?ntf=1");  
  } else {
    header("Location: ./kualitas-karyawan.php?ntf=6");
  }
}

// EDIT
if(isset($_POST["updatedatacrips"]))    
{    
	$id_kualitas     = $_POST['id_kualitas'];
	$ket_crips       = $_POST['ket_crips'];
	$nilai_crips     = $_POST['nilai_crips'];

  $query = mysql_query("UPDATE kualitas SET 
    ket_crips ='$ket_crips',
    nilai_crips ='$nilai_crips'
    WHERE id_kualitas ='$id_kualitas'");
  if($query){
    header("Location: ./kualitas-karyawan.php?ntf=4");                                                  
  } else {
    echo "Updated Failed - Please contact your Administrator";
  }
}

// DELETE
if(isset($_POST['delete']))
{
  $id_kualitas    = $_POST['id_kualitas'];

  if($id_kualitas){
    $query = mysql_query("DELETE FROM kualitas WHERE id_kualitas = '$id_kualitas'");
    if($query){
     header("Location: ./kualitas-karyawan.php?ntf=3");                     
   } else {
    header("Location: ./kualitas-karyawan.php?ntf=6");  
  }
} else {
  header("Location: ./kualitas-karyawan.php?ntf=6");  
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
<section class="content">
  <div class="container-fluid">
    <div class="block-header">
      <h2>DATA KUALITAS KARYAWAN PAGE</h2>
		</div>
    <?php include 'include/alert/success.php' ?>
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="card">
              <div class="header">
                  <h2>
                      DATA KUALITAS KARYAWAN
                  </h2>
              </div>
              <!-- MODAL ADD -->
              <div class="modal fade" id="modal-add">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <label class="modal-title">Tambah Data Kualitas Karyawan</label>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="" method="POST">
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label>Nama Karyawan<font style="color: red">*</font></label>
                                <input type="hidden" class="form-control" name="id_kualitas">
                                <select class="form-control select2bs4" name="id_alternatif" style="width: 100%;" required="required">
                                <option value="">-- Pilih Nama Karyawan --</option>
                                    <?php
                                    $con = mysqli_connect($conhost,$conuser,$conpassword,$dbname);
                                    if (!$con){
                                        die("coneksi database gagal:".mysqli_connect_error());
                                    }
                                    $sql="SELECT * FROM alternatif ORDER BY id_alternatif ASC";

                                    $hasil=mysqli_query($con,$sql);
                                    $no=0;
                                    while ($row = mysqli_fetch_array($hasil)) {
                                        $no++;
                                        ?>
                                        <option value="<?php echo $row['id_alternatif'];?>"><?php echo $row['nama_alternatif'];?></option>
                                        <?php 
                                    }
                                    ?>
                                </select>                         
                              </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                  <label>Keandalan<font style="color: red">*</font></label>
                                  <select class="form-control" name="keandalan" required>
                                    <option value="">-- Pilih Nilai --</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                  <label>Inisiatif<font style="color: red">*</font></label>
                                  <select class="form-control" name="inisiatif" required>
                                    <option value="">-- Pilih Nilai --</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                  <label>Kreatifitas<font style="color: red">*</font></label>
                                  <select class="form-control" name="kreatif" required>
                                    <option value="">-- Pilih Nilai --</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                  <label>Motivasi<font style="color: red">*</font></label>
                                  <select class="form-control" name="motivasi" required>
                                    <option value="">-- Pilih Nilai --</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label>Bulan<font style="color: red">*</font></label>
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
                                <label>Tahun<font style="color: red">*</font></label>
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
                            <div class="col-sm-12">
                              <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-block btn-success">Submit</button>
                                <button type="button" class="btn btn-block btn-warning" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              <!-- END MODAL ADD -->
              <!-- ALERT -->
              <div class="header">
                  <button type="button" class="btn btn-success btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#modal-add"><i class="material-icons">add_circle</i>       </button>
              </div>
              <div class="body">
                  <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                        <tr>
                            <th rowspan="2">Inisial Karyawan</th>
                            <th rowspan="2">Nama Karyawan</th>
                            <th rowspan="2">Keandalan</th>
                            <th rowspan="2">Inisiatif</th>
                            <th rowspan="2">Kreatifitas</th>
                            <th rowspan="2">Motivasi</th>
                            <th rowspan="2">Nilai</th>
                            <th rowspan="2">Keterangan Crips</th>
                            <th rowspan="2">Nilai Crips</th>
                            <th colspan="2">Periode</th>
                            <th rowspan="2">Aksi</th>
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
                    $result = mysqli_query($con,"SELECT a.id_alternatif,a.inisial_alternatif,a.nama_alternatif,a.hasil_alternatif,
                                                        b.id_kualitas,b.id_alternatif,b.keandalan,b.inisiatif,b.kreatif,b.motivasi,b.ket_crips,b.nilai_crips,b.bulan,b.tahun
                                                FROM alternatif a JOIN kualitas b
                                                ON a.id_alternatif=b.id_alternatif ORDER BY b.id_kualitas ASC");
                    
                    if(mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_array($result))
                        {
                            $ssatu = $row['keandalan'];
                            $sdua = $row['inisiatif'];
                            $stiga = $row['kreatif'];
                            $sempat = $row['motivasi'];
                            $persen = 100;
                            $nilai_kualitas = ($ssatu + $sdua + $stiga + $sempat) / 4 ;
                            echo "<tr>";
                            echo "<td>".$row['inisial_alternatif'] . "</td>";
                            echo "<td>".$row['nama_alternatif'] . "</td>";
                            echo "<td>".$row['keandalan'] . "</td>";
                            echo "<td>".$row['inisiatif'] . "</td>";
                            echo "<td>".$row['kreatif'] . "</td>";
                            echo "<td>".$row['motivasi'] . "</td>";
                            echo "<td>".round($nilai_kualitas) . "</td>";
                            // if($nilai_kualitas >= 90 OR $nilai_kualitas >= 100 ){
                            //     echo "<td>SANGAT BAIK</td>";
                            // }elseif($nilai_kualitas >= 80 OR $nilai_kualitas >= 89 ){
                            //     echo "<td>BAIK</td>";
                            // }elseif($nilai_kualitas >= 70 OR $nilai_kualitas >= 79 ){
                            //     echo "<td>CUKUP</td>";
                            // }elseif($nilai_kualitas >= 0 OR $nilai_kualitas >= 69 ){
                            //     echo "<td>KURANG</td>";
                            // }
                            // if($nilai_kualitas >= 90 OR $nilai_kualitas >= 100 ){
                            //     echo "<td>4</td>";
                            // }elseif($nilai_kualitas >= 80 OR $nilai_kualitas >= 89 ){
                            //     echo "<td>3</td>";
                            // }elseif($nilai_kualitas >= 70 OR $nilai_kualitas >= 79 ){
                            //     echo "<td>2</td>";
                            // }elseif($nilai_kualitas >= 0 OR $nilai_kualitas >= 69 ){
                            //     echo "<td>1</td>";
                            // }
                            if($row['ket_crips']==NULL){
                            echo "<td align='center' width='150px'>
                                <button type='button' data-toggle='modal' data-target='#datacrips$row[id_kualitas]' title='Delete'class='btn btn-warning btn-circle waves-effect waves-circle waves-float btn-sm'><i class='material-icons'>loop</i></button>
                                  </td>";
                            }else{
                                echo "<td>".$row['ket_crips'] . "</td>";
                            }      
                            if($row['nilai_crips']==NULL){
                                  echo "<td><b><i><small>Klik untuk Update di Icon Keterangan Crips</small></i></b></td>";
                            }else{
                                echo "<td>".$row['nilai_crips'] . "</td>";
                            }
                            echo "<td>".$row['bulan'] . "</td>";
                            echo "<td>".$row['tahun'] . "</td>";
                            echo "<td align= '' width='150px'>
                                <button type='button' data-toggle='modal' data-target='#delete$row[id_kualitas]' title='Delete'class='btn btn-danger btn-circle waves-effect waves-circle waves-float'><i class='material-icons'>delete</i></button>
                                  </td>";
                            echo "</tr>";
                            ?>
                            <!-- UPDATE -->
                            <div class="modal fade" id="datacrips<?php echo $row['id_kualitas'];?>">
                              <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <label class="modal-title">Update Data Keterangan Crips Kualitas Karyawan</label>
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
                                                <input type="hidden" class="form-control" name="id_kualitas" value="<?php echo $row['id_kualitas']; ?>">
                                                <!-- KETERANGAN -->
                                                <?php
                                                if(round($nilai_kualitas) >= 9 OR round($nilai_kualitas) >= 10 ){
                                                ?>
                                                    <input type="hidden" class="form-control" name="ket_crips" value="SANGAT BAIK">
                                                <?php
                                                }elseif(round($nilai_kualitas) >= 7 OR round($nilai_kualitas) >= 8 ){
                                                ?>
                                                    <input type="hidden" class="form-control" name="ket_crips" value="BAIK">
                                                <?php
                                                }elseif(round($nilai_kualitas) >= 5 OR round($nilai_kualitas) >= 6 ){
                                                ?>
                                                    <input type="hidden" class="form-control" name="ket_crips" value="CUKUP">
                                                <?php
                                                }elseif(round($nilai_kualitas) >= 0 OR round($nilai_kualitas) >= 4 ){
                                                ?>
                                                    <input type="hidden" class="form-control" name="ket_crips" value="KURANG">
                                                <?php } ?>
                                                <!-- NILAI -->
                                                <?php
                                                if(round($nilai_kualitas) >= 9 OR round($nilai_kualitas) >= 10 ){
                                                ?>
                                                    <input type="hidden" class="form-control" name="nilai_crips" value="4">
                                                <?php
                                                }elseif(round($nilai_kualitas) >= 7 OR round($nilai_kualitas) >= 8 ){
                                                ?>
                                                    <input type="hidden" class="form-control" name="nilai_crips" value="3">
                                                <?php
                                                }elseif(round($nilai_kualitas) >= 5 OR round($nilai_kualitas) >= 6 ){
                                                ?>
                                                    <input type="hidden" class="form-control" name="nilai_crips" value="2">
                                                <?php
                                                }elseif(round($nilai_kualitas) >= 0 OR round($nilai_kualitas) >= 4 ){
                                                ?>
                                                    <input type="hidden" class="form-control" name="nilai_crips" value="1">
                                                <?php } ?>
                                              </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                  <button type="submit" name="updatedatacrips" class="btn btn-block btn-success">Update Keterangan Crips</button>
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

                            <!-- UPDATE -->
                            <div class="modal fade" id="edit<?php echo $row['id_kualitas'];?>">
                              <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <label class="modal-title">Update Data Kualitas Karyawan</label>
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
                                                <input type="text" class="form-control" name="nama_alternatif" placeholder="Nama Karyawan ..." value="<?php echo $row['nama_alternatif']; ?>">
                                                <input type="hidden" class="form-control" name="id_kualitas" value="<?php echo $row['id_kualitas']; ?>">                              
                                              </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                  <button type="submit" name="update" class="btn btn-block btn-success">Update</button>
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

                            <!-- DELETE -->
                            <div class="modal fade" id="delete<?php echo $row['id_kualitas'];?>" role="dialog">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <label class="modal-title">Delete Karyawan</label>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <form method="post" action="">
                                        <div class="form-group">
                                        <label>Hapus Data?</label>
                                        <h6>Inisial Karyawan : <b><u><?php echo $row['inisial_alternatif'];?></u></b></h6>
                                        <h6>Nama Karyawan : <b><u><?php echo $row['nama_alternatif'];?></u></b></h6>
                                        <input type="hidden" name="id_kualitas" class="form-control" value="<?php echo $row['id_kualitas'];?>" required>
                                        <button type="submit" name="delete" class="btn btn-success btn-block btn-flat">Yes</button>
                                        <button type="button" class="btn btn-warning btn-block btn-flat" data-dismiss="modal">No</button>
                                      </div>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <!-- END DELETE -->
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
