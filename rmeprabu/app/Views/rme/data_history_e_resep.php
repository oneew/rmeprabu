<table class="table table-striped table-hover table-bordered w-100" id="datatable">
    <thead>
        <tr class="bg-success text-white">
            <th>No</th>
            <th>Pelayanan</th>
            <th>Resep</th>
            <th>Aksi</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datas as $key => $data) : ?>
            <tr>
                <td><?= ++$key ;?></td>
                <td>
                    <?= $data['poliklinikname'] ;?>
                    <br>
                    <?= $data['doktername'] ;?>
                    <br>
                    <?= date('d-m-Y H:i:s', strtotime($data['createddate'])) ;?>
                </td>
                <td>
                    <?php foreach ($data['detail'] as $item) : ?>
                        <div class="border-bottom"><?= $item['name'] .'['.($item['signa1'] + 0) . ' x ' . ($item['signa2'] + 0) .']' . '('. $item['qty'] . ')' ;?></div>
                    <?php endforeach ?>
                </td>
                <td><button type="button" class="btn btn-sm btn-success" onclick="gunakanEresep('<?= $data['journalnumber']; ?>')"><i class="fas fa-download"></i>Gunakan E Resep</button></td>
                <td><?= date('d-m-Y H:i:s', strtotime($data['createddate'])) ;?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<script>
    function gunakanEresep(journalnumber) {

        $.ajax({
            url: "<?php echo base_url('PelayananRawatJalanRME/useDataHistoryEresep') ?>",
            data: {
                journalnumberbaru: '<?= $journalnumberbaru; ?>',
                journalnumberlama: journalnumber,
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Berhasil menambah ' + response.success.length + ' Obat',
                    })
                    $.each(response.success, function (key, item) {
                        newRowAdd =
                            '<div class="row align-items-end p-1 clone-form" id="row">'+
                                '<input type="hidden" class="price" id="price" autocomplete="off" name="price[]"  value="'+item.price+'" required>'+
                                '<input type="hidden" class="qtystock" id="qtystock" autocomplete="off" name="qtystock[]" value="'+item.qtystock+'" required>'+
                                '<div class="col-md-1">'+
                                    '<label class="control-label">Keterangan</label>'+
                                    '<select name="racikan[]" id="racikan2" class="form-control">'+
                                        '<option value="'+item.koderacikan+'">'+ item.racikan +'</option>'+
                                        <?php foreach ($racikan as $SP) : ?>
                                            '<option value="<?= $SP['kode']; ?>" data-name="<?= $SP['name']; ?>" class="select-statuspulang"><?= $SP['name']; ?></option>'+
                                        <?php endforeach; ?>
                                    '</select>'+
                                '</div>'+
                                '<div class="col-md-1">'+
                                    '<label class="control-label">Racikan Ke</label>'+
                                    '<select name="koderacikan[]" id="koderacikan" class="form-control">'+
                                        '<option value="'+item.koderacikan+'">'+item.koderacikan+'</option>'+
                                        '<option value="-">-</option>'+
                                        <?php foreach ($itemracikan as $APS) : ?>
                                            '<option data-id="<?= $APS['id']; ?>" data-room="<?= $APS['name']; ?>" class="select-koderacikan"><?= $APS['name']; ?></option>'+
                                        <?php endforeach; ?>
                                    '</select>'+
                                '</div>'+
                                '<div class="col-md-2">'+
                                    '<div class="form-group mb-0">'+
                                        '<label>Nama Obat</label>'+
                                        '<div class="input-group">'+
                                            '<input type="text" class="form-control nama-obat" id="nama_obat" name="nama_obat[]" value="'+item.nama_obat+'" required>'+
                                            '<input type="hidden" class="kode_obat" name="kode_obat[]" id="kode_obat" value="'+item.kode_obat+'">'+
                                            '<input type="hidden" class="batchnumber" name="batchnumber[]" id="batchnumber_obat" value="'+item.batchnumber+'">'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-2">'+
                                    '<div class="form-group mb-0">'+
                                        '<label class="control-label">Jumlah Obat</label>'+
                                        '<input type="text" id="qtyresep" autocomplete="off" name="qtyresep[]" class="form-control" value="'+item.qtyresep+'">'+
                                    '</div>'+
                                '</div>'+
                                '<input type="hidden" id="expireddate" autocomplete="off" name="expireddate[]" class="form-control" value="'+item.expireddate+'">'+
                                '<div class="col-2">'+
                                    '<div class="form-group mb-0">'+
                                        '<label class="control-label">Aturan Pakai</label>'+
                                        '<input type="text" id="signa1" autocomplete="off" name="signa1[]" class="form-control" value="'+item.signa+'">'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-1">'+
                                    '<div class="form-group mb-0">'+
                                        '<label class="control-label">Satuan</label>'+
                                        '<input type="text" id="uom" autocomplete="off" name="uom[]" class="form-control uom" value="'+item.uom+'" readonly>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-2">'+
                                    '<div class="form-group mb-0">'+
                                        '<label class="control-label">Cara Pakai</label>'+
                                        '<input type="text" name="carapakai[]" id="carapakai" value="'+item.carapakai+'" class="form-control cara-pakai">'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col">'+
                                    '<div class="btn-group" role="group" aria-label="Basic example">'+
                                        '<button type="button" class="btn btn-warning px-2" id="rowAdder">+</button>'+
                                        '<button type="button" class="btn btn-danger px-2" id="deleteRow">-</button>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';

                            $('#newinput').append(newRowAdd);
                    });

                    $('#row').each(function() {
                        $(this).remove();
                    });
                    $('#nama_obat').val(null);
                    $('#kode_obat').val(null);
                    $('#code').val(null);
                    $('#uom').val(null);
                    $('#batchnumber').val(null);
                    $('#qty').val('1');
                    $('#modal_history_e_resep').modal('hide')
                }else{
                    Swal.fire({
                        icon: 'warning',
                        title: 'Ooops',
                        text: 'Gagal menambahkan riwayat obat',
                    })
                }
            }
        });
    }
</script>