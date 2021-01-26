<?php 
include "include/connection.php";

// ADD
if(isset($_POST["submit"]))    
{    
  $id_alternatif       = $_POST['id_alternatif'];
  $inisial_alternatif  = $_POST['inisial_alternatif'];
  $nama_alternatif     = $_POST['nama_alternatif'];
  $jabatan             = $_POST['jabatan'];
  $alamat              = $_POST['alamat'];
  $no_hp               = $_POST['no_hp'];
  $pendidikan          = $_POST['pendidikan'];

  $query = mysql_query("INSERT INTO alternatif 
    (id_alternatif,inisial_alternatif,nama_alternatif,jabatan,alamat,no_hp,pendidikan) 
    VALUES 
    ('','$inisial_alternatif','$nama_alternatif','$jabatan','$alamat','$no_hp','$pendidikan')
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
  $jabatan             = $_POST['jabatan'];
  $alamat              = $_POST['alamat'];
  $no_hp               = $_POST['no_hp'];
  $pendidikan          = $_POST['pendidikan'];

  $query = mysql_query("UPDATE alternatif SET 
    inisial_alternatif ='$inisial_alternatif',
    nama_alternatif ='$nama_alternatif',
    jabatan ='$jabatan',
    alamat ='$alamat',
    no_hp ='$no_hp',
    pendidikan ='$pendidikan'
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
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Jabatan<font style="color: red">*</font></label>
                          <input type="text" class="form-control" name="jabatan" placeholder="Jabatan ..." required="required">
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Alamat<font style="color: red">*</font></label>
                          <textarea type="text" class="form-control" name="alamat" placeholder="Tulis alamat lengkap disini ..." required="required"></textarea>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>No. Telepon<font style="color: red">*</font></label>
                          <input type="text" class="form-control" name="no_hp" placeholder="No. Telepon ..." required="required">
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Pendidikan Terakhir<font style="color: red">*</font></label>
                          <input type="text" class="form-control" name="pendidikan" placeholder="Pendidikan Terakhir ..." required="required">
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
                    <th>ID</th>
                    <th>Inisial Karyawan</th>
                    <th>Nama Karyawan</th>
                    <th>Jabatan</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Pendidikan Terakhir</th>
                    <!-- <th>Nilai Karyawan</th> -->
                    <th>Aksi</th>
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
                          //             if($row['hasil_alternatif']==NULL){
                          // echo "<td>0</td>";
                          //             }else{
                          // echo "<td>".$row['hasil_alternatif'] . "</td>";
                          //             }
                      echo "<td align= '' width='150px'>
                      <button type='button' data-toggle='modal' data-target='#edit$row[id_alternatif]' title='Edit'class='btn btn-warning btn-circle waves-effect waves-circle waves-float'><i class='material-icons'>create</i></button>
                      <button type='button' data-toggle='modal' data-target='#delete$row[id_alternatif]' title='Edit'class='btn btn-danger btn-circle waves-effect waves-circle waves-float'><i class='material-icons'>delete</i></button>
                      </td>";
                      echo "</tr>";
                      ?>
                      <!-- UPDATE -->
                      <div class="modal fade" id="edit<?php echo $row['id_alternatif'];?>">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <div class="modal-header">
                              <label class="modal-title">Update Data Data Karyawan</label>
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
                                      <input type="hidden" class="form-control" name="id_alternatif" value="<?php echo $row['id_alternatif']; ?>">                              
                                    </div>
                                  </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Inisial Karyawan</label>
                                      <input type="text" class="form-control" name="inisial_alternatif" value="<?php echo $row['inisial_alternatif']; ?>">                         
                                    </div>
                                  </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Jabatan</label>
                                      <input type="text" class="form-control" name="jabatan" placeholder="Jabatan ..." value="<?php echo $row['jabatan']; ?>">
                                    </div>
                                  </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Alamat</label>
                                      <textarea type="text" class="form-control" name="alamat" placeholder="Tulis alamat lengkap disini ..."><?php echo $row['alamat']; ?></textarea>
                                    </div>
                                  </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>No. Telepon</label>
                                      <input type="text" class="form-control" name="no_hp" placeholder="No. Telepon ..." value="<?php echo $row['no_hp']; ?>">
                                    </div>
                                  </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Pendidikan Terakhir</label>
                                      <input type="text" class="form-control" name="pendidikan" placeholder="Pendidikan Terakhir ..." value="<?php echo $row['pendidikan']; ?>">
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
                      <div class="modal fade" id="delete<?php echo $row['id_alternatif'];?>" role="dialog">
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
                                  <input type="hidden" name="id_alternatif" class="form-control" value="<?php echo $row['id_alternatif'];?>" required>
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
