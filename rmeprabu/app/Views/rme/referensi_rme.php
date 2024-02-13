<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <button type="button" class="btn btn-danger btn-rounded inputcp"><i class="fa fa-plus-circle"></i> Diagnosa Baru</button>
            </div>

            <div class="card-title">
                <h4 class="card-title">Data Referensi RME</h4>
            </div>
            <div class="table-responsive viewdata"></div>
        </div>
    </div>
</div>


<div class="viewmodaldiagnosarme" style="display:none;"></div>

<script>
    function dataReferensiCP() {
        $.ajax({

            url: "<?php echo base_url('PelayananRawatJalanRME/ambildataRME') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    // $(document).ready(function() {
    //     dataReferensiCP();
    // });
</script>


<script>
    $(document).ready(function() {
        dataReferensiCP();
        $('.inputcp').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('PelayananRawatJalanRME/CreateDiagnosaRME') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodaldiagnosarme').html(response.data).show();
                    $('#modalcreate_diagnosa_rme').modal('show');

                }
            });

        });
    });
</script>

<?= $this->endSection(); ?>