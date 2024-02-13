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
                        <div class="col-md-6">
                            <div class="form-group">

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Catatan</label>
                                <input type="text" name="catatan" id="catatan" class="form-control filter-input" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-md-3">
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

            url: "<?php echo base_url('StockOpnameGudang/ambildataDSO') ?>",
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
        $.ajax({
            type: "post",
            url: "<?php echo base_url('StockOpnameGudang/caridataDSO') ?>",
            dataType: "json",
            data: {

                catatan: catatan,
                DateOut: DateOut
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>

<?= $this->endSection(); ?>