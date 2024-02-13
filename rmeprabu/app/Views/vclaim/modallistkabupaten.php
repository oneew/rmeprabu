<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
<link href="<?= base_url(); ?>/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
<div id="modallistkabupaten" class="modal fade" role="dialog" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Data Wilayah <b><?= $namafaskes; ?></b> (Sumber Data : Vclaim)</h4>
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
                                        <table id="datakecamatan" class="tablesaw table-bordered table-hover table no-wrap">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>No</th>
                                                    <th>Kode Kabupaten/Kota</th>
                                                    <th>Nama Kabupaten/Kota</th>
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
                                                            <td style="width: 2px;"><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm btnplihatsarana" onclick="LihatKecamatan('<?= $row['kode']; ?>','<?= $row['nama']; ?>')"> <i class="ti-joomla"></i></button></td>
                                                            <td><?= $no ?></td>
                                                            <td><?= $row['kode']; ?></td>
                                                            <td><?= $row['nama']; ?></td>
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

<div class="viewmodalkecamatan" style="display:none;"></div>

<script>
    $(document).ready(function() {
        $('#datakecamatan').DataTable({});
    });
</script>


<script>
    function LihatKecamatan(kode, nama) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('VclaimAntrean/LihatKecamatan'); ?>",
            data: {
                kode: kode,
                nama: nama
            },
            dataType: "json",
            success: function(response) {
                if (response.sukseskecamatan) {
                    $('.viewmodalkecamatan').html(response.sukseskecamatan).show();
                    $('#modallistkecamatan').modal('show');

                }
            }

        });
    }
</script>