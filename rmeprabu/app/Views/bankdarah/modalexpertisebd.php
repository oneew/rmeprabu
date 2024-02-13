<link rel="stylesheet" href="../assets/plugins/html5-editor/bootstrap-wysihtml5.css" />
<!-- Dropzone css -->
<link href="../assets/plugins/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />

<div id="modalexpertisebd" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Bank Darah Expertise</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h6>Data Pasien</h6>
                <div class="row">
                    <div class="col-md-3 col-xs-6 border-right"> <strong>NoRm</strong>
                        <br>
                        <p class="text-muted"><?= $relation; ?> | <?= $documentdate; ?> | <?= $paymentmethod; ?> </p>
                    </div>
                    <div class="col-md-3 col-xs-6 border-right"> <strong>Nama</strong>
                        <br>
                        <p class="text-muted"><?= $relationname; ?> | <?= $roomname; ?> | <?= $journalnumber; ?> </p>
                    </div>
                    <div class="col-md-3 col-xs-6 border-right"> <strong>Dokter Pemohon</strong>
                        <br>
                        <p class="text-muted"><?= $doktername; ?></p>
                    </div>
                    <div class="col-md-3 col-xs-6"> <strong>Pemeriksaan</strong>
                        <br>
                        <p class="text-muted"><b><?= $name; ?></b></p>
                    </div>
                </div>
                <hr>
                <h6>Isi Expertise Pemeriksaan</h6>
                <div class="form-group">
                    <textarea class="textarea_editor form-control" rows="15" placeholder="Enter text ..."></textarea>
                </div>
                <h4><i class="ti-link"></i> Attachment</h4>
                <form action="#" class="dropzone">
                    <div class="fallback">
                        <input name="file" type="file" multiple />
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



<script src="../assets/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="../assets/plugins/html5-editor/bootstrap-wysihtml5.js"></script>
<script src="../assets/plugins/dropzone-master/dist/dropzone.js"></script>
<script>
    $(document).ready(function() {

        $('.textarea_editor').wysihtml5();

    });
</script>