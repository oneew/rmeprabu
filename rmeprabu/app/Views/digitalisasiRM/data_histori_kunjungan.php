<div class="table-responsive">
    <table id="datahistori" class="table color-table success-table">
        <thead>
            <tr>
                <th>#</th>
                <th>No</th>
                <th>Kunjungan</th>
                <th>Tanggal</th>
                <th>JournalNumber</th>
                <th>No.SEP</th>
                <th>NomorRekamMedik</th>
                <th>CaraPembayaran</th>
                <th>Pelayanan</th>
                <th>Dokter</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($kunjungan as $row) :
                $no++; ?>
                <tr>
                    <td><button type="button" class="btn btn-circle btn-info btn-sm" onclick="lihatdataarsipdigital('<?= $row['journalnumber'] ?>')"> <i class="mdi mdi-eye"></i></button></td>
                    <td><?= $no ?></td>
                    <td><?= $row['groups'] ?></td>
                    <td><?= $row['documentdate'] ?></td>
                    <td><?= $row['journalnumber'] ?></td>
                    <td><?= $row['bpjs_sep'] ?></td>
                    <td><?= $row['pasienid'] ?></td>
                    <td><?= $row['paymentmethodname']  ?></td>
                    <td><?= $row['poliklinikname']  ?></td>

                    <td><?= $row['doktername']  ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<script>
    function lihatdataarsipdigital(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DigitalisasiRawatJalan/ViewDataArsipDetailRajal'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalrajal').html(response.sukses).show();
                    $('#modalviewarsip_detail_rajal').modal('show');
                }
            }
        });
    }
</script>