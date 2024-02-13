<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
            </div>
            <div class="table-responsive mt-4">
                <div class="col-lg-12 col-md-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs profile-tab" role="tablist">
                        <li class="nav-item"> <a class="nav-link  active" data-toggle="tab" href="#home" role="tab">Rawat Inap</a></li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Rawat Jalan & IGD</a></li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Pendaftaran Langsung</a></li>

                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane" id="profile3" role="tabpanel">
                            <div class="card-body">
                                <h4>Data Pasien Rawat Jalan & IGD (Pendaftaran Pelayanan Ambulance)</h4>
                                <p class="card-text viewRajal">
                            </div>
                        </div>
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <div class="card-body">
                                <h4>Data Pasien Rawat Inap (Pendaftaran Pelayanan Ambulance)</h4>
                                <p class="card-text viewRanap">
                                </p>
                            </div>
                        </div>
                        <!--second tab-->
                        <div class="tab-pane" id="profile" role="tabpanel">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card card-outline-info">
                                            <div class="card-header">
                                                <h4 class="mb-0 text-white">Pendaftaran Pelayanan Ambulance Non Rekam Medis</h4>
                                            </div>
                                            <div class="card-body">
                                                <?= form_open('RegABL/simpandataNonRM', ['class' => 'formperawat']); ?>
                                                <?= csrf_field(); ?>
                                                <form action="#">
                                                    <div class="form-body">
                                                        <div class="row pt-3">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Norm</label>
                                                                    <input type="text" id="pasienid" name="pasienid" class="form-control" value="NONRM" readonly>

                                                                    <?php
                                                                    helper('text');
                                                                    $token = random_string('alnum', 8);
                                                                    ?>
                                                                    <input type="hidden" id="token_lpa" name="token_lpa" class="form-control" value="<?= $token; ?>">
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            <div class="col-md-3">
                                                                <div class="form-group has-danger">
                                                                    <label class="control-label">Nama Pasien</label>
                                                                    <input type="text" id="pasienname" name="pasienname" class="form-control" required onkeyup="this.value = this.value.toUpperCase()">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group has-danger">
                                                                    <label class="control-label">Tanggal Lahir</label>
                                                                    <input type="text" autocomplete="off" id="datepicker-autoclose" name="pasiendateofbirth" class="form-control" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="pasiengender"> Jenis Kelamin
                                                                        <span class="danger"></span>
                                                                    </label>
                                                                    <select class="select2" style="width:100%;" id="pasiengender" name="pasiengender">
                                                                        <option value="L">LAKI-LAKI</option>
                                                                        <option value="P">PEREMPUAN</option>

                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <!--/span-->
                                                        </div>

                                                        <div class="row pt-3">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Telephone</label>
                                                                    <input type="text" id="pasientelephone" name="pasientelephone" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Alamat</label>
                                                                    <input type="text" id="pasienaddress" name="pasienaddress" class="form-control" required onkeyup="this.value = this.value.toUpperCase()">
                                                                    <input type="hidden" id="visited" name="visited" class="form-control" value="K1">
                                                                    <input type="hidden" id="groups" name="groups" class="form-control" value="ABL">

                                                                    <input type="hidden" id="registernumber" name="registernumber" class="form-control" value="NONE">
                                                                    <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="NONE">
                                                                    <input type="hidden" id="registernumber_rawatjalan" name="registernumber_rawatjalan" class="form-control" value="NONE">
                                                                    <input type="hidden" id="registernumber_rawatinap" name="registernumber_rawatinap" class="form-control" value="NONE">
                                                                    <input type="hidden" id="oldcode" name="oldcode" class="form-control" value="NONE">
                                                                    <input type="hidden" id="registernumber_rawatinap" name="registernumber_rawatinap" class="form-control" value="NONE">
                                                                    <input type="hidden" id="smf" name="smf" class="form-control" value="NONE">
                                                                    <input type="hidden" id="smfname" name="smfname" class="form-control" value="">
                                                                    <input type="hidden" id="room" name="room" class="form-control" value="NONE">
                                                                    <input type="hidden" id="roomname" name="roomname" class="form-control" value="">
                                                                    <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="AMBULANCE">
                                                                    <input type="hidden" id="locationname" name="locationname" class="form-control" value="AMBULANCE">
                                                                    <input type="hidden" id="referencenumberparent" name="referencenumberparent" class="form-control" value="NONE">
                                                                    <input type="hidden" id="icdx" name="icdx" class="form-control" value="NONE">
                                                                    <input type="hidden" id="icdxname" name="icdxname" class="form-control">
                                                                    <input type="hidden" id="parentid" name="parentid" class="form-control" value="NONRM">
                                                                    <input type="hidden" id="parentname" name="parentname" class="form-control">
                                                                    <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                                                    <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                                                    <input type="hidden" id="types" name="types" class="form-control" value="NRM">
                                                                    <input type="hidden" id="orderpemeriksaan" name="orderpemeriksaan" class="form-control" value="NONE">

                                                                </div>
                                                            </div>


                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Kecamatan</label>
                                                                    <input type="text" id="kecamatan" name="kecamatan" class="form-control required" autocomplete="off" value="NONE">
                                                                    <input name="pasienarea" id="pasienarea" type="hidden" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()" value="NONE">
                                                                    <input type="hidden" name="pasiensubarea" id="pasiensubarea" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()" value="NONE">
                                                                    <input type="hidden" name="pasiensubareaname" id="pasiensubareaname" class="form-control" readonly onkeyup="this.value = this.value.toUpperCase()" value="NONE">
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tanggal Pelayanan</label>
                                                                    <input type="text" autocomplete="off" id="documentdate" name="documentdate" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="paymentmethod">Metode Pembayaran</label>
                                                                    <select name="paymentmethod" id="paymentmethod" class="select2" style="width: 100%;">
                                                                        <?php foreach ($metodepembayaran as $bayar) : ?>
                                                                            <option value="<?= $bayar['name']; ?>" class="select-inisial"><?= $bayar['name']; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">No Asuransi</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" id="paymentcardnumber" name="paymentcardnumber">
                                                                        <input type="hidden" class="form-control" id="registerdate" name="registerdate" value="<?= date('Y-m-d'); ?>">
                                                                        <div class="input-group-append">
                                                                            <button class="btn btn-info btncardbpjs" id="btn-card" type="button">Cek!</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="control-label">Faskes</label>
                                                                <div class="input-group">

                                                                    <input type="text" class="form-control" id="faskesname" name="faskesname" placeholder="Nama Faskes" value="DATANG SENDIRI">
                                                                    <input type="hidden" id="faskes" name="faskes" class="form-control" value="SENDIRI">
                                                                    <input type="hidden" name="employee" id="employee" value="NONE">
                                                                    <input type="hidden" name="employeename" id="employeename" value="NONE">
                                                                    <input type="hidden" name="dokter" id="dokter" value="NONE">
                                                                    <input type="hidden" name="doktername" id="doktername" value="NONE">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label>Kelas Pelayanan</label>
                                                                    <select name="classroomname" id="classroomname" class="select2" style="width: 100%" required>
                                                                        <option value="KELAS 2"></option>
                                                                        <?php foreach ($kelas as $kls) { ?>
                                                                            <option data-id="<?= $kls['id']; ?>" class="select-classroomname"><?= $kls['name']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                    <input type="hidden" name="classroom" id="classroom" value="KLS2">
                                                                    <div class="form-control-feedback errordoktername">
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <!--/span-->
                                                        </div>
                                                        <!--/row-->
                                                        <div class="row">


                                                            <!--/span-->
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tanggal Order</label>
                                                                    <input type="text" id="tgl_order" autocomplete="off" name="tgl_order" class="form-control" value="<?= date('Y-m-d'); ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Catatan</label>
                                                                    <input type="text" id="memo" name="memo" class="form-control">
                                                                    <input type="hidden" id="note" name="note" class="form-control" value="REGULER">
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                        </div>
                                                        <!--/row-->
                                                        </from>

                                                    </div>
                                                    <div class="form-actions">
                                                        <button type="submit" class="btn btn-success btnsimpan"> <i class="fa fa-check"></i>
                                                            Simpan</button>
                                                        <button type="button" class="btn btn-inverse">Batal</button>
                                                    </div>
                                                    <?= form_close() ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    function dataperawat() {
        $.ajax({

            url: "<?php echo base_url('RegisterABL/ambildata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewRanap').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataperawat();
    });
</script>
<script>
    function datarajal() {
        $.ajax({
            url: "<?php echo base_url('RegisterABL/ambildatapasienrajal') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewRajal').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datarajal();
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {

        $("#faskesname").autocomplete({
            source: "<?php echo base_url('RawatJalan/ajax_faskes'); ?>",
            select: function(event, ui) {
                $('#faskesname').val(ui.item.value);
                $('#faskes').val(ui.item.code);
            }
        });

        $('#doktername').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('autocomplete/fill_dokter') ?>",
                'data': {
                    key: $('#doktername option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#doktername').val(data.name);
                    $('#dokter').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

        $('#employeename').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('autocomplete/fill_dokter_penunjang') ?>",
                'data': {
                    key: $('#employeename option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#employeename').val(data.name);
                    $('#employee').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

        $('#classroomname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('autocomplete/fill_kelas') ?>",
                'data': {
                    key: $('#classroomname option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#classroomname').val(data.name);
                    $('#classroom').val(data.code);

                    $('#autocomplete-classroomname').html('');
                }
            })
        })
    });
</script>


<script type="text/javascript">
    function berangkat() {
        var page = document.getElementById("token_lpa").value;
        window.location.href = "<?php echo base_url('PelayananABL/inputdetailABL'); ?>?page=" + page;
    }
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
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.ibsdoktername) {
                            $('#doktername').addClass('form-control-danger');
                            $('.errordoktername').html(response.error.doktername);
                        } else {
                            $('#doktername').removeClass('form-control-danger');
                            $('.errordoktername').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                //$('#modaldaftarradiologi').modal('hide');
                                berangkat();
                            }
                        });

                    }
                }


            });
            return false;
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {

        $("#kecamatan").autocomplete({
            source: "<?php echo base_url('RawatJalan/ajax_wilayah'); ?>",
            select: function(event, ui) {
                $('#namakecamatan').val(ui.item.kecamatan);
                $('#kelurahan').val(ui.item.kelurahan);
                $('#kabupaten').val(ui.item.kabupaten);
                $('#propinsi').val(ui.item.propinsi);
                $('#pasiensubarea').val(ui.item.kodewilayah);
                $('#pasienarea').val(ui.item.kabupaten);
                $('#pasiensubareaname').val(ui.item.namasubarea);
            }
        });
    });
</script>

<?= $this->endSection(); ?>