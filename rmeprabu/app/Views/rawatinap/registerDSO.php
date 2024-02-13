<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Stock Opname</h4>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Lokasi</label>
                                <input type="hidden" id="locationcode" name="locationcode" class="form-control" readonly>
                                <select name="locationname" id="locationname" class="select2" style="width: 100%" required>
                                    <option value="">Pilih Lokasi</option>
                                    <?php foreach ($lokasi as $lr) : ?>
                                        <option data-id="<?= $lr['id']; ?>" class="select-smf"><?php echo $lr['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Catatan</label>
                                <input type="text" name="catatan" id="catatan" class="form-control filter-input" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Tgl Stock Opname</label>
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
    function dataRegisterDSO() {
        $.ajax({

            url: "<?php echo base_url('StockOpnameRuangan/ambildataDSORuangan') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataRegisterDSO();

    });


    $('.filter-input').on('input apply.daterangepicker', function() {
        let catatan = $('#catatan').val();
        let DateOut = $('#DateOut').val();
        let lokasiso = $('#locationcode').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('StockOpnameRuangan/caridataDSORuangan') ?>",
            dataType: "json",
            data: {

                catatan: catatan,
                DateOut: DateOut,
                lokasiso: lokasiso
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