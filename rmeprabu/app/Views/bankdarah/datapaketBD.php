<table id="datapaketLab" class="tablesaw table-bordered table-hover table no-wrap" width="100%">
    <thead class="text-white bg-success">
        <tr>
            <th>#</th>
            <th>No</th>
            <th>KodePemeriksaan</th>
            <th>NamaPemeriksaan</th>
            <th>Tarif</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>
                <?php if ($classroom == 'IRJ') {
                    $asal = $registernumber_rawatjalan;
                    $jenisrawat = '1';
                } else {
                    if ($classroom == 'IGD') {
                        $asal = $registernumber_rawatjalan;
                        $jenisrawat = '6';
                    } else {
                        if (($classroom == 'KLS2') and ($room = 'NONE')) {
                            $asal = $registernumber_rawatjalan;
                            $jenisrawat = '1';
                        } else {
                            $asal = $registernumber_rawatinap;
                            $jenisrawat = '2';
                        }
                    }
                } ?>
                <td><input type="checkbox" id="tandai" name="tandai[]" value="<?= $groups; ?>|<?= $journalnumber; ?>|<?= $documentdate; ?>|<?= $pasienid; ?>|<?= $pasienname; ?>|<?= $paymentmethod; ?>|<?= $paymentmethod; ?>|<?= $classroom; ?>|<?= $classroomname; ?>|<?= $room; ?>|<?= $roomname; ?>|<?= $smf; ?>|<?= $smfname; ?>|<?= $dokter; ?>|<?= $doktername; ?>|<?= $employee; ?>|<?= $employeename; ?>|<?= $asal; ?>|<?= $referencenumber; ?>|<?= $referencenumberparent; ?>|<?= $locationcode; ?>|<?= $row['code']; ?>|<?= $row['name']; ?>|1|<?= $row['groups']; ?>|
                <?= $row['groupname']; ?>|<?= $row['category']; ?>|<?= $row['categoryname']; ?>|<?= $row['price']; ?>|0|<?= $row['price']; ?>|0|<?= $row['price']; ?>|<?= $row['share1']; ?>|<?= $row['share2']; ?>|PELAYANAN DAN TINDAKAN PENUNJANG MEDIS||<?= session()->get('email'); ?>|<?= date('Y-m-d h:m:s'); ?>|<?= $row['kelompokLab']; ?>|<?= $pasienaddress; ?>|<?= $asal_lab; ?>|<?= $jenkel; ?>|<?= $pasiendateofbirth; ?>|<?= $usia; ?>|<?= $icdxname; ?>|<?= $jenisrawat; ?>|<?= $koinsiden; ?>" /></td>
                <td><?= $no ?></td>
                <td><?= $row['code']; ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['price'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>
<script>
    $(document).ready(function() {
        $('#datapaketLab2').DataTable({
            responsive: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#datapaketLab').DataTable({
            responsive: true,
            paging: false,
            scrollX: true,
            scrollY: "50vh"
        });
    });
</script>