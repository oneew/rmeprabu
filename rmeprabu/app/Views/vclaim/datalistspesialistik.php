<table id="datarujukan" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>

            <th>No</th>
            <th>Kode Poli</th>
            <th>Nama Poli</th>
            <th>Kapasitas</th>
            <th>Jumlah Rencana Kontrol Dan Rujukan</th>
            <th>Persentase</th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 0;
        $response = $list;
        foreach ($response as $row) :
            $no++; ?>
            <tr>

                <td><?= $no ?></td>
                <td><?= $row['kodePoli']; ?></td>
                <td><?= $row['namaPoli']; ?></td>
                <td><?= $row['kapasitas']; ?></td>
                <td><?= $row['jmlRencanaKontroldanRujukan']; ?></td>
                <td><?= $row['persentase']; ?></td>
            </tr>
        <?php endforeach;


        ?>
    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#datarujukan1').DataTable({
            responsive: true
        });
    });
</script>