<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
<div id="modalsaranafaskes" class="modal fade" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Data Sarana <b><?= $namafaskes; ?></b> (Sumber Data : Vclaim)</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12 col-md-12">
                        <form action="#">
                            <div class="form-body">
                                <div class="row pt-3">
                                    <div class="col-md-12">
                                        <table id="datasarana" class="tablesaw table-bordered table-hover table no-wrap">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>KodeSarana</th>
                                                    <th>Nama Sarana</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php $no = 0;
                                                $response = $list;
                                                $cek = json_decode($pesan);
                                                $hasil = $cek->metaData->code;
                                                $hasilpesan = $cek->metaData->message;
                                                if ($hasil == 200) {
                                                    foreach ($response['list'] as $row) :
                                                        $no++; ?>
                                                        <tr>
                                                            <td><?= $no ?></td>
                                                            <td><?= $row['kodeSarana']; ?></td>
                                                            <td><?= $row['namaSarana']; ?></td>
                                                        </tr>
                                                <?php endforeach;
                                                }
                                                if ($hasil != 200) {
                                                    echo "<tr><td colspan=3>" . $hasilpesan . "</td> </tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function() {
        $('#datasarana').DataTable({});
    });
</script>