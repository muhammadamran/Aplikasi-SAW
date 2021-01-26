<?php 
$user = $_SESSION['username'];
mysql_connect($conhost,$conuser,$conpassword);
mysql_select_db($dbname);
$role = mysql_query("SELECT * FROM pengguna WHERE username = '$user' ");
$data = mysql_fetch_array($role);
/*VALIDATION FOR FILTER USER = ADMINISTARTOR ALL */
/*START VALIDATION AND SHOW MENU LIST*/
?>
<section>
    <aside id="leftsidebar" class="sidebar">
        <div class="user-info">
            <div class="image">
                <?php
                if ($data['foto']==NULL) {
                  echo"<img src='assets/images/user/avatar.png' width='48' height='48' alt='User'>";
              }else{
                  echo"<img src='assets/images/user/$data[foto]' width='48' height='48' alt='User'>";
              }
              ?>
          </div>
          <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $data['nama_lengkap']; ?></div>
            <div class="email"><?php echo $data['role']; ?></div>
        </div>
    </div>
    <div class="menu">
        <ul class="list">
            <li class="header">SETTING PROFILE</li>
            <li>
                <a href="profile.php?ntf=0">
                    <i class="material-icons">assignment_ind</i>
                    <span>Setting Profil</span>
                </a>
            </li>
            <li class="header">MENU</li>
            <li>
                <a href="index.php?ntf=0">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            <?php if ($data['role'] == 'Asman') { ?>
                <li class="header">KRITERIA & PREFERENSI/CRIPS</li>
                <li>
                    <a href="kriteria.php?ntf=0">
                        <i class="material-icons">assignment</i>
                        <span>Kriteria & Bobot</span>
                    </a>
                </li>
                <li>
                    <a href="preferensi.php?ntf=0">
                        <i class="material-icons">assignment</i>
                        <span>Preferensi/Crips</span>
                    </a>
                </li>
                <li class="header">MASTER DATA</li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">receipt</i>
                        <span>Data Karyawan (Alternatif)</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="data-karyawan.php?ntf=0">Data Karyawan</a>
                        </li>
                        <li>
                            <a href="kehadiran-karyawan.php?ntf=0">Kehadiran Karyawan</a>
                        </li>
                        <li>
                            <a href="kerjasama-karyawan.php?ntf=0">Kerjasama Karyawan</a>
                        </li>
                        <li>
                            <a href="sikap-karyawan.php?ntf=0">Sikap Karyawan</a>
                        </li>
                        <li>
                            <a href="kualitas-karyawan.php?ntf=0">Kualitas Karyawan</a>
                        </li>
                        <li>
                            <a href="kuantitas-karyawan.php?ntf=0">Kuantitas Karyawan</a>
                        </li>
                    </ul>
                </li>
                <li class="header">PROSES</li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">verified_user</i>
                        <span>Proses Penilaian</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="data-hasil.php?ntf=0">Hasil Alternatif</a>
                        </li>
                        <li>
                            <a href="normalisasi-data.php?ntf=0">Normalisasi Data</a>
                        </li>
                        <li>
                            <a href="perangkingan.php?ntf=0">Hasil Penilaian</a>
                        </li>
                    </ul>
                </li>
                <li class="header">LAPORAN</li>
                <li>
                    <a href="laporan.php?ntf=0">
                        <i class="material-icons">markunread_mailbox</i>
                        <span>Laporan</span>
                    </a>
                </li>
            <?php } ?>
            <?php if ($data['role'] == 'Kakandatel') { ?>
                <li class="header">DATA KARYAWAN & PENILAIAN</li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">receipt</i>
                        <span>Data Karyawan & Penilaian</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="v-data-karyawan.php?ntf=0">Data Karyawan</a>
                        </li>
                         <li>
                            <a href="perangkingan.php?ntf=0">Hasil Penilaian</a>
                        </li>
                    </ul>
                </li>
                <li class="header">LAPORAN</li>
                <li>
                    <a href="laporan.php?ntf=0">
                        <i class="material-icons">markunread_mailbox</i>
                        <span>Laporan</span>
                    </a>
                </li>
            <?php } ?>
            <?php if ($data['role'] == 'Admin') { ?>
                <li class="header">KELOLA PENGGUNA</li>
                <li>
                    <a href="pengguna.php?ntf=0">
                        <i class="material-icons">person_add</i>
                        <span>Pengguna</span>
                    </a>
                </li>
            <?php } ?>
            <li class="header">LOG ACTIVITY</li>
            <li>
                <a href="ad_log_login.php?ntf=0">
                    <i class="material-icons">update</i>
                    <span>Changelogs</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - <?php echo date('Y');?> <a href="javascript:void(0);">Teknologi</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
</aside>
<?php include "panel.php"?>
</section>