<div id="modalupdatetindakankoinsiden" class="modal koinsiden" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg koinsiden">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Update Koinsiden</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div id="form-filter-atas" style="display: block;">
                    <?= form_open('PelayananRanap/simpanTNOheader', ['class' => 'formperawatheader']); ?>
                    <?= csrf_field(); ?>
                    <form method="post" id="form-filter">
                        <div class="form-body">
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">ReferenceNumber</label>

                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success btnsimpan"> <i class="fa fa-check"></i> Tambah</button>
                            <button type="button" class="btn btn-light koinsiden" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                    <?= form_close() ?>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script>
    $(document).ready(function() {
        $('.formTNO').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpanTNO').attr('disable', 'disabled');
                    $('.btnsimpanTNO').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpanTNO').removeAttr('disable');
                    $('.btnsimpanTNO').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.name) {
                            $('#name').addClass('form-control-danger');
                            $('.errorname').html(response.error.name);
                        } else {
                            $('#name').removeClass('form-control-danger');
                            $('.errorname').html('');
                        }
                    } else {
                        // resumeTNO();
                        // dataresume();
                        // $('#name').val('');
                        // $('#price').val('');
                    }
                }
            });
            return false;
        });
    });
</script>