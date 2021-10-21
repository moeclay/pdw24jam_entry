<header class="main-header">
  <a href="#" class="logo" style="font-family: Nunito;">
    <span class="logo-mini"><b>P</b>DW</span>
    <span class="logo-lg"><b>PANDAWA24JAM</b></span>
  </a>
  <nav class="navbar navbar-static-top">
    <div class="container-fluid">
  
      <div class="navbar-header">
        <a href="<?php echo site_url('admin/home');?>" class="navbar-brand"><b>Indikator Kinerja Utama</b></a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>
  
      <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href="<?php echo site_url('admin/home');?>">Data Kinerja</a></li>
          <li><a href="<?php echo site_url('admin/laporan2');?>">Laporan Data</a></li>
          <li class="dropdown ">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="<?php echo site_url('admin/staff');?>">Data Staff </a></li>
              <li><a href="<?php echo site_url('admin/karyawan');?>">Daftar Karyawan</a></li>
              <li><a href="<?php echo site_url('admin/att');?>">Jadwal Karyawan</a></li>
            </ul>
          </li>
          <li class="dropdown ">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hallo, <?php echo $this->session->userdata('nama_lengkap'); ?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <!--<li><a href="<?php echo site_url('user/ubah_password'); ?>"> <span class="fa fa-lock"></span> Ubah Password</a></li>-->
              <li><a href="<?php echo site_url('user/keluar');?>"><span class="fa fa-sign-out"></span> Keluar</a></li>
            </ul>
          </li>
        </ul>
      </div>
  
    </div>
    <!-- /.container-fluid -->
  </nav>
</header>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active"><a href="<?= site_url('admin/laporan2/index'); ?>"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-th"></i> 
            <span>PERSONAL</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!--<li><a href="<?= site_url('admin/laporan2/personalkinerja'); ?>"><i class="fa fa-circle-o"></i> PRODUKSI KINERJA </a></li>-->
            <li><a href="<?= site_url('admin/laporan2/personalrupiah'); ?>"><i class="fa fa-circle-o"></i> PRODUKSI POINT </a></li>
            <!--<li><a href="<?= site_url('admin/laporan2/sales'); ?>"><i class="fa fa-circle-o"></i> SALES KINERJA </a></li>-->
            <li><a href="<?= site_url('admin/laporan2/salespoint'); ?>"><i class="fa fa-circle-o"></i> SALES POINT </a></li>
          </ul>
          
          
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>DEPT/DIV</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= site_url('admin/laporan2/dept_semua'); ?>"><i class="fa fa-table" aria-hidden="true"></i> - SEMUA - </a></li>
            <li><a href="<?= site_url('admin/laporan2/dept_develop'); ?>"><i class="fa fa-circle-o"></i> DIG_A3+</a></li>
            <li><a href="<?= site_url('admin/laporan2/dept_banner'); ?>"><i class="fa fa-circle-o"></i> BANNER</a></li>
            <li><a href="<?= site_url('admin/laporan2/dept_penjilidan'); ?>"><i class="fa fa-circle-o"></i> PENJILIDAN</a></li>
            <li><a href="<?= site_url('admin/laporan2/dept_bengkel_buku'); ?>"><i class="fa fa-circle-o"></i> BENGKEL BUKU</a></li>
            <li><a href="<?= site_url('admin/laporan2/dept_creative'); ?>"><i class="fa fa-circle-o"></i> CREATIVE</a></li>
            <li><a href="<?= site_url('admin/laporan2/dept_fotocopy'); ?>"><i class="fa fa-circle-o"></i> FOTOCOPY</a></li>
            <li><a href="<?= site_url('admin/laporan2/barangjadi'); ?>"><i class="fa fa-circle-o"></i> BARANG JADI</a></li>
          </ul>
        </li>
        <li><a href="<?= site_url('admin/laporan2/bulan'); ?>"><i class="fa fa-calendar" aria-hidden="true"></i> <span>BULAN</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>