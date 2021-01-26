<?php 
include "include/connection.php";

// ADD
if(isset($_POST["submit"]))    
{    
	$id_kriteria       = $_POST['id_kriteria'];
	$inisial_kriteria  = $_POST['inisial_kriteria'];
	$nama_kriteria     = $_POST['nama_kriteria'];
	$tipe_kriteria     = $_POST['tipe_kriteria'];
	$bobot_kriteria    = $_POST['bobot_kriteria'];

  $query = mysql_query("INSERT INTO kriteria 
    (id_kriteria,inisial_kriteria,nama_kriteria,tipe_kriteria,bobot_kriteria) 
    VALUES 
    ('','$inisial_kriteria','$nama_kriteria','$tipe_kriteria','$bobot_kriteria')
    ");
  if ($query) {
    header("Location: ./kriteria.php?ntf=1");  
  } else {
    header("Location: ./kriteria.php?ntf=6");
  }
}

// EDIT
if(isset($_POST["update"]))    
{    
	$id_kriteria       = $_POST['id_kriteria'];
	$inisial_kriteria  = $_POST['inisial_kriteria'];
	$nama_kriteria     = $_POST['nama_kriteria'];
	$tipe_kriteria     = $_POST['tipe_kriteria'];
	$bobot_kriteria    = $_POST['bobot_kriteria'];

  $query = mysql_query("UPDATE kriteria SET 
    inisial_kriteria ='$inisial_kriteria',
    nama_kriteria ='$nama_kriteria',
    tipe_kriteria ='$tipe_kriteria',
    bobot_kriteria = '$bobot_kriteria'
    WHERE id_kriteria ='$id_kriteria'");
  if($query){
    header("Location: ./kriteria.php?ntf=4");                                                  
  } else {
    echo "Updated Failed - Please contact your Administrator";
  }
}

// DELETE
if(isset($_POST['delete']))
{
  $id_kriteria    = $_POST['id_kriteria'];

  if($id_kriteria){
    $query = mysql_query("DELETE FROM kriteria WHERE id_kriteria = '$id_kriteria'");
    if($query){
     header("Location: ./kriteria.php?ntf=3");                     
   } else {
    header("Location: ./kriteria.php?ntf=6");  
  }
} else {
  header("Location: ./kriteria.php?ntf=6");  
}
}

$con=mysqli_connect($conhost,$conuser,$conpassword,$dbname);
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$query = mysqli_query($con,"SELECT MAX(inisial_kriteria) as kodeC FROM kriteria");
$data = mysqli_fetch_array($query);
$kodeKriteria = $data['kodeC'];

$urutan = (int) substr($kodeKriteria, 1, 1);

$urutan++;
$huruf = "C";
$kodeKriteria = $huruf . sprintf("%s", $urutan);


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
      <h2>KRITERIA & BOBOT PAGE</h2>
    </div>
    <?php include 'include/alert/success.php' ?>
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>
              DATA KRITERIA & BOBOT
            </h2>
          </div>
          <!-- MODAL ADD -->
          <div class="modal fade" id="modal-add">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <label class="modal-title">Tambah Kriteria & Bobot</label>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="" method="POST">
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Nama Kriteria<font style="color: red">*</font></label>
                          <input type="text" class="form-control" name="nama_kriteria" placeholder="Nama Kriteria ..." required="required">
                          <input type="hidden" class="form-control" name="id_kriteria">
                          <input type="hidden" class="form-control" name="inisial_kriteria" value="<?php echo $kodeKriteria; ?>">                              
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Tipe Kriteria<font style="color: red">*</font></label>
                          <select class="form-control show-tick" name="tipe_kriteria" required="required">
                            <option value="">-- Pilih Tipe Kriteria</option>
                            <option value="Benefit">Benefit</option>
                            <option value="Cost">Cost</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Bobot Kriteria<font style="color: red">*</font></label>
                          <input type="number" class="form-control" name="bobot_kriteria" placeholder="Bobot Kriteria ..." required="required">
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <button type="submit" name="submit" class="btn btn-block btn-lg btn-success waves-effect">Submit</button>
                          <button type="button" class="btn btn-block btn-lg btn-warning waves-effect" data-dismiss="modal">Close</button>
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
                    <th>Inisial Kriteria</th>
                    <th>Nama Kriteria</th>
                    <th>Tipe Kriteria</th>
                    <th>Bobot Kriteria</th>
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
                  $result = mysqli_query($con,"SELECT * FROM kriteria ORDER BY id_kriteria DESC");

                  if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_array($result))
                    {
                      echo "<tr>";
                      echo "<td>".$row['id_kriteria'] . "</td>";
                      echo "<td>".$row['inisial_kriteria'] . "</td>";
                      echo "<td>".$row['nama_kriteria'] . "</td>";
                      echo "<td>".$row['tipe_kriteria'] . "</td>";
                      echo "<td>".$row['bobot_kriteria'] . "</td>";
                      echo "<td align= '' width='150px'>
                      <button type='button' data-toggle='modal' data-target='#edit$row[id_kriteria]' title='Edit'class='btn btn-warning btn-circle waves-effect waves-circle waves-float'><i class='material-icons'>create</i></button>
                      <button type='button' data-toggle='modal' data-target='#delete$row[id_kriteria]' title='Edit'class='btn btn-danger btn-circle waves-effect waves-circle waves-float'><i class='material-icons'>delete</i></button>
                      </td>";
                      echo "</tr>";
                      ?>
                      <!-- UPDATE -->
                      <div class="modal fade" id="edit<?php echo $row['id_kriteria'];?>">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <div class="modal-header">
                              <label class="modal-title">Update Data Kriteria & Bobot</label>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="" method="POST">
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Nama Kriteria</label>
                                      <input type="text" class="form-control" name="nama_kriteria" placeholder="Nama Kriteria ..." value="<?php echo $row['nama_kriteria']; ?>">
                                      <input type="hidden" class="form-control" name="id_kriteria" value="<?php echo $row['id_kriteria']; ?>">
                                      <input type="hidden" class="form-control" name="inisial_kriteria" value="<?php echo $row['inisial_kriteria']; ?>">                              
                                    </div>
                                  </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Tipe Kriteria</label>
                                      <select class="form-control show-tick" name="tipe_kriteria" required="required">
                                        <option value="<?php echo $row['tipe_kriteria']; ?>"><?php echo $row['tipe_kriteria']; ?></option>
                                        <option value="">-- Pilih Tipe Kriteria</option>
                                        <option value="Benefit">Benefit</option>
                                        <option value="Cost">Cost</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Bobot Kriteria</label>
                                      <input type="number" class="form-control" name="bobot_kriteria" placeholder="Bobot Kriteria ..." value="<?php echo $row['bobot_kriteria']; ?>">
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
                      <div class="modal fade" id="delete<?php echo $row['id_kriteria'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <label class="modal-title">Delete Data</label>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="post" action="">
                                <label>Hapus Data?</label>
                                <h6>Inisial Kriteria : <b><u><?php echo $row['inisial_kriteria'];?></u></b></h6>
                                <h6>Nama Kriteria : <b><u><?php echo $row['inisial_kriteria'];?></u></b></h6>
                                <h6>Tipe Kriteria : <b><u><?php echo $row['tipe_kriteria'];?></u></b></h6>
                                <h6>Bobot Kriteria : <b><u><?php echo $row['bobot_kriteria'];?></u></b></h6>
                                <input type="hidden" name="id_kriteria" class="form-control"  value="<?php echo $row['id_kriteria'];?>" required>
                                <hr>
                                <button type="submit" name="delete" class="btn btn-success btn-block btn-flat">Yes</button>
                                <button type="button" class="btn btn-warning btn-block btn-flat" data-dismiss="modal">No</button>
                              </form>
                            </div>
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
