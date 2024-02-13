<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<?php
$page = $_SERVER['PHP_SELF'];
$sec = "10";
?>

<meta http-equiv="refresh" content="<?php echo $sec ?>">

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
            </div>
            <div class="table-responsive mt-4">
                <h4 class="card-title">Informasi Tempat Tidur Rawat Inap</h4>
                <table id="myTable" class="table display table-bordered table-striped no-wrap">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama ruangan</td>
                            <td>Kelas Perawatan</td>
                            <td>SMF</td>
                            <td>Nomor Bed</td>
                            <td>Status</td>
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
                "url": "<?php echo base_url('PelayananBedInfo/ajax_list') ?>",
                "type": "POST"
            },

            createdRow: function(row, data, dataIndex) {
                if (data['status'] == "TERISI") {
                    $(row).css('background-color', 'red');
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

        $('#btn-filter').click(function() { //button filter event click
            table.ajax.reload(); //just reload table
        });
    });
</script>

<?= $this->endSection(); ?>