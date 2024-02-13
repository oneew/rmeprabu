<table class="table table-striped table-hover table-bordered w-100 mt-3" id="eResepTable">
    <thead>
        <tr class="bg-success text-white">
            <th>No</th>
            <th>Nama Tindakan</th>
            <th>Nama Dokter</th>
            <th>Resep</th>
            <th>Created At</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datas as $key => $data) : ?>
            <tr>
                <td><?= ++$key ;?></td>
                <td><?= $data['nama_tindakan'] ;?></td>
                <td><?= $data['nama_dokter'] ;?></td>
                <td>
                    <?php foreach ($data['detail'] as $item) : ?>
                        <div class="border-bottom"><?= $item['nama_obat'] .'('.$item['jumlah_obat'].')' ;?></div>
                    <?php endforeach ?>
                </td>
                <td><?= date('d-m-Y H:i:s', strtotime($data['created_at'])) ;?></td>
                <td>
                    <div class="d-flex">
                        <button type="button" class="btn btn-sm btn-warning mr-2" id="btn_edit" data-id="<?= $data['id'] ;?>"><i class="fas fa-edit"></i></button>
                        <button type="button" class="btn btn-sm btn-danger" id="btn_delete" data-id="<?= $data['id'] ;?>" data-ref="<?= $data['referencenumber'] ;?>" data-nama="<?= $data['nama_tindakan'] ;?>" data-dokter="<?= $data['nama_dokter'] ;?>"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<script>
    $('#eResepTable').dataTable({
        scrollX:true
    })

    $('#eResepTable tbody').on( 'click', '#btn_edit',function(e){
        $.ajax({
            type: "GET",
            url: '<?= base_url('TempletEResep/edit'); ?>',
            data: {
                id: $(this).data("id"),
            },
            dataType: "json",
            success: function(response) {
                $('.viewmodal').html(response.data).show();
                $('#editEresepModal').modal('show');

                $('#editEresepModal').on('shown.bs.modal', function (event) {
                    old_data()
                })
            }
        });
    })

    $('#eResepTable tbody').on( 'click', '#btn_delete',function() {
        Swal.fire({
            title: 'Hapus !!!',
            text: 'Apakah anda yakin untuk templet resep tindakan '+$(this).data('nama') + ' milik dokter ' + $(this).data('dokter') +' !!!',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: '<?= base_url('TempletEResep/delete'); ?>',
                    data: {
                        id: $(this).data("id"),
                        ref: $(this).data("ref")
                    },
                    dataType: "json",
                    success: function(response) {
                        dataEresep()
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil !!',
                            text: response.success,
                        })
                    }
                });
            }
        })
    })
</script>