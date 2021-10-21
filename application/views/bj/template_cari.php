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

</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">

        <div class="navbar-header">
          <a href="<?php echo site_url('staff/home');?>" class="navbar-brand"><b><?php echo config_item('web_title'); ?></b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="<?php echo site_url('staff');?>">Input Kinerja</a></li>
            <li class="dropdown ">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-user"></span> <?php echo $this->session->userdata('nama_lengkap'); ?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?php echo site_url('user/keluar');?>"><span class="fa fa-sign-out"></span> Keluar</a></li>
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
      <!-- alert pesan sukses-->
      <?php if($this->session->flashdata('sukses')) { ?>
        <div class="alert alert-success alert-dismissible" id="notif-alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <?php echo $this->session->flashdata('sukses'); ?>
        </div>
        <br>
      <?php } ?>


<!-- main kontent -->
<div class="row" id="report_invoice">
    <div class="col-xs-12 col-md-12">
      <form class="form-horizontal" action="#" method="post">
        <div class="panel panel-default">
          <div class="panel-body">
            <!--code here-->
            <h5><i class="fa fa-laptop"> </i> <b>Data Kinerja</b> <span class="pull-right" style="margin-top: -8px;"><button title="Print" type="button" class="btn btn-warning btn-sm"  onclick="printData('report_invoice')"><i class="fa fa-print"> Print Data </i></button><span></h5>
            <hr>
            <div class="row">
               <div class="col-xs-12 col-md-12">
                <!-- kontent here-->
                    <div class="box-body">
                        <div class="form-group">
                            <label for="id_kinerja" class="col-sm-2 control-label">ID Kinerja</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="id_kinerja" type="text" value="<?php echo $view_idkinerja; ?>" readonly/>
                            </div>
                            <label for="total_harga" class="col-sm-2 control-label">Total Harga</label>
                            <div class="col-sm-4">
                              <input class="form-control" name="total_harga" type="text" value="<?php echo $view_totalharga; ?>" readonly/>
                            </div>
                        </div>
                        
                        <!-- data faktur -->
                        <div class="form-group">
                          <label for="tgl_spk" class="col-sm-2 control-label">Tanggal SPK</label>
                          <div class="col-sm-4">
                            <input class="form-control" name="tgl_spk" type="date" value="<?php echo $view_tglspk; ?>" readonly/>
                          </div>
                          
                          <label for="toko" class="col-sm-2 control-label">Toko/Cabang</label>
                          <div class="col-sm-4">
                            <input class="form-control" name="toko" type="text" value="<?php echo $view_toko; ?>" readonly/>
                          </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="no_invoice" class="col-sm-2 control-label">No Invoice</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="no_invoice" type="text" value="<?php echo $view_noinvoice; ?>" readonly/>
                            </div>
        
                            <label for="design_edit" class="col-sm-2 control-label">Design Edit</label>
                            <div class="col-sm-4">
                                <input class="form-control" name="design_edit" type="text" value="<?php echo $view_designedit; ?>" readonly/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="penerimaan" class="col-sm-2 control-label">Penerimaan</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="penerimaan" type="text" value="<?php echo $view_penerimaan; ?>" readonly>
                            </div>
                        </div>
                      
                        <div class="form-group">
                            <label for="pengerjaan" class="col-sm-2 control-label">Pengerjaan</label>
                            <div class="col-sm-10">
                              <input class="form-control" name="pengerjaan" type="text" value="<?php echo $view_pengerjaan; ?>" readonly>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>
          </div>
        </div>
      </form>
    </div>

    <!--daftar list-->
    <div class="col-md-12 col-lg-12">
          <div class="box box-danger">
            <div class="box-header text-center">
              <h4 class="box-title text-danger"><b>Daftar SPK</b></h4>
            </div>
            <div class="box-body table-responsive">
              <!--kode untuk realtime orderan masuk-->
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th class="text-center">No Invoice</th>
                    <th class="text-center">Total Harga</th>
                    <th class="text-center">Tanggal SPK</th>
                    <th class="text-center">Design Edit</th>
                    <th class="text-center">Penerimaan</th>
                    <th class="text-center">Pengerjaan</th>
                  </tr>
                </thead>
                <tbody>
                    <!-- data embedd -->
                    <?php foreach($kinerjaDB2 as $kDB){ ?>
                    <tr class="text-center">
                        <td><?= $kDB->no_invoice; ?></td>
                        <td><?= format_uang($kDB->total_harga); ?></td>
                        <td><?= $kDB->tgl_spk; ?></td>
                        <td><?= $kDB->design_edit; ?></td>
                        <td>
                        <?php
                            // parsing list_penerimaan
                      $data1 = $kDB->penerimaan;
                            if($data1 == 'kosong'){
                                $data4 = 'kosong';
                            }else{
                                $data2 = explode(",",$data1);
                                // buat array penampung
                                $data3 = array();
                                foreach($data2 as $d2){
                                    array_push($data3,getNamaKaryawan($d2));
                                }
                                $data4 = implode("  /  ",$data3);
                            }
                      //output
                      echo $data4;
                        ?>
                        </td>
                        <td>
                        <?php
                            // parsing list_pengerjaan
                      $data6 = $kDB->pengerjaan;
                            if($data6 == 'kosong'){
                                $data9 = 'kosong';
                            }else{
                                $data7 = explode(",",$data6);
                                // buat array penampung
                                $data8 = array();
                                foreach($data7 as $d7){
                                    array_push($data8,getNamaKaryawan($d7));
                                }
                                $data9 = implode("  /  ",$data8);
                            }
                      
                      //output
                      echo $data9;
                        ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
              </table>
            </div>

          </div>
    </div>
</div>



  <!--fotter-->
  <!-- /.content -->
  </div>
    <!-- /.container -->
</div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.2
      </div>
      <strong>Copyright &copy; 2017-<?php echo date('Y');?> <a href="#">Pandawa24Jam</a>.</strong>
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- script for printing -->
<script type="text/javascript">
function printData(el){
    var restorePage  = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorePage; 
}
</script>

<!-- SlimScroll -->
<script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js');?>"></script>

<script src="<?php echo base_url('assets/bower_components/chart.js/Chart.js');?>"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/dist/js/adminlte.min.js');?>"></script>
</body>
</html>