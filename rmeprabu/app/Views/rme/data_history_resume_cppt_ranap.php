<table id="datariwayatCPPT" class="table table-striped table-hover no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black; width:100%">

    <thead class="bg-primary text-white">
        <tr>
            <th>No</th>
            <th class="text-center">Tanggal
                </br>& Jam</th>
            <th class="text-center">Profesional
                </br>Pemberi
                </br>Asuhan
                </br>(PPA)
            </th>
            <th class="text-center">Hasil Asesmen Pasien
                </br>dan Tatalaksana</th>
            <th class="text-center">Intruksi PPA
                </br> Termasuk Pasca Bedah
            </th>
            <th class="text-center">Verifikasi
                </br>DPJP
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tampildata as $no => $row) : ?>
            <tr>
                <td><?= ++$no; ?></td>
                <td class="text-center">
                    <?= date('d F Y', strtotime($row['createddate'])) ;?>
                    <br>
                    <?= date('H:i:s', strtotime($row['createddate'])) ;?>
                </td>
                <td class="text-center">
                    <?= $row['createdBy']  ?>
                    </br>
                    [<?= $row['kelompokCppt']; ?>]
                </td>
                <td class="align-top" style="white-space: normal;">
                    <h6 class="font-weight-bold">Subyektif</h6>
                    <?= $row['s']; ?>
                    <br><br>
                    <h6 class="font-weight-bold">Obyektif</h6>
                    <?= $row['o']; ?>
                    <br><br>
                    <h6 class="font-weight-bold">Asesmen</h6>
                    <?= $row['a']; ?>
                    <br><br>
                    <h6 class="font-weight-bold">Planning</h6>
                    <?= $row['p']; ?>
                </td>
                <td class="bisa-diedit" data-id="<?= $row['id']; ?>" data-field="instruksiPPA"><?= $row['instruksiPPA'] ?></td>
                <td class="text-center">
                    <?php if ($row['verifikasiDPJP'] == 0) { ?>
                        <span class="bagde badge-danger">Belum Verifikasi</span>
                    <?php } ?>
                    <?php if ($row['verifikasiDPJP'] == 1) { ?>
                        Diverifikasi Oleh : <?= $row['verifikator']; ?>
                        </br>Pada Tanggal : <?= $row['tanggalJamVerifikasi']; ?>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#datariwayatCPPT').DataTable({
            scrollX: true,
        });
    });
</script>