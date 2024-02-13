<div id="old" class="container-fluid pl-0">
    <?php foreach ($list_obat as $item) : ?>
        <div class="row mb-3">
            <div class="col border-bottom mr-2">
                <?= $item['nama_obat']; ?>
            </div>
            <div class="col-2 border-bottom mr-2">
                <?= $item['jumlah_obat']; ?>
            </div>
            <button type="button" class="btn btn-sm btn-danger me-2" id="hapus_obat" data-id_drug="<?= $item['id']; ?>" data-nama="<?= $item['nama_obat'] ;?>" data-jumlah="<?= $item['jumlah_obat'] ;?>"><i class="fas fa-trash"></i></button>
        </div>
    <?php endforeach ?>
</div>
<script>
    $('#old #hapus_obat').click(function() {
        Swal.fire({
            title: 'Hapus !!!',
            text: 'Apakah anda yakin untuk menghapus obat '+$(this).data('nama') + ', ' + $(this).data('jumlah') +' !!!',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#d33',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: '<?= base_url('TempletEResep/delete_drug'); ?>',
                    data: {
                        id: $(this).data("id_drug")
                    },
                    dataType: "json",
                    success: function(response) {
                        old_data()
                        dataEresep()
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil !!',
                            text: response.success,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                });
            }
        })
    })
</script>