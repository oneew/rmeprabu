<div class="table-responsive d-block">
    <table border="1" id="datariwayatCPPT" class="table display <?= (count($tampildata) > 1) ? "table-striped" : "" ?> no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black; width:100%">
        <thead class="bg-success text-white">
            <tr>
                <th colspan="10" style="text-align: center;">Tindakan Keperawatan</th>
                <th colspan="4" style="text-align: center;">Intake</th>
                <th colspan="1" style="text-align: center;">Output (cc)</th>
                <th colspan="1" style="text-align: center;">Keterangan</th>
                <th style="text-align: center;">#</th>
            </tr>
            <tr>
                <th>No</th>
                <th>Observasi</th>
                <th>Tanggal Jam</th>
                <th>QB<small class="form-control-feedback">(Ml/menit)</small></th>
                <th>UF Rate<small class="form-control-feedback">(Ml)</small></th>
                <th>Td Sistolik<small class="form-control-feedback">(mmHg)</small></th>
                <th>Td Diastolik<small class="form-control-feedback">(mmHg)</small></th>
                <th>Frekuensi Nadi <small class="form-control-feedback">(x/menit)</small></th>
                <th>Suhu<small class="form-control-feedback">(oC)</small></th>
                <th>Frekuensi Nafas<small class="form-control-feedback">(x/menit)</small></th>
                <th>NaCl<small class="form-control-feedback">(0.9%)</small></th>
                <th>Dext<small class="form-control-feedback">(40%)</small></th>
                <th>Mkn/mnm</th>
                <th>Lain-lain</th>
                <th>UF Volume</th>
                <th>keterangan</th>
                <th>Paraf</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row['monitoring_hd']; ?></td>
                    <td><?= $row['createddate']; ?></td>
                    <td><?= $row['monitoring_qb']; ?></td>
                    <td><?= $row['monitoring_uf']; ?></td>
                    <td><?= $row['tdSistolik']; ?></td>
                    <td><?= $row['tdDiastolik']; ?></td>
                    <td><?= $row['frekuensiNadi']; ?></td>
                    <td><?= $row['suhu']; ?></td>
                    <td><?= $row['frekuensiNafas']; ?></td>
                    <td><?= $row['monitoring_Nacl']; ?></td>
                    <td><?= $row['monitoring_dext']; ?></td>
                    <td><?= $row['monitoring_Mkn']; ?></td>
                    <td><?= $row['monitoring_Lain']; ?></td>
                    <td><?= $row['monitoring_UFVolume']; ?></td>
                    <td><?= $row['KeteranganUF']; ?></td>
                    <td><?= $row['createdBy']; ?></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>




<script>
    $(document).ready(function() {
        $('#dataresumepenunjang').DataTable({
            responsive: true,
            // scrollX: true,
            // scrollY: "50vh"
        });
    });
</script>