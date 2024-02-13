<div id="modal_e_resep" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Template E Resep</h4>
            </div>

            <div class="modal-body viewdataeresep table-responsive">
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
    $(document).ready(function(){
        console.log('dd');
        $.ajax({
            url: "<?= base_url('PelayananRawatJalanRME/getDataTemplateEresep'); ?>",
            data:{
                journalnumber: '<?= $journalnumber; ?>',
                referencenumber_transaksi : '<?= $referencenumber_transaksi; ?>'
            },
            dataType: "json",
            success: function(response) {
                $('.viewdataeresep').html(response.data);
                $('#datatable').dataTable({
                    scrollX: true
                });
            }
        });
    });

    $('body').on('click', '#closeModal', function() { 
        $('#modal_e_resep').remove();
    });
</script>