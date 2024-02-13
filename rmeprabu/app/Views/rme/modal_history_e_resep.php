<div id="modal_history_e_resep" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Riwayat Pelayanan E Resep</h4>
            </div>
            <div class="modal-body viewdatahistoryeresep table-responsive">
            </div>

            <div class="modal-footer">
                <button id="closeModal" type="button" class="btn btn-default waves-effect">Kembali</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    $('body').on('click', '#closeModal', function() { 
        $('#modal_history_e_resep').remove();
    });
</script>