<table id="datarujukan" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>Pilih</th>
            <th>No</th>
            <th>Kode Dokter</th>
            <th>Nama Dokter</th>
            <th>Jadwal Praktek</th>
            <th>Kapasitas</th>
            <th>Kode Poli</th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 0;

        $cek = json_decode($pesan);
        $hasil = $cek->metaData->code;
        $hasilpesan = $cek->metaData->message;

        if ($hasil == 200) {
            $response = $list['list'];
            foreach ($response as $row) :
                $no++; ?>
                <tr>
                    <td style="width: 2px;"><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm btnplihatsarana" onclick="AmbilDokter('<?= $row['kodeDokter']; ?>','<?= $row['namaDokter']; ?>','<?= $kodepoli; ?>','<?= $rencanakontrol; ?>')"> <i class="ti-pin-alt"></i></button></td>
                    <td><?= $no ?></td>
                    <td><?= $row['kodeDokter']; ?></td>
                    <td><?= $row['namaDokter']; ?></td>
                    <td><?= $row['jadwalPraktek']; ?></td>
                    <td><?= $row['kapasitas']; ?></td>
                    <td><?= $kodepoli; ?></td>
                </tr>
        <?php endforeach;
        }

        if ($hasil != 200) {
            echo
            "<tr>
                    <td colspan=5>" . $hasilpesan . "</td>    
            </tr>";
        } ?>
    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#datarujukan1').DataTable({
            responsive: true
        });
    });
</script>


<script>
    function AmbilDokter(kodeDokter, namaDokter, kodepoli, rencanakontrol) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('VclaimAntrean/DetailJadwalDokter'); ?>",
            data: {
                kodeDokter: kodeDokter,
                namaDokter: namaDokter,
                kodepoli: kodepoli,
                rencanakontrol: rencanakontrol
            },
            dataType: "json",
            success: function(response) {
                $('#poliKontrol').val(response.kodepoli);
                $('#namaPoliKontrol').val(response.namaPoli);
                $('#kodenamaDokter').val(response.namaDokter);
                $('#kodeDokter').val(response.kodeDokter);
                $('#tglRencanaKontrol').val(response.rencanakontrol);
                $('#modaldaftarjadwaldokterkontrol').modal('hide');

            }
        });
    }
</script>