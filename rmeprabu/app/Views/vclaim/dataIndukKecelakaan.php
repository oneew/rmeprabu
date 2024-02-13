<table id="datahistori" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>No Sep</th>
            <th>Tanggal Kejadian</th>
            <th>PPK</th>
            <th>Wilayah</th>
            <th>KeteranganKejadian</th>
            <th>No Suplesi</th>

        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        $list = $response['list'];
        foreach ($list as $row) :
            $no++; ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row['noSEP']; ?></td>
                <td><?= $row['tglKejadian']; ?></td>
                <td><?= $row['ppkPelSEP']; ?></td>
                <td><?= $row['kdProp']; ?>
                    <br><?= $row['kdKab']; ?>
                    <br><?= $row['kdKec']; ?>
                </td>
                <td><?= $row['ketKejadian']; ?></td>
                <td><?= $row['noSEPSuplesi']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#datahistori').DataTable(); {
            responsive: true
        }
    });
</script>