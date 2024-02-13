<table id="masterdatapasien" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>NoRekam Medis</th>
            <th>Namapasien</th>
            <th>Status</th>
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
                    <td><?= $row['pasienid'] ?></td>
                    <td><?= $row['pasienname'] ?> [<?= $row['pasiengender']; ?>]
                        <br><span class="<?php if ($row['covid'] == 1) {
                                                echo "badge badge-danger";
                                                $periksa = "Terkonfirmasi Covid";
                                            } else {
                                                echo "badge badge-success";
                                                $periksa = "Non Covid";
                                            }  ?>"><?= $periksa; ?></span>
                        <br><span class="<?php if ($row['koinsiden'] == 1) {
                                                echo "badge badge-warning";
                                                $koinsiden = "Pasien Koinsiden";
                                            } else {
                                                $koinsiden = '';
                                            } ?>"><?= $koinsiden; ?></span>
                    </td>
                    <td><b><?= $row['statusrawatinap'] ?></b>
                        <br><?php if ($row['dateout'] < '2022-02-01') {
                                echo '';
                            } else {
                                echo $row['dateout'];
                            } ?>
                    </td>
                    <td><?= $row['paymentmethod'] ?></td>
                    <td><?= $row['roomname'] ?></td>
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
            url: "<?php echo base_url('FarmasiPelayananRanap/detailpasienranap'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                $('#noreg').val(response.journalnumber);
                $('#referencenumber').val(response.referencenumber);
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
                $('#poliklinik').val(response.room);
                $('#poliklinikname').val(response.roomname);
                $('#poliklinikclass').val(response.classroom);
                $('#poliklinikclassname').val(response.classroomname);
                $('#bednumber').val(response.bednumber);

                $('#modalcaripasienranap').modal('hide');
            }
        });
    }
</script>