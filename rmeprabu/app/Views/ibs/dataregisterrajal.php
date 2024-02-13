<table id="registerrajal" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th></th>
            <th>No</th>
            <th>TglPelayanan</th>
            <th>NomorRekamMedis</th>
            <th>MetodePembayaran</th>
            <th>Dokter</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        <form id="div-form-tambah" method="post">
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>

                    <td style="width: 2px;"><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm btnplihatsarana" onclick="AmbilPasien('<?= $row['pasienid']; ?>','<?= $row['pasienname']; ?>','<?= $row['pasiendateofbirth']; ?>','<?= $row['poliklinikname']; ?>','<?= $row['pasienaddress']; ?>','<?= $row['journalnumber']; ?>','<?= $row['paymentcardnumber']; ?>','<?= $row['paymentmethodname']; ?>')"> <i class="ti-pin-alt"></i></button></td>
                    <td><?= $no ?></td>
                    <td><?= $row['documentdate'] ?>
                        <br><?= $row['groups']; ?>
                    </td>
                    <td><?= $row['pasienid'] ?>
                        <br><?= $row['pasienname']; ?>

                    </td>
                    <td><span class="badge badge-info"><?= $row['paymentmethodname'] ?></span>
                    </td>
                    <td><?= $row['poliklinikname']; ?>
                        <br><?= $row['doktername'] ?>
                    </td>
                    <td><?= $row['pasienaddress'] ?>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>


<script>
    function AmbilPasien(pasienid, pasienname, pasiendateofbirth, poliklinikname, pasienaddress, journalnumber, paymentcardnumber, paymentmethodname) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('EnJadwal/DetailPasien'); ?>",
            data: {
                pasienid: pasienid,
                pasienname: pasienname,
                pasiendateofbirth: pasiendateofbirth,
                poliklinikname: poliklinikname,
                pasienaddress: pasienaddress,
                journalnumber: journalnumber,
                paymentcardnumber: paymentcardnumber,
                paymentmethodname: paymentmethodname

            },
            dataType: "json",
            success: function(response) {
                $('#pasienid').val(response.pasienid);
                $('#pasienname').val(response.pasienname);
                $('#pasiendateofbirth').val(response.pasiendateofbirth);
                $('#asalRuangan').val(response.poliklinikname);
                $('#referencenumber').val(response.journalnumber);

                $('#pasienaddress').val(response.pasienaddress);
                $('#paymentcardnumber').val(response.paymentcardnumber);
                $('#paymentmethodname').val(response.paymentmethodname);
                $('#kodepoli').val(response.kodepoli);
                $('#modalpasienrajal').modal('hide');

            }
        });
    }
</script>