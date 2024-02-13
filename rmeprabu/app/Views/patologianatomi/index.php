<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">


            <button type="button" class="btn btn-info btn-rounded mt-2 float-right" data-toggle="modal" data-target="#add-contact"><i class="fa fa-search"></i> Filter Data</button>
            <div class="row">
                <h4 class="card-title">Data Pelayanan Patologi Anantomi</h4>
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="table-responsive mt-4">
                <table id="myTable" class="table display table-bordered table-striped no-wrap">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>No</td>
                            <td>Note</td>
                            <td>Tanggal</td>
                            <td>Norm</td>
                            <td>Nama Pasien</td>
                            <td>Cara Bayar</td>
                            <td>SMF</td>
                            <td>DPJP</td>
                            <td>Ruangan</td>

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

                <h4 class="modal-title" id="myModalLabel">Filter Data Pelayanan</h4>
            </div>
            <div class="modal-body">
                <from class="form-horizontal form-material" id="form-filter" method="post">
                    <div class="form-group">
                        <div class="col-md-12 mb-3">
                            <input type="text" class="form-control" placeholder="Norm" id="norm" name="norm">
                        </div>
                        <div class="col-md-12 mb-3">
                            <select class="select2" name="smf" id="smf" style="width: 100%">
                                <option value="%">--Semua SMF--</option>
                                <?php
                                foreach ($smf as $k) {
                                    echo "<option value='$k->name'";
                                    echo ">$k->name</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="input-daterange input-group">
                                <input type="text" id="start-date" autocomplete="off" class="form-control" name="start" value="<?= date('m/d/Y'); ?>" />
                                <div class="input-group-append">
                                    <span class="input-group-text bg-info b-0 text-white">Until</span>
                                </div>
                                <input type="text" id="end-date" autocomplete="off" class="form-control" name="end" value="<?= date('m/d/Y'); ?>" />
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>



<script type="text/javascript">
    $(document).ready(function() {

        function fill_data(norm = "", smf = "", star_date = "", end_date = "") {

            var table = $('#myTable').DataTable({

                "processing": true,
                "serverSide": true,
                "order": [],

                "ajax": {
                    "url": "<?php echo base_url('PasienLPA/ajax_list') ?>",
                    "type": "POST",

                    "data": {
                        'norm': norm,
                        'smf': smf,
                        'start_date': star_date,
                        'end_date': end_date
                    }
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
        }

        fill_data();

        $('#btn-filter').click(function() {
            $('#myTable').DataTable().destroy();

            fill_data($('#norm').val(), $('#smf').val(), $('#start-date').val(), $('#end-date').val());
        });

    });
</script>



<script src="<?= base_url(); ?>/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.js"></script>

<script>
    /*******************************************/
    // Basic Date Range Picker
    /*******************************************/
    $('.daterange').daterangepicker();


    $('.autoapply').daterangepicker({
        autoApply: true,
    });


    $('.dateLimit').daterangepicker({
        dateLimit: {
            days: 7
        },
    });

    /*******************************************/
    // Show Dropdowns
    /*******************************************/
    $('.showdropdowns').daterangepicker({
        showDropdowns: true,
    });

    /*******************************************/
    // Show Week Numbers
    /*******************************************/
    $('.showweeknumbers').daterangepicker({
        showWeekNumbers: true,
    });

    /*******************************************/
    // Date Ranges
    /*******************************************/
    $('.dateranges').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    /*******************************************/
    // Always Show Calendar on Ranges
    /*******************************************/
    $('.shawCalRanges').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        alwaysShowCalendars: true,
    });

    /*******************************************/
    // Top of the form-control open alignment
    /*******************************************/
    $('.drops').daterangepicker({
        drops: "up" // up/down
    });

    /*******************************************/
    // Custom button options
    /*******************************************/
    $('.buttonClass').daterangepicker({
        drops: "up",
        buttonClasses: "btn",
        applyClass: "btn-info",
        cancelClass: "btn-danger"
    });

    /*******************************************/
    // Language
    /*******************************************/
</script>
<script>
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true,
        format: 'MM/DD/YYYY h:mm A',
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
</script>

<?= $this->endSection(); ?>