<?php
include 'include/restrict.php';

$user = $_SESSION['username'];
mysql_connect($conhost,$conuser,$conpassword);
mysql_select_db($dbname);
$role = mysql_query("SELECT * FROM pengguna WHERE username = '$user' ");
$data = mysql_fetch_array($role);
?>
<script type="text/javascript"> 
    function display_c(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct()',refresh)
}

function display_ct() {
    var x = new Date()
    document.getElementById('ct').innerHTML = x;
    display_c();
}
</script>
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="index.php?ntf=0">SPK-SAW | Penilaian Kinerja Karyawan</a>
            <a class="navbar-brand" href="index.php?ntf=0">
              <body onload=display_ct();>
                - <b>CLOCK | </b> <span id='ct' ></span>
            </body>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
            <li class="pull-right"><a href="logout.php" class="js-right-sidebar" data-close="true"><i class="material-icons">power_settings_new</i></a></li>
            <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
        </ul>
    </div>
</div>
</nav>