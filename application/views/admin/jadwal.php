<link href="<?= base_url('assets/absensi/fullcalendar-5.9.0/lib/main.min.css'); ?>" rel='stylesheet' />
<script src=<?= base_url('assets/absensi/fullcalendar-5.9.0/lib/main.min.js'); ?>></script>
<script src=<?= base_url('assets/sweetalert.min.js'); ?>></script>

<!--box list order-->
<div class="row" id="app">
  <div class="col-xs-12">
    <div class="box box-dark">
      
      <div class="box-header bg-info">
        <div class="row">
          <div class="col-md-12">
              <h4 style="font-family: Nunito;" class="box-title"><b>Jadwal Kerja Karyawan</b></h4>
          </div>
        </div>
      </div>

      <!-- jadwal karyawan -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-3">
            <div style="margin-bottom: 10px; text-align: right;">
              <button id="refresh_button" type="button" style="background: #9cd08e33;" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i> Refresh Data</button>  
              <button id="tambah_jadwal" type="button" style="background: #9cd08e33;" class="btn btn-default"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Jadwal</button>  
            </div>

            <div class="panel panel-success">
              <div class="panel-heading"><strong><span class="glyphicon glyphicon-th- list" aria-hidden="true"></span> Daftar Divisi</strong></div>
              <div class="panel-body">
                <div class="list-group" style="max-height: 300px; overflow-y: scroll; background: #9cd08e33;">
                  <?php
                    foreach($list_divisi as $d){
                  ?>
                  <a href="<?= site_url('admin/att/index/').$d->id_divisi; ?>" id="<?= $d->id_divisi; ?>" class="list-group-item"><i class="fa fa-circle-o" aria-hidden="true"></i> <?= $d->nama_divisi; ?></a>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div style="margin-bottom: 10px;">
              <h4 style="font-weight: bold; font-family: Nunito;">Kalender <?= getNamaDivisi($divisi); ?> (<?= $divisi; ?>)</h4>
            </div>
            <div style="background: #9cd08e33; border-radius: 10px;" id="calendar"></div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- modal atur jadwal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalAbsensi" aria-labelledby="modalAbsensiLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 style="font-family: Nunito;" class="modal-title" id="modalAbsensiLabel">Atur Absensi</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal">
          <input type="hidden" id="divisi_karyawan" value="<?= $divisi; ?>" />
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Karyawan</label>
            <div class="col-sm-8">
              <select id="cari_nama" name="cari_nama" class="form-control">
              <?php
                foreach($karyawan as $k){
              ?>
                <option style="font-size: 12px;" value="<?php echo $k->id_karyawan;?>"><?= $k->nama_divisi;?> | <?= $k->nama_lengkap;?></option>
              <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="jam_awal" class="col-sm-2 control-label">Masuk</label>
            <div class="col-sm-5">
              <input type="datetime-local" class="form-control" id="jam_awal">
            </div>
          </div>
          <div class="form-group">
            <label for="jam_akhir" class="col-sm-2 control-label">Pulang</label>
            <div class="col-sm-5">
              <input type="datetime-local" class="form-control" id="jam_akhir">
            </div>
          </div>
          <div class="form-group">
            <label for="warna" class="col-sm-2 control-label">Warna</label>
            <div class="col-sm-2">
              <input id="pilih_warna" type="color" class="form-control" />
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button id="simpanJadwal" type="button" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // defaut method call
    funcGetListEvent();

    // set divisi aktif
    var iddivisi_aktif = '#<?= $divisi; ?>';
    $(iddivisi_aktif).addClass('active');

    // tanggal sekarang
    var tglObj = new Date()
    var tglformat = tglObj.toISOString().split('T')[0];

    // jadwal karyawan
    var jadwalkaryawan = null;

    // inisialisasi calender
    var calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
      locale: 'id',
      timeZone: 'Asia/Jakarta',
      initialView: 'dayGridMonth',
      initialDate: tglformat,
      headerToolbar: {
        left: 'prev,next',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek'
      },
      events: '<?= base_url('admin/att/getevent/').$divisi; ?>',
      dayHeaderFormat: { weekday: 'long' },
      buttonText: {
        month: 'Bulan',
        week: 'Minggu'
      },

      // event select
      selectable: true,
      selectHelper:true,
      select: function(info){
       // show modal call function
       funcOpenModal();
       $("#jam_awal").val(info.startStr+'T08:00:00');
       $("#jam_akhir").val(info.endStr+'T00:00:00');
      },

      // event edit
      editable: true,
      eventResize: function(info) {
        var event_id = info.event.id;
        var event_title = info.event.title;
        var event_start_date = info.event.start.toISOString().slice(0, -5);
        var event_end_date = info.event.end.toISOString().slice(0, -5);

        $.ajax({
         url:"<?= base_url('admin/att/updateevent'); ?>",
         type:"POST",
         data:{id:event_id, start:event_start_date, end:event_end_date},
         success:function(infoupdate){
          swal('berhasil diupdate');
          console.log(infoupdate)
          calendar.refetchEvents();
         }
        });
      },

      // event remove
      eventClick:function(info){
        swal({
          text: "Anda yakin ingin menghapusnya ?",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          var afterdelete = false;
          if (willDelete) {
            var event_id = info.event.id;
            $.ajax({
             url:"<?= base_url('admin/att/deleteevent'); ?>",
             type:"POST",
             data:{id: event_id},
             success:function(infodelete){
              calendar.refetchEvents();
              swal('berhasil dihapus');
              console.log(infodelete);
             }
            });
          }
        });
      },

      // event drop
      eventDrop:function(info){
       var id = info.event.id;
       var start = info.event.startStr;
       var end = info.event.endStr;

       $.ajax({
        url:"<?= base_url('admin/att/updateevent'); ?>",
        type:"POST",
        data:{id:id, start:start, end:end},
        success:function(infoupdate){
          swal('berhasil diupdate');
          console.log(infoupdate);
          calendar.refetchEvents();
        }
       });
      }
    });

    // function to get event list
    function funcGetListEvent(){
      var urlallevent = '<?= base_url('admin/att/getevent/').$divisi; ?>';
      $.ajax({
          url: urlallevent,
          type: 'GET',
          dataType: 'json',
          success: function(res) {
            jadwalkaryawan = res;
          }
      });
    }

    // function to open modal
    function funcOpenModal(){
      calendar.refetchEvents();
      $('#modalAbsensi').modal({
        backdrop: 'static'
      });
    }

    // render calender instance
    calendar.render();

    // open modal
    $("#tambah_jadwal").click(function(){
      // call modal attedence
      funcOpenModal();
    });

    // refresh
    $("#refresh_button").click(function(){
      location.reload();
    });

    // save modal
    $("#simpanJadwal").click(function(){
      var divisi = $("#divisi_karyawan").val();
      var idkaryawan = $("#cari_nama :selected").val();
      var namaTemp = $("#cari_nama :selected").text();
      const nama_lengkap = namaTemp.split(' | ')[1];

      var jam_mulai = $("#jam_awal").val()+':00';
      var jam_akhir = $("#jam_akhir").val()+':00';
      var color = $("#pilih_warna").val();
      $.ajax({
       url:"<?= base_url('admin/att/addevent'); ?>",
       type:"POST",
       data:{divisi_karyawan: divisi, id_karyawan: idkaryawan, title:nama_lengkap, start:jam_mulai, end:jam_akhir, color: color},
       success:function(infoinsert){
        console.log(infoinsert);
        calendar.refetchEvents();

        $('#modalAbsensi').modal('hide');
        swal('berhasil disimpan');
       }
      });
    });
    
  });
</script>