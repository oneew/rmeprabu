<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Peserta JKN</h4>
                <h6 class="card-subtitle"> <code>(Sumber Data Vclaim 2.0)</code></h6>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <select name="filter" id="filter" class="select2" style="width: 100%">
                                    <option>Pilih Kriteria</option>
                                    <option value="1">No Kartu</option>
                                    <option value="2">NIK</option>
                                </select>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <label class="control-label"></label>
                                <input type="text" name="card" id="card" class="form-control filter-input" autocomplete="off">
                                <input type="hidden" name="tanggal" id="tanggal" class="form-control filter-input" autocomplete="off" value="<?= date('Y-m-d'); ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-info" id="caripeserta" type="button"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive viewpeserta"></div>
        </div>
    </div>
</div>
</div>

<div class="viewmodalfaskes" style="display:none;"></div>
<script>
    $(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();

        $('.selectpicker').selectpicker();



        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // 
                        page: params.page
                    };
                },
                processResults: function(data, params) {

                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            },
            minimumInputLength: 1,

        });
    });
</script>

<script>
    $('#caripeserta').click(function(e) {
        e.preventDefault();
        let tanggal = $('#tanggal').val();
        let filter = $('#filter').val();
        let card = $('#card').val();
        $.ajax({
            url: "<?php echo base_url('VclaimAntrean/check_card') ?>",
            type: 'POST',
            data: {
                tanggal: tanggal,
                card: card,
                filter: filter
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $('.viewpeserta').html(response.data);
                } else {
                    Swal.fire({
                        html: 'Pesan: ' + response.pesan,
                        icon: 'error',
                        title: 'error'
                    });
                    $('.viewpeserta').html(response.data);
                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>