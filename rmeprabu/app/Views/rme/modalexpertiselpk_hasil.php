<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />

<!-- Dropzone css -->
<link href="<?= base_url(); ?>/assets/plugins/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

<div id="modalexpertiselpk_hasil" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Hasil Pemeriksaan Laboratorium Patologi Klinik</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive d-block">
                    <table id="dataexpertiseLPK" class="w-100 table display <?= (count($expertiseLPK) > 1) ? "" : "" ?> no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black;">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>No</th>
                                <th>Pemeriksaan</th>
                                <th>Satuan</th>
                                <th>Nilai Rujukan</th>
                                <th>Hasil</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($expertiseLPK as $no => $row) : ?>
                                <tr>
                                    <td><?= ++$no; ?></td>
                                    <td><?= $row['nama_pemeriksaan']; ?></td>
                                    <td><?= $row['unit']; ?></td>
                                    <td><?= $row['normal']; ?></td>
                                    <td><?= $row['hasil']; ?></td>
                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->