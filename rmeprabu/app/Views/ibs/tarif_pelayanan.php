<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
            </div>
            <div class="table-responsive mt-4">
                <h4 class="card-title">Data Tarif Pelayanan</h4>
                <table id="myTable" class="table display table-bordered table-striped no-wrap">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Groupname</td>
                            <td>Kode Tindakan</td>
                            <td>Nama Tindakan</td>
                            <td>Kelas Perawatan</td>
                            <td>Kategori</td>
                            <td>Tarif</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>








<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#myTable').DataTable({

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo base_url('pelayanan/ajax_list') ?>",
                "type": "POST"
            },

            //optional
            "lengthMenu": [
                [20, 30, 50, 100],
                [20, 30, 50, 100]
            ],

            "columnDefs": [{
                "targets": [],
                "orderable": false,
            }, ],

        });
        $('#btn-filter').click(function() { //button filter event click
            table.ajax.reload(); //just reload table
        });
    });
</script>

<?= $this->endSection(); ?>