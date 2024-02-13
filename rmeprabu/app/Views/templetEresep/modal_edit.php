<div class="modal fade" id="editEresepModal" aria-labelledby="editEresepModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEresepModalLabel">Edit Templet E Resep</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('TempletEResep/update') ;?>" method="post" class="formupdate">
                    <?= csrf_field() ;?>
                    <input type="hidden" name="id_header" value="<?= $data['id'] ;?>" readonly>
                    <div class="form-group">
                        <label for="nama_tindakan_edit">Nama Tindakan<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_tindakan_edit" name="nama_tindakan_edit" required value="<?= $data['nama_tindakan'] ;?>">
                    </div>
                    <div class="form-group">
                        <label for="nama_dokter_edit">Dokter<span class="text-danger">*</span>
                        </label>
                        <select name="nama_dokter_edit" id="nama_dokter_edit" class="select2 form-control" style="width: 100%;">
                            <option value="" disabled>Pilih Dokter</option>
                            <?php foreach ($list_dokter as $dokter) : ?>
                                <option value="<?= $dokter['code'].'|'.$dokter['name'] ;?>" <?= $dokter['code'] == $data['kode_dokter'] ? 'selected' : null ;?>><?= $dokter['name'] ;?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning btn-sm update-btn mb-2">Ubah</button>
                </form>
                <div class="form-check p-0">
                    <input class="form-check-input" type="checkbox" value="" id="addCheck">
                    <label class="form-check-label" for="addCheck">
                        Tambah Obat Lainnya ?
                    </label>
                </div>
                <form class="form_add_drug d-none" method="post" action="<?= base_url('TempletEResep/add_drug') ;?>" id="form_add_drug">
                    <?= csrf_field() ;?>
                    <input type="hidden" name="referencenumber" value="<?= $data['referencenumber'] ;?>" readonly>
                    <div class="row">
                        <div class="form-group mb-0 col">
                            <label class="control-label">Nama Obat</label>
                            <input type="text" id="namaobatbaru_add" autocomplete="off" name="namaobatbaru_add" class="form-control filter-input">
                            <input type="hidden" id="nama_obat_add" autocomplete="off" name="nama_obat_add">
                            <input type="hidden" id="kode_obat_add" autocomplete="off" name="kode_obat_add">
                        </div>
                        <div class="form-group mb-0 col-4">
                            <label for="jumlah_obat_add">Jumlah Obat<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="jumlah_obat_add" name="jumlah_obat_add" required>
                        </div>
                        <button type="submit" id="add_drug_btn" class="btn btn-sm btn-success mr-4"><i class="fas fa-check"></i></button>
                    </div>
                </form>
                <div class="mt-5">
                    <span class="text-muted">Data Obat:</span>
                </div>
                <div class="viewdataolddrug"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.select2').select2({
        dropdownParent: $("#editEresepModal")
    });
    $("#namaobatbaru_add").autocomplete({
        source: "<?php echo base_url('MasterObat/ajax_nama_obat'); ?>",
        select: function(event, ui) {
            $('#namaobatbaru_add').val(ui.item.value);
            $('#kode_obat_add').val(ui.item.code);
            $('#nama_obat_add').val(ui.item.name);
        }
    });

    function old_data() { 
        $.ajax({
            type: "GET",
            url: '<?= base_url('TempletEResep/old_drug'); ?>',
            data: {
                referencenumber: '<?= $data['referencenumber']; ?>'
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataolddrug').html(response.data).show();
            }
        });
    }

    $('.form_add_drug').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('#add_drug_btn').attr('disable', 'disabled');
                $('#add_drug_btn').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('#add_drug_btn').removeAttr('disable');
                $('#add_drug_btn').html('<i class="fas fa-check"></i>');
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: response.success,
                    }).then((result) => {
                        dataEresep()
                        old_data()
                        $('#namaobatbaru_add').val('')
                        $('#nama_obat_add').val('')
                        $('#kode_obat_add').val('')
                        $('#jumlah_obat_add').val('')
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        html: `${response.gagal}`,
                    })
                }
            }
        });
        return false;
    });
    $('.formupdate').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.update-btn').attr('disable', 'disabled');
                $('.update-btn').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.update-btn').removeAttr('disable');
                $('.update-btn').html('Ubah');
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: response.success,
                    }).then((result) => {
                        dataEresep()
                        old_data()
                        $('#namaobatbaru_add').val('')
                        $('#nama_obat_add').val('')
                        $('#kode_obat_add').val('')
                        $('#jumlah_obat_add').val('')
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        html: `${response.gagal}`,
                    })
                }
            }
        });
        return false;
    });

    $('#addCheck').click(function() {
        if(this.checked) {
            $('#form_add_drug').removeClass('d-none')
            $('#form_add_drug').addClass('d-block')
        }else{
            $('#form_add_drug').removeClass('d-block')
            $('#form_add_drug').addClass('d-none')
            $('#namaobatbaru_add').val('')
            $('#nama_obat_add').val('')
            $('#kode_obat_add').val('')
            $('#jumlah_obat_add').val('')
        }
    });
</script>