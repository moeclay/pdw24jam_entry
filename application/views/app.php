<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo config_item('web_title'); ?></title>
	<meta charset="utf-8"/>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link href='<?php echo base_url();?>assets/images/favicon.ico' type='image/x-icon' rel='shortcut icon'>
	<link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css"> 
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/preloader/style.css">

	<script src="<?php echo base_url(); ?>assets/preloader/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/preloader/modernizr.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/preloader/script.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/main.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript">
    $(document).ready(function() {
        $('#notif-alert').fadeOut(5000);
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
<!--Data Kontent-->
<body class="app hold-transition login-page">

<div class="login-box">
  <div id="loader-wrapper">
  <div id="loader"></div>
  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>
  
</div>

  <div class="login-logo">
    <h1 style="color: #fff; font-family: 'Fredericka the Great', cursive;"><?php echo config_item('web_title'); ?></h1>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="border-radius: 5px;">
    <p class="login-box-msg"><b>Masukkan username dan password !</b></p>

    <!-- alert untuk validasi-->
    <?php if($this->session->flashdata('error_login')) { ?>
      <div class="alert alert-danger alert-dismissible" id="notif-alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php echo $this->session->flashdata('error_login'); ?>
      </div>
    <?php } ?>

    <form action="user/validasi_credensial" method="post">
      <div class="form-group has-feedback">
        <input autofocus type="text" class="form-control" name="username" placeholder="Username" autofocus>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="data-password" type="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" id="data-checkbox"> Tampilkan Password !
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
  <div class="text-center login-footer"><b>Version</b> <?php echo config_item('version_app');?></div>
</div>

</body>
</html>