  <!-- =============================================== -->
<?php if($_SESSION["status_user"] == "guru"){ ?>
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar" style='position: fixed;'>
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php base_url();?>assets/admin/dist/img/profile.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo "$_SESSION[nama]"; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
		
		<li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>SOAL</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="#" id='ujian'><i class="fa fa-circle-o"></i>Data Ujian</a></li>
            <li><a href="#" id='jenis_ujian'><i class="fa fa-circle-o"></i>Jenis Ujian</a></li>
            <li><a href="#" id='bank_soal'><i class="fa fa-circle-o"></i> Bank Soal</a></li>
            <!-- <li><a href="#" id='bank_soal_essay'><i class="fa fa-circle-o"></i> Soal Essay</a></li> -->
            
          </ul>
        </li>
		<li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>DATA</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- <li><a href="#" id='profile_sekolah'><i class="fa fa-circle-o"></i>Profile Sekolah</a></li> -->
            <li><a href="#" id='guru'><i class="fa fa-circle-o"></i>Guru</a></li>
            <li><a href="#" id='kelas'><i class="fa fa-circle-o"></i>Kelas</a></li>
            <li><a href="#" id='jurusan'><i class="fa fa-circle-o"></i>Jurusan</a></li>
            <li><a href="#" id='materi'><i class="fa fa-circle-o"></i>Materi</a></li>
            <!-- <li><a href="#" id='absen_struktur'><i class="fa fa-circle-o"></i>Absen Struktur</a></li>
            <li><a href="#" id='absen_input_guru'><i class="fa fa-circle-o"></i>Absen Input Guru</a></li> -->
          </ul>
        </li>
		<!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i>
            <span>Ujian</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" id='ujian'><i class="fa fa-circle-o"></i>Data Ujian</a></li>
            <li><a href="#" id='jenis_ujian'><i class="fa fa-circle-o"></i>Jenis Ujian</a></li>
          </ul>
        </li> -->
		<li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>PENILAYAN</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" id='nilai_bank_soal'><i class="fa fa-circle-o"></i> Soal Pilihan</a></li>
            <!-- <li><a href="#" id='nilai_bank_soal_essay'><i class="fa fa-circle-o"></i> Soal Essay</a></li>
            <li><a href="#" id='save_nilai'><i class="fa fa-circle-o"></i> Save Nilai Pilihan</a></li> -->
          </ul>
        </li>
		<li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>SISWA</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="#" id='data_siswa'><i class="fa fa-circle-o"></i>Data Siswa</a></li>
			<!-- <li><a href="#" id='absensi'><i class="fa fa-circle-o"></i>Absensi</a></li> -->
		  </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
<?php } else {?>
<?php } ?>
  <!-- =======================end left menu======================== -->