<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">


            <button type="button" class="btn btn-info btn-rounded mt-2 float-right" data-toggle="modal" data-target="#add-contact"><i class="fa fa-search"></i> Filter Data</button>
            <div class="row">
                <h4 class="card-title">Data Pelayanan CathLab</h4>
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="table-responsive mt-4">
                <table id="myTable" class="table display table-bordered table-striped no-wrap">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>No</td>
                            <td>Tanggal</td>
                            <td>Journalnumber</td>
                            <td>Norm</td>
                            <td>Nama Pasien</td>
                            <td>Cara Bayar</td>
                            <td>SMF</td>
                            <td>DPJP</td>

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
                            <div class="input-daterange input-group" id="date-range">
                                <input type="text" id="start-date" autocomplete="off" class="form-control" name="start" />
                                <div class="input-group-append">
                                    <span class="input-group-text bg-info b-0 text-white">Until</span>
                                </div>
                                <input type="text" id="end-date" autocomplete="off" class="form-control" name="end" />
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
                    "url": "<?php echo base_url('icdAKHP/ajax_list') ?>",
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

        $('#btn-filter').click(function() { //button filter event click

            $('#myTable').DataTable().destroy();

            fill_data($('#norm').val(), $('#smf').val(), $('#start-date').val(), $('#end-date').val()); // reload table and add data
        });


    });
</script>


<?= $this->endSection(); ?>