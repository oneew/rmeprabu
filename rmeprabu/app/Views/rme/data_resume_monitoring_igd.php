<div class="table-responsive d-block">
    <table border="1" id="datariwayatCPPT" class="table display <?= (count($tampildata) > 1) ? "table-striped" : "" ?> no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black; width:100%">
        <thead class="bg-success text-white">
            <tr>
                <th colspan="14" style="text-align: center;">Tanda-tanda Vital</th>
                <th colspan="4" style="text-align: center;">Intake</th>
                <th colspan="7" style="text-align: center;">Output</th>
                <th colspan="7" style="text-align: center;">Observasi Kebidanan</th>
                <th style="text-align: center;">#</th>
            </tr>
            <tr>
                <th>No</th>
                <th>Tanggal Jam</th>
                <th>Kesadaran</th>
                <th>Frekuensi Nadi <small class="form-control-feedback">(x/menit)</small></th>
                <th>Td Sistolik<small class="form-control-feedback">(mmHg)</small></th>
                <th>Td Diastolik<small class="form-control-feedback">(mmHg)</small></th>
                <th>Suhu<small class="form-control-feedback">(oC)</small></th>
                <th>Frekuensi Nafas<small class="form-control-feedback">(x/menit)</small></th>
                <th>SpO2<small class="form-control-feedback">(%)</small></th>
                <th>Eye</th>
                <th>Verbal</th>
                <th>Motorik</th>
                <th>Total GCS</th>
                <th>Skala Nyeri</th>
                <th>Pemberian Oral<small class="form-control-feedback">(cc)</small></th>
                <th>Pemberian Parental<small class="form-control-feedback">(cc)</small></th>
                <th>NGT (Intake)<small class="form-control-feedback">(cc)</small></th>
                <th>Obat<small class="form-control-feedback">(cc)</small></th>
                <th>Muntah<small class="form-control-feedback">(cc)</small></th>
                <th>Drain<small class="form-control-feedback">(cc)</small></th>
                <th>IWL<small class="form-control-feedback">(cc)</small></th>
                <th>Perdarahan<small class="form-control-feedback">(cc)</small></th>
                <th>Urin<small class="form-control-feedback">(cc)</small></th>
                <th>Balance<small class="form-control-feedback">(cc)</small></th>
                <th>Diuresis<small class="form-control-feedback">(cc/KgBb/Jam)</small></th>
                <th>Kontraksi Uterus<small class="form-control-feedback">(x/menit)</small></th>
                <th>Durasi<small class="form-control-feedback">(detik)</small></th>
                <th>Intensitas</th>
                <th>Periksa Dalam<small class="form-control-feedback">(cm)</small></th>
                <th>pengeluaran PerVaginam<small class="form-control-feedback">(cc)</small></th>
                <th>Denyut Jantung Janin<small class="form-control-feedback">(x/menit)</small></th>
                <th>Tinggi Fundus Uteri</th>
                <th>Perawat Pelaksana</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row['executionDateTime']; ?></td>
                    <td><?= $row['kesadaran']; ?></td>
                    <td><?= $row['frekuensiNadi']; ?></td>
                    <td><?= $row['tdSistolik']; ?></td>
                    <td><?= $row['tdDiastolik']; ?></td>
                    <td><?= $row['suhu']; ?></td>
                    <td><?= $row['frekuensiNafas']; ?></td>
                    <td><?= $row['spo2']; ?></td>
                    <td><?= $row['eye']; ?></td>
                    <td><?= $row['verbal']; ?></td>
                    <td><?= $row['motorik']; ?></td>
                    <td><?= $row['totalGcs']; ?></td>
                    <td><?= $row['skalaNyeri']; ?></td>
                    <td><?= $row['pemberianOral']; ?></td>
                    <td><?= $row['pemberianParental']; ?></td>
                    <td><?= $row['pemberianNgt']; ?></td>
                    <td><?= $row['pemberianObat']; ?></td>
                    <td><?= $row['muntah']; ?></td>
                    <td><?= $row['drain']; ?></td>
                    <td><?= $row['iwl']; ?></td>
                    <td><?= $row['perdarahan']; ?></td>
                    <td><?= $row['urin']; ?></td>
                    <td><?= $row['balance']; ?></td>
                    <td><?= $row['diuresis']; ?></td>
                    <td><?= $row['kontraksiUterus']; ?></td>
                    <td><?= $row['durasi']; ?></td>
                    <td><?= $row['intensitas']; ?></td>
                    <td><?= $row['periksaDalam']; ?></td>
                    <td><?= $row['pervaginam']; ?></td>
                    <td><?= $row['janin']; ?></td>
                    <td><?= $row['tinggiPundusUteri']; ?></td>
                    <td><?= $row['paramedicName']; ?></td>
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