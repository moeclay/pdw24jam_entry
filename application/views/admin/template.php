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
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="<?php echo base_url(); ?>assets/preloader/jquery.min.js" type="text/javascript"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>

  <!--Data Tables -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/jquery.dataTables.css'?>">

  <!-- Data Jquery UI -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/jquery-ui.css">
  <script src="<?php echo base_url(); ?>assets/jquery-ui.js"></script>

  <!-- Data Select2 -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">
  <script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
        $('.select-form-multiple').select2();
        $('#notif-alert').fadeOut(2000);
    });
  </script>

  <!-- font nunito -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet"> 
  <style>
    body{ font-family: 'Nunito', sans-serif; }
  </style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
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
            <li class="dropdown"><a href="<?php echo site_url('admin/laporan2');?>">Laporan Data</a></li>
            <li class="dropdown ">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting <i class="caret"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo site_url('admin/staff');?>">Data Staff </a></li>
                <li><a href="<?php echo site_url('admin/karyawan');?>">Daftar Karyawan</a></li>
                <li><a href="<?php echo site_url('admin/att');?>">Absensi Karyawan</a></li>
              </ul>
            </li>
            <li class="dropdown ">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hallo, <?php echo $this->session->userdata('nama_lengkap'); ?> <i class="caret"></i></a>
              <ul class="dropdown-menu" role="menu">
                <!--<li><a href="<?php echo site_url('user/ubah_password'); ?>"> <i class="fa fa-lock"></i> Ubah Password</a></li>-->
                <li><a href="<?php echo site_url('user/keluar');?>"><i class="fa fa-sign-out"></i> Keluar</a></li>
              </ul>
            </li>
          </ul>
        </div>

      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>

  <!-- Full Width Column -->
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
      
      <!-- Load page from other view -->
       <?php $this->load->view($main_page);?>  

      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container-fluid">
      <div class="pull-right hidden-xs">
        <b>Version</b> <?php echo config_item('version_app'); ?>
      </div>
      <strong>Copyright &copy; 2017-<?php echo date('Y');?> <a href="#">Pandawa24Jam</a>.</strong>
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- SlimScroll -->
<script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js');?>"></script>

<script src="<?php echo base_url('assets/bower_components/chart.js/Chart.js');?>"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js');?>"></script>
</body>
</html>
