<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Rujukan Peserta JKN</h4>
                <h6 class="card-subtitle"> <code>(Sumber Data Vclaim 2.0)</code></h6>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <select name="searchBy" id="searchBy" class="select2" style="width: 100%">
                                    <option>Pilih Asal Rujukan</option>
                                    <option value="RSS">Faskes I</option>
                                    <option value="RS">RS</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <select name="kriteria" id="kriteria" class="select2" style="width: 100%">
                                    <option>Pilih Kriteria</option>
                                    <option value="1">No Kartu</option>
                                    <option value="2">Nomor Rujukan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <label class="control-label"></label>
                                <input type="text" name="card" id="card" class="form-control" autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn btn-info" id="cariRujukan" type="button"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive viewrujukan"></div>
        </div>
    </div>
</div>
</div>


<div class="viewmodalrujukan" style="display:none;"></div>

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
        let searchBy = $('#searchBy').val();
        let kriteria = $('#kriteria').val();
        let card = $('#card').val();
        $.ajax({
            url: "<?php echo base_url('VclaimAntrean/check_rujukan_kartu_v2') ?>",
            type: 'POST',
            data: {
                searchBy: searchBy,
                card: card,
                kriteria: kriteria
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $('.viewrujukan').html(response.data);
                } else {
                    Swal.fire({
                        html: 'Pesan: ' + response.pesan,
                        icon: 'warning',
                        title: 'Perhatian'
                    });
                    $('.viewrujukan').html(response.data);
                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>