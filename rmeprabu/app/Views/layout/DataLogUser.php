<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Log Pengguna Aplikasi SIMRS</h4>
            <div class="col-md-3">
                <label class="control-label"></label>
                <div class="input-group">
                    <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="icon-calender"></i>
                        </span>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-info" id="cariklaim" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div class="table-responsive viewdata"></div>
        </div>
    </div>
</div>

<div class="viewmodal" style="display:none;"></div>




<script>
    function datausers() {
        $.ajax({

            url: "<?php echo base_url('UsersAkun/ambildataLog') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datausers();

    });

    //$('.filter-input').on('input apply.daterangepicker', function() {
    $('#cariklaim').click(function(e) {
        e.preventDefault();

        let DateOut = $('#DateOut').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('UsersAkun/ambildataLogperiodik') ?>",
            dataType: "json",
            data: {

                DateOut: DateOut
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>

<?= $this->endSection(); ?>