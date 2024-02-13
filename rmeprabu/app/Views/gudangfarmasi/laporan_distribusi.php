<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>

            </div>

            <div class="card-title">
                <h4 class="card-title">Laporan Distribusi Barang</h4>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-1">
                    <div class="col-sm">
                            <div class="form-group">
                                <label class="control-label">Tanggal Distribusi</label>
                                <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label class="control-label">Distribusi Ke</label>
                                <select name="referencelocationcode" id="referencelocationcode" class="select2 filter-input" style="width: 100%">
                                    <option value="">Pilih Tujuan Distribusi</option>
                                    <?php foreach ($lokasi as $b) : ?>
                                        <option <?= (session()->get('locationcode') == $b['code']) ? 'selected' : null ?> value="<?php echo $b['code']; ?>"><?php echo $b['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-info" id="caristok" type="button"><i class="fas fa-search"></i></button>
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
    function dataDistribusi() {
        $.ajax({
            beforeSend: function() {
                $('.viewdata').empty();
                $('.viewdata').html(`<div class="text-center text-danger h5 font-weight-bold">...Sedang Mengambil Data....</div>`);
            },
            url: "<?php echo base_url('LaporanGudangFarmasi/ambildataDistribusi') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        // dataDistribusi();

    });

    $('#caristok').click(function(e) {
        e.preventDefault();

        let referencelocationcode = $('#referencelocationcode').val();
        let DateOut = $('#DateOut').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('LaporanGudangFarmasi/caridataDistribusi') ?>",
            dataType: "json",
            data: {
                referencelocationcode: referencelocationcode,
                DateOut: DateOut
            },
            beforeSend: function() {
                $('.viewdata').empty();
                $('.viewdata').html(`<div class="text-center text-danger h5 font-weight-bold">...Sedang Mengambil Data....</div>`);
              $("#caristok").attr("disabled", true);  
            },
            success: function(response) {
                $("#caristok").removeAttr("disabled");
                $('.viewdata').html(response.data);

            }
        });
    });
</script>

<?= $this->endSection(); ?>