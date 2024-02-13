<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>


<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-md-12">
        <div class="card profile-card"> <img class="card-img profile-img" src="../assets/images/background/kamaroperasi.jpg" alt="Card image">
            <div class="card-img-overlay card-inverse social-profile d-flex justify-content-center">
                <?php


                if ($pasiengender == 'L') {


                    $gambar = base_url() . '/assets/images/users/pasienlaki.jpg';
                } else {
                    $gambar = base_url() . '/assets/images/users/pasienperempuan.jpg';
                }

                ?>
                <div class="align-self-center"> <?php echo "<img src='" . $gambar . "' class='rounded-circle' width='100'>"; ?>
                    <h4 class="card-title"><?= $pasienname; ?><button class="btn btn-outline-info waves-effect waves-light" type="button" onclick="ubah('<?= $id ?>')"><i class="fa fa-edit"></i></button>

                    </h4>
                    <h4 class="card-title"><?= $pasienid; ?>
                    </h4>
                    <h6 class="card-subtitle"><?= $email; ?></h6>
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
                <small class="text-muted mt-2 d-block">No. Registrasi</small>
                <h6><?= $journalnumber; ?> <?= ' _ '; ?>Tanggal Registrasi : <?= $documentdate; ?></h6>
                <small class="text-muted mt-2 d-block">Dokter Penanggung Jawab</small>
                <h6><?= $doktername; ?><?= ' _ '; ?>SMF : <?= $smfname; ?></h6>

                <small class="text-muted mt-2 d-block">Ruang & Kelas Perawatan</small>
                <h6><?= $roomname; ?><?= ' _ '; ?>Kelas : <?= $classroomname; ?></h6>
                <small class="text-muted mt-2 d-block">Diagnosa</small>
                <h6><?= $icdxname; ?><?= ' _ '; ?>Kode ICD X : <?= $icdx; ?></h6>
                <small class="text-muted mt-2 d-block">Catatan</small>
                <h6><?= $memo; ?></h6>
                <small class="text-muted pt-4 d-block">Kirim Email</small>
                <button class="btn btn-outline-warning waves-effect waves-light" type="button"><span class="mr-1"><i class="far fa-envelope"></i></span>Mail</button>

            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-md-12">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link  active" data-toggle="tab" href="#profile3" role="tab">Resume</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#home" role="tab">Tindakan</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Visite</a></li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile2" role="tab">Asuhan Keperawatan</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">

                <div class="tab-pane active" id="profile3" role="tabpanel">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 border-right"> <strong>NoRm</strong>
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
                        <p class="mt-4 viewdataresume">

                        </p>
                        </p>

                    </div>
                </div>



                <div class="tab-pane" id="home" role="tabpanel">
                    <div class="card-body">
                        <div class="profiletimeline position-relative">
                            <div class="sl-item mt-2 mb-3">
                                <div class="sl-left float-left mr-3"> <img src="../assets/images/users/note.jpg" alt="user" class="rounded-circle"> </div>
                                <div class="sl-right">
                                    <?= form_open('PelayananRanap/simpantindakanranapheader', ['class' => 'formperawatheader']); ?>
                                    <?= csrf_field(); ?>
                                    <form method="post" id="form-filter">
                                        <div class="form-body">

                                            <div class="row pt-3">
                                                <div class="col-md-6">
                                                    <div class="form-group has-danger">
                                                        <label class="control-label">Tindakan Medis</label>
                                                        <input type="text" id="name" name="name" class="form-control" autocomplete="off">
                                                        <input type="hidden" id="groups_TH" name="groups_TH" class="form-control" value="TNO" readonly>
                                                        <input type="hidden" id="jotext_TH" name="journalnumber_TH" class="form-control" readonly>
                                                        <input type="hidden" id="documentdate_TH" name="documentdate_TH" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                                        <input type="hidden" id="documentyear_TH" name="documentyear_TH" class="form-control" value="<?= date('Y'); ?>" readonly>
                                                        <input type="hidden" id="documentmonth_TH" name="documentmonth_TH" class="form-control" value="<?= date('m'); ?>" readonly>
                                                        <input type="hidden" id="registernumber_TH" name="registernumber_TH" class="form-control" readonly>
                                                        <input type="hidden" id="referencenumber_TH" name="referencenumber_TH" class="form-control" value="<?= $referencenumber; ?>" readonly>
                                                        <input type="hidden" id="pasienid_TH" name="pasienid_TH" class="form-control" value="<?= $pasienid; ?>" readonly>
                                                        <input type="hidden" id="oldcode_TH" name="oldcode_TH" class="form-control" value="<?= $oldcode; ?>" readonly>
                                                        <input type="hidden" id="pasienname_TH" name="pasienname_TH" class="form-control" value="<?= $pasienname; ?>" readonly>
                                                        <input type="hidden" id="pasiengender_TH" name="pasiengender_TH" class="form-control" value="<?= $pasiengender; ?>" readonly>
                                                        <input type="hidden" id="pasienage_TH" name="pasienage_TH" class="form-control" value="<?= $pasienage; ?>" readonly>
                                                        <input type="hidden" id="pasiendateofbirth_TH" name="pasiendateofbirth_TH" class="form-control" value="<?= $pasiendateofbirth; ?>" readonly>
                                                        <input type="hidden" id="pasienaddress_TH" name="pasienaddress_TH" class="form-control" value="<?= $pasienaddress; ?>" readonly>
                                                        <input type="hidden" id="pasienarea_TH" name="pasienarea_TH" class="form-control" value="<?= $pasienarea; ?>" readonly>
                                                        <input type="hidden" id="pasiensubarea_TH" name="pasiensubarea_TH" class="form-control" value="<?= $pasiensubarea; ?>" readonly>
                                                        <input type="hidden" id="pasiensubareaname_TH" name="pasiensubareaname_TH" class="form-control" value="<?= $pasiensubareaname; ?>" readonly>
                                                        <input type="hidden" id="paymentmethod_TH" name="paymentmethod_TH" class="form-control" value="<?= $paymentmethod; ?>" readonly>
                                                        <input type="hidden" id="paymentmethodname_TH" name="paymentmethodname_TH" class="form-control" value="<?= $paymentmethodname; ?>" readonly>
                                                        <input type="hidden" id="paymentcardnumber_TH" name="paymentcardnumber_TH" class="form-control" value="<?= $paymentcardnumber; ?>" readonly>
                                                        <input type="hidden" id="smfname_TH" name="smfname_TH" class="form-control" value="<?= $smfname; ?>" readonly>
                                                        <input type="hidden" id="smf_TH" name="smf_TH" class="form-control" value="<?= $smf; ?>" readonly>
                                                        <input type="hidden" id="classroom_TH" name="classroom_TH" class="form-control" value="<?= $classroom; ?>" readonly>
                                                        <input type="hidden" id="classroomname_TH" name="classroomname_TH" class="form-control" value="<?= $classroomname; ?>" readonly>
                                                        <input type="hidden" id="room_TH" name="room_TH" class="form-control" value="<?= $roomfisik; ?>" readonly>
                                                        <input type="hidden" id="roomname_TH" name="roomname_TH" class="form-control" value="<?= $roomfisikname; ?>" readonly>
                                                        <input type="hidden" id="locationcode_TH" name="locationcode_TH" class="form-control" value="" readonly>
                                                        <input type="hidden" id="locationname_TH" name="locationname_TH" class="form-control" value="" readonly>
                                                        <input type="hidden" id="referencenumberparent_TH" name="referencenumberparent_TH" class="form-control" value="NONE" readonly>
                                                        <input type="hidden" id="parentid_TH" name="parentid_TH" class="form-control" value="NONRM" readonly>
                                                        <input type="hidden" id="parentname_TH" name="parentname_TH" class="form-control" value="" readonly>
                                                        <input type="hidden" id="createddate_TH" name="createddate_TH" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                                        <input type="hidden" id="createdby_TH" name="createdby_TH" class="form-control" value="<?= session()->get('email'); ?>" readonly>
                                                    </div>

                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">

                                                        <button type="submit" class="btn btn-danger btnsimpanheader"> <i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    </form>
                                    <?= form_close() ?>
                                    <div>
                                        <?= form_open('PelayananRanap/simpantindakanranap', ['class' => 'formperawat']); ?>
                                        <?= csrf_field(); ?>

                                        <div class="row">
                                            <form method="post" id="form-filter">
                                                <div class="form-body">


                                                    <div class="row pt-3">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-danger">
                                                                <label class="control-label">Tindakan Medis</label>
                                                                <input type="text" id="name" name="name" class="form-control" autocomplete="off">
                                                                <input type="hidden" id="types" name="types" class="form-control" value="<?= $groups; ?>" readonly>
                                                                <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>" readonly>
                                                                <input type="hidden" id="documentdate" name="documentdate" class="form-control" value="<?= $documentdate; ?>" readonly>
                                                                <input type="hidden" id="relation" name="relation" class="form-control" value="<?= $pasienid; ?>" readonly>
                                                                <input type="hidden" id="relationname" name="relationname" class="form-control" value="<?= $pasienname; ?>" readonly>
                                                                <input type="hidden" id="paymentmethod" name="paymentmethod" class="form-control" value="<?= $paymentmethod; ?>" readonly>
                                                                <input type="hidden" id="paymentmethodname" name="paymentmethodname" class="form-control" value="<?= $paymentmethodname; ?>" readonly>
                                                                <input type="hidden" id="classroom" name="classroom" class="form-control" value="<?= $classroom; ?>" readonly>
                                                                <input type="hidden" id="classroomname" name="classroomname" class="form-control" value="<?= $classroomname; ?>" readonly>
                                                                <input type="hidden" id="room" name="room" class="form-control" value="<?= $room; ?>" readonly>
                                                                <input type="hidden" id="roomname" name="roomname" class="form-control" value="<?= $roomname; ?>" readonly>
                                                                <input type="hidden" id="smf" name="smf" class="form-control" value="<?= $smf; ?>" readonly>
                                                                <input type="hidden" id="smfname" name="smfname" class="form-control" value="<?= $smfname; ?>" readonly>


                                                                <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>" readonly>
                                                                <input type="hidden" id="referencenumberparent" name="referencenumberparent" value="NONE" class="form-control" readonly>
                                                                <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="<?= $locationcode; ?>" readonly>
                                                                <input type="hidden" id="token_ranap" name="token_ranap" class="form-control" value="<?= $token_ranap; ?>" readonly>
                                                                <input type="hidden" id="code" name="code" class="form-control">

                                                                <input type="hidden" id="groups" name="groups" class="form-control">
                                                                <input type="hidden" id="category" name="category" class="form-control">
                                                                <input type="hidden" id="categoryname" name="categoryname" class="form-control">
                                                                <input type="hidden" id="share1ori" name="share1ori" class="form-control">
                                                                <input type="hidden" id="share2ori" name="share2ori" class="form-control">
                                                                <input type="hidden" id="price" name="price" class="form-control">
                                                                <input type="hidden" id="bhp" name="bhp" value="0.00" class="form-control">

                                                                <input type="hidden" id="totaltarif" name="totaltarif" class="form-control">
                                                                <input type="hidden" id="totalbhp" name="totalbhp" class="form-control">
                                                                <input type="hidden" id="subtotal" name="subtotal" class="form-control">
                                                                <input type="hidden" id="disc" name="disc" value="0.00" class="form-control">
                                                                <input type="hidden" id="totaldiscount" name="totaldiscount" value="0.00" class="form-control">
                                                                <input type="hidden" id="grandtotal" name="grandtotal" value="0.00" class="form-control">
                                                                <input type="hidden" id="share1" name="share1" class="form-control">
                                                                <input type="hidden" id="share2" name="share2" class="form-control">
                                                                <input type="hidden" id="share21" name="share21" value="0.00" class="form-control">
                                                                <input type="hidden" id="share22" name="share22" value="0.00" class="form-control">
                                                                <input type="hidden" id="memo" name="memo" value="PELAYANAN DAN TINDAKAN BEDAH" class="form-control">
                                                                <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('email'); ?>">
                                                                <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                                                <ul class="list-group" id="autocomplete-pelayanan"></ul>

                                                            </div>
                                                            <div class="form-control-feedback errorname">

                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Jenis Tindakan</label>

                                                                <input type="text" id="groupname" name="groupname" class="form-control" readonly>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Kategori</label>
                                                                <input type="text" id="operationgroup" name="operationgroup" class="form-control" value="" readonly>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label class="control-label">Tarif</label>
                                                                <input type="text" id="priceori" name="priceori" class="form-control" readonly>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label class="control-label">Qty</label>
                                                                <input type="number" id="qty" name="qty" value="1.00" class="form-control" style="text-align: right;">

                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-group">
                                                                <label class="control-label">Bhp</label>
                                                                <input type="number" id="bhpori" name="bhpori" class="form-control" value="0.00" style="text-align: right;">

                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Advice Dokter</label>
                                                                <select name="doktername" id="doktername" class="select2" style="width: 100%">
                                                                    <option></option>
                                                                    <?php foreach ($list as $do) {
                                                                        $selected = ($do['name'] == $doktername) ? 'selected' : '';
                                                                    ?>
                                                                        <option data-id="<?= $do['id']; ?>" <?= $selected; ?> class="select-dokter"><?= $do['name']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <input type="hidden" id="doktername2" name="doktername2" class="form-control" value="<?= $doktername; ?>" readonly>
                                                                <input type="hidden" id="dokter" name="dokter" class="form-control" value="<?= $dokter; ?>" readonly>
                                                                <input type="hidden" id="kode_dpjp" name="kode_dpjp" class="form-control" value="<?= $dokter; ?>" readonly>
                                                                <input type="hidden" id="dpjp" name="dpjp" class="form-control" value="<?= $doktername; ?>" readonly>


                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->

                                                    <!--/row-->

                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-success btnsimpan"> <i class="fa fa-check"></i>
                                                        Save</button>
                                                    <button type="button" class="btn btn-inverse">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                        <?= form_close() ?>

                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="sl-item mt-2 mb-3">
                                <div class="sl-left float-left mr-3"> <img src="../assets/images/users/catatan.png" alt="user" class="rounded-circle"> </div>
                                <div class="sl-right">
                                    <div><a href="#" class="link">Data Tindakan Medis</a> <span class="sl-date text-muted">
                                            <blockquote class="mt-2">
                                                <p class="card-text viewdata">
                                                </p>
                                            </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--second tab-->
                <div class="tab-pane" id="profile" role="tabpanel">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 border-right"> <strong>NoRm</strong>
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
                        <p class="mt-4 viewdata2">

                        </p>
                        </p>

                    </div>
                </div>

                <div class="tab-pane" id="profile2" role="tabpanel">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-xs-6 border-right"> <strong>NoRm</strong>
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
                        <p class="mt-4 viewdata3">

                        </p>
                        </p>

                    </div>
                </div>




            </div>
        </div>
    </div>
    <!-- Column -->
</div>


<div class="viewmodal" style="display:none;"></div>

<script>
    function dataperawat() {
        //let journalnumber = $('#journalnumber').val();
        $.ajax({

            url: "<?php echo base_url('rawatinap/ambildatadetailibs') ?>",
            data: {
                journalnumber: $('#journalnumber').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataperawat();


    });
</script>

<script>
    function datahistori() {

        $.ajax({

            url: "<?php echo base_url('rawatinap/ambildatadetailibs_histori') ?>",
            data: {
                pasienid: $('#relation').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdata2').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datahistori();


    });
</script>


<script>
    function datahistoritindakan() {

        $.ajax({

            url: "<?php echo base_url('rawatinap/ambildatadetailibs_histori_tindakan') ?>",
            data: {
                pasienid: $('#relation').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdata3').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datahistoritindakan();


    });
</script>

<script>
    function dataresume() {

        $.ajax({

            url: "<?php echo base_url('PelayananRanap/resume') ?>",
            data: {
                pasienid: $('#relation').val()
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataresume').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        datahistoritindakan();


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
                        if (response.error.doktername) {
                            $('#doktername').addClass('form-control-danger');
                            $('.errordoktername').html(response.error.doktername);
                        } else {
                            $('#doktername').removeClass('form-control-danger');
                            $('.erroroktername').html('');
                        }

                        if (response.error.name) {
                            $('#name').addClass('form-control-danger');
                            $('.errorname').html(response.error.name);
                        } else {
                            $('#name').removeClass('form-control-danger');
                            $('.errorname').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        })

                        //$('#modaltambah').modal('hide');
                        dataperawat();
                        datahistoritindakan();

                    }
                }


            });
            return false;
        });
    });
</script>



<script>
    $(document).ready(function() {
        $('.formperawatheader').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpanheader').attr('disable', 'disabled');
                    $('.btnsimpanheader').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpanheader').removeAttr('disable');
                    $('.btnsimpanheader').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.doktername) {
                            $('#doktername').addClass('form-control-danger');
                            $('.errordoktername').html(response.error.doktername);
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        })


                        dataperawat();
                        datahistoritindakan();

                    }
                }


            });
            return false;
        });
    });
</script>




<script type="text/javascript">
    $(document).ready(function() {
        var kelas = document.getElementById("classroom").value;

        // Fungsi autocomplete pelayanan yang baru menggunakan jquery ui
        $("#name").autocomplete({
            source: "<?php echo base_url('PelayananRanap/ajax_pelayanan'); ?>?kelas=" + kelas,
            select: function(event, ui) {
                $('#name').val(ui.item.value);
                $('#code').val(ui.item.code);
                $('#groupname').val(ui.item.groupname);
                $('#priceori').val(ui.item.price);

                $('#category').val(ui.item.category);
                $('#categoryname').val(ui.item.categoryname);
                $('#groups').val(ui.item.groups);
                $('#share1ori').val(ui.item.share1ori);
                $('#share2ori').val(ui.item.share2ori);

            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        // ketika select nama dokter maka akan menjalankan fungsi dibawah
        $('#doktername').on('change', function() {
            $.ajax({
                'type': "POST",
                //'url': "http://localhost/simrs/public/index.php/autocomplete/fill_dokter",
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


        $('#doktergeneralname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('autocomplete/fill_dokter') ?>",
                'data': {
                    key: $('#doktergeneralname option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#doktergeneralname').val(data.name);
                    $('#doktergeneral').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

    });
</script>

<script>
    function ubah(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRanap/formubahmaster'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaleditranap').modal('show');

                }
            }

        });


    }
</script>

<?= $this->endSection(); ?>