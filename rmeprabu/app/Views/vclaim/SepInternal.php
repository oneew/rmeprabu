<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Sep Internal</h4>
                <h6 class="card-subtitle"> <code>(Sumber Data Vclaim 2.0)</code></h6>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <label class="control-label"></label>
                                <input type="text" name="noSep" id="noSep" class="form-control" autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn btn-info" id="cariSep" type="button"><i class="fas fa-search"></i> Cari SEP Internal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <br>
            <div class="table-responsive viewSepInternal"></div>
        </div>
    </div>
</div>
</div>


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
    $('#cariSep').click(function(e) {
        e.preventDefault();
        let noSep = $('#noSep').val();
        $.ajax({
            url: "<?php echo base_url('VclaimAntrean/check_SepInternal') ?>",
            type: 'POST',
            data: {
                noSep: noSep

            },
            dataType: "json",
            success: function(response) {
                if (response.gagal) {
                    Swal.fire({
                        html: 'Pesan: ' + response.pesan,
                        icon: 'warning',
                        title: 'Perhatian'
                    });
                } else if (response.success) {
                    $('.viewSepInternal').html(response.data);
                } else {
                    Swal.fire({
                        html: 'Pesan: ' + response.pesan,
                        icon: 'warning',
                        title: 'Perhatian'
                    });
                    $('.viewSepInternal').html('');
                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>