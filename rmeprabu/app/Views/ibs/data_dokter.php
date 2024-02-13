<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Data Dokter</h4>
            <button type="button" class="btn btn-info btn-sm tomboltambah"><i class="fa fa-plus-circle"></i> Tambah Data</button>
            <div class="table-responsive mt-4">
                <table id="myTable" class="table display table-bordered table-striped no-wrap">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Kode</td>
                            <td>Nama Dokter</td>
                            <td>Kode BPJS</td>
                            <td>SMF</td>
                            <td>Telepon</td>
                            <td>Handphone</td>
                            <td>SIP</td>
                            <td>TMT SIP</td>
                            <td>TAT SIP</td>
                            <td>STR</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<div class="viewmodal" style="display:none;"></div>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#myTable').DataTable({

            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?php echo base_url('dokter/ajax_list') ?>",
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


<script>
    $(document).ready(function() {
        $('.tomboltambah').click(function(e) {
            e.preventDefault();
            $.ajax({

                url: "<?php echo base_url('dokter/formtambah') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaltambahdokter').modal('show');

                }
            });

        });
    });
</script>

<?= $this->endSection(); ?>