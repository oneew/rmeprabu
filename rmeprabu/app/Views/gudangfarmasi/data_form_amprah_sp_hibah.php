<div class="table-responsive">
    <table id="datapermintaan" class="table color-table success-table" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black" cellspacing="0" cellpadding="0">
        <thead>
            <tr>

                <th>#</th>
                <th>No</th>
                <th>Kode</th>
                <th>Uraian</th>
                <th>JumlahPesan</th>
                <th>JumlahDistribusi</th>
                <th>Jumlah Belum Distribusi</th>
                <th>Satuan</th>
                <th>Stok</th>
                <th>Operator</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($DetailObat as $row) :
                $no++; ?>
                <tr>
                    <td> <button type="button" class="btn btn-danger btn-sm" onclick="tambahkanhibah('<?= $row['id'] ?>')"> <i class="fa fa-hand-point-right"></i> </button></td>
                    <td><?= $no ?></td>
                    <td><?= $row['code']  ?></td>
                    <td><?= $row['name']  ?></td>
                    <td><?= $row['qty']  ?></td>
                    <td> <span class="badge badge-info"> Jumlah Sudah Distribusi</span><?= $row['qtydistribusi'] ?></td>
                    <td><span class="<?php if ($row['qty'] > $row['qtydistribusi']) {
                                            echo "badge badge-danger";
                                            $periksa = "Kurang Distribusi";
                                            $hasil = $row['qty'] - $row['qtydistribusi'];
                                        } else {
                                            echo "badge badge-success";
                                            $periksa = "";
                                            $hasil = '';
                                        }  ?>"><?= $periksa; ?></span> <?= $hasil; ?></td>
                    <td><?= $row['uom']  ?></td>
                    <td><?= $row['qtystock']  ?></td>
                    <td><?= $row['createdby']  ?></td>
                    <td><?= $row['createddate']  ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <td colspan="15" class="text-center"></td>
        </tfoot>
    </table>
</div>

<div class="viewmodaltambahdistribusix" style="display:none;"></div>

<script>
    function insertkan(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DistribusiAmprahFarmasi/detailobatdistribusi'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                $('#code').val(response.code);
                $('#name').val(response.name);
                $('#uom').val(response.uom);
                $('#price').val(response.salesprice);
                $('#qtyrequest').val(response.qty);
            }
        });
    }
</script>




<script>
    function tambahkanhibah(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DistribusiAmprahFarmasi/InputDistribusiModalHibah'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodaltambahdistribusix').html(response.sukses).show();
                    $('#modalinputdistribusibaruhibah').modal('show');

                }
            }

        });
    }
</script>

<script>
    $(document).ready(function() {
        $('#datapermintaan').DataTable({
            responsive: true,
            paging: false,
            scrollX: true,
            scrollY: "30vh"
        });
    });
</script>