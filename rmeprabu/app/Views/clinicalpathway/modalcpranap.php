<div id="modalcpranap" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">
                    <button type="button" class="btn btn-info waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>

                </h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <!-- Column -->
                    <div class="col-lg-3 col-md-12">

                        <div class="card profile-card"> <img class="card-img profile-img" src="<?= base_url(); ?>/assets/images/background/kamaroperasi.jpg" alt="Card image">
                            <div class="card-img-overlay card-inverse social-profile d-flex justify-content-center">
                                <?php


                                if ($pasiengender == 'L') {


                                    $gambar = base_url() . '/assets/images/users/pasienlaki.jpg';
                                } else {
                                    $gambar = base_url() . '/assets/images/users/pasienperempuan.jpg';
                                }

                                ?>
                                <div class="align-self-center"> <?php echo "<img src='" . $gambar . "' class='rounded-circle' width='100'>"; ?>
                                    <h4 class="card-title"><?= $pasienname; ?>
                                        <?php if ($statusrawatinap <> "PULANG") { ?>
                                            <button class="btn btn-outline-info waves-effect waves-light" type="button" onclick="ubah('<?= $id ?>')"><i class="fa fa-edit"></i></button>
                                        <?php } ?>

                                    </h4>
                                    <h4 class="card-title"><?= $pasienid; ?>
                                    </h4>
                                    <h6 class="card-subtitle"></h6>
                                    <p class="text-white"><?= $pasienaddress; ?> <?= $pasiensubareaname; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <?php if (($pasienclassroom == 'KLS3') and ($classroom == 'KLS3')) {
                                    $kesimpulankelas = 'Sesuai Hak kelas';
                                    $naik = 0;
                                } else {
                                    if (($pasienclassroom == 'KLS3') and ($classroom == 'KLS2')) {
                                        $kesimpulankelas = 'Naik kelas';
                                        $naik = 1;
                                    } else {
                                        if (($pasienclassroom == 'KLS3') and ($classroom == 'KLS1')) {
                                            $kesimpulankelas = 'Naik kelas';
                                            $naik = 1;
                                        } else {
                                            if (($pasienclassroom == 'KLS2') and ($classroom == 'KLS2')) {
                                                $kesimpulankelas = 'Sesuai Hak kelas';
                                                $naik = 0;
                                            } else {
                                                if (($pasienclassroom == 'KLS2') and ($classroom == 'KLS1')) {
                                                    $kesimpulankelas = 'Naik kelas';
                                                    $naik = 1;
                                                } else {
                                                    $kesimpulankelas = '';
                                                    $naik = 0;
                                                }
                                            }
                                        }
                                    }
                                } ?>
                                <small class="text-muted">Cara Bayar</small>
                                <h6><?= $paymentmethodname; ?> Hak kelas : <?= $pasienclassroom; ?> <span class="<?php if ($naik == 1) {
                                                                                                                        echo "badge badge-danger";
                                                                                                                    } else {
                                                                                                                        echo "badge badge-success";
                                                                                                                    }  ?>"><?= $kesimpulankelas ?></span></h6>
                                <small class="text-muted mt-2 d-block">Kartu Asusuransi</small>
                                <button class="btn btn-outline-success waves-effect waves-light btn-card" data-pasiencard="<?= $paymentcardnumber; ?>" data-registerdate="<?= $documentdate; ?>"><span class="mr-1"><i class="fas fa-id-card-alt"></i></span> <?= $paymentcardnumber; ?></button>
                                <small class="text-muted mt-2 d-block">No. Registrasi</small>
                                <h6><?= $journalnumber; ?> <?= ' _ '; ?>Tanggal Registrasi : <?= $documentdate; ?></h6>
                                <small class="text-muted mt-2 d-block">Dokter Penanggung Jawab</small>
                                <h6><?= $doktername; ?><?= ' _ '; ?>SMF : <?= $smfname; ?></h6>

                                <small class="text-muted mt-2 d-block">Ruang & Kelas Perawatan</small>
                                <h6><?= $roomname; ?><?= ' _ '; ?>Kelas : <?= $classroomname; ?></h6>
                                <small class="text-muted mt-2 d-block">Diagnosa</small>
                                <h6><?= $icdxname; ?><?= ' _ '; ?>Kode ICD X : <?= $icdx; ?></h6>
                                <div class="form-group">
                                    <label>
                                        <h6><span class="badge badge-danger">Diagnosa Clinical Pathway</span></h6>
                                    </label>
                                    <select name="diagnosa_cp" id="diagnosa_cp" class="form-control-select2 filter-input" style="width: 100%">
                                        <option value="">Pilih Diagnosa</option>
                                        <?php foreach ($clinical as $cp) { ?>
                                            <option data-id="<?= $cp['diagnosa']; ?>" class="select-rincian"><?= $cp['diagnosa']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-9 col-md-12">
                        <div class="card">
                            <!-- Nav tabs -->

                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div class="tab-pane active" id="profile3" role="tabpanel">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-6 border-right"> <strong>Nomor Rekam Medis</strong>
                                                <br>
                                                <p class="text-muted"><?= $pasienid; ?></p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 border-right"> <strong>Nama</strong>
                                                <br>
                                                <p class="text-muted"><?= $pasienname; ?></p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 border-right"> <strong>Tanggal Lahir</strong>
                                                <br>
                                                <p class="text-muted"><?= $pasiendateofbirth; ?></p>
                                            </div>
                                            <div class="col-md-3 col-xs-6"> <strong>Alamat</strong>
                                                <br>
                                                <p class="text-muted"><?= $pasienaddress; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>">
                                        <p class="mt-4 viewdataresume">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="viewmodaldact" style="display:none;"></div>


<script>
    function dataresume() {

        $.ajax({

            url: "<?php echo base_url('ClinicalPathway/resumeGabungCP') ?>",
            data: {
                referencenumber: $('#referencenumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataresume').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataresume();

    });
</script>

<script src="<?= base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script>
    $(function() {
        $(".select2").select2();

        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
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
            }, // let our custom formatter work
            minimumInputLength: 1,

        });
    });
</script>



<script>
    $('.filter-input').on('change', function() {
        let rincian = $('#diagnosa_cp').val();
        let referencenumber = $('#referencenumber').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ClinicalPathway/CP_Pilihan') ?>",
            dataType: "json",
            data: {
                pilihancp: rincian,
                referencenumber: referencenumber

            },
            success: function(response) {
                $('.viewdataresume').html(response.data);

            }
        });
    });
</script>