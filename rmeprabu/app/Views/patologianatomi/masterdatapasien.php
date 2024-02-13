<table id="masterdatapasien" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>No</th>
            <th>NomorRekamMedis</th>
            <th>NamaPasien</th>
            <th>JenisKelamin</th>
            <th>TanggalLahir</th>
            <th>NIK</th>
            <th>No Asuransi</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        <form id="div-form-tambah" method="post">
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" onclick="daftarkanpasiennonrm('<?= $row['id'] ?>')"> <i class="fas fa-share"></i></button>

                    </td>

                    <td><?= $no ?></td>
                    <td><?= $row['code'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['gender'] ?></td>
                    <td><?= $row['dateofbirth'] ?></td>
                    <td><span class="badge badge-success"><?= $row['ssn'] ?></span> </td>
                    <td><?= $row['cardnumber'] ?></td>
                    <td><?= $row['address'] ?>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>


<script>
    function daftarkanpasiennonrm(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('RegisterRAD/DaftarkanPasienLamaNonRM'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                $('#modalcaripasiennonrm').modal('hide');
                $('#pasienid').val(response.code);
                $('#pasienname').val(response.name);
                $('#pasiencard').val(response.cardnumber);
                //$('#pasiengender').val(response.gender);
                $('.lahir').val(response.dateofbirth);
                $('#pasienaddress').val(response.address);
                $('#kecamatan').val(response.kecamatan);
                $('#pasienarea').val(response.area);
                $('#pasiensubarea').val(response.subarea);
                $('#pasiensubareaname').val(response.subareaname);
                $('#pasienparentname').val(response.parentname);
                $('#pasienssn').val(response.ssn);
                $('#pasientelephone').val(response.telephone);
                $('#paymentcardnumber').val(response.cardnumber);

                $('#pasiengender').val($('#pasiengender option[value=' + response.gender + ']').val());

            }
        });

    }
</script>