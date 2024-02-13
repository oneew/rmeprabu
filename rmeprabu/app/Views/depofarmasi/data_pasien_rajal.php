<table id="masterdatapasien" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>Tanggal</th>
            <th>NoRekam Medis</th>
            <th>Namapasien</th>
            <th>JenisKelamin</th>
            <th>CaraBayar</th>
            <th>Ruangan</th>
            <th>DPJP</th>
        </tr>
    </thead>
    <tbody>
        <form id="div-form-tambah" method="post">
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>
                    <td><button type="button" class="btn btn-info btn-sm" onclick="daftarresep('<?= $row['id'] ?>')"> <i class="fas fa-hand-point-right"></i></button></td>
                    <td><?= $no ?></td>
                    <td><?= $row['documentdate'] ?></td>
                    <td><?= $row['pasienid'] ?></td>
                    <td><?= $row['pasienname'] ?></td>
                    <td><?= $row['pasiengender'] ?></td>
                    <td><?= $row['paymentmethod'] ?></td>
                    <td><?= $row['poliklinikname'] ?></td>
                    <td><?= $row['doktername'] ?></td>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>


<script>
    function daftarresep(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('FarmasiPelayananIGD/detailpasienranap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                $('#noreg').val(response.journalnumber);
                $('#referencenumber').val(response.journalnumber);
                $('#bpjs_sep').val(response.bpjs_sep);
                $('#pasienid').val(response.pasienid);
                $('#pasienname').val(response.pasienname);
                $('#pasiengender').val(response.pasiengender);
                $('#dateofbirth').val(response.pasiendateofbirth);
                $('#pasienaddress').val(response.pasienaddress);
                $('#pasienaddress').val(response.pasienaddress);
                $('#pasienarea').val(response.pasienarea);
                $('#pasiensubarea').val(response.pasiensubarea);
                $('#pasiensubareaname').val(response.pasiensubareaname);
                $('#paymentmethod').val(response.paymentmethod);
                $('#paymentmethodname').val(response.paymentmethodname);
                $('#paymentcardnumber').val(response.paymentcardnumber);
                $('#paymentmethodori').val(response.paymentmethodori);
                $('#paymentmethodnameori').val(response.paymentmethodnameori);
                $('#paymentcardnumberori').val(response.paymentcardnumberori);
                $('#smf').val(response.smf);
                $('#smfname').val(response.smfname);
                $('#poliklinik').val(response.poliklinik);
                $('#poliklinikname').val(response.poliklinikname);
                $('#poliklinikclass').val(response.classroom);
                $('#poliklinikclassname').val(response.classroomname);
                $('#bednumber').val(response.bednumber);

                $('#modalcaripasienrajal').modal('hide');
            }
        });
    }
</script>