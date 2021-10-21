<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="row">
    <div class="col-md-12">
        <h3><b>Cek Mutasi Bank</b></h3>
        <p id="subtitle">pandawa24jam digital printing
            <span style="margin-left: 50px;">
                <a href="<?= site_url('staff/home/mutasi');?>" class="btn btn-warning btn-sm"><i class="fas fa-bank"></i> Semua Transaksi</a>
                <a href="<?= site_url('staff/home/mutasiinfo');?>" class="btn btn-primary btn-sm"><i class="fas fa-info"></i> Info</a>
            </span>
        </p>
    </div>
</div>

<div class="row">
    <?php foreach($allinfo as $info){ ?>
    <div class="col-md-4">
        <div class="panel panel-default" style="background: #efe; border: 2px dashed #555;">
          <div class="panel-heading"><?= $info->service_name; ?></div>
          <div class="panel-body">
            <p><i class="far fa-dot-circle"></i> A.N Rekening : <?= $info->account_name; ?></p>
            <p><i class="far fa-dot-circle"></i> No Rekening  : <?= $info->account_number; ?></p>
            <p><i class="far fa-dot-circle"></i> Total Saldo  : <?= format_uang($info->balance); ?></p>
            <p><i class="far fa-dot-circle"></i> Status Bank  : <?= $info->status; ?></p>
          </div>
        </div>
    </div>
    <?php } ?>
</div>