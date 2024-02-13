<!DOCTYPE html>
<html>

<head>
    <title>Demo icd</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <style type="text/css">
        .tengah {
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <div class="tengah">
        <div class="container">
            <table id="myTable" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Kode ICD</td>
                        <td>Nama ICD</td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#myTable').DataTable({

                "processing": true,
                "serverSide": true,
                "order": [],

                "ajax": {
                    "url": "<?php echo base_url('/icd/ajax_list') ?>",
                    "type": "POST"
                },

                //optional
                "lengthMenu": [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],

                "columnDefs": [{
                    "targets": [],
                    "orderable": false,
                }, ],

            });
        });
    </script>

    <script src="<?php echo base_url("datatable/DataTables-1.10.20/js/jquery.dataTables.min.js"); ?>"></script>

    <script src="<?php echo base_url("datatable/datatables.min.js"); ?>"></script>

</body>

</html>