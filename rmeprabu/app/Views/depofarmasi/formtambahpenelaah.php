<?= form_open('PenelaahResep/simpandatabanyak', ['class' => 'formsimpanbanyak']); ?>
<?= csrf_field(); ?>
<P>
    <button type="button" class="btn btn-warning btnkembali"><i class=" fa fa-home"></i> Kembali</button>
    <button type="submit" class="btn btn-warning btnsimpanbanyak"><i class=" fa fa-plus"></i> Simpan</button>
</P>
<table class="table display table-bordered table-striped no-wrap">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Nip</th>
            <th>Handphone</th>
            <th>Alamat</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody class="formtambah">
        <tr>
            <td>
                <input type="text" name="code[]" class="form-control" required>
            </td>
            <td>
                <input type="text" name="nama[]" class="form-control" required>
            </td>
            <td>
                <input type="text" name="nip[]" class="form-control" required>
            </td>
            <td>
                <input type="text" name="handphone[]" class="form-control" required>
            </td>

            <td><input type="text" name="address[]" class="form-control">
            </td>
            <td>
                <button type="button" class="btn btn-primary btnaddform"><i class="fa fa-plus"></i></button>
            </td>
        </tr>
    </tbody>

</table>

<?= form_close(); ?>

<script>
    $(document).ready(function(e) {

        $('.formsimpanbanyak').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpanbanyak').attr('disable', 'disabled');
                    $('.btnsimpanbanyak').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnsimpanbanyak').removeAttr('disable');
                    $('.btnsimpanbanyak').html('Simpan');
                },
                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            html: `${response.sukses}`,

                        }).then((result) => {
                            if (result.value) {
                                window.location.href = ("<?php echo base_url('PenelaahResep/index') ?>");
                            }
                        });


                    }
                }
            });
            return false;
        });

        $('.btnaddform').click(function(e) {
            e.preventDefault();
            $('.formtambah').append(`
            <tr>
            <td>
                <input type="text" name="code[]" class="form-control" required>
            </td>
            <td>
                <input type="text" name="nama[]" class="form-control" required>
            </td>
            <td>
            <input type="text" name="nip[]" class="form-control" required>
            </td>
            <td>
            <input type="text" name="handphone[]" class="form-control" required>
            </td>

            <td><input type="text" name="address[]" class="form-control">
            </td>
            <td>
                <button type="button" class="btn btn-danger btnhapusform"><i class="fa fa-trash"></i></button>
            </td>
        </tr>


            `);

        });
        $('.btnkembali').click(function(e) {
            e.preventDefault();
            dataperawat();

        });
    });

    $(document).on('click', '.btnhapusform', function(e) {
        e.preventDefault();
        $(this).parents('tr').remove();

    });
</script>