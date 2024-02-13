<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
<div class="col-lg-12 col-md-12 px-0">
    <?= form_open('PelayananRawatJalanRME/UbahTriaseIGD', ['class' => 'formasesmen']); ?>
    <?= csrf_field(); ?>
    <div class="modal-body px-0">
        <from class="form-horizontal form-material" id="form-filter" method="post">
            <div class="form-body">
                <?php $no = 0;
                foreach ($tampiltriase as $row) :
                    $no++;
                    $Resusitasi = $row['kondisiPasien'] == "Resusitasi" ? 'checked' : '';
                    $Emergency = $row['kondisiPasien'] == "Emergency" ? 'checked' : '';
                    $Urgent = $row['kondisiPasien'] == "Urgent" ? 'checked' : '';
                    $SemiUrgent = $row['kondisiPasien'] == "Semi Urgent" ? 'checked' : '';
                    $FalseEmergency = $row['kondisiPasien'] == "False Emergency" ? 'checked' : '';
                    $Doa = $row['kondisiPasien'] == "doa" ? 'checked' : '';

                    $BEDAH = $row['kelompokTriase'] == "BEDAH" ? 'checked' : '';
                    $NONBEDAH = $row['kelompokTriase'] == "NON BEDAH" ? 'checked' : '';
                    $ANAK = $row['kelompokTriase'] == "ANAK" ? 'checked' : '';
                    $KEBIDANAN = $row['kelompokTriase'] == "BEDAH" ? 'checked' : '';

                ?>
                    <form>
                        <div class="form-row">
                            <div class="col-md-2 mb-3">
                                <label>Tanggal Kedatangan</label>
                                <input type="text" class="form-control" id="admissionDate" name="admissionDate" required value="<?= $row['admissionDate']; ?>">
                                <input type="hidden" class="form-control" id="id" name="id" required value="<?= $row['id']; ?>">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Jam Kedatangan</label>
                                <input type="text" class="form-control" id="admissionDateTime" name="admissionDateTime" required value="<?= $row['admissionDateTime']; ?>">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Transportasi Kedatangan</label>
                                <select name="transportasi" id="transportasi" class="select2" style="width: 100%" required>
                                    <?php foreach ($mobil as $mob) : ?>
                                        <option value="<?php echo $mob['name']; ?>"><?php echo $mob['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label>BB</label>
                                <input type="number" class="form-control" id="bb" name="bb" required value="<?= $row['bb']; ?>">
                                <small class="form-control-feedback">Kg</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>TB</label>
                                <input type="number" class="form-control" id="tb" name="tb" required value="<?= $row['tb']; ?>">
                                <small class="form-control-feedback">Cm</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Frekuensi Nadi</label>
                                <input type="number" class="form-control" id="frekuensiNadi" name="frekuensiNadi" required value="<?= $row['frekuensiNadi']; ?>">
                                <small class="form-control-feedback">x/menit</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>TD Sistolik</label>
                                <input type="number" class="form-control" id="tdSistolik" name="tdSistolik" required value="<?= $row['tdSistolik']; ?>">
                                <small class="form-control-feedback">mmHg</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>TD Diastolik</label>
                                <input type="number" class="form-control" id="tdDiastolik" name="tdDiastolik" required value="<?= $row['tdDiastolik']; ?>">
                                <small class="form-control-feedback">mmHg</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Suhu</label>
                                <input type="text" class="form-control" id="suhu" name="suhu" required value="<?= $row['suhu']; ?>">
                                <small class="form-control-feedback">oC</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Frekuensi Nafas</label>
                                <input type="number" class="form-control" id="frekuensiNafas" name="frekuensiNafas" required value="<?= $row['frekuensiNafas']; ?>">
                                <small class="form-control-feedback">x/menit</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>SpO2</label>
                                <input type="number" class="form-control" id="spo2" name="spo2" required value="<?= $row['spo2']; ?>">
                                <small class="form-control-feedback">%</small>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Airway</label>
                                <select name="airway" id="airway" class="select2" style="width: 100%" required>
                                    <option value="">Pilih</option>
                                    <?php foreach ($airway as $air) : ?>
                                        <option value="<?php echo $air['name']; ?>" <?php if ($air['name'] == $row['airway']) { ?> selected="selected" <?php } ?>><?php echo $air['name']; ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Breathing</label>
                                <select name="breathing" id="breathing" class="select2" style="width: 100%" required>
                                    <option value="">Pilih</option>
                                    <?php foreach ($breathing as $brea) : ?>
                                        <option value="<?php echo $brea['name']; ?>" <?php if ($brea['name'] == $row['breathing']) { ?> selected="selected" <?php } ?>><?php echo $brea['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Circulation</label>
                                <select name="circulation" id="circulation" class="select2" style="width: 100%" required>
                                    <option value="">Pilih</option>
                                    <?php foreach ($circulation as $circ) : ?>
                                        <option value="<?php echo $circ['name']; ?>" <?php if ($circ['name'] == $row['circulation']) { ?> selected="selected" <?php } ?>><?php echo $circ['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label>Eye</label>
                                <select name="eye2" id="eye2" class="select2" style="width: 100%" required onchange="total2()">
                                    <option value="">Pilih</option>
                                    <?php foreach ($eye as $eye) : ?>
                                        <option value="<?php echo $eye['nilai']; ?>" <?php if ($eye['nilai'] == $row['eye']) { ?> selected="selected" <?php } ?>><?php echo $eye['name']; ?>[<b><?= $eye['nilai']; ?></b>]</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label>Verbal</label>
                                <select name="verbal2" id="verbal2" class="select2" style="width: 100%" required onchange="total2()">
                                    <option value="">Pilih</option>
                                    <?php foreach ($verbal as $verbal) : ?>
                                        <option value="<?php echo $verbal['nilai']; ?>" <?php if ($verbal['nilai'] == $row['verbal']) { ?> selected="selected" <?php } ?>><?php echo $verbal['name']; ?>[<b><?= $verbal['nilai']; ?></b>]</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Motorik</label>
                                <select name="motorik2" id="motorik2" class="select2" style="width: 100%" required onchange="total2()">
                                    <option value="">Pilih</option>
                                    <?php foreach ($motorik as $motorik) : ?>
                                        <option value="<?php echo $motorik['nilai']; ?>" <?php if ($motorik['nilai'] == $row['motorik']) { ?> selected="selected" <?php } ?>><?php echo $motorik['name']; ?>[<b><?= $motorik['nilai']; ?></b>]</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label><b>Total GCS</b></label>
                                <input type="number" class="form-control" id="gcs2" name="gcs2" required readonly value="<?= $row['totalGcs']; ?>">

                            </div>
                            <div class="col-md-2 mb-3">
                                <label>Kesadaran</label>
                                <select name="kesadaran" id="kesadaran" class="select2" style="width: 100%">
                                    <?php foreach ($kesadaran as $kes) : ?>
                                        <option value="<?php echo $kes['name']; ?>" <?php if ($kes['name'] == $row['kesadaran']) { ?> selected="selected" <?php } ?>><?php echo $kes['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>


                            <input type="hidden" class="form-control" id="nomorreferensi" name="nomorreferensi" required value="<?= $row['referencenumber']; ?>">
                            <input type="hidden" class="form-control" id="poliklinikname" name="poliklinikname" required value="<?= $row['poliklinikname']; ?>">
                            <input type="hidden" class="form-control" id="pasienid" name="pasienid" required value="<?= $row['pasienid']; ?>">
                            <input type="hidden" class="form-control" id="pasienname" name="pasienname" required value="<?= $row['pasienname']; ?>">
                            <input type="hidden" class="form-control" id="paymentmethodname" name="paymentmethodname" required value="<?= $row['paymentmethodname']; ?>">


                            <input type="hidden" class="form-control" id="paramedicName2" name="paramedicName2" required value="<?= session()->get('firstname'); ?>">
                            <input type="hidden" class="form-control" id="createdBy" name="createdBy" required value="<?= session()->get('firstname'); ?>">
                            <input type="hidden" class="form-control" id="createddate" name="createddate" required value="<?= date('Y-m-d G:i:s'); ?>">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h6 class="card-title mt-4">
                                    Kesimpulan Triase<br />
                                    <small>
                                        <code></code> </small>
                                </h6>
                                <div class="demo-radio-button">
                                    <input name="kondisiPasien" type="radio" id="Resusitasi" class="radio-col-red" value="Resusitasi" <?= $Resusitasi; ?> />
                                    <label for="Resusitasi">ATS 1 (Resusitasi)</label>
                                    <input name="kondisiPasien" type="radio" id="Emergency" class="radio-col-yellow" value="Emergency" <?= $Emergency; ?> />
                                    <label for="Emergency"> ATS 2 (Emergensi)</label>
                                    <input name="kondisiPasien" type="radio" id="Urgent" class="radio-col-yellow" value="Urgent" <?= $Urgent; ?> />
                                    <label for="Urgent">ATS 3 (Urgensi)</label>
                                    <input name="kondisiPasien" type="radio" id="Semi Urgent" class="radio-col-light-green" value="Semi Urgent" <?= $SemiUrgent; ?> />
                                    <label for="Semi Urgent">ATS 4 (Semi Urgensi)</label>
                                    <input name="kondisiPasien" type="radio" id="False Emergency" class="radio-col-light-green" value="False Emergency" <?= $FalseEmergency; ?> />
                                    <label for="False Emergency">ATS 5 (Tidak Urgensi)</label>
                                    <input name="kondisiPasien" type="radio" id="doa" class="radio-col-black" value="doa" <?= $Doa; ?> />
                                    <label for="doa">DOA (Death On Arrival)</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h6 class="card-title mt-4">
                                    SMF<br />
                                    <small>
                                        <code></code> </small>
                                </h6>
                                <div class="demo-radio-button">
                                    <input name="kelompokTriase" type="radio" id="BEDAH" value="BEDAH" <?= $BEDAH; ?> />
                                    <label for="BEDAH">BEDAH</label>
                                    <input name="kelompokTriase" type="radio" id="NON BEDAH" value="NON BEDAH" <?= $NONBEDAH; ?> />
                                    <label for="NON BEDAH">NON BEDAH</label>
                                    <input name="kelompokTriase" type="radio" id="ANAK" value="ANAK" <?= $ANAK; ?> />
                                    <label for="ANAK">ANAK</label>
                                    <input name="kelompokTriase" type="radio" id="KEBIDANAN DAN KANDUNGAN" value="KEBIDANAN DAN KANDUNGAN" <?= $KEBIDANAN; ?> />
                                    <label for="KEBIDANAN DAN KANDUNGAN">KEBIDANAN DAN KANDUNGAN</label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="control-label">Dokter Pemeriksa</label>
                                    <select name="doktername" id="doktername" class="select2" style="width: 100%" required>
                                        <option value="">Pilih Dokter Pemeriksa</option>
                                        <?php foreach ($list as $dpjp) { ?>
                                            <option value="<?= $dpjp['name']; ?>" <?php if ($dpjp['name'] == $doktername) { ?> selected="selected" <?php } ?>><?= $dpjp['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Perawat</label>
                                <input type="text" class="form-control" id="paramedicName" name="paramedicName" required value="<?= $row['paramedicName']; ?>">
                                <small class="form-control-feedback">Nama Perawat</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <button type="submit" class="btn btn-warning btnsimpan"><i class="fas fa-edit"></i> Ubah</button>
                                <button type="submit" class="btn btn-danger btnhapus" onclick="HapusTriase('<?= $row['id'] ?>')"><i class="fas fa-trash"></i> Hapus</button>
                            </div>

                        </div>

                    </form>
                <?php endforeach; ?>
            </div>
        </from>
    </div>
    <div class="modal-footer">

    </div>
    <?= form_close() ?>
</div>





<script src="<?= base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

<script>
    $(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
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

<script src="<?= base_url(); ?>/assets/plugins/tinymce/tinymce.min.js"></script>
<script>
    $(document).ready(function() {

        if ($("#mymce").length > 0) {
            tinymce.init({
                selector: "textarea#mymce",
                theme: "modern",
                height: 100,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

            });
        }
    });
</script>




<script type="text/javascript">
    $(document).ready(function() {
        var poliklinikname = document.getElementById("poliklinikname").value;
        $("#paramedicName").autocomplete({

            source: "<?php echo base_url('PelayananRawatJalanRME/ajax_paramedicName'); ?>?poliklinikname=" + poliklinikname,
            select: function(event, ui) {
                $('#paramedicName').val(ui.item.value);

            }
        });
    });
</script>


<script type="text/javascript">
    $('#isialergi').on('change', function() {
        if ($('#isialergi').val() == 1) {
            $('#uraianAlergi').removeAttr('disabled');
            $('#isialergi').val(0);
            $('#alergi').val(1);
        } else {
            $('#uraianAlergi').attr('disabled', 'disabled');
            $('#uraianAlergi').val('');
            $('#isialergi').val(1);
            $('#alergi').val(0);

        }

    })
</script>


<script type="text/javascript">
    $('#isinutrisiKondisiKhusus').on('change', function() {
        if ($('#isinutrisiKondisiKhusus').val() == 1) {
            $('#uraianKondisiKhusus').removeAttr('disabled');
            $('#isinutrisiKondisiKhusus').val(0);
            $('#nutrisiKondisiKhusus').val(1);
        } else {
            $('#uraianKondisiKhusus').attr('disabled', 'disabled');
            $('#uraianKondisiKhusus').val('');
            $('#isinutrisiKondisiKhusus').val(1);
            $('#nutrisiKondisiKhusus').val(0);

        }

    })
</script>


<script type="text/javascript">
    $('#isifungsionalAlatBantu').on('change', function() {
        if ($('#isifungsionalAlatBantu').val() == 1) {
            $('#fungsionalNamaAlatBantu').removeAttr('disabled');
            $('#isifungsionalAlatBantu').val(0);
            $('#fungsionalAlatBantu').val(1);
        } else {
            $('#fungsionalNamaAlatBantu').attr('disabled', 'disabled');
            $('#fungsionalNamaAlatBantu').val('');
            $('#isifungsionalAlatBantu').val(1);
            $('#fungsionalAlatBantu').val(0);

        }

    })
</script>


<script>
    $(document).ready(function() {
        $('.formasesmen').submit(function(e) {
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
                    if (response.gagal) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Gagal',
                            text: response.pesan,
                        })

                    } else if (response.error) {
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

                        $('#form-filter-atas').css('display', 'none');
                        $('#form-filter-bawah').css('display', 'block');
                        $('#journalnumber').val(response.JN);
                        $('#kode').val(response.JN);
                        $('#dokter').val(response.dokter);
                        $('#doktername').val(response.doktername);
                        $('#documentdate').val(response.tanggalpelayanan);
                        dataTriage();

                    }
                }


            });
            return false;
        });
    });
</script>


<script>
    $('#cariaskep').click(function(e) {
        e.preventDefault();
        let diagnosakeperawatan = $('#DiagnosaAskep').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/cariAskep'); ?>",

            data: {
                diagnosakeperawatan: diagnosakeperawatan
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalpilihaskep').modal('show');

                }
            }

        })


    })
</script>



<script type="text/javascript">
    function total2() {
        var eye2 = document.getElementById('eye2').value;
        var verbal2 = document.getElementById('verbal2').value;
        var motorik2 = document.getElementById('motorik2').value;
        //var totalpotongan = ((parseInt(hargaperbox) * jumlahkemasanbox)) * (potongan / 100);
        var nilai_eye2 = parseInt(eye2);
        var nilai_verbal2 = parseInt(verbal2);
        var nilai_motorik2 = parseInt(motorik2);
        var totalGCS2 = nilai_eye2 + nilai_verbal2 + nilai_motorik2;
        document.getElementById('gcs2').value = totalGCS2;



    }
</script>



<script>
    function HapusTriase(id) {

        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus data Triase ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('PelayananRawatJalanRME/HapusTriase'); ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            });
                            dataTriage();
                        }
                    }
                });
            }
        })

    }
</script>