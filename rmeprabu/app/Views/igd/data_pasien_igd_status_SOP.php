<table id="dataperawat" class="table display table-bordered table-striped no-wrap">
    <thead>
        <tr>

            <th>#</th>
            <th>No</th>
            <th>Tanggal</th>
            <th>JournalNumber</th>
            <th>PasienID</th>
            <th>Nama Pasien</th>
            <th>Cara Bayar</th>
            <th>Dokter</th>
            <th>Status</th>


        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>
                <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" onclick="lihat('<?= $row['journalnumber']; ?>')"> <i class="fas fa-eye"></i></button></td>
                <td><?= $no ?></td>
                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['journalnumber'] ?></td>
                <td><?= $row['pasienid']  ?></td>
                <td><?= $row['pasienname'] ?></td>
                <td><?= $row['paymentmethod'] ?></td>
                <td><?= $row['doktername'] ?></td>
                <td><span class="<?php if ($row['status'] == "ORDER") {
                                        echo "badge badge-warning";
                                    } else {
                                        if ($row['status'] == "APPROVED") {
                                            echo "badge badge-success";
                                        } else {
                                            if ($row['status'] == "REJECTED") {
                                                echo "badge badge-danger";
                                            }
                                        }
                                    } ?>"><?= $row['status'] ?></span></td>


            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable();


    });

    function lihat(journalnumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('SOPIGD/lihatorderpenunjang'); ?>",
            data: {
                journalnumber: journalnumber
            },
            dataType: "json",
            success: function(response) {
                if (response.sukseslihat) {
                    $('.viewmodal').html(response.sukseslihat).show();
                    $('#modallihatorderpenunjang').modal('show');

                }
            }

        });

    }
</script>