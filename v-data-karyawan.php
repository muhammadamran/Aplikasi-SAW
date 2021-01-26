<?php 
include "include/connection.php";

// ADD
if(isset($_POST["submit"]))    
{    
	$id_alternatif       = $_POST['id_alternatif'];
	$inisial_alternatif  = $_POST['inisial_alternatif'];
	$nama_alternatif     = $_POST['nama_alternatif'];

  $query = mysql_query("INSERT INTO alternatif 
    (id_alternatif,inisial_alternatif,nama_alternatif) 
    VALUES 
    ('','$inisial_alternatif','$nama_alternatif')
    ");
  if ($query) {
    header("Location: ./data-karyawan.php?ntf=1");  
  } else {
    header("Location: ./data-karyawan.php?ntf=6");
  }
}

// EDIT
if(isset($_POST["update"]))    
{    
	$id_alternatif       = $_POST['id_alternatif'];
	$inisial_alternatif  = $_POST['inisial_alternatif'];
	$nama_alternatif     = $_POST['nama_alternatif'];

  $query = mysql_query("UPDATE alternatif SET 
    inisial_alternatif ='$inisial_alternatif',
    nama_alternatif ='$nama_alternatif'
    WHERE id_alternatif ='$id_alternatif'");
  if($query){
    header("Location: ./data-karyawan.php?ntf=4");                                                  
  } else {
    echo "Updated Failed - Please contact your Administrator";
  }
}

// DELETE
if(isset($_POST['delete']))
{
  $id_alternatif    = $_POST['id_alternatif'];

  if($id_alternatif){
    $query = mysql_query("DELETE FROM alternatif WHERE id_alternatif = '$id_alternatif'");
    if($query){
     header("Location: ./data-karyawan.php?ntf=3");                     
   } else {
    header("Location: ./data-karyawan.php?ntf=6");  
  }
} else {
  header("Location: ./data-karyawan.php?ntf=6");  
}
}

$con=mysqli_connect($conhost,$conuser,$conpassword,$dbname);
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$query = mysqli_query($con,"SELECT MAX(inisial_alternatif) as kodeC FROM alternatif");
$data = mysqli_fetch_array($query);
$kodealternatif = $data['kodeC'];

$urutan = (int) substr($kodealternatif, 1, 1);

$urutan++;
$huruf = "A";
$kodealternatif = $huruf . sprintf("%s", $urutan);


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
      <h2>DATA KARYAWAN PAGE</h2>
    </div>
    <?php include 'include/alert/success.php' ?>
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>
              DATA KARYAWAN
            </h2>
          </div>
          <!-- MODAL ADD -->
          <div class="modal fade" id="modal-add">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <label class="modal-title">Tambah Data Karyawan</label>
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
                          <input type="text" class="form-control" name="nama_alternatif" placeholder="Nama Karyawan ..." required="required">
                          <input type="hidden" class="form-control" name="id_alternatif">
                          <input type="hidden" class="form-control" name="inisial_alternatif" value="<?php echo $kodealternatif; ?>">                              
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
          </div>
          <div class="body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Inisial Karyawan</th>
                    <th>Nama Karyawan</th>
                    <th>Jabatan</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Pendidikan Terakhir</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $con=mysqli_connect($conhost,$conuser,$conpassword,$dbname);
                  if (mysqli_connect_errno())
                  {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  }
                  $result = mysqli_query($con,"SELECT * FROM alternatif ORDER BY id_alternatif DESC");

                  if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_array($result))
                    {
                     echo "<tr>";
                     echo "<td>".$row['id_alternatif'] . "</td>";
                     echo "<td>".$row['inisial_alternatif'] . "</td>";
                     echo "<td>".$row['nama_alternatif'] . "</td>";
                     echo "<td>".$row['jabatan'] . "</td>";
                     echo "<td>".$row['alamat'] . "</td>";
                     echo "<td>".$row['no_hp'] . "</td>";
                     echo "<td>".$row['pendidikan'] . "</td>";
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
