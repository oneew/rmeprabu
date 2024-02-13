<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
<div id="modaldaftarrujukan" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Data Rencana Rujukan (Sumber Data : Vclaim)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                        <form action="#">
                            <div class="form-body">
                                <div class="row pt-3">
                                    <div class="col-md-3">
                                        <div class="form-group has-success">
                                            <label class="control-label">Asal Rujukan</label>
                                            <select name="filter" id="filter" class="form-control custom-select filter-input">
                                                <option value="">Pilih Asal Rujukan</option>
                                                <option value="RSS">Faskes I</option>
                                                <option value="RS">RS</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Nomor Kartu</label>
                                            <input type="text" name="noKartu" id="noKartu" class="form-control filter-input" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive viewdatarujukan">


                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- Column -->
                    <!-- Column -->

                    <!-- Column -->
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="viewmodalbaru" style="display:none;"></div>
<script>
    $('.filter-input').on('change', function() {
        let noKartu = $('#noKartu').val();
        let filter = $('#filter').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('VclaimAntrean/check_rujukan_kartu') ?>",
            dataType: "json",
            data: {
                card: noKartu,
                filter: filter
            },
            success: function(response) {
                $('.viewdatarujukan').html(response.data);

            }
        });
    });
</script>