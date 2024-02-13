<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black" cellspacing="0" cellpadding="0">
    <thead>
        <tr>

            <th>Ubah</th>
            <th>Hapus</th>
            <th>#</th>
            <th>#</th>
            <th>No</th>
            <th>Kelompok</th>
            <th>TglTerima</th>
            <th>Journalnumber</th>
            <th>KodeSupplier</th>
            <th>NamaSupplier</th>
            <th>AlamatSupplier</th>
            <th>NomorPesanan</th>
            <th>NomorFaktur</th>
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
                <td>
                    <form method="post" action="<?= base_url(); ?>/ObatMasukGudang/DetailDTNonPBF">
                        <input type="hidden" name="id" id="id" value="<?= $row['id']; ?>">
                        <button type="submit" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm"><i class="fa fa-tags"></i></button>
                    </form>
                </td>
                <td>
                    <button id="print" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm btnprint" type="button" data-id="<?= $row['journalnumber']; ?>"> <span><i class="fas fa-book"></i></span> </button>
                </td>
                <td><?= $no ?></td>
                <td><?= $row['groups'] ?></td>
                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['journalnumber'] ?></td>
                <td><?= $row['supplier'] ?></td>
                <td><?= $row['suppliername'] ?></td>
                <td><?= $row['supplieraddress'] ?></td>
                <td><?= $row['ordernumber'] ?></td>
                <td><?= $row['invoicenumber'] ?></td>
            </tr>

        <?php endforeach; ?>

    </tbody>
</table>




<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprint').on('click', function() {

            let id = $(this).data('id');
            window.open("<?php echo base_url('ObatMasukGudang/printfakturnonpbf') ?>?page=" + id, "_blank");

        })
    });
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
                    url: "<?php echo base_url('ObatMasukGudang/hapusFakturNonPBF'); ?>",
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


<script>
    function ubahitem(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('ObatMasukGudang/ubahFakturNonPBF'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalubahfakturnonbpf').modal('show');
                }
            }
        });
    }
</script>