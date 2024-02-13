<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Poli Spesialistik</h4>
                <h6 class="card-subtitle"> <code>(Sumber Data Vclaim 2.0)</code></h6>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <select name="jnsKontrol" id="jnsKontrol" class="select2" style="width: 100%">
                                    <option value="">Jenis Kontrol</option>
                                    <option value="1">SPRI</option>
                                    <option value="2">Rencana Kontrol</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group has-success">
                                <select name="jnsKartu" id="jnsKartu" class="select2" style="width: 100%">
                                    <option value="">Pilih Kriteria</option>
                                    <option value="1">No Kartu</option>
                                    <option value="2">Nomor SEP</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <label class="control-label"></label>
                                <input type="text" name="card" id="card" class="form-control" autocomplete="off">
                            </div>
                            <small class="form-control-feedback text-danger"> Disi NoKa Jika Jns Kontrol SPRI, Disi No.SEP Jika Jns Kontrol Rencana Kontrol</small>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <label class="control-label"></label>
                                <input type="text" name="tglRencanaKontrol" id="tglRencanaKontrol" class="form-control" autocomplete="off" value="<?= date('Y-m-d'); ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-info" id="cariSpesialistik" type="button"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive viewspesialistik"></div>
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
    $('#cariSpesialistik').click(function(e) {
        e.preventDefault();
        let jnsKontrol = $('#jnsKontrol').val();
        let jnsKartu = $('#jnsKartu').val();
        let card = $('#card').val();
        let tglRencanaKontrol = $('#tglRencanaKontrol').val();
        $.ajax({
            url: "<?php echo base_url('VclaimAntrean/check_spesialistik') ?>",
            type: 'POST',
            data: {
                jnsKontrol: jnsKontrol,
                card: card,
                jnsKartu: jnsKartu,
                tglRencanaKontrol: tglRencanaKontrol

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
                    $('.viewspesialistik').html(response.data);
                } else {
                    Swal.fire({
                        html: 'Pesan: ' + response.pesan,
                        icon: 'warning',
                        title: 'Perhatian'
                    });
                    $('.viewspesialistik').html(response.data);
                }
            }
        });
    });
</script>
<?= $this->endSection(); ?>