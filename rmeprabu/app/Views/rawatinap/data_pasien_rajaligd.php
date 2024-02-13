<table id="dataperawat" class="table display table-bordered table-striped no-wrap">
    <thead>
        <tr>

            <th>#</th>
            <th>#</th>
            <th>No</th>
            <th>Tanggal</th>
            <th>ReferenceNumber</th>
            <th>PasienID</th>
            <th>Nama Pasien</th>
            <th>Cara Bayar</th>
            <th>Asal Poli</th>
            <th>Dokter</th>
            <th>Groups</th>

        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>



                <td>
                    <button id="print" class="btn btn-danger btn-outline btn btnbatalperiksa" type="button" onclick="BatalPeriksa('<?= $row['id'] ?>')"> <span><i class="fas fa-shekel-sign"></i></span> Batal Ranap?</button>
                </td>
                <td>
                    <button type="button" class="btn btn-info waves-light btn-rounded btn-sm" onclick="daftarkan('<?= $row['id'] ?>')"> <i class="fas fa-bed"></i></button>
                </td>
                <td><?= $no ?></td>
                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['journalnumber'] ?></td>
                <td><?= $row['pasienid']  ?></td>
                <td><?= $row['pasienname'] ?></td>
                <td><?= $row['paymentmethodname'] ?></td>
                <td><?= $row['poliklinikname'] ?></td>
                <td><?= $row['doktername'] ?></td>
                <td><span class="<?php if ($row['groups'] == "IRJ") {
                                        echo "badge badge-info";
                                    } else {
                                        echo "badge badge-warning";
                                    }  ?>"><?= $row['groups'] ?></span></td>

            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable();


    });

    function edit(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PendaftaranRanap/formedit'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaldaftarranap').modal('show');

                }
            }

        });


    }

    function daftarkan(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PendaftaranRanap/formedit'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaldaftarRanapNew').modal('show');

                }
            }

        });


    }
</script>

<script>
    function BatalPeriksa(id) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan membatalkan pendaftaran pasien ini ?",
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
                    url: "<?php echo base_url('PendaftaranRanap/BatalPeriksa'); ?>",
                    data: {
                        id: id,
                        modifiedby: $('#createdby').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            }).then((result) => {
                                if (result.value) {
                                    // berangkat();
                                    location.reload();

                                }
                            });
                        }
                    }

                });


            }
        })

    }
</script>