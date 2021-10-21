        <div class="col-md-8 col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <p><span class="fa fa-user-secret"></span> Grafik </p>
              <div class="box-tools pull-right">
                  <button title="Cetak" type="button" class="btn btn-success btn-xs" onclick="printData('data_pribadi')"><i class="fa fa-print"> print</i>
                  </button>
                  <button title="Hide" type="button" class="btn btn-danger btn-xs" data-widget="collapse"><i class="fa fa-minus"> </i>
                  </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div id="data_pribadi" class="box-body table-responsive">
              <h4 class="text-center"><b>SEDANG DALAM MAINTANANCE</b></h4>
              <br>

            <div class="box-footer">
              <!--taro pagination-->
              <div class="text-center">
                  <?php echo $paginator;?>
              </div>
            </div>
          </div>
        </div>
      </div>


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