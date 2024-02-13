<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Faskes</h4>
                <h6 class="card-subtitle"> <code>(Sumber Data Vclaim 2.0)</code></h6>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <label class="control-label">Jenis Faskes</label>
                                <select name="filter" id="filter" class="form-control custom-select">
                                    <option value="1">Faskes I</option>
                                    <option value="2">RS</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Kode PPK/ Nama PPK</label>
                                <input type="text" name="kodefaskes" id="kodefaskes" class="form-control filter-input" autocomplete="off">
                            </div>
                        </div>


                    </div>
                </div>
            </form>
            <div class="table-responsive viewfaskes"></div>
        </div>
    </div>
</div>
</div>

<div class="viewmodalfaskes" style="display:none;"></div>
<script>
    $('.filter-input').on('change', function() {
        let kodefaskes = $('#kodefaskes').val();
        let filter = $('#filter').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('VclaimAntrean/referensiFaskes') ?>",
            dataType: "json",
            data: {
                kodefaskes: kodefaskes,
                filter: filter
            },
            success: function(response) {
                $('.viewfaskes').html(response.data);

            }
        });
    });
</script>
<?= $this->endSection(); ?>