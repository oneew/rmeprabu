<table id="datahistori" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th style="width: 2%;">#</th>
            <th>No</th>
            <th>NamaRuangan</th>
            <th>Kelas</th>
            <th class="text-center">JumlahBed</th>
            <th>KodeRuanganAplicares</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($list as $row) :
            $no++; ?>
            <tr>
                <td style="width: 2%;"><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-warning btn-sm" onclick="create('<?= $row['roomcode'] ?>')"> <i class="fa fa-plus"></i></button>
                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm" onclick="hapus('<?= $row['roomcode'] ?>')"> <i class="fa fa-trash"></i></button>
                </td>
                <td class="text-center"><?= $no ?></td>
                <td><?= $row['roomcode'] ?></td>
                <td><?= $row['classroom'] ?></td>
                <td class="text-center"><?= $row['jumlahbed']; ?></td>
                <td><?= $row['roomcode']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#datahistori').DataTable({
            responsive: true
        })
    });
</script>

<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable();


    });

    function create(roomcode) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('Aplicares/ViewMasterKamar'); ?>",
            data: {
                roomcode: roomcode
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalcreatekamar').modal('show');
                }
            }
        });
    }

    function hapus(roomcode) {

        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus data kamar ini dari database Aplicares ?",
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
                    url: "<?php echo base_url('Aplicares/delete_kamar'); ?>",
                    data: {
                        roomcode: roomcode
                    },
                    dataType: "json",
                    success: function(response) {
                        let data = JSON.parse(response);
                        //alert(data.metadata.message);
                        if (data.metadata.message == "Data tidak ada di database.") {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Perhatian',
                                text: data.metadata.message,

                            });
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: data.metadata.message,

                            });
                        }
                    }

                });


            }
        })

    }
</script>