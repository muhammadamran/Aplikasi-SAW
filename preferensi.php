<?php 
include "include/connection.php";

// ADD
if(isset($_POST["submit"]))    
{    
	$id_nilai       = $_POST['id_nilai'];
	$ket_nilai      = $_POST['ket_nilai'];
	$jum_nilai      = $_POST['jum_nilai'];

  $query = mysql_query("INSERT INTO nilai 
    (id_nilai,ket_nilai,jum_nilai) 
    VALUES 
    ('','$ket_nilai','$jum_nilai')
    ");
  if ($query) {
    header("Location: ./preferensi.php?ntf=1");  
  } else {
    header("Location: ./preferensi.php?ntf=6");
  }
}

// EDIT
if(isset($_POST["update"]))    
{    
	$id_nilai       = $_POST['id_nilai'];
	$ket_nilai      = $_POST['ket_nilai'];
	$jum_nilai      = $_POST['jum_nilai'];

  $query = mysql_query("UPDATE nilai SET 
    ket_nilai ='$ket_nilai',
    jum_nilai ='$jum_nilai'
    WHERE id_nilai ='$id_nilai'");
  if($query){
    header("Location: ./preferensi.php?ntf=4");                                                  
  } else {
    echo "Updated Failed - Please contact your Administrator";
  }
}

// DELETE
if(isset($_POST['delete']))
{
  $id_nilai    = $_POST['id_nilai'];

  if($id_nilai){
    $query = mysql_query("DELETE FROM nilai WHERE id_nilai = '$id_nilai'");
    if($query){
     header("Location: ./preferensi.php?ntf=3");                     
   } else {
    header("Location: ./preferensi.php?ntf=6");  
  }
} else {
  header("Location: ./preferensi.php?ntf=6");  
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
      <h2>PREFERENSI/CRIPS PAGE</h2>
    </div>
    <?php include 'include/alert/success.php' ?>
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>
              DATA PREFERENSI/CRIPS
            </h2>
          </div>
          <!-- MODAL ADD -->
          <div class="modal fade" id="modal-add">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <label class="modal-title">Tambah Preferensi/Crips</label>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="" method="POST">
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Keterangan Crips<font style="color: red">*</font></label>
                          <input type="text" class="form-control" name="ket_nilai" placeholder="Keterangan Crips ..." required="required">
                          <input type="hidden" class="form-control" name="id_nilai">
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Nilai Crips<font style="color: red">*</font></label>
                          <input type="number" class="form-control" name="jum_nilai" placeholder="Nilai Crips ..." required="required">
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
                    <th>Keterangan Crips</th>
                    <th>Nilai Crips</th>
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
                  $result = mysqli_query($con,"SELECT * FROM nilai ORDER BY id_nilai DESC");

                  if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_array($result))
                    {
                      echo "<tr>";
                      echo "<td>".$row['id_nilai'] . "</td>";
                      echo "<td>".$row['ket_nilai'] . "</td>";
                      echo "<td>".$row['jum_nilai'] . "</td>";
                      echo "<td align= '' width='150px'>
                      <button type='button' data-toggle='modal' data-target='#edit$row[id_nilai]' title='Edit'class='btn btn-warning btn-circle waves-effect waves-circle waves-float'><i class='material-icons'>create</i></button>
                      <button type='button' data-toggle='modal' data-target='#delete$row[id_nilai]' title='Edit'class='btn btn-danger btn-circle waves-effect waves-circle waves-float'><i class='material-icons'>delete</i></button>
                      </td>";
                      echo "</tr>";
                      ?>
                      <!-- UPDATE -->
                      <div class="modal fade" id="edit<?php echo $row['id_nilai'];?>">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <div class="modal-header">
                              <label class="modal-title">Update Data Preferensi/Crips</label>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="" method="POST">
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Keterangan Nilai</label>
                                      <input type="text" class="form-control" name="ket_nilai" placeholder="Nama nilai ..." value="<?php echo $row['ket_nilai']; ?>">
                                      <input type="hidden" class="form-control" name="id_nilai" value="<?php echo $row['id_nilai']; ?>">
                                    </div>
                                  </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Jumlah Nilai</label>
                                      <input type="number" class="form-control" name="jum_nilai" placeholder="Jumlah Nilai ..." value="<?php echo $row['jum_nilai']; ?>">
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
                      <div class="modal fade" id="delete<?php echo $row['id_nilai'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <label class="modal-title">Delete Preferensi/Crips</label>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="post" action="">
                                <div class="form-group">
                                  <label>Hapus Data?</label>
                                  <h6>Keterangan Nilai : <b><u><?php echo $row['ket_nilai'];?></u></b></h6>
                                  <h6>Jumlah Nilai : <b><u><?php echo $row['jum_nilai'];?></u></b></h6>
                                  <input type="hidden" name="id_nilai" class="form-control" value="<?php echo $row['id_nilai'];?>" required>
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
