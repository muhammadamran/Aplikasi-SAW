<?php 
include "include/connection.php";

// ADD
if(isset($_POST["submit"]))    
{    
  $id           = $_POST['id'];
  $username     = $_POST['username'];
  $password     = $_POST['password'];
  $role         = $_POST['role'];
  $nama_lengkap = $_POST['nama_lengkap'];

  $nama = $_FILES['foto']['name'];
  $file_tmp = $_FILES['foto']['tmp_name'];

  move_uploaded_file($file_tmp, './assets/images/user/'.$nama);

  $query = mysql_query("INSERT INTO pengguna 
    (id,username,password,role,nama_lengkap,foto) 
    VALUES 
    ('','$username',md5('$password'),'$role','$nama_lengkap','$nama')
    ");
  if ($query) {
    header("Location: ./pengguna.php?ntf=1");  
  } else {
    header("Location: ./pengguna.php?ntf=6");
  }
}

// EDIT
if(isset($_POST["update"]))    
{    
  $id           = $_POST['id'];
  $username     = $_POST['username'];
  $role         = $_POST['role'];
  $nama_lengkap = $_POST['nama_lengkap'];

  $query = mysql_query("UPDATE pengguna SET 
    username ='$username',
    role = '$role',
    nama_lengkap = '$nama_lengkap'
    WHERE id ='$id'");
  if($query){
    header("Location: ./pengguna.php?ntf=4");                                                  
  } else {
    echo "Updated Failed - Please contact your Administrator";
  }
}

// CHANGE PASSWORD
if(isset($_POST["changepassword"]))    
{    
  $id          = $_POST['id'];
  $password    = $_POST['password'];

  $query = mysql_query("UPDATE pengguna SET 
    password =md5('$password')
    WHERE id ='$id'");
  if($query){
    header("Location: ./pengguna.php?ntf=4");                                                  
  } else {
    echo "Updated Failed - Please contact your Administrator";
  }
} 

// UBAH FOTO
if(isset($_POST["uploadfoto"]))    
{    
  $id           = $_POST['id'];

  $nama = $_FILES['foto']['name'];
  $file_tmp = $_FILES['foto']['tmp_name'];

  move_uploaded_file($file_tmp, './assets/images/user/'.$nama);

  $query = mysql_query("UPDATE pengguna SET 
    foto = '$nama'
    WHERE id ='$id'");
  if($query){
    header("Location: ./pengguna.php?ntf=5");                                                  
  } else {
    header("Location: ./pengguna.php?ntf=6");  
  }
} 

// DELETE
if(isset($_POST['delete']))
{
  $id    = $_POST['id'];

  if($id){
    $query = mysql_query("DELETE FROM pengguna WHERE id = '$id'");
    if($query){
     header("Location: ./pengguna.php?ntf=3");                     
   } else {
    header("Location: ./pengguna.php?ntf=6");  
  }
} else {
  header("Location: ./pengguna.php?ntf=6");  
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
      <h2>PENGGUNA PAGE</h2>
    </div>
    <?php include 'include/alert/success.php' ?>
    <div class="row clearfix">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>
              PENGGUNA
            </h2>
          </div>
          <!-- MODAL ADD -->
          <div class="modal fade" id="modal-add">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <label class="modal-title">Tambah Pengguna</label>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="modal-body">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>File Foto</label><br>
                        <input type="file" name="foto">
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Username<font style="color: red">*</font></label>
                          <input type="text" class="form-control" name="username" placeholder="Username ..." required="required">
                          <input type="hidden" class="form-control" name="id">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Password<font style="color: red">*</font></label>
                          <input type="text" class="form-control" name="password" value="user123123" required="required">
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Nama Lengkap<font style="color: red">*</font></label>
                          <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap ..." required="required">
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label>Hak Akses<font style="color: red">*</font></label>
                          <select class="form-control" name="role" style="width: 100%;">
                            <option value="">-- Pilih Hak Akses --</option>
                            <option value="Kakandatel">Kakandatel</option>
                            <option value="Asman">Asman</option>
                            <option value="Admin">Admin</option>
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
          
          <div class="header">
            <button type="button" class="btn btn-success btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#modal-add"><i class="material-icons">add_circle</i>       </button>
          </div>
          <div class="body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Hak Akses</th>
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
                  $result = mysqli_query($con,"SELECT * FROM pengguna ORDER BY id DESC");

                  if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_array($result))
                    {
                      echo "<tr>";
                      echo "<td>".$row['id'] . "</td>";
                      if ($row['foto']==NULL){
                        echo "<td><img src='assets/images/user/avatar.png' class='lingkaran2'></td>";
                      }else{
                        echo "<td><img src='assets/images/user/$row[foto]' class='lingkaran2'></td>";
                      }
                      echo "<td>".$row['nama_lengkap'] . "</td>";
                      echo "<td>".$row['username'] . "</td>";
                      echo "<td>***********</td>";
                      echo "<td>".$row['role'] . "</td>";
                      echo "<td align= '' width='250px'>
                      <button type='button' data-toggle='modal' data-target='#edit$row[id]' title='Delete'class='btn btn-success btn-circle waves-effect waves-circle waves-float'><i class='material-icons'>create</i></button>
                      <button type='button' data-toggle='modal' data-target='#delete$row[id]' title='Delete'class='btn btn-danger btn-circle waves-effect waves-circle waves-float'><i class='material-icons'>delete</i></button>
                      <button type='button' data-toggle='modal' data-target='#updatefoto$row[id]' title='Delete'class='btn btn-default btn-circle waves-effect waves-circle waves-float'><i class='material-icons'>add_a_photo</i></button>
                      <button type='button' data-toggle='modal' data-target='#change$row[id]' title='Delete'class='btn btn-info btn-circle waves-effect waves-circle waves-float'><i class='material-icons'>https</i></button>
                      </td>";
                      echo "</tr>";
                      ?>
                      <!-- UPDATE -->
                      <div class="modal fade" id="edit<?php echo $row['id'];?>">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <div class="modal-header">
                              <label class="modal-title">Update Data Pengguna</label>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="" method="POST">
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Username</label>
                                      <input type="text" class="form-control" name="username" placeholder="Username ..." required="required" value="<?php echo $row['username'] ?>">
                                      <input type="hidden" class="form-control" name="id" value="<?php echo $row['id'] ?>">
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Nama Lengkap</label>
                                      <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap ..." required="required" value="<?php echo $row['nama_lengkap'] ?>">
                                    </div>
                                  </div>
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Hak Akses</label>
                                      <select class="form-control" name="role" style="width: 100%;">
                                        <option value="<?php echo $row['role'] ?>"><?php echo $row['role'] ?></option>
                                        <option value="">-- Pilih Hak Akses --</option>
                                        <option value="Kakandatel">Kakandatel</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Asman">Asman</option>
                                      </select>
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
                      <div class="modal fade" id="delete<?php echo $row['id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <label class="modal-title">Delete Pengguna</label>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="post" action="">
                                <div class="form-group">
                                  <div align="center">
                                    <?php
                                    if ($row['foto']==NULL) {
                                      echo"<img src='assets/images/user/avatar.png' class='lingkaran3'>";
                                    }else{
                                      echo"<img src='assets/images/user/$row[foto]' class='lingkaran3'>";
                                    }
                                    ?>
                                  </div>
                                  <hr>
                                  <label>Hapus Pengguna?</label>
                                  <h6>Nama Lengkap : <b><u><?php echo $row['nama_lengkap'];?></u></b></h6>
                                  <h6>Username : <b><u><?php echo $row['username'];?></u></b></h6>
                                  <h6>Hak Akses : <b><u><?php echo $row['role'];?></u></b></h6>
                                  <input type="hidden" name="id" class="form-control" placeholder="client name" value="<?php echo $row['id'];?>" required>
                                  <button type="submit" name="delete" class="btn btn-success btn-block btn-flat">Yes</button>
                                  <button type="button" class="btn btn-warning btn-block btn-flat" data-dismiss="modal">No</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- END DELETE -->

                      <!-- UPDATE FOTO -->
                      <div class="modal fade" id="updatefoto<?php echo $row['id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <label class="modal-title">Ubah Foto Profile</label>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="post" action="" enctype="multipart/form-data">
                                <div class="form-group">
                                  <div align="center">
                                    <?php
                                    if ($row['foto']==NULL) {
                                      echo"<img src='assets/images/user/avatar.png' class='lingkaran3'>";
                                    }else{
                                      echo"<img src='assets/images/user/$row[foto]' class='lingkaran3'>";
                                    }
                                    ?>
                                  </div>
                                  <hr>
                                  <label>Upload File</label>
                                  <input type="file" name="foto" placeholder="Upload ...">
                                  <input type="hidden" name="id" class="form-control" value="<?php echo $row['id'];?>" required>
                                  <button type="submit" name="uploadfoto" class="btn btn-success btn-block btn-flat">Upload</button>
                                  <button type="button" class="btn btn-warning btn-block btn-flat" data-dismiss="modal">Close</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- END UPDATE FOTO -->

                      <!-- UPDATE PASSWORD -->
                      <div class="modal fade" id="change<?php echo $row['id'];?>" role="dialog">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <label class="modal-title">Change Password</label>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="post" action="">
                                <div class="form-group">
                                  <label>Password Baru</label>
                                  <input type="password" name="password" class="form-control" placeholder="Password Baru ..." required>
                                  <input type="hidden" name="id" class="form-control" placeholder="client name" value="<?php echo $row['id'];?>" required>
                                  <button type="submit" name="changepassword" class="btn btn-success btn-block btn-flat">Change Password</button>
                                  <button type="button" class="btn btn-warning btn-block btn-flat" data-dismiss="modal">Close</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- END UPDATE PASSWORD -->
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
