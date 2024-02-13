<link href="<?= base_url(); ?>/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/tags_input/jquery.tagsinput-revisited.css" />

<div id="modalinsertRujukanKhusus" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Insert Rujukan Khusus</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <!-- Column -->

                    <div class="col-lg-3 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <?php


                                $umur = $umursekarang;
                                if (($sex == 'L') and ($umur <= 5)) {
                                    $gambar = base_url() . '/assets/images/users/anakkecillaki.jpeg';
                                } else if (($sex == 'P') and ($umur <= 5)) {
                                    $gambar = base_url() . '/assets/images/users/anakkecilP.jpeg';
                                } else if (($sex == 'L') and ($umur >= 6) and ($umur <= 12)) {
                                    $gambar = base_url() . '/assets/images/users/remajapria.jpeg';
                                } else if (($sex == 'P') and ($umur >= 6) and ($umur <= 12)) {

                                    $gambar = base_url() . '/assets/images/users/remajaperempuan.jpeg';
                                } else if (($sex == 'L') and ($umur >= 13) and ($umur <= 59)) {
                                    $gambar = base_url() . '/assets/images/users/pasienlaki.jpg';
                                } else if (($sex == 'P') and ($umur >= 13) and ($umur <= 59)) {

                                    $gambar = base_url() . '/assets/images/users/pasienperempuan.jpg';
                                } else if (($sex == 'L') and ($umur >= 60)) {

                                    $gambar = base_url() . '/assets/images/users/priatua.jpeg';
                                } else if (($sex == 'P') and ($umur >= 60)) {

                                    $gambar = base_url() . '/assets/images/users/wanitatua.jpeg';
                                }
                                ?>
                                <div class="mt-4 text-center"> <?php echo "<img src='" . $gambar . "' class='rounded-circle' width='100'>"; ?>
                                    <h4 class="card-title mt-2"><?= $nama; ?></h4>
                                    <h6 class="card-subtitle"><?= $noKartu; ?></h6>

                                    <h6 class="card-subtitle text-dark">NoRujukan : <?= $noRujukan; ?></h6>
                                </div>
                            </div>
                            <div>
                                <hr>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-9 col-md-12">
                        <div class="card">
                            <?php helper('form') ?>
                            <?= form_open('VclaimAntrean/simpanRujukanKhusus', ['class' => 'formperawat']); ?>
                            <?= csrf_field(); ?>
                            <div class="modal-body">
                                <from class="form-horizontal form-material" id="form-filter" method="post">
                                    <div class="form-body">
                                        <div id="slimtest4">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">No Rujukan</label>
                                                        <input type="text" class="form-control" id="noRujukan" name="noRujukan" placeholder="No.Kartu Asuransi" value="<?= $noRujukan ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Nama Pasien</label>
                                                        <input type="text" id="nama" name="nama" class="form-control" readonly value="<?= $nama; ?>" readonly>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group-append">
                                                        <input type="hidden" id="diagAwal" name="diagAwal" class="form-control" autocomplete="off">
                                                        <input type="text" id="diagnosa10" name="diagnosa10" data-role="tagsinput" placeholder="Tambah Diagnosa" />
                                                        <button class="btn btn-info" id="btncari" type="button"><i class="fas fa-search"></i> Cari ICD 10</button>
                                                    </div>
                                                    <div class="input-group list-tag">
                                                    </div>
                                                </div>
                                                <small class="form-control-feedback text-danger"> Disi Diagnosa</small>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="text" id="procedure" name="procedure" class="form-control" autocomplete="off">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-info" id="btn-cariprocedure" type="button"><i class="fas fa-search"></i> Cari ICD 9</button>
                                                    </div>
                                                </div>
                                                <small class="form-control-feedback text-danger"> Disi Procedure</small>
                                            </div>

                                        </div>
                                        <label>Tags input with autocomplete:</label>
                                        <input id="input-diagnosa" name="diagnosa" type="text" value="">

                                    </div>
                            </div>
                            </from>
                        </div>
                        <div class="modal-footer">
                            <button id="tombol" type="submit" class="btn btn-success btnsimpan"><i class="fas fa-plus"></i> Simpan Rujukan Khusus</button>
                        </div>
                        <?= form_close() ?>

                    </div>
                </div>

                <!-- Column -->
            </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="viewmodalrukus" style="display:none;"></div>

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
    $(document).ready(function() {
        $('.formperawat').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",

                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Simpan Rujukan Khusus');
                },
                success: function(response) {
                    if (response.gagal) {
                        Swal.fire({
                            html: 'Pesan: ' + response.pesan,
                            icon: 'warning',
                            title: 'Perhatian'

                        });
                    } else
                    if (response.success) {
                        Swal.fire({
                            html: 'Nomor Rujukan: ' + response.response.rujukan.norujukan + '<br>No.Kapst: ' + response.response.rujukan.nokapst + '<br>Nama: ' + response.response.rujukan.nmpst +
                                '<br>Diagnosa: ' + response.response.rujukan.diagppk + '<br>Tgl Rujukan Awal: ' + response.response.rujukan.tglrujukan_awal + '<br>Tgl Rujukan Akhir: ' + response.response.rujukan.tglrujukan_berakhir,
                            icon: 'success',
                            title: 'succes'
                        });
                    } else {
                        Swal.fire({
                            html: 'Pesan: ' + response.pesan,
                            icon: 'error',
                            title: 'error'
                        });
                    }
                }
            });
            return false;
        });
    });
</script>



<script>
    $('#btncari').click(function(e) {
        e.preventDefault();
        $.ajax({

            url: "<?php echo base_url('VclaimAntrean/CariDiagnosaRujukanKhusus') ?>",
            dataType: "json",
            success: function(response) {
                if (response.suksescaridiagnosa) {
                    $('.viewmodalrukus').html(response.suksescaridiagnosa).show();
                    $('#modalcaridiagnosaRujukanKhusus').modal('show');
                }
            }
        });
    });
</script>

<script type="text/javascript">
    function tutup(id) {
        //e.preventDefault();
        alert('test');
        // let id = $(this).data('id');
        // $('#input' + id).remove();
        // $('#btn' + id).remove();
    }
</script>

<script src="<?= base_url(); ?>/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $("#diagnosa101").autocomplete({
            source: "<?php echo base_url('RawatJalan/ajax_diagnosa'); ?>",
            select: function(event, ui) {
                $('#diagnosa10').val(ui.item.value);
                $('#icdxname').val(ui.item.name);
                $('#icdx').val(ui.item.code);
            }
        });
    });
</script>

<script src="<?= base_url(); ?>/assets/plugins/tags_input/jquery.tagsinput-revisited.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>



<script>
    $('#input-diagnosa').tagsInput({
        'autocomplete': {
            source: [
                '<?php echo base_url('RawatJalan/ajax_diagnosa'); ?>'
            ]

        },
        'delimiter': '|',
    });
</script>