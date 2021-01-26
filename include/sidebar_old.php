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
                <li class="header">MASTER DATA</li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">assignment</i>
                        <span>Kriteria & Preferensi/Crips</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="kriteria.php?ntf=0">Kriteria & Bobot</a>
                        </li>
                        <li>
                            <a href="preferensi.php?ntf=0">Preferensi/Crips</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">view_list</i>
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
                            <a href="sikap-karyawan.php?ntf=0">Sikap/Etika Karyawan</a>
                        </li>
                        <li>
                            <a href="kualitas-karyawan.php?ntf=0">Kualitas Karyawan</a>
                        </li>
                        <li>
                            <a href="kuantitas-karyawan.php?ntf=0">Kuantitas Karyawan</a>
                        </li>
                    </ul>
                </li>
                <li class="header">LAPORAN</li>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">perm_media</i>
                        <span>Laporan</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="data-hasil.php?ntf=0">Hasil Alternatif</a>
                        </li>
                        <li>
                            <a href="normalisasi-data.php?ntf=0">Normalisasi Data</a>
                        </li>
                        <li>
                            <a href="perangkingan.php?ntf=0">Perangkingan</a>
                        </li>
                    </ul>
                </li>
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
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
            <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                <ul class="demo-choose-skin">
                    <li data-theme="red" class="active">
                        <div class="red"></div>
                        <span>Red</span>
                    </li>
                    <li data-theme="pink">
                        <div class="pink"></div>
                        <span>Pink</span>
                    </li>
                    <li data-theme="purple">
                        <div class="purple"></div>
                        <span>Purple</span>
                    </li>
                    <li data-theme="deep-purple">
                        <div class="deep-purple"></div>
                        <span>Deep Purple</span>
                    </li>
                    <li data-theme="indigo">
                        <div class="indigo"></div>
                        <span>Indigo</span>
                    </li>
                    <li data-theme="blue">
                        <div class="blue"></div>
                        <span>Blue</span>
                    </li>
                    <li data-theme="light-blue">
                        <div class="light-blue"></div>
                        <span>Light Blue</span>
                    </li>
                    <li data-theme="cyan">
                        <div class="cyan"></div>
                        <span>Cyan</span>
                    </li>
                    <li data-theme="teal">
                        <div class="teal"></div>
                        <span>Teal</span>
                    </li>
                    <li data-theme="green">
                        <div class="green"></div>
                        <span>Green</span>
                    </li>
                    <li data-theme="light-green">
                        <div class="light-green"></div>
                        <span>Light Green</span>
                    </li>
                    <li data-theme="lime">
                        <div class="lime"></div>
                        <span>Lime</span>
                    </li>
                    <li data-theme="yellow">
                        <div class="yellow"></div>
                        <span>Yellow</span>
                    </li>
                    <li data-theme="amber">
                        <div class="amber"></div>
                        <span>Amber</span>
                    </li>
                    <li data-theme="orange">
                        <div class="orange"></div>
                        <span>Orange</span>
                    </li>
                    <li data-theme="deep-orange">
                        <div class="deep-orange"></div>
                        <span>Deep Orange</span>
                    </li>
                    <li data-theme="brown">
                        <div class="brown"></div>
                        <span>Brown</span>
                    </li>
                    <li data-theme="grey">
                        <div class="grey"></div>
                        <span>Grey</span>
                    </li>
                    <li data-theme="blue-grey">
                        <div class="blue-grey"></div>
                        <span>Blue Grey</span>
                    </li>
                    <li data-theme="black">
                        <div class="black"></div>
                        <span>Black</span>
                    </li>
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="settings">
                <div class="demo-settings">
                    <p>GENERAL SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Report Panel Usage</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Email Redirect</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>SYSTEM SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Notifications</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Auto Updates</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>ACCOUNT SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Offline</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Location Permission</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
</section>