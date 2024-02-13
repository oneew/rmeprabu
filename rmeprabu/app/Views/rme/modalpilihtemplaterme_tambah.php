<div id="modalpilihtemplaterme_tambah" class="modal fade" id="bs-example-modal-lg"  role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Data Template SOAP</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <?php helper('form') ?>
            <?= form_open('PelayananRawatJalanRME/simpanpilihAskep', ['class' => 'formsimpanbanyak']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div id="form-filter-atas">
                    <div class="">
                        <table id="datapaketLab" class="tablesaw table-bordered table-hover table w-100" style="font-size: 14px;">
                            <thead class="text-white bg-success">
                                <tr>
                                    <th>No</th>
                                    <th>Keterangan</th>
                                    <th>Subjective</th>
                                    <th>Objective</th>
                                    <th>Diagnosa</th>
                                    <th>Planning</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                foreach ($template as $row) :
                                    $no++; ?>
                                    <tr>

                                        <td class="align-top"><?= $no ?></td>
                                        <td class="align-top" style="white-space: normal;"><?= $row['keterangan']; ?></td>
                                        <td class="align-top" style="white-space: normal;"><?= $row['subjective'] ?></td>
                                        <td class="align-top" style="white-space: normal;"><?= $row['objective'] ?></td>
                                        <td class="align-top" style="white-space: normal;"><?= $row['asesmen'] ?></td>
                                        <td class="align-top" style="white-space: normal;"><?= $row['planning'] ?></td>
                                        <td class="align-top"><button type="button" id="template" class="btn btn-sm btn-success" data-sub="<?= $row['subjective'] ?>" data-obj="<?= $row['objective'] ?>" data-asesment="<?= $row['asesmen'] ?>" data-planing="<?= $row['planning'] ?>">Gunakan Templet</button></td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>

                </div>
            </div>

            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#datapaketLab').DataTable();
    });
    $('#datapaketLab').on('click', '#template', function() {
        $('#subjective1').data("wysihtml5").editor.setValue($(this).attr("data-sub"));
        $('#objective1').data("wysihtml5").editor.setValue($(this).attr("data-obj"));
        $('#asesmen1').data("wysihtml5").editor.setValue($(this).attr("data-asesment"));
        $('#planning1').data("wysihtml5").editor.setValue($(this).attr("data-planing"));
        $('#modalpilihtemplaterme_tambah').modal('hide');
    })
</script>