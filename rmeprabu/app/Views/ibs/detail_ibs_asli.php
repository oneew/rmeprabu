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
                <small class="text-muted mt-2 d-block">No. Registrasi IBS</small>
                <h6><?= $journalnumber; ?> <?= ' _ '; ?>Tanggal Registrasi : <?= $documentdate; ?></h6>
                <small class="text-muted mt-2 d-block">Dokter Penanggung Jawab</small>
                <h6><?= $doktername; ?><?= ' _ '; ?>SMF : <?= $smfname; ?></h6>
                <small class="text-muted mt-2 d-block">Dokter Operator</small>
                <h6><?= $ibsdoktername; ?><?= ' _ '; ?>Anestesi : <?= $ibsanestesiname; ?></h6>
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
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Resume</a>
                </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Asesmen Pra Bedah</a>
                </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Asesmen Pra Anestesi</a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel">
                    <div class="card-body">
                        <div class="profiletimeline position-relative">
                            <div class="sl-item mt-2 mb-3">
                                <div class="sl-left float-left mr-3"> <img src="../assets/images/users/note.jpg" alt="user" class="rounded-circle"> </div>
                                <div class="sl-right">
                                    <div><a href="#" class="link">Input Detail Operasi</a>
                                        <?= form_open('rawatinap/simpandatadetailibs', ['class' => 'formperawat']); ?>
                                        <?= csrf_field(); ?>

                                        <div class="row">
                                            <form method="post" id="form-filter">
                                                <div class="form-body">


                                                    <div class="row pt-3">
                                                        <div class="col-md-6">
                                                            <div class="form-group has-danger">
                                                                <label class="control-label">Tindakan Operasi</label>
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

                                                                <input type="hidden" id="registernumber" name="registernumber" class="form-control" value="<?= $registernumber; ?>" readonly>
                                                                <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $referencenumber; ?>" readonly>
                                                                <input type="hidden" id="referencenumberparent" name="referencenumberparent" value="NONE" class="form-control" readonly>
                                                                <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="<?= $locationcode; ?>" readonly>
                                                                <input type="hidden" id="token_ibs" name="token_ibs" class="form-control" value="<?= $token_ibs; ?>" readonly>
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
                                                                <label class="control-label">Jenis Tindakan Operasi</label>

                                                                <input type="text" id="groupname" name="groupname" class="form-control" readonly>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label class="control-label">Kategori Operasi</label>
                                                                <input type="text" id="operationgroup" name="operationgroup" class="form-control" value="<?= $cases; ?>" readonly>
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
                                                                <label class="control-label">Dokter Pendamping</label>
                                                                <select name="doktergeneralname" id="doktergeneralname" class="select2" style="width: 100%">
                                                                    <option></option>
                                                                    <?php foreach ($list as $dp) { ?>
                                                                        <option data-id="<?= $dp['id']; ?>" class="select-dokter"><?= $dp['name']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <input type="hidden" id="doktergeneral" name="doktergeneral" class="form-control" readonly>
                                                                <input type="hidden" id="doktergeneralname2" name="doktergeneralname2" class="form-control" value="RINI SULVIANI, HJ. DR. SP.A MKES." readonly>

                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Dokter Operator</label>
                                                                <select name="doktername" id="doktername" class="select2" style="width: 100%">
                                                                    <option></option>
                                                                    <?php foreach ($list as $do) {
                                                                        $selected = ($do['name'] == $ibsdoktername) ? 'selected' : '';
                                                                    ?>
                                                                        <option data-id="<?= $do['id']; ?>" <?= $selected; ?> class="select-dokter"><?= $do['name']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                <input type="hidden" id="doktername2" name="doktername2" class="form-control" value="<?= $ibsdoktername; ?>" readonly>
                                                                <input type="hidden" id="dokter" name="dokter" class="form-control" value="<?= $ibsdokter; ?>" readonly>
                                                                <input type="hidden" id="kode_dpjp" name="kode_dpjp" class="form-control" value="<?= $dokter; ?>" readonly>
                                                                <input type="hidden" id="dpjp" name="dpjp" class="form-control" value="<?= $doktername; ?>" readonly>

                                                            </div>
                                                            <div class="form-control-feedback errordoktername">

                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Dokter Anestesi</label>
                                                                <input type="text" id="ibsanestesiname" name="ibsanestesiname" class="form-control" value="<?= $ibsanestesiname; ?>" readonly>
                                                            </div>

                                                        </div>
                                                        <!--/span-->
                                                    </div>
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
                                    <div><a href="#" class="link">Data Operasi</a> <span class="sl-date text-muted">
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
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Full Name</strong>
                                <br>
                                <p class="text-muted">Johnathan Deo</p>
                            </div>
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Mobile</strong>
                                <br>
                                <p class="text-muted">(123) 456 7890</p>
                            </div>
                            <div class="col-md-3 col-xs-6 border-right"> <strong>Email</strong>
                                <br>
                                <p class="text-muted">johnathan@admin.com</p>
                            </div>
                            <div class="col-md-3 col-xs-6"> <strong>Location</strong>
                                <br>
                                <p class="text-muted">London</p>
                            </div>
                        </div>
                        <hr>
                        <p class="mt-4">Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                            arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
                            Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus.
                            Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo
                            ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the
                            1500s, when an unknown printer took a galley of type and scrambled it to
                            make a type specimen book. It has survived not only five centuries </p>
                        <p>It was popularised in the 1960s with the release of Letraset sheets
                            containing Lorem Ipsum passages, and more recently with desktop publishing
                            software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        <h4 class="font-medium mt-4">Skill Set</h4>
                        <hr>
                        <h5 class="mt-4">Wordpress <span class="pull-right">80%</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%; height:6px;">
                                <span class="sr-only">50% Complete</span> </div>
                        </div>
                        <h5 class="mt-4">HTML 5 <span class="pull-right">90%</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%; height:6px;">
                                <span class="sr-only">50% Complete</span> </div>
                        </div>
                        <h5 class="mt-4">jQuery <span class="pull-right">50%</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%; height:6px;">
                                <span class="sr-only">50% Complete</span> </div>
                        </div>
                        <h5 class="mt-4">Photoshop <span class="pull-right">70%</span></h5>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%; height:6px;">
                                <span class="sr-only">50% Complete</span> </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="settings" role="tabpanel">
                    <div class="card-body">
                        <form class="form-horizontal form-material">
                            <div class="form-group">
                                <label class="col-md-12">Full Name</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="example-email" class="col-md-12">Email</label>
                                <div class="col-md-12">
                                    <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Password</label>
                                <div class="col-md-12">
                                    <input type="password" value="password" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Phone No</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="123 456 7890" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12">Message</label>
                                <div class="col-md-12">
                                    <textarea rows="5" class="form-control form-control-line"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12">Select Country</label>
                                <div class="col-sm-12">
                                    <select class="form-control form-control-line">
                                        <option>London</option>
                                        <option>India</option>
                                        <option>Usa</option>
                                        <option>Canada</option>
                                        <option>Thailand</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success">Update Profile</button>
                                </div>
                            </div>
                        </form>
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

                    }
                }


            });
            return false;
        });
    });
</script>


<!-- <script type="text/javascript">
    $(document).ready(function() {

        $('#name').on('keyup', function() {
            $.ajax({
                'type': "POST",
                'url': "<?php echo base_url('autocomplete/ajax_pelayanan') ?>",

                'data': {
                    key: $('#name').val(),
                    term: $('#classroom').val()
                },
                'success': function(response) {
                    // json to object
                    let data = JSON.parse(response);
                    // kosongin ul/semua element li sebelumnya
                    $('#autocomplete-pelayanan').html('');
                    $.each(data, function() {
                        // ngeload element li. gantinya view auto pelayanan
                        $('#autocomplete-pelayanan').append("<li class='list-group-item fill-pelayanan' data-id='" + this.id + "'>" + this.name + "</li>");

                    })
                    // harus ditaruh disini. jika ditaruh diluar ajax maka akan gagal select
                    $('.fill-pelayanan').on('click', function() {
                        $.ajax({
                            'type': "POST",

                            'url': "<?php echo base_url('autocomplete/fill_pelayanan') ?>",
                            'data': {
                                key: $(this).data('id')
                            },
                            'success': function(response) {
                                let data = JSON.parse(response);
                                $('#name').val(data.name);
                                $('#code').val(data.code);
                                $('#groupname').val(data.groupname);
                                $('#priceori').val(data.price);
                                $('#category').val(data.category);
                                $('#categoryname').val(data.categoryname);
                                $('#groups').val(data.groups);
                                $('#share1ori').val(data.share1);
                                $('#share2ori').val(data.share2);
                                $('#autocomplete-pelayanan').html('');
                            }
                        })
                    })

                }
            })

        })

    });
</script> -->

<script type="text/javascript">
    $(document).ready(function() {
        var kelas = document.getElementById("classroom").value;

        // Fungsi autocomplete pelayanan yang baru menggunakan jquery ui
        $("#name").autocomplete({
            source: "<?php echo base_url('rawatinap/ajax_pelayanan'); ?>?kelas=" + kelas,
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
                //'url': "http://localhost/simrs/public/index.php/autocomplete/fill_dokter",
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
            url: "<?php echo base_url('rawatinap/formubah'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaledit').modal('show');

                }
            }

        });


    }
</script>

<?= $this->endSection(); ?>