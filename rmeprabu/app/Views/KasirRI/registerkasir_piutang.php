<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h4 class="card-title">Laporan Piutang Kasir</h4>
            </div>

            <form action="#">
                <div class="form-body">

                    <div class="row pt-2">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">NoRekamMedis</label>
                                <input type="text" name="norm" id="norm" class="form-control filter-input" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Nama Pasien</label>
                                <input type="text" name="patientname" id="patientname" class="form-control filter-input" autocomplete="off">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Metode Pembayaran</label>
                                <select name="metodepembayarancari" id="metodepembayarancari" class="select2 filter-input" style="width: 100%">
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <?php foreach ($list as $b) : ?>
                                        <option value="<?php echo $b['name']; ?>"><?php echo $b['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">StatusPembayaran</label>
                                <select name="statusbayar" id="statusbayar" class="select2 filter-input" style="width: 100%">
                                    <option value="">Pilih Status</option>
                                    <option value="LUNAS">Lunas</option>
                                    <option value="PIUTANG">Piutang</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tgl Validasi</label>
                                <input type="text" name="DateOutPenerimaan" id="DateOutPenerimaan" class="form-control daterange filter-input" autocomplete="off">
                            </div>
                        </div>

                    </div>
                </div>
            </form>

            <div class="table-responsive viewdata">


            </div>

        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    function dataRegisterPoli() {
        $.ajax({

            url: "<?php echo base_url('KasirRanap/ambildatapiutang') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataRegisterPoli();

    });
    $('.filter-input').on('input apply.daterangepicker', function() {

        let patientname = $('#patientname').val();
        let norm = $('#norm').val();
        let metodepembayaran = $('#metodepembayarancari').val();
        let DateOut = $('#DateOutPenerimaan').val();
        let statusbayar = $('#statusbayar').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRanap/caridatapiutang') ?>",
            dataType: "json",
            data: {
                patientname: patientname,
                norm: norm,
                metodepembayaran: metodepembayaran,
                DateOut: DateOut,
                statusbayar: statusbayar
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>




<?= $this->endSection(); ?>