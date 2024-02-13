<div id="modal_history_e_resep_racikan" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Riwayat Pelayanan E Resep</h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-striped table-hover table-bordered w-100" id="datatable">
                    <thead>
                        <tr class="bg-success text-white">
                            <th>No</th>
                            <th>Pelayanan</th>
                            <th>Resep</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datas as $key => $data) : ?>
                            <tr>
                                <td><?= ++$key; ?></td>
                                <td>
                                    <?= $data['created_by']; ?>
                                    <br>
                                    <?= date('d-m-Y H:i:s', strtotime($data['created_at'])); ?>
                                </td>
                                <td>
                                    <?= $data['description']; ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success btn-use-racikan" data-id="<?= $data['id']; ?>"><i class="fas fa-download"></i>Gunakan Racikan</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
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
        $('#modal_history_e_resep_racikan').remove();
    });

    $('#modal_history_e_resep_racikan').on('shown.bs.modal', function(event) {
        $('#datatable').dataTable()
    })

    $('.btn-use-racikan').click(function() {
        $.ajax({
            method: "GET",
            url: "<?= base_url('PelayananRawatJalanRME/reuseObatRacikan'); ?>",
            dataType: "json",
            data: {
                id: $(this).data("id")
            },
            success: function(response) {
                $('.show-tab').html(response.success);

                $('.tab-satuan').removeClass('active');
                $('.tab-racikan').addClass('active');
                $('#satuan').removeClass('active');
                $('#racikan').addClass('active');
                $('#racikan').tab('show');

                $('#modal_history_e_resep_racikan').modal('hide');
            }
        });
    })
</script>