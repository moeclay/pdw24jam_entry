<!--Data Widget-->
<div class="box box-danger">
    <div class="box-header">
        <h4><i class="fa fa-laptop"> </i> <b>Total Kinerja Semua </b> <span class="pull-right"><button title="Print" type="button" class="btn btn-primary btn-sm" onclick="window.location.href='<?= site_url();?>admin/laporan/export_file'"><i class="fa fa-print"> Tarik Laporan </i></button><span></span></span></h4>
    </div>
    <div class="box-body">
        <div class="row">
            <!-- Total Faktur -->
            <div class="col-lg-3 col-md-3 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h4><?php echo $tk_semua;?></h4>
        
                        <p><b>Total Kinerja</b></p>
                    </div>
                    <div class="icon">
                        <small><i class="fa fa-cubes"></i></small>
                    </div>
                </div>
            </div>
        
            <!-- Total Faktur Sudah Diambil -->
            <div class="col-lg-3 col-md-3 col-xs-12"
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h4><?php echo $tk_sudah_diambil;?></h4>
        
                        <p><b>Telah Diambil</b></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cube"></i>
                    </div>
                </div>
            </div>
            <!-- Total Faktur Belum Diambil -->
            <div class="col-lg-3 col-md-3 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h4><?php echo $tk_belum_diambil;?></h4>
        
                        <p><b>Siap Diambil<b></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cube"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h4><?php echo $tk_diproses;?></h4>
        
                        <p><b>Diproses<b></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cube"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Data Bulan Widget-->
<div class="box box-danger">
    <div class="box-header">
        <h4><i class="fa fa-laptop"> </i> <b>Total Kinerja <?= ambilNamaBulan(bulanSebelumnya(date('m')));?> </b> <span class="pull-right"><button title="Print" type="button" class="btn btn-primary btn-sm" onclick="window.location.href='<?= site_url();?>admin/laporan/export_filemonthly'"><i class="fa fa-print"> Tarik Laporan </i></button></span></h4>
    </div>
    <div class="box-body">
        <div class="row">
            <!-- Total Faktur -->
            <div class="col-lg-3 col-md-3 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h4><?php echo $terakhir_semua;?></h4>
        
                        <p><b>Total | <?= ambilNamaBulan(bulanSebelumnya(date('m')));?></b></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                </div>
            </div>
    
            <!-- Total Faktur Sudah Diambil -->
            <div class="col-lg-3 col-md-3 col-xs-12"
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h4><?php echo $terakhir_sudah_diambil; ?></h4>
        
                        <p><b>Telah Diambil | <?= ambilNamaBulan(bulanSebelumnya(date('m')));?></b></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                </div>
            </div>

            <!-- Total Faktur Sudah Diambil -->
            <div class="col-lg-3 col-md-3 col-xs-12"
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h4><?php echo $terakhir_belum_diambil; ?></h4>
        
                        <p><b>Belum Diambil | <?= ambilNamaBulan(bulanSebelumnya(date('m')));?></b></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-xs-12"
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h4><?php echo $terakhir_diproses; ?></h4>
        
                        <p><b>Diproses | <?= ambilNamaBulan(bulanSebelumnya(date('m')));?></b></p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>