<div id="modal_get_lo_katarak" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Templet Laporan Operasi Katarak</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover w-100" id="dataTable">
                        <thead class="bg-primary text-white">
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Pembuat</td>
                                <td>Tanggal Buat</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_data as $no => $item) : ?>
                                <tr>
                                    <td><?= ++$no; ?></td>
                                    <td><?= $item['nama']; ?></td>
                                    <td><?= $item['created_by']; ?></td>
                                    <td><?= date('d-m-Y H:i:s', strtotime($item['created_at'])); ?></td>
                                    <td>
                                        <div class="btn btn-sm btn-success use-templet" data-id="<?= $item['id'] ;?>" data-name="<?= $item['nama'] ;?>">Gunakan Templet</div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $('#modal_get_lo_katarak').on('shown.bs.modal', function(event) {
        $('#dataTable').dataTable({
            scrollX: true
        })
    })

    $('#dataTable tbody').on('click', '.use-templet', function(e) {
        Swal.fire({
            title: "Perhatian !!",
            text: "Apakah anda yakin untuk menggunakan templet tindakan " + $(this).data('name')+", Harap cermati lagi data dengan seksama !",
            showCancelButton: true,
            confirmButtonText: "Gunakan",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: '<?= base_url('TempletLapOk/getDataLapKatarak'); ?>',
                    data: {
                        id: $(this).data("id"),
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.data.od == '1') {
                            $('#od').prop('checked', true);
                        }else{
                            $('#od').prop('checked', false);
                        }

                        if (response.data.os == '1') {
                            $('#os').prop('checked', true);
                        }else{
                            $('#os').prop('checked', false);
                        }

                        $('#cataractGrade').val(response.data.cataractGrade)
                        $('#noteOp').val(response.data.noteOp)
                        $('#ucva').val(response.data.ucva)
                        $('#bcva').val(response.data.bcva)
                        $('#retinometry').val(response.data.retinometry)
                        $('#k1').val(response.data.k1)
                        $('#k2').val(response.data.k2)
                        $('#axl').val(response.data.axl)
                        $('#acd').val(response.data.acd)
                        $('#lt').val(response.data.lt)
                        $('#formula').val(response.data.formula)
                        $('#emetropia').val(response.data.emetropia)
                        $('#visus').val(response.data.visus)
                        $('#typeOperasi').val(response.data.typeOperasi)
                        $('#scrub').val(response.data.scrub)
                        $('#cukator').val(response.data.cukator)
                        $('#anestehesia').val(response.data.anestehesia).change()
                        $('#approach').val(response.data.approach).change()
                        $('#capsulotomy').val(response.data.capsulotomy).change()
                        if (response.data.hydrodissection == '1') {
                            $('#hydrodissection').prop('checked', true);
                        }else{
                            $('#hydrodissection').prop('checked', false);
                        }
                        $('#nucleus').val(response.data.nucleus).change()
                        $('#phaco').val(response.data.phaco).change()
                        $('#iol').val(response.data.iol).change()
                        $('#stitch').val(response.data.stitch).change()
                        $('#phacoMachine').val(response.data.phacoMachine)
                        $('#phacoTime').val(response.data.phacoTime)
                        $('#irigatingSolution').val(response.data.irigatingSolution)
                        if (response.data.komplikasi == '1') {
                            $('#komplikasi').prop('checked', true);
                        }else{
                            $('#komplikasi').prop('checked', false);
                        }
                        if (response.data.posterior == '1') {
                            $('#posterior').prop('checked', true);
                        }else{
                            $('#posterior').prop('checked', false);
                        }
                        if (response.data.vitreus == '1') {
                            $('#vitreus').prop('checked', true);
                        }else{
                            $('#vitreus').prop('checked', false);
                        }
                        if (response.data.vitrectomy == '1') {
                            $('#vitrectomy').prop('checked', true);
                        }else{
                            $('#vitrectomy').prop('checked', false);
                        }
                        if (response.data.retained == '1') {
                            $('#retained').prop('checked', true);
                        }else{
                            $('#retained').prop('checked', false);
                        }
                        if (response.data.cortex == '1') {
                            $('#cortex').prop('checked', true);
                        }else{
                            $('#cortex').prop('checked', false);
                        }
                    }
                });
            }
        });
    })
</script>