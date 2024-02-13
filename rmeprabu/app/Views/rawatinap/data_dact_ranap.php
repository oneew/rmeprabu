<table id="dataperawat" class="table display table-bordered table-striped no-wrap" style="width:100%">
    <thead>
        <tr>

            <th>#</th>
            <th>No</th>
            <th>Tanggal</th>
            <th>KodeRuangan</th>
            <th>Ruangan</th>
            <th>JournalNumber</th>
            <th>PasienID</th>
            <th>Nama Pasien</th>
            <th>Cara Bayar</th>
            <th>KelasPerawatan</th>
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
                <td><button type="button" class="btn btn-success btn-sm" onclick="CatatDact('<?= $row['id'] ?>')"> <i class="fas fa-bed"></i></button></td>
                <td><?= $row['datetimein'] ?></td>
                <td><?= $row['room'] ?></td>
                <td><?= $row['roomname'] ?></td>
                <td><?= $row['journalnumber'] ?></td>
                <td>
                    <h4><?= $row['pasienid']  ?></h4>
                </td>
                <td>
                    <h4><?= $row['pasienname'] ?>
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
                        <span class="<?php if ($row['titipan'] == "YA") {
                                            echo "badge badge-danger";
                                            $catatan = "Pasien titipan";
                                        } else {
                                            $catatan = '';
                                        } ?>"><?= $catatan; ?></span>
                    </h4>
                </td>
                <td><?= $row['paymentmethodname'] ?>
                    <br><span class="badge badge-info"><?= $row['bpjs_sep']; ?></span>
                </td>
                <td><?= $row['classroom'] ?></td>


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
            //            responsive: true,
            scrollX: true,
            scrollY: "50vh"
        });
    });

    function CatatDact(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PasienRanap/entriDact'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaldactranap').modal('show');
                }
            }
        });

    }

    function hapus(id) {

        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus data ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('perawat/hapus'); ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            });
                            dataperawat();

                        }
                    }

                });
            }
        })

    }
</script>