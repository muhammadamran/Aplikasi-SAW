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
    header("Location: ./profile.php?ntf=0");                                                  
  } else {
    header("Location: ./profile.php?ntf=6");  
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
    header("Location: ./profile.php?ntf=5");                                                  
  } else {
    header("Location: ./profile.php?ntf=6");  
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

  .lingkaran{
    width: 150px;
    height: 150px;
    background: #ffffff;
    border-radius: 100%;
  }

  .lingkaran-profile{
    width: 150px;
    height: 150px;
    background: #ffffff;
    border-radius: 100%;
  }
</style>
<?php include "include/head.php" ?>
<?php include "include/header.php" ?>
<?php include "include/sidebar.php" ?>
<?php include 'include/alert/success.php' ?>
<!-- FOTO -->
<div class="modal fade" id="foto<?php echo $data['id'];?>">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <label class="modal-title">Change Foto</label>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <div align="center">
                  <?php
                  if ($data['foto']==NULL) {
                    echo"<img src='assets/images/user/avatar.png' class='lingkaran'>";
                  }else{
                    echo"<img src='assets/images/user/$data[foto]' class='lingkaran'>";
                  }
                  ?>
                </div>
                <hr>
                <label>Upload Foto</label><br>
                <input type="file" name="foto" placeholder="Upload ...">
                <input type="hidden" name="id" value="<?php echo $data['id'];?>">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <button type="submit" name="updatefoto" class="btn btn-block btn-success">Update</button>
                <button type="button" class="btn btn-block btn-warning" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- END FOTO -->

<!-- UPDATE -->
<div class="modal fade" id="addfile<?php echo $data['id'];?>">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <label class="modal-title">Update Profile</label>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>ID</label>
                <input type="text" class="form-control" name="id" readonly="readonly" value="<?php echo $data['id'];?>">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username"  readonly="readonly" value="<?php echo $data['username'];?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $data['nama_lengkap'];?>">
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

<!-- UPDATE PASSWORD -->
<div class="modal fade" id="change<?php echo $data['id'];?>" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <label class="modal-title">Input Password Baru</label>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
          <div class="form-group">
            <label>Password Baru</label>
            <input type="password" name="password" class="form-control" placeholder="Password Baru ..." required>
            <input type="hidden" name="id" class="form-control" value="<?php echo $data['id'];?>" required>
          </div>
          <button type="submit" name="changepassword" class="btn btn-success btn-block btn-flat">Ganti Password</button>
          <button type="button" class="btn btn-warning btn-block btn-flat" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- END UPDATE PASSWORD -->
<section class="content">
  <div class="container-fluid">
    <div class="row clearfix">
      <div class="col-xs-12 col-sm-12">
        <div class="card profile-card">
          <div class="profile-header">&nbsp;</div>
          <div class="profile-body">
            <div class="image-area">
              <!-- <img src="../../images/user-lg.jpg" alt="AdminBSB - Profile Image" /> -->
              <?php
              if ($data['foto']==NULL) {
                echo"<img src='assets/images/user/avatar.png' alt='AdminBSB - Profile Image' class='lingkaran-profile' />";
              }else{
                echo"<img src='assets/images/user/$data[foto]' alt='AdminBSB - Profile Image' class='lingkaran-profile' />";
              }
              ?>
            </div>
            <div class="content-area">
              <h3><?php echo $data['nama_lengkap']; ?></h3>
              <p>Username: <?php echo $data['username']; ?></p>
              <p>Hak Akses: <?php echo $data['role']; ?></p>
            </div>
          </div>
          <div class="profile-footer" align="center">
            <button class="btn btn-primary btn-lg waves-effect" data-toggle="modal" data-target="#foto<?php echo $data['id'];?>" title="Edit Profile">Change Foto</button>
            <button class="btn btn-info btn-lg waves-effect" data-toggle="modal" data-target="#addfile<?php echo $data['id'];?>" title="Edit Profile">Edit Profile</button>
            <button class="btn btn-warning btn-lg waves-effect" data-toggle="modal" data-target="#change<?php echo $data['id'];?>" title="Change Password">Change Password</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php include 'include/thirdparty.php'; ?>
<?php include "include/footer.php" ?>