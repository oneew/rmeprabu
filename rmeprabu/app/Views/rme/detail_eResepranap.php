<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<div class="table-responsive">
    <table id="dataradiologi" class="table color-table success-table">
        <thead>
            <tr>
                <th>#</th>
                <th>No</th>
                <th>Kode</th>
                <th>Jumlah</th>
                <th>Jml Kronis</th>
                <th>Aturan Pakai</th>
                <th>Cara Pakai</th>
                <th>Batch</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($DetailObat as $row) :
                $no++; ?>
                <tr>
                    <td>
                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm" onclick="hapusresep('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button>
                    </td>

                    <td><?= $no ?></td>
                    <td>[<?= $row['code']  ?>] <b><?= $row['name']  ?></b>
                        <br><?= $row['uom']  ?>
                    </td>
                    <td><?= round($row['qtypaket'], 0) ?></td>
                    <td><?= round($row['qtyluarpaket'], 0) ?></td>
                    <td><?= $row['signa1']  ?>X<?= $row['signa2']  ?></td>
                    <td><?= $row['eticket_carapakai']  ?></td>
                    <td><?= $row['batchnumber']  ?></td>
                    <td><?= format_rupiah($row['price']);  ?></td>
                    <td><?= format_rupiah(abs($row['subtotal'])) ?></td>
                    <?php $Total[] = $row['subtotal']; ?>
                </tr>

            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <?php $check_Total = isset($Total) ? array_sum($Total) : 0;
            $grandtotal = $check_Total;
            $totalbiaya = abs($grandtotal);
            ?>
            <tr>
                <td colspan="11" class="text-center">
                    <h4>Grand Total : Rp.<?= number_format($totalbiaya, 2, ",", "."); ?></h4>
                </td>
            </tr>
        </tfoot>
    </table>
</div>

<?php if (check_obat_racikan($kodejournal) != "TIDAK ADA") : ?>
    <div class="m-1">
        <div class="bg-success p-2 mb-3">
            <h3 class="text-white mb-0">Obat Racikan</h6>
        </div>
        <?php foreach (check_obat_racikan($kodejournal) as $item) : ?>
            <div class="d-flex border-top border-bottom py-3">
                <div class="mr-3">
                    <button class="btn btn-sm btn-danger btn-destroy" type="button" data-id="<?= $item['id']; ?>"><i class="fas fa-trash"></i></button>
                    <button class="btn btn-sm btn-warning btn-edit" type="button" data-id="<?= $item['id']; ?>" data-description="<?= $item['description']; ?>"><i class="fas fa-edit"></i></button>
                </div>
                <?= $item['description']; ?>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>


<script>
    function hapusresep(id) {

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
                    url: "<?php echo base_url('FarmasiPelayananRanap/hapus_detail_resep'); ?>",
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
                            detaileResep();

                        }
                    }

                });
            }
        })
    }

    $('.btn-destroy').click(function() {
        Swal.fire({
            icon: "warning",
            title: "Peringatan !!",
            text: "Apakah anda yakin ingin menghapus obat racikan ini ??",
            showCancelButton: true,
            confirmButtonText: "Hapus",
            denyButtonText: "Batal",
            confirmButtonColor: "#d33",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('PelayananRawatJalanRME/destroyObatRacikan'); ?>",
                    data: {
                        id: $(this).data("id")
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.success,
                            });
                            detaileResep();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Gagal',
                                text: response.error,
                            });
                            detaileResep();
                        }
                    }

                });
            }
        });
    })

    $('.btn-edit').click(function() {
        $.ajax({
            method: "GET",
            url: "<?= base_url('PelayananRawatJalanRME/getObatRacikan'); ?>",
            dataType: "json",
            data: {
                id: $(this).data("id")
            },
            success: function(response) {
                $('.show-tab').html(response.success);

                $('.tab-satuan').removeClass('active');
                $('.tab-racikan').addClass('active');
                $('#satuan').removeClass('active');
                $('#racikan').addClass('active');
                $('#racikan').tab('show');
            }
        });
    })
</script>





<script>
    $(document).ready(function() {
        $('#datapaketLab').DataTable({
            responsive: true,
            paging: false,
            scrollX: true,
            scrollY: "50vh"
        });
    });
</script>