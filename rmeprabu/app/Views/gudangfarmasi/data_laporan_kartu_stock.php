<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>

            <th>No</th>
            <th>Tanggal & Jam</th>
            <th>Tanggal</th>
            <th>No. Register</th>
            <th>Uraian</th>
            <th>Referensi/ Dokumen</th>
            <th>No. Batch</th>
            <th>Exp. Date</th>
            <th>Terima</th>
            <th>Keluar</th>
            <th>Sisa</th>
        </tr>
    </thead>
    <tbody>
        <thead>
            <tr>

                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th><?= $sisasebelum; ?></th>
            </tr>
        </thead>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row['createddate'] ?></td>
                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['journalnumber'] ?></td>
                <td><span class="<?php if ($row['referencelocationcode'] == "NONE") {
                                        echo "badge badge-info";
                                        $keterangan = "Faktur Masuk dari";
                                    } else {
                                        echo "badge badge-success";
                                        $keterangan = "Distribusi Dari Gudang Ke";
                                    }  ?>"><?= $keterangan; ?></span><?= $row['referencelocationname'] ?> <?= $row['relationname']; ?> </td>

                <td><?= $row['referencenumber'] ?></td>
                <td><?= $row['batchnumber'] ?></td>
                <td><?= $row['expireddate'] ?></td>
                <td style="text-align: right;"><?php if ($row['qty'] > 0) {
                                                    $terima = $row['qty'];
                                                } else {
                                                    $terima = 0;
                                                }
                                                echo number_format($terima, 2, ",", "."); ?></td>
                <td style="text-align: right;"><?php if ($row['qty'] < 0) {
                                                    $keluar = ABS($row['qty']);
                                                } else {
                                                    $keluar = 0;
                                                }
                                                echo number_format($keluar, 2, ",", "."); ?></td>
                <td style="text-align: right;"></td>
            </tr>

        <?php endforeach; ?>
        <tr>

            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th><?= $sisaakhir; ?></th>
        </tr>
    </tbody>
    <tfoot>
        <td colspan="11" class="text-center">
            <button id="print" class="btn btn-info btnprint" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print</button>
        </td>
    </tfoot>
</table>


<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprint').on('click', function() {

            let id = $(this).data('id');
            window.open("<?php echo base_url('LaporanGudangFarmasi/printterimapbf') ?>?page=" + id, "_blank");

        })
    });
</script>