<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

<div id="modalcariobatretur" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Pencarian Barang Yang Akan Diretur</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="#">
                    <div class="form-body">
                        <div class="row pt-3">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="text" name="codeobat" id="codeobat" class="form-control filter-input" placeholder="Kode Barang" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="namaobat" id="namaobat" class="form-control filter-input" placeholder="Nama Barang" autocomplete="off">
                                    <input type="hidden" name="kodesuplier" id="kodesuplier" class="form-control filter-input" value="<?= $kodesuplier; ?>" autocomplete="off">
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
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>
    function datapobat() {
        $.ajax({

            url: "<?php echo base_url('ObatMasukGudang/ambildataobat') ?>",
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
        let kodesuplier = $('#kodesuplier').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ObatKeluarGudang/caridataobat') ?>",
            dataType: "json",
            data: {
                namaobat: namaobat,
                codeobat: codeobat,
                kodesuplier: kodesuplier
            },
            success: function(response) {
                $('.viewdataobat').html(response.data);
            }
        });
    });
</script>