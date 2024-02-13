<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-md-12">
        <div class="card profile-card"> <img class="card-img profile-img" src="../assets/images/background/medicalrecord.jpg" alt="Card image">
            <div class="card-img-overlay card-inverse social-profile d-flex justify-content-center">
                <?php


                if ($pasiengender == 'LAKI-LAKI') {


                    $gambar = base_url() . '/assets/images/users/pasienlaki.jpg';
                } else {
                    $gambar = base_url() . '/assets/images/users/pasienperempuan.jpg';
                }

                ?>
                <div class="align-self-center"> <?php echo "<img src='" . $gambar . "' class='rounded-circle' width='100'>"; ?>
                    <h4 class="card-title"><?= $pasienname; ?>
                        <button class="btn btn-outline-info waves-effect waves-light" type="button" onclick="ubahdata('<?= $id ?>')"><i class="fa fa-edit"></i></button>
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

                <small class="text-muted">Cara Bayar</small>
                <h6><?= $paymentmethodname; ?></h6>
                <small class="text-muted mt-2 d-block">Kartu Asusuransi</small>
                <h6><?= $paymentcardnumber; ?></h6>
                <small class="text-muted mt-2 d-block">Tanggal Lahir</small>
                <h6><span class="mr-1"><i class="fas fa-birthday-cake"></i></span><?= $pasiendateofbirth; ?> (<?= $umur; ?>)</h6>
                <small class="text-muted mt-2 d-block">NIK</small>
                <h6><?= $ssn; ?> <?= ' '; ?>Tanggal Berobat terakhir : <?= $datelastin; ?></h6>
                <small class="text-muted mt-2 d-block">Kontak</small>
                <h6><span class="mr-1"><i class="fas fa-phone"></i><?= $telephone; ?><?= ' '; ?> <span class="mr-1"><i class="fas fa-mobile-alt"></i></span><?= $mobilephone; ?></h6>
                <small class="text-muted mt-2 d-block">Penanggung Jawab</small>
                <h6><?= $parentname; ?><?= ' '; ?> (<i class="fas fa-street-view"></i> <?= $couplename; ?>) <i class="fas fa-mobile-alt"></i></span> <?= $parenttelephone; ?></h6>
                <small class="text-muted mt-2 d-block">Golongan Darah</small>
                <h6><?= $bloodtype; ?></h6>
                <small class="text-muted mt-2 d-block">Status pernikahan</small>
                <h6><?= $maritalstatus; ?><?= ' '; ?></h6>
                <small class="text-muted mt-2 d-block">Agama</small>
                <h6><?= $religion; ?><?= ' '; ?> </h6>
                <small class="text-muted mt-2 d-block">Pendidikan</small>
                <h6><?= $education; ?><?= ' '; ?> </h6>
                <small class="text-muted mt-2 d-block">Alamat</small>
                <h6><?= $pasienaddress; ?><?= ' '; ?>(RT <?= $rt; ?><?= ' '; ?>)(RW <?= $rw; ?><?= ' '; ?>)</h6>
                <?php
                $documentdate = date('Y-m-d');
                ?>
                <div class="text-left">
                    <button class="btn btn-outline-success waves-effect waves-light btn-card" data-pasiencard="<?= $paymentcardnumber; ?>" data-registerdate="<?= $documentdate; ?>"><span class="mr-1"><i class="fas fa-id-card-alt"></i></span>Asuransi</button>
                </div>
                <div class="text-right">
                    <button class="btn btn-outline-warning waves-effect waves-light" type="button" onclick="window.location.href='<?= base_url('/MDP'); ?>'"><span class="mr-1"><i class="fas fa-step-backward"></i></span>Kembali</button>
                </div>



            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link  active" data-toggle="tab" href="#profile3" role="tab">Resume Diagnosa</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home" role="tab">Rawat Jalan</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">IGD</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile2" role="tab">Rawat Inap</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#OP" role="tab">Operasi</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#Penunjang" role="tab">Penunjang</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#Farmasi" role="tab">Farmasi</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">

                <div class="tab-pane active" id="profile3" role="tabpanel">
                    <input type="hidden" id="pasienid" name="pasienid" class="form-control" value="<?= $pasienid; ?>" readonly>
                    <div class="card-body viewdataresume"></div>
                </div>



                <div class="tab-pane" id="home" role="tabpanel">
                    <div class="card-body viewrajal">
                    </div>
                </div>
                <!--second tab-->
                <div class="tab-pane" id="profile" role="tabpanel">
                    <div class="card-body viewIGD">
                    </div>
                </div>

                <div class="tab-pane" id="profile2" role="tabpanel">
                    <div class="card-body viewRanap">
                    </div>
                </div>


                <div class="tab-pane" id="OP" role="tabpanel">
                    <div class="card-body viewOperasi">
                    </div>
                </div>

                <div class="tab-pane" id="Penunjang" role="tabpanel">
                    <div class="card-body viewPenunjang">
                    </div>
                </div>


                <div class="tab-pane" id="Farmasi" role="tabpanel">
                    <div class="card-body viewfarmasiresume">
                    </div>
                </div>




            </div>
        </div>
    </div>
    <!-- Column -->
</div>


<div class="viewmodal" style="display:none;"></div>


<script>
    function dataresume() {

        $.ajax({

            url: "<?php echo base_url('RekamMedis/resumeDiagnosa') ?>",
            data: {
                referencenumber: $('#pasienid').val()
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

<script>
    function resumeRajal() {

        $.ajax({

            url: "<?php echo base_url('RekamMedis/resumeRajal') ?>",
            data: {
                referencenumber: $('#pasienid').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewrajal').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        resumeRajal();


    });
</script>

<script>
    function resumeIgd() {

        $.ajax({

            url: "<?php echo base_url('RekamMedis/resumeIGD') ?>",
            data: {
                referencenumber: $('#pasienid').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewIGD').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        resumeIgd();


    });
</script>


<script>
    function resumeRanap() {

        $.ajax({

            url: "<?php echo base_url('RekamMedis/resumeRanap') ?>",
            data: {
                referencenumber: $('#pasienid').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewRanap').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        resumeRanap();


    });
</script>

<script>
    function resumeOperasi() {

        $.ajax({

            url: "<?php echo base_url('RekamMedis/resumeOperasi') ?>",
            data: {
                referencenumber: $('#pasienid').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewOperasi').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        resumeOperasi();


    });
</script>



<script>
    function resumePenunjang() {

        $.ajax({

            url: "<?php echo base_url('RekamMedis/resumePenunjang') ?>",
            data: {
                referencenumber: $('#pasienid').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewPenunjang').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        resumePenunjang();


    });
</script>

<script>
    function resumeFarmasi() {

        $.ajax({

            url: "<?php echo base_url('RekamMedis/resumeFarmasi') ?>",
            data: {
                referencenumber: $('#pasienid').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewfarmasiresume').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        resumeFarmasi();


    });
</script>








<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable();


    });

    function ubahdata(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('RekamMedis/ubahdatapasien'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalubahpasien').modal('show');

                }
            }

        });


    }
</script>


<script type="text/javascript">
    $(document).ready(function() {

    });


    $('.btn-card').on('click', function() {

        if ($('#pasiencard').val() == '' || $('#registerdate').val == '') {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'Tidak Boleh Kosong'

            })
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Bpjs/check_card') ?>",
                data: {
                    card: $(this).data('pasiencard'),
                    date: $(this).data('registerdate')
                },
                success: function(response) {
                    let parseResponse = JSON.parse(response);
                    if (parseResponse.metaData.code == 200) {

                        Swal.fire({
                            html: 'Nama: ' + parseResponse.response.peserta.nama + '<br>No.Kartu: ' + parseResponse.response.peserta.noKartu + '<br>Jenis Kelamin: ' + parseResponse.response.peserta.sex + '<br>Tanggal Lahir: ' + parseResponse.response.peserta.tglLahir +
                                '<br>Hak Kelas: ' + parseResponse.response.peserta.pisa + '<br>Status: ' + parseResponse.response.peserta.statusPeserta.keterangan + '<br>Pekerjaan: ' + parseResponse.response.peserta.jenisPeserta.keterangan +
                                '<br>Kode Faskes 1: ' + parseResponse.response.peserta.provUmum.kdProvider + '<br>Nama Faskes 1: ' + parseResponse.response.peserta.provUmum.nmProvider + '<br>TMT Kepesertaan: ' + parseResponse.response.peserta.tglTMT,

                            icon: 'success',
                            text: parseResponse.metaData.message,
                        });
                        $('#faskesname').val(parseResponse.response.peserta.provUmum.nmProvider);
                        $('#faskes').val(parseResponse.response.peserta.provUmum.kdProvider);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            //title: 'Error',
                            text: parseResponse.metaData.message

                        });
                    }
                }
            })
        }

    })
</script>



<?= $this->endSection(); ?>