<div class="table-responsive d-block">
    <table id="datariwayatPelayananMedisResep" class="w-100 table display <?= (count($tampildata) > 1) ? "" : "" ?> no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black;">
        <thead class="bg-primary text-white">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelayanan</th>
                <th>Resep</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++;
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row['documentdate'] ?></td>
                    <td><?= $row['poliklinikname'] ?>
                        </br><?= $row['doktername']; ?></td>

                    <td>
                        <table style="border-collapse: collapse; height: 36px;" border="0">
                            <tbody>
                                <?php $noD = 0;
                                foreach ($row['listResep'] as $resep) :
                                    $noD++;
                                ?>
                                    <tr>
                                        <td style="width: 5%;"><?= $noD; ?>.&nbsp;<?= $resep['name']; ?>[<?= $resep['signa1'] ?> x <?= $resep['signa2']; ?>](<?= ABS($resep['qty']); ?>)</td>
                                    </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <?php if ($row['listResep'] <> null) { ?>
                            <button type="button" class="btn btn-info btn-sm" onclick="gunakanRiwayatResep('<?= $resep['journalnumber'] ?>','<?= $nomorKunjungan ?>')"> <i class="fas fa-download"></i> Gunakan Riwayat Resep Ini</button>
                        <?php } ?>
                    <td>
                    </td>
                    </td>
                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#datariwayatPelayananMedisResep').DataTable({
            responsive: true,
            // scrollX: true,
            // scrollY: "50vh"
        });
    });
</script>

<script>
    function gunakanRiwayatResep(id, nomorKunjungan) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/ambilRiwayatResep'); ?>",
            data: {
                id: id,
                nomorKunjungan: nomorKunjungan
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalambilresep').html(response.sukses).show();
                    $('#modalpilihriwayatresep').modal('show');
                }
            }
        });
    }
</script>