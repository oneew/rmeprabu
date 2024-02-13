<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<style>
  .ui-autocomplete {
    max-height: 100px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 100px;
  }
  </style>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="card-title">
                <h4 class="card-title">Data Templet E Resep</h4>
            </div>

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addEresepModal">
                <i class="fas fa-plus"></i> Templet Eresep
            </button>

            <div class="table-responsive viewdata">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addEresepModal" aria-labelledby="addEresepModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEresepModalLabel">Tambah Templet E Resep</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('TempletEResep/store') ;?>" method="post" class="formimpan">
                    <?= csrf_field() ;?>
                    <?php helper('text');; ?>
                    <input type="hidden" name="token" value="<?= random_string('alnum', 8) ;?>" readonly>
                    <div class="form-group">
                        <label for="nama_tindakan">Nama Tindakan<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_tindakan" name="nama_tindakan" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_dokter">Dokter<span class="text-danger">*</span>
                        </label>
                        <select name="nama_dokter" id="nama_dokter" class="select2 form-control" style="width: 100%;">
                            <option value="" disabled>Pilih Dokter</option>
                            <?php foreach ($datas as $dokter) : ?>
                                <option value="<?= $dokter['code'].'|'.$dokter['name'] ;?>"><?= $dokter['name'] ;?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Nama Obat</label>
                        <input type="text" id="namaobatbaru" autocomplete="off" name="namaobatbaru" class="form-control filter-input">
                        <input type="hidden" id="nama_obat" autocomplete="off" name="nama_obat">
                        <input type="hidden" id="kode_obat" autocomplete="off" name="kode_obat">
                    </div>

                    <div class="form-group">
                        <label for="jumlah_obat">Jumlah Obat<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="jumlah_obat" name="jumlah_obat" required>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btnsimpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="viewmodal"></div>

<script>
    function dataEresep() {
        $.ajax({

            url: "<?php echo base_url('TempletEResep/index') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
                $('#datatable').dataTable();
            }
        });
    }
    $(document).ready(function() {
        dataEresep();
        $('.select2').select2({
            dropdownParent: $("#addEresepModal")
        });
        $("#namaobatbaru").autocomplete({
            source: "<?php echo base_url('MasterObat/ajax_nama_obat'); ?>",
            select: function(event, ui) {
                $('#namaobatbaru').val(ui.item.value);
                $('#kode_obat').val(ui.item.code);
                $('#nama_obat').val(ui.item.name);

            }
        });
    });

    $('.formimpan').submit(function(e) {
        $('#nama_tindakan').prop('readonly', true);
        $('#nama_dokter').prop('readonly', true);
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnsimpan').attr('disable', 'disabled');
                $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.btnsimpan').removeAttr('disable');
                $('.btnsimpan').html('Simpan');
            },
            success: function(response) {
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: `${response.sukses}`,
                    }).then((result) => {
                        dataEresep()
                        $('#namaobatbaru').val('')
                        $('#kode_obat').val('')
                        $('#nama_obat').val('')
                        $('#jumlah_obat').val('')
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
</script>



<?= $this->endSection(); ?>