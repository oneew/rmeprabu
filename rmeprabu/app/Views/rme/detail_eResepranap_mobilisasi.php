<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<div class="table-responsive">
    <table id="dataradiologi" class="table color-table success-table">
        <thead>
            <tr>

                <th>No</th>
                <th>Kode</th>
                <th>Jumlah</th>
                <th>Jml Kronis</th>
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


                    <td><?= $no ?></td>
                    <td>[<?= $row['code']  ?>] <b><?= $row['name']  ?></b>
                        <br><?= $row['uom']  ?>
                    </td>
                    <td><?= $row['qtypaket'] ?></td>
                    <td><?= $row['qtyluarpaket'] ?></td>
                    <td><?= $row['batchnumber']  ?></td>
                    <td><?= number_format($row['price'], 2, ",", ".");  ?></td>
                    <td><?= abs($row['subtotal']) ?></td>
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
        <tfoot>
            <?php $check_Total = isset($Total) ? array_sum($Total) : 0;
            $grandtotal = $check_Total;
            $totalbiaya = abs($grandtotal);
            ?>

            <tr>
                <td colspan="15" class="text-center">
                    <button id="print" class="btn btn-info btnprint" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Bukti Resep</button>
                    <button id="print" class="btn btn-warning btn-outline btn btnprintbuktiresep2" type="button"> <span><i class="fa fa-print"></i></span> Bukti Resep </button>

                    <button id="print" class="btn btn-success btn-outline btn btnprintbuktiresep" type="button"> <span><i class="fa fa-print"></i></span> Bukti Resep Non Kronis</button>
                    <input type="hidden" id="nomorjournal" autocomplet="off" name="nomorjournal" class="form-control" value="<?= $nomorjournal; ?>">

                </td>
            </tr>

        </tfoot>
    </table>
</div>


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


<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintbuktiresep2').on('click', function() {
            let id = $('#nomorjournal').val();
            window.open("<?php echo base_url('PelayananRawatJalanRME/printEResep') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=700, height=700");
        })

        $('.btnprintbuktiresep').on('click', function() {
            let id = $('#nomorjournal').val();
            window.open("<?php echo base_url('PelayananRawatJalanRME/printEResep') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=700, height=700");
        })
    });
</script>



<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprint').on('click', function() {
            let id = $('#nomorjournal').val();
            window.open("<?php echo base_url('PelayananRawatJalanRME/printpenjualanKonvesional') ?>?page=" + id, "_blank");
        })
    });
</script>