<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>



<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <h6 class="card-subtitle"></h6>

            </div>

            <div class="card-title">
                <h4 class="card-title">Data Penerimaan Barang Dari Non PBF</h4>
            </div>

            <form action="#">
                <div class="form-body">
                    <div class="row pt-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nomor Pesanan</label>
                                <input type="text" name="nomorpesanan" id="nomorpesanan" class="form-control filter-input" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Nomor Faktur</label>
                                <input type="text" name="nomorfaktur" id="nomorfaktur" class="form-control filter-input" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Supplier</label>
                                <select name="namasupplier" id="namasupplier" class="select2 filter-input" style="width: 100%">
                                    <option value="">Pilih Supplier</option>
                                    <?php foreach ($supplier as $b) : ?>
                                        <option value="<?php echo $b['name']; ?>"><?php echo $b['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Tgl Terima</label>
                                <input type="text" name="DateOut" id="DateOut" class="form-control daterange filter-input" autocomplete="off">
                            </div>
                        </div>

                    </div>
                </div>
            </form>

            <div class="table-responsive viewdata">
            </div>
        </div>
    </div>
</div>
</div>

<div class="viewmodal" style="display:none;"></div>

<script>
    function dataRegisterDTPBF() {
        $.ajax({

            url: "<?php echo base_url('ObatMasukGudang/ambildataDTNonPBF') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataRegisterDTPBF();

    });


    $('.filter-input').on('input apply.daterangepicker', function() {

        let nomorpesanan = $('#nomorpesanan').val();
        let nomorfaktur = $('#nomorfaktur').val();
        let namasupplier = $('#namasupplier').val();
        let DateOut = $('#DateOut').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ObatMasukGudang/caridataDTNonPBF') ?>",
            dataType: "json",
            data: {
                nomorpesanan: nomorpesanan,
                nomorfaktur: nomorfaktur,
                namasupplier: namasupplier,
                DateOut: DateOut
            },
            success: function(response) {
                $('.viewdata').html(response.data);

            }
        });
    });
</script>

<?= $this->endSection(); ?>