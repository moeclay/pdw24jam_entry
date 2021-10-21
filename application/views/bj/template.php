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
  <script src="<?php echo base_url(); ?>assets/sweetalert.min.js"></script>

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

  <!-- library vuejs -->
  <script src="<?php echo base_url(); ?>assets/js/vue@2.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/moment.js"></script>

</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">

        <div class="navbar-header">
          <a href="<?php echo site_url('bj/home');?>" class="navbar-brand"><b><?php echo config_item('web_title'); ?></b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="text-center"><a href="<?= site_url('bj'); ?>">Daftar Transaksi</a></li>
            <li class="text-center dropdown ">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-user"></span> <?php echo $this->session->userdata('nama_lengkap'); ?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li class="text-center"><a href="<?php echo site_url('user/keluar');?>"><span class="fa fa-sign-out"></span> Keluar</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <a class="pull-right btn btn-warning navbar-btn text-black" href="<?= site_url('bj/home/late'); ?>"><i class="fa fa-clock-o"></i> Pesanan Terlambat</a>
        

      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>

  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
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

      <!-- simpan alert-->
      <?php if($this->session->flashdata('simpan')) { ?>
        <script type="text/javascript">
          swal({
            title: "<?php echo $this->session->flashdata('simpan'); ?>",
            icon: "success",
          });
        </script>
      <?php } ?>
      
      <!-- gagal alert-->
      <?php if($this->session->flashdata('gagal')) { ?>
        <script type="text/javascript">
          swal({
            title: "<?php echo $this->session->flashdata('gagal'); ?>",
            icon: "error",
          });
        </script>
      <?php } ?>

      <!-- alert pesan sukses-->
      <?php if($this->session->flashdata('sukses')) { ?>
        <div class="alert alert-success alert-dismissible" id="notif-alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php echo $this->session->flashdata('sukses'); ?>
        </div>
        <br>
      <?php } ?>

      <!-- Load page from other view -->
       <?php $this->load->view($main_page);?>  

      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>


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
