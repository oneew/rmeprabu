<table class="table table-striped table-hover table-bordered w-100 mt-3" id="lapOk">
    <thead>
        <tr class="bg-success text-white">
            <th>No</th>
            <th>Nama Tindakan</th>
            <th>Jenis</th>
            <th>dibuat oleh</th>
            <th>dibuat pada</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datas as $key => $data) : ?>
            <tr>
                <td><?= ++$key ;?></td>
                <td><?= $data['nama'] ;?></td>
                <td><?= $data['katarak'] == '1' ? 'Katarak' : 'General' ;?></td>
                <td><?= $data['created_by'] ;?></td>
                <td><?= date('d-m-Y H:i:s', strtotime($data['created_at'])) ;?></td>
                <td>
                    <div class="d-flex">
                        <?php if ($data['katarak'] == '1') : ?>
                            <button type="button" class="btn btn-sm btn-secondary mr-2" id="btn_katarak" data-id="<?= $data['id'] ;?>"><i class="fas fa-edit"></i></button>
                        <?php else : ?>
                            <button type="button" class="btn btn-sm btn-warning mr-2" id="btn_edit" data-id="<?= $data['id'] ;?>"><i class="fas fa-edit"></i></button>
                        <?php endif ?>
                        <button type="button" class="btn btn-sm btn-danger" id="btn_delete" data-id="<?= $data['id'] ;?>" data-nama="<?= $data['nama'] ;?>" data-dokter="<?= $data['created_by'] ;?>"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<script>
    $('#lapOk').dataTable({
        scrollX:true
    })

    $('#lapOk tbody').on( 'click', '#btn_edit',function(e){
        $.ajax({
            type: "GET",
            url: '<?= base_url('TempletLapOk/edit'); ?>',
            data: {
                id: $(this).data("id"),
            },
            dataType: "json",
            success: function(response) {
                $('.viewmodal').html(response.data).show();
                $('#modalcreate_lo_general').modal('show');
            }
        });
    })

    $('#lapOk tbody').on( 'click', '#btn_katarak',function(e){
        $.ajax({
            type: "GET",
            url: '<?= base_url('TempletLapOk/editKatarak'); ?>',
            data: {
                id: $(this).data("id"),
            },
            dataType: "json",
            success: function(response) {
                $('.viewmodal').html(response.data).show();
                $('#modalcreate_lo_katarak').modal('show');
            }
        });
    })

    $('#lapOk tbody').on( 'click', '#btn_delete',function() {
        Swal.fire({
            title: 'Hapus !!!',
            text: 'Apakah anda yakin untuk templet laporan operasi '+$(this).data('nama') + ' milik ' + $(this).data('dokter') +' !!!',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: '<?= base_url('TempletLapOk/delete'); ?>',
                    data: {
                        id: $(this).data("id"),
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.error) {
                            Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            text: response.error
                            })
                        }

                        if (response.success) {
                            dataLap()
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil !!',
                                text: response.success,
                            })
                        }
                    }
                });
            }
        })
    })
</script>