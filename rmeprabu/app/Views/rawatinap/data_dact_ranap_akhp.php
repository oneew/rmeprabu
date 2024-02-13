<table id="dataperawat" class="table display table-bordered table-striped no-wrap" style="width:100%">
    <thead>
        <tr>

            <th>#</th>
            <th>No</th>
            <th>Tanggal</th>
            <th>JournalNumber</th>
            <th>PasienID</th>
            <th>Nama Pasien</th>
            <th>Cara Bayar</th>
            <th>KelasPerawatan</th>
            <th>Ruangan</th>
            <th>BedNumber</th>
            <th>Dokter</th>
            <th>Memo</th>
            <th>Memo</th>

        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>

                <td><?= $no ?></td>
                <td><button type="button" class="btn btn-success btn-sm" onclick="CatatDactAKHP('<?= $row['id'] ?>')"> <i class="fas fa-bed"></i></button></td>
                <td><?= date('d-m-Y G:i:s', strtotime($row['datetimein'])) ?></td>
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
                <td><?= $row['classroom'] ?></td>
                <td><?= $row['roomname'] ?></td>
                <td><?= $row['bednumber'] ?></td>
                <td><?= $row['doktername'] ?></td>
                <td><?= $row['memo'] ?></td>
                <td><?= $row['referencenumber'] ?></td>

            </tr>

        <?php endforeach; ?>
    </tbody>
</table>



<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable({
            responsive: true
        });
    });

    function CatatDactAKHP(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PasienRanapAKHP/entriDact'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaldactranapakhp').modal('show');
                }
            }
        });
    }
</script>