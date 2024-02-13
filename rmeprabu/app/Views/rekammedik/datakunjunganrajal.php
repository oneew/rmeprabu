<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/plugins/datatables.net-bs4/css/responsive.dataTables.min.css">

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <button type="button" class="btn btn-info btn-rounded mt-2 float-right" data-toggle="modal" data-target="#add-contact"><i class="fa fa-search"></i> Filter Data</button>
            <div class="row">
            </div>
            <div class="table-responsive mt-4">
                <h4 class="card-title">Data Kunjungan Poliklinik</h4>
                <table id="myTable" class="table display table-bordered table-striped no-wrap">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Tanggal</td>
                            <td>NomorRekamMedis</td>
                            <td>NamaPasien</td>
                            <td>Cara Bayar</td>
                            <td>Poliklinik</td>
                            <td>Dokter</td>
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
</div>

<div id="add-contact" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Filter Data Pasien</h4>
            </div>
            <div class="modal-body">
                <from class="form-horizontal form-material" id="form-filter" method="post">
                    <div class="form-group">
                        <div class="col-md-12 mb-3">
                            <input type="text" class="form-control" placeholder="Norm" id="norm" name="norm">
                        </div>
                        <div class="col-md-12 mb-3">
                            <select name="smf" id="smf" class="select2" style="width: 100%;">
                                <option value="">Pilih Jenis Pembayaran</option>
                                <?php foreach ($cabar as $bayar) : ?>
                                    <option value="<?= $bayar['name']; ?>"><?= $bayar['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <select name="poliklinikname" id="poliklinikname" class="select2" style="width: 100%;">
                                <option value="">Pilih Poliklinik</option>
                                <?php foreach ($poli as $p) : ?>
                                    <option value="<?= $p['name']; ?>"><?= $p['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="input-daterange input-group">
                                <input type="text" id="start-date" autocomplete="off" class="form-control" name="start" value="<?= date('d/m/Y'); ?>" />
                                <div class="input-group-append">
                                    <span class="input-group-text bg-info b-0 text-white">Until</span>
                                </div>
                                <input type="text" id="end-date" autocomplete="off" class="form-control" name="end" value="<?= date('d/m/Y'); ?>" />
                            </div>
                        </div>

                    </div>
                </from>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn-filter" data-dismiss="modal"><i class="fa fa-search"></i></button>
                <button type="reset" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="viewmodal" style="display:none;"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>



<script type="text/javascript">
    $(document).ready(function() {

        function fill_data(norm = "", smf = "", star_date = "", end_date = "", poliklinikname = "") {

            var table = $('#myTable').DataTable({

                "processing": true,
                "serverSide": true,
                "order": [],

                "ajax": {
                    "url": "<?php echo base_url('RekMedDaKuRajal/ajax_list') ?>",
                    "type": "POST",
                    "data": {
                        'norm': norm,
                        'smf': smf,
                        'start_date': star_date,
                        'end_date': end_date,
                        'poliklinikname': poliklinikname
                    }
                },

                "lengthMenu": [
                    [100, 150, 200, 250],
                    [100, 150, 150, 200]
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
            fill_data($('#norm').val(), $('#smf').val(), $('#start-date').val(), $('#end-date').val(), $('#poliklinikname').val());
        });

    });
</script>

<?= $this->endSection(); ?>