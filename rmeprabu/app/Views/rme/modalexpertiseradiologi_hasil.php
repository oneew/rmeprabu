<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />

<style type="text/css">
    .textarea_editor {
        height: 1000px;
    }
</style>

<div id="modalexpertiseradiologi_hasil" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Radiologi Expertise</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="form-filter">
                    <div class="form-group">
                        <textarea id="expertise" name="expertise" class="textarea_editor form-control" rows="100" placeholder="Enter text ..."><?= $expertise; ?></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script src="<?= base_url(); ?>/assets/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.js"></script>
<script>
    $(document).ready(function() {

        $('.textarea_editor').wysihtml5({

            // Opsi lain yang mungkin Anda butuhkan
            height: '2000px', // Tinggi yang diinginkan
        });
    });
</script>