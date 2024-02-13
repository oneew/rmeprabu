<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black" cellspacing="0" cellpadding="0">
    <thead>
        <tr>

            <th>Edit</th>
            <th>#</th>
            <th>#</th>
            <th>#</th>
            <th>No</th>
            <th>Kelompok</th>
            <th>TglTerima</th>
            <th>Operator</th>
            <th>Journalnumber</th>
            <th>KodePemberiHibah</th>
            <th>Nama Pemberi Hibah</th>
            <th>Alama</th>
            <th>NomorSuratHibah</th>
            <th>Nilai Hibah</th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;
        ?>
            <tr>
                <td>
                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm" onclick="ubahitem('<?= $row['id']; ?>')"> <i class="fa fa-edit"></i></button>
                </td>
                <td> <button type="button" class="btn btn-danger btn-rounded btn-sm" onclick="hapus('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button></td>
                <td>
                    <form method="post" action="<?= base_url(); ?>/ObatMasukGudang/DetailDTHibah">
                        <input type="hidden" name="id" id="id" value="<?= $row['id']; ?>">
                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm"><i class="fa fa-tags"></i></button>
                    </form>
                </td>
                <td>
                    <button id="print" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm btnprintfaktur" type="button" data-id="<?= $row['journalnumber']; ?>"> <span><i class="fas fa-book"></i></span> </button>
                </td>
                <td><?= $no ?></td>
                <td><?= $row['groups'] ?></td>
                <td><?= $row['createddate'] ?></td>
                <td><?= $row['createdby'] ?></td>
                <td><?= $row['journalnumber'] ?></td>
                <td><?= $row['supplier'] ?></td>
                <td><?= $row['suppliername'] ?></td>
                <td><?= $row['supplieraddress'] ?></td>
                <td><?= $row['invoicenumber'] ?></td>
                <td><?= number_format($row['totalinvoiceamount'], 2, ",", "."); ?></td>
            </tr>

        <?php endforeach; ?>

    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {
        $('#registerranap').DataTable({
            //responsive: true,
            scrollX: true,
            scrollY: "50vh"
        });
    });

    $(document).ready(function() {
        $('.btnprintfaktur').on('click', function() {

            let id = $(this).data('id');
            window.open("<?php echo base_url('ObatMasukGudang/printfakturhibah') ?>?page=" + id, "_blank");

        })
    });
</script>


<script>
    function ubahitem(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ObatMasukGudang/ubahFaktur'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalubahfaktur').modal('show');
                }
            }
        });
    }
</script>


<script>
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
                    url: "<?php echo base_url('ObatMasukGudang/hapusFaktur'); ?>",
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
                            dataRegisterDTPBF();

                        }
                    }

                });


            }
        })

    }
</script>