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
            let result1 = await fetch("http://localhost/entry/admin/laporan/kalkulasipersonal");
            let result  = await result1.json();
            var panjang = result.personal.length.toString();
            
            var pot_ontime = parseInt(result.potongan[0].rupiah_pot);
            var pot_hijau = parseInt(result.potongan[1].rupiah_pot);
            var pot_kuning = parseInt(result.potongan[2].rupiah_pot);
            var pot_merah = parseInt(result.potongan[3].rupiah_pot);
            var pot_ungu = parseInt(result.potongan[4].rupiah_pot);
            
            let datapengerjaan = "";
            for(var i=0; i<panjang; i++){
                // master 1
                totalpersonal = result.personal[i].total_personal;
                
                // master 2
                ontime = ( parseInt(result.personal[i].total_putih)*pot_ontime );
                hijau  = ( parseInt(result.personal[i].total_hijau)*pot_hijau );
                kuning = ( parseInt(result.personal[i].total_kuning)*pot_kuning );
                merah  = ( parseInt(result.personal[i].total_merah)*pot_merah );
                ungu   = ( parseInt(result.personal[i].total_ungu)*pot_ungu );
                total_telat = (hijau+kuning+merah+ungu);
                bonus  = ( ontime + total_telat);
                
                var nama_divisi = result.personal[i].nama_divisi;
                if(nama_divisi === 'Develop'){
                    nama_divisi = 'Digital A3+';
                }
                
                datapengerjaan += "<tr><td>"+result.personal[i].nama.toUpperCase()+" <small>("+nama_divisi+")</small> "+"</td><td style='font-size: 12px;' class='text-center'>"+ontime+"</td><td style='font-size: 12px;' class='text-center'>"+hijau+"</td><td style='font-size: 12px;' class='text-center'>"+kuning+"</td><td style='font-size: 12px;' class='text-center'>"+merah+"</td><td style='font-size: 12px;' class='text-center'>"+ungu+"</td><td style='font-size: 12px; border-left: 1px solid #333;' class='text-center bg-danger'><b>"+total_telat+"</b></td><td style='font-size: 12px; border-left: 1px solid #333; border-right: 1px solid #333;' class='text-center bg-info'><b>"+bonus+"</b></td></tr>";
            }
            document.getElementById("datapengerjaanrupiah").innerHTML = datapengerjaan;

            // datatable
            $('#pengerjaan').DataTable({
                paging: false,
                order: [[ 6, "desc" ]]
            });
        }
    </script>
    
    <!-- font nunito -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet"> 
    <style>
      body{ font-family: 'Nunito', sans-serif; font-size: 12px; }
    </style>
</head>
<body class="hold-transition skin-green fixed sidebar-mini">

 <div class="wrapper">
    <!-- loadnavigation -->
    <?php $this->load->view('dashboard/nav_topleft'); ?>
    <!-- end of loadnavigation -->
  
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
                        <div class="box-header bg-success">
                            <p class="text-center"><b>PRODUKSI POINT | KINERJA</b></p>
                        </div>

                        <div class="box-body">
                            <div class="chart-container">
                                <table class="table table-striped table-responsive" id="pengerjaan">
                                    <thead>
                                        <tr>
                                            <th>Operator Produksi</th>
                                            <th class='text-center'>Sum OnTime</th>
                                            <th class='text-center'>Point &#60;10Menit</th>
                                            <th class='text-center'>Point &#60;30Menit</th>
                                            <th class='text-center'>Point &#60;60Menit</th>
                                            <th class='text-center'>Point &#62;60Menit</th>
                                            <th class='text-center'>Sum Telat</th>
                                            <th class='text-center'>Selisih Point</th>
                                        </tr>
                                    </thead>
                                    <tbody id="datapengerjaanrupiah"></tbody>
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
