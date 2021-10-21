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
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="http://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
    <script src="<?php echo base_url('assets/dist/js/adminlte.min.js');?>"></script>
    <script type="text/javascript">
        // pengerjaan data personal
        getData4();
        async function getData4(){
            let result1 = await fetch("http://entry.org/admin/laporan/kalkulasibarangjadi");
            let result  = await result1.json();
            var panjang = result.kinerja.length.toString();
            
            let databarangjadi = "";
            for(var i=0; i<panjang; i++){
                // master 1
                operator      = result.kinerja[i].operator;
                totalinput    = result.kinerja[i].totalinput;
                totalambil    = result.kinerja[i].totalambil;
                rata2         = result.kinerja[i].rata2;

                databarangjadi += "<tr><td>"+operator.toUpperCase()+"</td><td>"+totalinput+"</td><td>"+totalambil+"</td><td>"+rata2+"</td></tr>";
            }
            document.getElementById("databarangjadi").innerHTML = databarangjadi;

            // datatable
            $('#barangjadi').DataTable({
                paging: false,
                order: [[ 3, "desc" ]],
                searching: false
            });
        }
    </script>
</head>
<body class="hold-transition skin-green fixed sidebar-mini">

 <div class="wrapper">
  <header class="main-header">
        <a href="#" class="logo">
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
                <li><a href="<?php echo site_url('admin/staff');?>"><i class="fa fa-user"></i> Data Staff </a></li>
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
   <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="<?= site_url('admin/laporan2/index'); ?>"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a></li>
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
        <li class="treeview active">
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
            <li class="active"><a href="<?= site_url('admin/laporan2/barangjadi'); ?>"><i class="fa fa-circle-o"></i> BARANG JADI</a></li>
          </ul>
        </li>
        <li><a href="<?= site_url('admin/laporan2/bulan'); ?>"><i class="fa fa-calendar" aria-hidden="true"></i> <span>BULAN</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
   </aside>
  
   <div class="content-wrapper">
       
        <!-- alert notif -->
        <?php if($this->session->flashdata('pesan')) { ?>
        <div class="alert alert-danger alert-dismissible" id="notif-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $this->session->flashdata('pesan'); ?>
        </div>
        <br>
        <?php } ?>
    
        <?php if($this->session->flashdata('sukses')) { ?>
        <div class="alert alert-success alert-dismissible" id="notif-alert">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $this->session->flashdata('sukses'); ?>
        </div>
        <?php } ?>

      <section class="content">
        <div class="row">
            <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header">
                            <!-- data personal kinerja produksi keseluruhan -->
                            <p class='text-center'><b>BARANG JADI | KINERJA</b></p>
                        </div>

                        <div class="box-body">
                            <div class="chart-container">
                                <table class="table table-striped table-responsive text-center" id="barangjadi">
                                    <thead>
                                        <tr>
                                            <th>Operator BarangJadi</th>
                                            <th>Total Input</th>
                                            <th>Total Ambil</th>
                                            <th>Rata2 Kinerja</th>
                                        </tr>
                                    </thead>
                                    <tbody id="databarangjadi"></tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end of box-body-->
                    </div>
                </div>
        </div>
       </section>
   </div>

    <footer class="main-footer">
          <div class="pull-right hidden-xs">
            <b>Version</b> <?php echo config_item('version_app'); ?>
          </div>
          <strong>Copyright &copy; 2017-<?php echo date('Y');?> <a href="#">Pandawa24Jam</a>.</strong>
  </footer>
  
 </div>
 
 
</body>
</html>
