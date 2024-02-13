<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
<link href="<?= base_url(); ?>/css/colors/default-dark.css" id="theme" rel="stylesheet">
<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="mb-0 text-white">Input Rencana Operasi</h4>
            </div>
            <?= form_open('EnJadwal/simpandatajadwal', ['class' => 'formperawat']); ?>
            <?= csrf_field(); ?>
            <div class="card-body">
                <from action="#">
                    <div class="form-body">
                        <h3 class="card-title">Data Pasien & Rencana Jadwal Operasi</h3>
                        <hr>
                        <div class="row pt-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nomorasuransi">Norm</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control required" id="pasienid" name="pasienid" required>
                                        <div class="input-group-append">
                                            <button class="btn-danger btn-rajal" id="btn-carirajal" type="button">IGD/Rajal</button>
                                            <button class="btn-info btn-ranap" id="btn-cariranap" type="button">Ranap</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Nama Pasien</label>
                                    <input type="text" id="pasienname" name="pasienname" class="form-control" required readonly>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Lahir</label>
                                    <input type="text" id="pasiendateofbirth" name="pasiendateofbirth" class="form-control form-control-danger">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Alamat</label>
                                    <input type="text" id="pasienaddress" name="pasienaddress" class="form-control form-control-danger">
                                    <input type="hidden" id="paymentcardnumber" name="paymentcardnumber" class="form-control form-control-danger">
                                    <input type="hidden" id="kodebooking" name="kodebooking" class="form-control form-control-danger">
                                    <input type="hidden" id="kodepoli" name="kodepoli" class="form-control form-control-danger">
                                    <input type="hidden" class="form-control required" id="tanggaljaminput" name="tanggaljaminput" value="<?= date('Y-m-d h:m:s'); ?>" required>

                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group has-success">
                                    <label class="control-label">Dokter Operator</label>
                                    <select name="ibsdoktername" id="ibsdoktername" class="select2 filter-input" style="width: 100%" required>
                                        <option value="">Pilih</option>
                                        <?php foreach ($list as $b) : ?>
                                            <option value="<?php echo $b['name']; ?>"><?php echo $b['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="form-control-feedback erroribsdoktername"></div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-3">
                                <div class="form-group has-success">
                                    <label class="control-label">Dokter Anestesi</label>
                                    <select name="ibsanestesiname" id="ibsanestesiname" class="select2 filter-input" style="width: 100%" required>
                                        <option value="">Pilih</option>
                                        <?php foreach ($anestesi as $anes) : ?>
                                            <option value="<?php echo $anes['name']; ?>"><?php echo $anes['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Prosedur Bedah</label>
                                    <input type="text" id="name" name="name" class="form-control" autocomplete="off">
                                    <input type="hidden" id="classroom" name="classroom" class="form-control" autocomplete="off" value="KLS1">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Kamar Operasi</label>
                                    <select name="kamarok" id="kamarok" class="select2 filter-input" style="width: 100%" required>
                                        <option value="">Pilih</option>
                                        <?php foreach ($kamarok as $kamar) : ?>
                                            <option value="<?php echo $kamar['room']; ?>"><?php echo $kamar['room']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <?= $a = 0; ?>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nomorasuransi">Tanggal</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control required" id="tanggaloperasi" name="tanggaloperasi" value="<?= date('Y-m-d'); ?>" required>
                                        <div class="input-group-append">
                                            <button class="btn-success" type="button"><i class="fas fa-calendar-alt"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nomorasuransi">Jam</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control required" id="jamoperasi" name="jamoperasi" value="<?= date('h:m:s'); ?>" required>
                                        <div class="input-group-append">
                                            <button class="btn-success" type="button"><i class="fas fa-calendar-alt"></i></button>
                                            <input type="hidden" id="createdBy" name="createdBy" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Asal Ruangan/poli</label>
                                    <input type="text" id="asalRuangan" name="asalRuangan" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">No Referensi</label>
                                    <input type="text" id="referencenumber" name="referencenumber" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tim Bedah</label>
                                    <textarea class="form-control" rows="5" name="timpelaksana"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tim Anestesi</label>
                                    <textarea class="form-control" rows="5" name="timanestesi"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Diagnosa</label>
                                    <input type="text" id="diagnosa" name="diagnosa" class="form-control">
                                    <input type="hidden" id="paymentmethodname" name="paymentmethodname" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nomorasuransi">Tanggal Keputusan Operasi</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control required" id="tanggal_keputusan" name="tanggal_keputusan" value="<?= date('Y-m-d'); ?>" required>
                                        <div class="input-group-append">
                                            <button class="btn-success" type="button"><i class="fas fa-calendar-alt"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/row-->



                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i>
                            Save</button>
                        <button type="button" class="btn btn-inverse">Cancel</button>
                    </div>
                </from>

            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<div class="viewmodal" style="display:none;"></div>
<script type="text/javascript">
    $(document).ready(function() {
        var kelas = document.getElementById("classroom").value;
        $("#name").autocomplete({
            source: "<?php echo base_url('rawatinap/ajax_pelayanan_ibs'); ?>?kelas=" + kelas,
            select: function(event, ui) {
                $('#name').val(ui.item.value);

            }
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
                            $('#ibsdoktername').addClass('form-control-danger');
                            $('.erroribsdoktername').html(response.error.ibsdoktername);
                        } else {
                            $('#ibsdoktername').removeClass('form-control-danger');
                            $('.erroribsdoktername').html('');
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                            timer: 1500

                        }).then((result) => {
                            if (result.value) {

                                // dataRegisterPoli();

                            }
                        });

                    }
                }


            });
            return false;
        });
    });
</script>


<script>
    $(document).ready(function() {

        $('.btn-rajal').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('EnJadwal/PasienRajal') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalpasienrajal').modal('show');

                }
            });

        });
        $('.btn-ranap').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('EnJadwal/PasienRanap') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalpasienranap').modal('show');

                }
            });

        });
    });
</script>
<?= $this->endSection(); ?>