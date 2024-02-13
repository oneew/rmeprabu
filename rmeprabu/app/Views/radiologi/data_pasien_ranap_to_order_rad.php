<table id="dataranap" class="table display table-bordered table-striped no-wrap">
    <thead>
        <tr>

            <th>#</th>
            <th>No</th>
            <th>Tanggal</th>
            <th>ReferenceNumber</th>
            <th>PasienID</th>
            <th>Nama Pasien</th>
            <th>Cara Bayar</th>
            <th>Asal Ruangan</th>
            <th>Dokter</th>


        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>

                <td><?= $no ?></td>
                <td><button type="button" class="btn btn-success waves-light btn-rounded btn-sm" onclick="daftar('<?= $row['id'] ?>')"> <i class="fas fa-diagnoses"></i></button></td>
                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['journalnumber'] ?></td>
                <td><?= $row['pasienid']  ?></td>
                <td><?= $row['pasienname'] ?>
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
                <td><?= $row['paymentmethodname'] ?></td>
                <td><?= $row['roomname'] ?></td>
                <td><?= $row['doktername'] ?></td>


            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataranap').DataTable();


    });

    function daftar(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('RegRAD/order'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaldaftarradiologi').modal('show');

                }
            }

        });


    }
</script>