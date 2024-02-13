<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Surat Kontrol Pasca Pulang Rawat Inap</h4>
                <h6 class="card-subtitle"> <code>(Sumber Data Vclaim 2.0)</code></h6>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <label class="control-label"></label>
                                <input type="text" name="card" id="card" class="form-control" autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn btn-info" id="cariRujukan" type="button"><i class="fas fa-search"></i> Cari Nomor Surat Kontrol</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive viewkontrol"></div>
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
    $('#cariRujukan').click(function(e) {
        e.preventDefault();
        let card = $('#card').val();
        $.ajax({
            url: "<?php echo base_url('VclaimAntrean/check_surat_kontrol') ?>",
            type: 'POST',
            data: {
                card: card
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $('.viewkontrol').html(response.data);
                } else {
                    Swal.fire({
                        html: 'Pesan: ' + response.pesan,
                        icon: 'warning',
                        title: 'Perhatian'
                    });
                    $('.viewkontrol').html(response.data);
                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>