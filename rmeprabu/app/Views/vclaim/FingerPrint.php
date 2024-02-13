<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Perekaman Finger Print</h4>
                <h6 class="card-subtitle"> <code>(Sumber Data Vclaim 2.0)</code></h6>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-2">
                            <div class="input-group">
                                <label class="control-label"></label>
                                <input type="text" name="tglPelayanan" id="tglPelayanan" class="form-control" autocomplete="off" value="<?= date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <label class="control-label"></label>
                                <input type="text" name="card" id="card" class="form-control" autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn btn-info" id="cariSEP" type="button"><i class="fas fa-search"></i> Cari No Kartu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive viewsep"></div>
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
    $('#cariSEP').click(function(e) {
        e.preventDefault();
        let card = $('#card').val();
        let tglPelayanan = $('#tglPelayanan').val();
        $.ajax({
            url: "<?php echo base_url('VclaimAntrean/check_Finger_Print') ?>",
            type: 'POST',
            data: {
                card: card,
                tglPelayanan: tglPelayanan
            },
            dataType: "json",
            success: function(response) {
                if (response.gagal) {
                    Swal.fire({
                        html: 'Pesan: ' + response.pesantambahan,
                        icon: 'warning',
                        title: 'Perhatian',
                        text: response.kodepesan,
                    });
                } else if (response.success) {
                    Swal.fire({
                        html: 'Pesan: ' + response.pesan,
                        //icon: 'success',
                        //title: 'success',
                        text: response.kodepesan,
                    });
                } else {
                    Swal.fire({
                        //html: 'Pesan: ' + response.pesan,
                        icon: 'warning',
                        title: 'Perhatian',
                        text: response.pesantambahan,
                    });

                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>