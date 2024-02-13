<div id="modalcariobatpelayanan_eresep" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Obat e-Resep</h4>

            </div>
            <div class="modal-body">
                <form action="#">
                    <div class="form-body">
                        <div class="row pt-3">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" name="codeobat" id="codeobat" class="form-control filter-input" placeholder="Kode Obat" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="namaobat" id="namaobat" class="form-control filter-input" placeholder="Nama Obat" autocomplete="off">
                                    <input type="hidden" name="lokasi" id="lokasi" class="form-control filter-input" autocomplete="off" value="<?= $lokasi; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive viewdataobat">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="viewmodalklinis" style="display:none;"></div>
<script>
    function datapobat() {
        $.ajax({

            url: "<?php echo base_url('FarmasiPelayananRanap/ambildataobat') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdataobat').html(response.data);
            }
        });
    }
    $(document).ready(function() {
        dataobat();

    });


    $('.filter-input').on('input apply.daterangepicker', function() {

        let namaobat = $('#namaobat').val();
        let codeobat = $('#codeobat').val();
        let lokasi = $('#lokasi').val();

        $.ajax({
            type: "post",
            url: "<?php echo base_url('FarmasiPelayananRajal/caridataobateresepBaruAKHP') ?>",
            dataType: "json",
            data: {
                namaobat: namaobat,
                codeobat: codeobat,
                lokasi: lokasi
            },
            success: function(response) {
                $('.viewdataobat').html(response.data);
            }
        });
    });
</script>