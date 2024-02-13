<table id="datarujukan" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>Pilih</th>
            <th>No</th>
            <th>Kode Diagnosa</th>
            <th>Nama Diagnosa</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;

        $response = $diagnosa;
        if ($response !== null) {
            foreach ($response as $row) :
                $no++; ?>
                <tr>
                    <td style="width: 2px;"><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm btn-diagnosa" onclick="AmbilDiagnosaRujukanKhusus('<?= $row['kode']; ?>','<?= $row['nama']; ?>')"> <i class="ti-pin-alt"></i></button></td>
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
    function AmbilDiagnosaRujukanKhusus2(kode, nama) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('VclaimAntrean/DetailDiagnosa'); ?>",
            data: {
                kode: kode,
                nama: nama
            },
            dataType: "json",
            success: function(response) {
                $('#diagAwal').val(response.kode);
                $('#namadiagAwal').val(response.nama);
                $('#modalcaridiagnosaRujukanKhusus').modal('hide');

            }
        });
    }

    function AmbilDiagnosaRujukanKhusus(kode, nama) {
        let row_kode = '<input id="input' + kode + '" type="hidden" name="kode[]" value="' + kode + '">';
        let row_tag = '<button type="button" class="btn btn-danger btn-hapus" id="btn' + kode + '" onclick="tutup(' + kode + ')" data-id="' + kode + '">' + kode + ' x</button>';

        $('formperawat').append(row_kode);
        $('.list-tag').append(row_tag);
        $('#modalcaridiagnosaRujukanKhusus').modal('hide');
    }
</script>