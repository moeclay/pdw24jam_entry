<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo config_item('web_title'); ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link href='<?php echo base_url();?>assets/images/favicon.ico' type='image/x-icon' rel='shortcut icon'>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css');?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">
    <style type="text/css">
        li {
          list-style-type: none;
        }

        li a {
          display: block;
          color: #000;
          padding: 8px 16px;
          text-decoration: none;
        }

        li a.active {
          background-color: #4CAF50;
          color: white;
        }

        li a:hover:not(.active) {
          background-color: #555;
          color: white;
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="<?php echo base_url(); ?>assets/preloader/jquery.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
    <script src="<?php echo base_url('assets/dist/js/adminlte.min.js');?>"></script>
    <script type="text/javascript">
        // for get data laporanapi !important
        // author : reza clay
        getData();
        async function getData(){
            console.log('detail data');
        }
    </script>
</head>
<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container-fluid">

        <div class="navbar-header">
          <a href="<?php echo site_url('admin/home');?>" class="navbar-brand"><b>KEY PERFORMANCE INDICATOR</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo site_url('admin/home');?>">Data Kinerja</a></li>
            <li class="dropdown"><a href="<?php echo site_url('admin/laporan');?>">Laporan Data</a></li>
            <li><a href="<?php echo site_url('admin/staff');?>"><span class="fa fa-user"> Data Staff </a></li>
            <li><a href="<?php echo site_url('admin/karyawan');?>"><i class="fa fa-users"></i> Daftar Karyawan</a></li>
            <li class="dropdown ">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-user"></span> <?php echo $this->session->userdata('nama_lengkap'); ?> <span class="caret"></span></a>
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

  <div class="content-wrapper">
    <div class="container-fluid">
      <br>
      <!-- Content Header (Page header) -->
      <!-- Algoritma untuk Pesan / KEsalahan -->
      <!-- alert pesan-->
      <?php if($this->session->flashdata('pesan')) { ?>
        <div class="alert alert-danger alert-dismissible" id="notif-alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php echo $this->session->flashdata('pesan'); ?>
        </div>
        <br>
      <?php } ?>
      <!-- alert pesan sukses-->
      <?php if($this->session->flashdata('sukses')) { ?>
        <div class="alert alert-success alert-dismissible" id="notif-alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php echo $this->session->flashdata('sukses'); ?>
        </div>
      <?php } ?>

        <!-- START OF MAIN CONTENT -->
        <div class="row">
            <!--Data Widget-->
            <div class="col-md-2">
                <div class="box box-danger">
                    <div class="box-header">
                        <p><b><i class="fa fa-bandcamp" aria-hidden="true"></i> MAIN MENU </b></p>
                    </div>
                    <div class="box-body">
                          <li><a href="<?php echo site_url('admin/laporan');?>"><i class="fa fa-line-chart" aria-hidden="true"></i>&nbsp;&nbsp;Dashboard</a></li>
                          <li><a href="<?php echo site_url('admin/laporan/detail');?>"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>&nbsp;&nbsp;Personal</a></li>
                          <li><a href="<?php echo site_url('admin/laporan/divisi');?>"><i class="fa fa-calendar-o" aria-hidden="true"></i>&nbsp;&nbsp;Dept/Div</a></li>
                          <li><a href="<?php echo site_url('admin/laporan/bulan');?>"><i class="fa fa-line-chart" aria-hidden="true"></i>&nbsp;&nbsp;Bulan</a></li>
                          <li><a class="active" href="<?php echo site_url('admin/laporan/tahun');?>"><i class="fa fa-line-chart" aria-hidden="true"></i>&nbsp;&nbsp;Tahun</a></li>
                    </div>
                </div>
            </div>
            <!-- Detail & Grapkhics -->    
            <div class="col-md-10">                
                <div class="box box-danger">
                    <div class="box-header">
                        <p><b>Laporan Tahun : </b><span>Data commit harus lebih dari 2 bulan</span></p>
                    </div>
                    <!-- end of box-body-->
                </div>    
            </div>
        </div>
        <!-- END OF MAIN CONTENT -->
    </div>
  </div>

  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> <?php echo config_item('version_app'); ?>
      </div>
      <strong>Copyright &copy; 2017-<?php echo date('Y');?> <a href="#">Pandawa24Jam</a>.</strong>
    </div>
    <!-- /.container -->
  </footer>
</div>
</body>
</html>
