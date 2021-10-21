<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/dt-1.10.25/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.25/datatables.min.js"></script>

<div class="row">
    <div class="col-md-12">
        <h3><b>Cek Mutasi Bank</b></h3>
        <p id="subtitle">pandawa24jam digital printing
            <span style="margin-left: 50px;">
                <a href="<?= site_url('staff/home/mutasi');?>" class="btn btn-warning btn-sm"><i class="fa fa-university" aria-hidden="true"></i> Semua Transaksi</a>
                <a href="<?= site_url('staff/home/mutasiinfo');?>" class="btn btn-primary btn-sm"><i class="fa fa-info" aria-hidden="true"></i> Info</a>
            </span>
        </p>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
      <table id="trxSort" class="table table-bordered" style="background: #efe; border: 2px dashed #555;">
        <thead>
          <tr style="background: #ddd;">
            <th style="width: 10px;" class="text-center">ID</th>
            <th style="width: 10px;" class="text-center">Code</th>
            <th class="text-center">Account Name</th>
            <th class="text-center">Jumlah Transfer</th>
            <th class="text-left">Description</th>
            <!--<th class="text-center">Total Saldo</th>-->
            <th class="text-center">Server Time</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($alltrx as $trx){ ?>
          <tr>
            <td class="text-center"><?= $trx->data_id; ?></td>
            <td class="text-center"><?= $trx->service_code; ?></td>
            <td class="text-center"><?= $trx->account_name; ?></td>
            <td class="text-center"><?= format_uang($trx->data_amount); ?></td>
            <td class="text-left"><?= $trx->data_description; ?></td>
            <!--<td class="text-center"><?= format_uang($trx->data_balance); ?></td>-->
            <td class="text-center"><?= date('d-m-Y H:i:s', $trx->data_unix_timestamp); ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#trxSort').DataTable({
      "paging":   true,
      "pageLength": 100,
      "info":     true,
      "order": [[ 0, "desc" ]]
    });
  });
</script>