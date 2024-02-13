<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Distribusi Barang (Amprah) Dari Gas Central</h4>
            </div>
            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-3">
                            <div class="form-group">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nomor Distribusi</label>
                                <input type="text" name="nomorpesanan" id="nomorpesanan" class="form-control filter-input" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Distribusi Ke</label>
                                <select name="locationname" id="locationname" class="select2" style="width: 100%">
                                    <option>Pilih Sumber Permintaan</option>
                                    <?php foreach ($lokasi as $l) : ?>
                                        <option data-id="<?= $l['id']; ?>" class="select-smf"><?php echo $l['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="hidden" id="locationcode" name="locationcode" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tanggal Distribusi</label>
                                <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">
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
    function dataRegisterDSP() {
        $.ajax({

            url: "<?php echo base_url('DataDistribusiAmprahFarmasiGasCentral/ambildataDDB') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataRegisterDSP();

    });


    $('.filter-input').on('input apply.daterangepicker', function() {

        let nomorpesanan = $('#nomorpesanan').val();
        let locationcode = $('#locationcode').val();
        let DateOut = $('#DateOut').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DataDistribusiAmprahFarmasiGasCentral/caridataDDB') ?>",
            dataType: "json",
            data: {
                nomorpesanan: nomorpesanan,
                locationcode: locationcode,
                DateOut: DateOut
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#locationname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_lokasi') ?>",
                'data': {
                    key: $('#locationname option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#locationname').val(data.name);
                    $('#locationcode').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })


    });
</script>

<?= $this->endSection(); ?>