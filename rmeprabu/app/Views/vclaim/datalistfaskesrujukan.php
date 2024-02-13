<table id="datarujukan" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>Pilih</th>
            <th>Lihat Sarana</th>
            <th>No</th>
            <th>Kode PPK</th>
            <th>Nama PPK</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;

        $response = $faskes;
        if ($response !== null) {
            foreach ($response as $row) :
                $no++; ?>
                <tr>
                    <td style="width: 2px;"><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm btnplihatsarana" onclick="AmbilFaskes('<?= $row['kode']; ?>','<?= $row['nama']; ?>')"> <i class="ti-pin-alt"></i></button></td>
                    <td style="width: 2px;"><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm btnplihatsarana" onclick="LihatSarana('<?= $row['kode']; ?>','<?= $row['nama']; ?>')"> <i class="ti-joomla"></i></button></td>
                    <td><?= $no ?></td>
                    <td><?= $row['kode']; ?></td>
                    <td><?= $row['nama']; ?></td>
                </tr>

        <?php endforeach;
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
    function LihatSarana(kode, nama) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('VclaimAntrean/LihatSaranaFaskes'); ?>",
            data: {
                kode: kode,
                nama: nama
            },
            dataType: "json",
            success: function(response) {
                if (response.suksessarana) {
                    $('.viewmodallihatfaskes').html(response.suksessarana).show();
                    $('#modalsaranafaskes').modal('show');

                }
            }

        });
    }
</script>


<script>
    function AmbilFaskes(kode, nama) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('VclaimAntrean/DetailFaskes'); ?>",
            data: {
                kode: kode,
                nama: nama
            },
            dataType: "json",
            success: function(response) {
                $('#ppkDirujuk').val(response.kode);
                $('#namappkDirujuk').val(response.nama);
                $('#modalcarifaskes').modal('hide');

            }
        });
    }
</script>