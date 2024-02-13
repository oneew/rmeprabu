<div class="modal fade" id="modallihatorderpenunjang" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="scrollableModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollableModalTitle">Detail Pemeriksaan Penunjang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="dataorder" class="table color-table success-table">
                    <thead>
                        <tr>

                            <th>#</th>
                            <th>No</th>
                            <th>Pemeriksaan</th>
                            <th>Tarif</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($penunjang as $row) :
                            $no++; ?>
                            <tr>
                                <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm" onclick="lihat('<?= $row['journalnumber']; ?>')"> <i class="fas fa-trash"></i></button></td>
                                <td><?= $no ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['price'] ?></td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->