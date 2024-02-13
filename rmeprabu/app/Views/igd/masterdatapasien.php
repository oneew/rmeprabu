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
            <th>NamaIbuKandung</th>
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
                    <td><button type="button" class="btn btn-info btn-sm" onclick="daftarkanpasienlama('<?= $row['id'] ?>')"> <i class="fas fa-share"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" onclick="daftarkanbackdate('<?= $row['id'] ?>')"> <i class="fas fa-share"></i>BackDate</button>
                        <button type="button" class="btn btn-warning btn-sm" onclick="ubahpasienlama('<?= $row['id'] ?>')"> <i class="fas fa-edit"></i></button>
                        <button type="button" class="btn btn-success btn-sm" onclick="histori('<?= $row['id'] ?>','<?= $row['code'] ?>')"> <i class="fas fa-hospital"></i></button>
                    </td>
                    <td><?= $no ?></td>
                    <td><?= $row['code'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['gender'] ?></td>
                    <td><?= $row['dateofbirth'] ?></td>
                    <td><span class="badge badge-success"><?= $row['ssn'] ?></span> </td>
                    <td><?= $row['namaibukandung'] ?></td>
                    <td><span class="badge badge-warning"><?= $row['cardnumber'] ?></span></td>
                    <td><?= $row['address'] ?>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>






<script>
    function daftarkanpasienlama(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('IGD/DaftarkanPasienLama'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {

                    $('.viewmodalbaru').html(response.sukses).show();
                    //$('#modaldaftarigdpasienlama').modal('hide');
                    $('#modalinputdaftarpasienlama').modal();
                }
            }

        });
    }

    function ubahpasienlama(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('IGD/UbahMasterPasien'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {

                    $('.viewmodalbaru').html(response.data).show();
                    //$('#modaldaftarigdpasienlama').modal('hide');
                    $('#modaleditmasterpasien').modal();
                }
            }
        });
    }

    function daftarkanbackdate(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('IGD/DaftarkanPasienLamaBackdate'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesbackdate) {

                    $('.viewmodalbaru').html(response.suksesbackdate).show();
                    //$('#modaldaftarigdpasienlama').modal('hide');
                    $('#modalinputdaftarpasienlamabackdate').modal();
                }
            }

        });
    }

    function histori(id, code) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('RawatJalan/HistoriPasienLama'); ?>",
            data: {
                id: id,
                pasienid: code
            },
            dataType: "json",
            success: function(response) {
                if (response.sukseshistori) {
                    $('.viewmodalbaru').html(response.sukseshistori).show();
                    $('#modalhistoripasienlama').modal();
                }
            }
        });
    }
</script>