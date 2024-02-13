<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/plugins/datatables.net-bs4/css/responsive.dataTables.min.css">

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Diagnosa Prosedur (ICD IX) </h4>
            <div class="table-responsive mt-4">
                <table id="myTable" class="table display table-bordered table-striped no-wrap">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Code</td>
                            <td>Description</td>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="smf">
<input type="hidden" name="norm">
<input type="hidden" name="start_date">
<input type="hidden" name="end_date">



<div class="viewmodal" style="display:none;"></div>

<script src="<?= base_url(); ?>/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>



<script type="text/javascript">
    $(document).ready(function() {

        function fill_data(norm = "", smf = "", star_date = "", end_date = "") {

            var table = $('#myTable').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],

                "ajax": {
                    "url": "<?php echo base_url('Prosedur/ajax_list') ?>",
                    "type": "POST",
                    "data": {
                        'norm': norm,
                        'smf': smf,
                        'start_date': star_date,
                        'end_date': end_date
                    }
                },

                "lengthMenu": [
                    [20, 30, 50, 100],
                    [20, 30, 50, 100]
                ],

                "columnDefs": [{
                    "targets": [],
                    "orderable": false,
                }, ],

            });
        }

        fill_data();
        $('#btn-filter').click(function() {
            $('#myTable').DataTable().destroy();
            fill_data($('#norm').val(), $('#smf').val(), $('#start-date').val(), $('#end-date').val());
        });

    });
</script>
<?= $this->endSection(); ?>