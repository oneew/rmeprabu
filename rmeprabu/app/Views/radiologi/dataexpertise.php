<table id="dataexpertise" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>Peminjaman</th>
            <th>No</th>
            <th>No Foto/Expertise</th>
            <th>Peminjam</th>
            <th>NomorRekamMedis</th>
            <th>NamaPasien</th>
            <th>MetodePembayaran</th>
            <th>RuanganAsal</th>
            <th>Pemeriksaan</th>
            <th>DokterPengirim</th>
            <th>TanggalExpertise</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>
                <td>
                    <button type="button" class="btn-rounded btn-outline-success btnprintsep" onclick="Cetak('<?= $row['id']; ?>')"> <i class="fas fa-eye"></i></button>
                </td>
                <td>
                    <button type="button" class="btn-rounded btn-outline-danger btnpinjam" onclick="Pinjam('<?= $row['expertiseid']; ?>')"> <i class="fas fa-handshake"></i></button>
                </td>
                <td><?= $no ?></td>
                <td><span class="<?php if ($row['statuspinjam'] == 1) {
                                        $asalpeminjam = $row['asalpeminjam'];
                                        $asalpeminjam = $row['peminjamname'];
                                        echo "badge badge-danger";
                                    }   ?>"><?= $row['expertiseid'] ?></span>
                    <br><b><?= $row['employeename']; ?></b>
                </td>
                <td><?php if ($row['statuspinjam'] == 1) {
                        $asalpeminjam = $row['asalpeminjam'];
                        $peminjam = $row['peminjamname'];
                        echo $asalpeminjam;
                        echo "[$peminjam]";
                    }   ?></td>
                <td><?= $row['relation'] ?></td>
                <td><?= $row['relationname'] ?></td>
                <td><?= $row['paymentmethod'] ?></td>
                <td><?= $row['roomname'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['doktername'] ?></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<script>
    function Cetak(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRadiologi/CreateExpertise'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalexpertiseradiologi').modal('show');

                }
            }

        });


    }

    function Pinjam(expertiseid) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRadiologi/PinjamFotoRadiologi'); ?>",
            data: {
                expertiseid: expertiseid
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalpinjamfotoradiologi').modal('show');

                }
            }

        });


    }
</script>