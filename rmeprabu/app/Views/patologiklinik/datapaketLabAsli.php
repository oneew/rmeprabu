<table id="datapaketLab" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
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
                <td><input type="checkbox" id="tandai" name="tandai[]" value="<?= $row['name']; ?>|<?= $row['code']; ?>" />
                    <input type="hidden" name="name[]" id="name" class="form-control form-tambah" autocomplete="off" value="<?= $row['name']; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="types[]" id="types" class="form-control" value="<?= $groups; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="journalnumber[]" id="journalnumber" class="form-control" value="<?= $journalnumber; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="documentdate[]" id="documentdate" class="form-control" value="<?= $documentdate; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="relation[]" id="relation" class="form-control" value="<?= $pasienid; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="relationname[]" id="relationname" class="form-control" value="<?= $pasienname; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="paymentmethod[]" id="paymentmethod" class="form-control" value="<?= $paymentmethod; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="paymentmethodname[]" id="paymentmethodname" class="form-control" value="<?= $paymentmethod; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="classroom[]" id="classroom" class="form-control" value="<?= $classroom; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="classroomname[]" id="classroom" class="form-control" value="<?= $classroomname; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="room[]" id="room" class="form-control" value="<?= $room; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="roomname[]" id="roomname" class="form-control" value="<?= $roomname; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="smf[]" id="smf" class="form-control" value="<?= $smf; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="smfname[]" id="smfname" class="form-control" value="<?= $smfname; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="dokter[]" id="dokter" class="form-control" value="<?= $dokter; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="doktername[]" id="doktername" class="form-control" value="<?= $doktername; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="employee[]" id="employee" class="form-control" value="<?= $employee; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="employeename[]" id="employeename" class="form-control" value="<?= $employeename; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="referencenumber[]" id="referencenumber" class="form-control" value="<?= $referencenumber; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="registernumber[]" id="registernumber" class="form-control" value="<?= $registernumber; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="referencenumberparent[]" id="referencenumberparent" class="form-control" value="<?= $referencenumberparent; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="locationcode[]" id="locationcode" class="form-control" value="<?= $locationcode; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="code[]" id="code" class="form-control" value="<?= $row['code']; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="expertisegroup[]" id="expertisegroup" class="form-control">
                    <input type="hidden" name="groups[]" id="groups" class="form-control" value="<?= $row['groups']; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="groupname[]" id="groupname" class="form-control" value="<?= $row['groups']; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="category[]" id="category" class="form-control" value="<?= $row['category']; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="categoryname[]" id="categoryname" class="form-control" value="<?= $row['categoryname']; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="bhp[]" id="bhp" class="form-control">
                    <input type="hidden" name="disc[]" id="disc" value="1.00" class="form-control">
                    <input type="hidden" name="share1[]" id="share1" class="form-control" value="<?= $row['share1']; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="share2[]" id="share2" class="form-control" value="<?= $row['share2']; ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="expertisegroup[]" id="expertisegroup" class="form-control">
                    <input type="hidden" name="memo[]" id="memo" value="PELAYANAN DAN TINDAKAN PENUNJANG MEDIS|<?= $row['code']; ?>" class="form-control">
                    <input type="hidden" name="createdby[]" id="createdby" class="form-control" value="<?= session()->get('email'); ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="createddate[]" id="createddate" class="form-control" value="<?= date('Y-m-d h:m:s'); ?>|<?= $row['code']; ?>">
                    <input type="hidden" name="price[]" id="price" class="form-control" value="<?= $row['price']; ?>">
                    <input type="hidden" name="qty[]" id="qty" value="1.00" class="form-control">
                </td>
                <td><?= $no ?></td>
                <td><?= $row['code']; ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['price'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>