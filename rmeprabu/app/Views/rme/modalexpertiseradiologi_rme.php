<!-- Dropzone css -->
<link href="<?= base_url(); ?>/assets/plugins/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />


<div id="modalexpertiseradiologi_rme" class="modal fade" tabindex="-1"  role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Radiologi Expertise</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h6>Data Pasien</h6>
                <div class="row">
                    <div class="col-md-3 col-xs-6 border-right"> <strong>NoRm</strong>
                        <br>
                        <p class="text-muted"><?= $relation; ?> | <?= $documentdate; ?> | <?= $paymentmethod; ?> </p>
                    </div>
                    <div class="col-md-3 col-xs-6 border-right"> <strong>Nama</strong>
                        <br>
                        <p class="text-muted"><?= $relationname; ?> | <?= $roomname; ?> | <?= $journalnumber; ?> </p>
                    </div>
                    <div class="col-md-3 col-xs-6 border-right"> <strong>Dokter Pemohon</strong>
                        <br>
                        <p class="text-muted"><?= $doktername; ?></p>
                    </div>
                    <div class="col-md-3 col-xs-6"> <strong>Pemeriksaan</strong>
                        <br>
                        <p class="text-dark"><b><?= $name; ?></b> (No.Expertise :<?= $expertiseid; ?>)</p>
                    </div>
                </div>
                <hr>
                <h6>Isi Expertise Pemeriksaan</h6>
                <button class="btn btn-sm btn-primary mb-3" type="button" id="eegYusril">Templet EEG Dr. Yusril</button>
                <button class="btn btn-sm btn-primary mb-3" type="button" id="eegDian">Templet EEG dr. Dian</button>
                <button class="btn btn-sm btn-primary mb-3" type="button" id="echoDewasa">Echo Dewasa</button>
                <button class="btn btn-sm btn-primary mb-3" type="button" id="echoAnak">Echo Anak</button>
                <form action="<?= base_url('PelayananRadiologi/simpanexpertise') ;?>" method="post" id="form-filter" class="formexpertise">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <textarea id="expertise" name="expertise" class="textarea_editor form-control" rows="60" placeholder="Enter text ..."><?= $expertise; ?></textarea>
                        <div class="form-control-feedback text-danger errorexpertise">
                        </div>

                        <input type="hidden" id="pacsnumber" name="pacsnumber" class="form-control" value="<?= $pacsnumber; ?>">
                        <input type="hidden" id="groups" name="groups" class="form-control" value="NONE">
                        <input type="hidden" id="cekexpertise" name="cekexpertise" class="form-control" value="<?= $expertiseidhasil; ?>">
                        <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                        <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                        <input type="hidden" id="idpemeriksaan" name="idpemeriksaan" class="form-control" value="<?= $id; ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Dokter Pemeriksa</label>
                                <select name="employeename" id="employeename" class="select2" style="width: 100%">
                                    <option>Pilih Dokter Pemeriksa</option>
                                    <?php foreach ($list as $dokterrad) { ?>
                                        <option data-id="<?= $dokterrad['id']; ?>" class="select-employeename" <?php if ($dokterrad['name'] == $employeename) { ?> selected="selected" <?php } ?>><?= $dokterrad['name']; ?></option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" name="employee" id="employee" value="<?= $employee; ?>">
                                <div class="form-control-feedback errordoktername">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nomor Foto/ Expertise</label>
                                <input type="hidden" id="journalnumber" name="journalnumber" class="form-control" value="<?= $journalnumber; ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Klinis</label>
                                <input type="text" id="klinis" name="klinis" class="form-control" value="<?= $klinis; ?>">
                            </div>
                        </div>
                    </div>
                    <h4><i class="ti-link"></i> Attachment</h4>
                    <div class="col-md-6 col-lg-6 col-xl-4">
                        <div class="row">
                            <div class="col-md-4 col-lg-3 text-center">
                                <?php
                                $foto = !is_null($fotoradiologi) ? $fotoradiologi : 'default.png'; ?>
                                <a data-foto="<?= $fotoradiologi; ?>" data-id="<?= $expertiseidhasil; ?>" class="btn-form-upload"><img id="foto-<?= $expertiseidhasil; ?>" src="<?= base_url(); ?>/assets/images/fotoradiologi/<?= $foto; ?>" alt="dokter" height="50" width="50" class="rounded-circle img-fluid"></a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success btnsimpanExpertise"> <i class="fa fa-check"></i> Simpan</button>
                        <button type="button" class="btn btn-inverse" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <div id="form-filter-bawah" style="display: block;">
                    <div class="text-right">

                    <!-- <div class="dropdown ">
                    <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cetak Laporan</button>
                        <div class="dropdown-menu ">
                                    <input type="hidden" id="journalnumberhasil" name="journalnumberhasil" class="form-control">
                                    <button id="print" class="dropdown-item btnprintloasites" type="button"> <span><i class="fa fa-print "></i></span> <strong> LO Asites</strong></button>
                                    <button id="print" class="dropdown-item btnprintlousg" type="button"> <span><i class="fa fa-print"></i></span> <strong> LO USG </strong></button>
                                    <button id="print" class="dropdown-item btnprintkolon" type="button"> <span><i class="fa fa-print"></i></span><strong> Print LO Kolonoskopi</strong></button>
                                    <button id="print" class="dropdown-item btnprintlopleura" type="button"> <span><i class="fa fa-print"></i></span> <strong> LO Pleura </strong></button>
                                    <button id="print" class="dropdown-item btnprinteegy" type="button"> <span><i class="fa fa-print"></i></span> <strong>Print LO EEG </strong></button>
                                    <button id="print" class="dropdown-item btnprintecho" type="button"> <span><i class="fa fa-print"></i></span> <strong>Print LO Echocardiography </strong></button>
                                    <button id="print" class="dropdown-item btnprintexpert" type="button"> <span><i class="fa fa-print"></i></span> <strong>Print Ekspertise Radiologi </strong></button>
                        </div>
                    </div> -->
                    </div>
                </div>
                <button id="print" class="btn btn-info btnprintexpert" type="button"> <span><i class="fa fa-print"></i></span> <strong>Cetak Ekspertise</button>
                <button id="print" class="btn btn-warning btnprintlabel" type="button"> <span><i class="fa fa-print"></i></span> Cetak Label</button>
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal-upload">

</div>
<script src="<?= base_url('ckeditor/build/ckeditor.js') ;?>"></script>

<script src="<?= base_url(); ?>/assets/plugins/dropzone-master/dist/dropzone.js"></script>
<script>
    $(".select2").select2({
        dropdownParent: $('#modalexpertiseradiologi_rme')
    });
    $('#modalexpertiseradiologi_rme').on('shown.bs.modal', function (e) {
        let myEditEditor;
        ClassicEditor.create( document.querySelector('.textarea_editor'),{
            fontSize: {
                options: [
                    8,
                    9,
                    10,
                    11,
                    12,
                    'default',
                    15,
                    16,
                    17
                ]
            },
        }).then(editor => {
            myEditEditor = editor;

            window.CKEditor5 = editor;
        })
        .catch( error => {
            console.error( error );
        });

        $('#eegYusril').click(function(){
            myEditEditor.setData('<p><strong>Medications:</strong></p><p><strong>History:</strong></p><p><strong>Hasil Pemeriksaan:</strong></p><figure class="table" style="width:100%;"><table class="ck-table-resized" id="yus"><colgroup><col style="width:17.36%;"><col style="width:16.12%;"><col style="width:10.13%;"><col style="width:10.55%;"><col style="width:23.46%;"><col style="width:22.38%;"></colgroup><tbody><tr><td><strong>Kondisi aktivitas</strong></td><td><strong>Aktivitas dasar</strong></td><td><strong>Frek (Hz)</strong></td><td><strong>Volt(mV)</strong></td><td><strong>Distribusi</strong></td><td><strong>Ket (Jumlah reaktivitas, durasi, dll)</strong></td></tr><tr><td><p>Tidur</p><p>Bangun</p></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Photic</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>Hiperventilasi</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure><p>***R=Rendah(&lt;20mV), M=Medium(20-70mV), T=Tinggi(&gt;70mV)</p><p>Klasifikasi:</p><p>Kesan:</p><p><strong>Interpretation:</strong></p>');
        });
        $('#eegDian').click(function(){
            myEditEditor.setData('<p><strong>Medications:</strong></p><p><strong>History:</strong></p><p><strong>Technician Comments:</strong></p><p><strong>Interpretation:</strong></p>');
        });
        $('#echoDewasa').click(function(){
            myEditEditor.setData('<p>Dimension:</p><p>Wall Motion:</p><p>Syst. Function: &nbsp; &nbsp; &nbsp; &nbsp; LVEF:</p><p>Diast. Function:</p><p>Valve:</p><p>Others:</p><p>Conclusion:</p>');
        });
        $('#echoAnak').click(function(){
            myEditEditor.setData('<p>Situs :</p><p>AV Connection:</p><p>VA Connection:</p><p>PV:</p><p>ASD:</p><p>VSD:</p><p>PDA:</p><p>LV:</p><p>RV:</p><p>Katup-katup:</p><p>Aorch Aroh:</p><p>Coarct:</p><p>Conclusion:</p>');
        });
    });

    $('.formexpertise').submit(function(e) {
        e.preventDefault();
        $('#expertise').val(CKEditor5.getData())
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnsimpanExpertise').attr('disable', 'disabled');
                $('.btnsimpanExpertise').html('<i class="fa fa-spin fa-spinner "></i>');
            },
            complete: function() {
                $('.btnsimpanExpertise').removeAttr('disable');
                $('.btnsimpanExpertise').html('Simpan');
            },
            success: function(response) {
                if (response.error) {

                    if (response.error.expertise) {
                        $('#expertise').addClass('form-control-danger');
                        $('.errorexpertise').html(response.error.expertise);
                    } else {
                        $('#expertise').removeClass('form-control-danger');
                        $('.errorexpertise').html('');
                    }

                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.sukses,
                    })

                }
            }
        });
        return false;
        
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-form-upload').on('click', function() {
            $.ajax({
                type: 'post',
                url: "<?php echo base_url('FotoRadiologi/upload') ?>",
                data: {
                    code: $(this).data('id'),
                    foto: $(this).data('foto')
                },
                success: function(response) {
                    $('.modal-upload').html(response);
                }
            })
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
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintloasites').on('click', function() {
            let id = $('#idpemeriksaan').val();
            window.open("<?php echo base_url('PelayananRadiologi/printloasites') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=800, height=600");
        })
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintkolon').on('click', function() {
            let id = $('#idpemeriksaan').val();
            window.open("<?php echo base_url('PelayananRadiologi/printkolon') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=800, height=600");
        })
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintlopleura').on('click', function() {
            let id = $('#idpemeriksaan').val();
            window.open("<?php echo base_url('PelayananRadiologi/printlopleura') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=800, height=600");
        })
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintlousg').on('click', function() {
            let id = $('#idpemeriksaan').val();
            window.open("<?php echo base_url('PelayananRadiologi/printlousg') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=800, height=600");
        })
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprinteegy').on('click', function() {
            let id = $('#idpemeriksaan').val();
            window.open("<?php echo base_url('PelayananRadiologi/printloeegy') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=800, height=600");
        })
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintecho').on('click', function() {
            let id = $('#idpemeriksaan').val();
            window.open("<?php echo base_url('PelayananRadiologi/printecho') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=800, height=600");
        })
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintexpert').on('click', function() {
            let id = $('#idpemeriksaan').val();
            window.open("<?php echo base_url('PelayananRadiologi/printexpertiseKonvensional') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=800, height=600");
        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintlabel').on('click', function() {
            let id = $('#idpemeriksaan').val();
            window.open("<?php echo base_url('PelayananRadiologi/printlabelradiologi') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=500, height=500");
        })
    });
</script>