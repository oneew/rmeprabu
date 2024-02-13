<?php helper('form') ?>
<?= form_open('BedahTim/simpandatabanyak', ['class' => 'formsimpanbanyak']); ?>
<?= csrf_field(); ?>
<div class="modal fade" id="modaltim" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Setup Tim Pelaksana Operasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">


                <table class="table display table-bordered table-striped no-wrap">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>#Peran</th>

                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody class="formtambah">
                        <tr>
                            <form id="div-form-tambah">
                                <td>


                                    <input type="text" name="nama[]" id="nama" class="form-control form-tambah" autocomplete="off">
                                    <input type="hidden" name="jabatan2[]" id="jabatan2" class="form-control">
                                    <input type="hidden" name="id_tprod[]" id="id_tprod" class="form-control" value="<?= $id_tprod; ?>">
                                    <input type="hidden" name="journalnumber[]" id="journalnumber" class="form-control" value="<?= $journalnumber; ?>">
                                    <input type="hidden" name="referencenumber[]" id="referencenumber" class="form-control" value="<?= $referencenumber; ?>">
                                    <input type="hidden" name="pasienid[]" id="pasienid" class="form-control" value="<?= $pasienid; ?>">
                                    <input type="hidden" name="pasienname[]" id="pasienname" class="form-control" value="<?= $pasienname; ?>">
                                    <input type="hidden" name="paymentmethod[]" id="paymentmethod" class="form-control" value="<?= $paymentmethod; ?>">
                                    <input type="hidden" name="cases[]" id="cases" class="form-control" value="<?= $cases; ?>">
                                    <input type="hidden" name="name[]" id="name" class="form-control" value="<?= $name; ?>">
                                    <input type="hidden" name="ibsdoktername[]" id="ibsdoktername" class="form-control" value="<?= $ibsdoktername; ?>">
                                    <input type="hidden" name="ibsanestesiname[]" id="ibsanestesiname" class="form-control" value="<?= $ibsanestesiname; ?>">
                                    <input type="hidden" name="jenis_anestesi[]" id="jenis_anestesi" class="form-control" value="<?= $jenis_anestesi; ?>">
                                    <input type="hidden" name="room[]" id="room" class="form-control" value="<?= $room; ?>">
                                    <input type="hidden" name="dt_advice_op[]" id="dt_advice_op" class="form-control" value="<?= $dt_advice_op; ?>">
                                    <input type="hidden" name="diagnosa_prabedah[]" id="diagnosa_prabedah" class="form-control" value="<?= $diagnosa_prabedah; ?>">

                                    <input type="hidden" name="user[]" id="user" class="form-control" value="<?= session()->get('email'); ?>">
                                    <input type="hidden" name="groupname[]" id="groupname" class="form-control" value="<?= $groupname; ?>">
                                    <input type="hidden" name="id_book_operasi[]" id="id_book_operasi" class="form-control" value="<?= $id; ?>">
                                </td>
                                <td>
                                    <select name="jabatan[]" id="jabatan" class="form-control">
                                        <option value="">-Pilih Peran-</option>
                                        <option value="Asisten 1">Asisten 1</option>
                                        <option value="Asisten 2">Asisten 2</option>
                                        <option value="Circulation Nurse">Circulation Nurse</option>
                                        <option value="Resepsionis Nurse">Resepsionis Nurse</option>
                                        <option value="Runer Nurse">Runer Nurse</option>
                                        <option value="Instrumen">Instrumen</option>
                                        <option value="Instrumen">Penata Anestesi</option>
                                    </select>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-primary btnaddform"><i class="fa fa-plus"></i></button>
                                </td>
                        </tr>
                    </tbody>

                </table>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnsimpanbanyak">Simpan</button>
            </div>
        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
                                $('#modaltim').modal('hide');
                                pelaksanaoperasiresume();
                                dataoperasi();
                                datajadwal();
                                //datajadwal2();
                                datajadwalinputtim();
                                datatim();

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
                <input type="text" name="nama[]" class="form-control form-tambah" autocomplete="off">
                <input type="hidden" name="jabatan2[]" id="jabatan2" class="form-control">
                <input type="hidden" name="id_tprod[]" id="id_tprod" class="form-control" value="<?= $id_tprod; ?>">
                                <input type="hidden" name="journalnumber[]" id="journalnumber" class="form-control" value="<?= $journalnumber; ?>">
                                <input type="hidden" name="referencenumber[]" id="referencenumber" class="form-control" value="<?= $referencenumber; ?>">
                                <input type="hidden" name="pasienid[]" id="pasienid" class="form-control" value="<?= $pasienid; ?>">
                                <input type="hidden" name="pasienname[]" id="pasienname" class="form-control" value="<?= $pasienname; ?>">
                                <input type="hidden" name="paymentmethod[]" id="paymentmethod" class="form-control" value="<?= $paymentmethod; ?>">
                                <input type="hidden" name="cases[]" id="cases" class="form-control" value="<?= $cases; ?>">
                                <input type="hidden" name="name[]" id="name" class="form-control" value="<?= $name; ?>">
                                <input type="hidden" name="ibsdoktername[]" id="ibsdoktername" class="form-control" value="<?= $ibsdoktername; ?>">
                                <input type="hidden" name="ibsanestesiname[]" id="ibsanestesiname" class="form-control" value="<?= $ibsanestesiname; ?>">
                                <input type="hidden" name="jenis_anestesi[]" id="jenis_anestesi" class="form-control" value="<?= $jenis_anestesi; ?>">
                                <input type="hidden" name="room[]" id="room" class="form-control" value="<?= $room; ?>">
                                <input type="hidden" name="dt_advice_op[]" id="dt_advice_op" class="form-control" value="<?= $dt_advice_op; ?>">
                                <input type="hidden" name="diagnosa_prabedah[]" id="diagnosa_prabedah" class="form-control" value="<?= $diagnosa_prabedah; ?>">

                                <input type="hidden" name="user[]" id="user" class="form-control" value="<?= session()->get('email'); ?>">
                                <input type="hidden" name="groupname[]" id="groupname" class="form-control" value="<?= $groupname; ?>">
                                <input type="hidden" name="id_book_operasi[]" id="id_book_operasi" class="form-control" value="<?= $id; ?>">
            </td>
            <td>
                <select name="jabatan[]" id="jabatan" class="form-control">
                    <option value="">-Pilih peran-</option>
                    <option value="Asisten 1">Asisten 1</option>
                                    <option value="Asisten 2">Asisten 2</option>
                                    <option value="Circulation Nurse">Circulation Nurse</option>
                                    <option value="Resepsionis Nurse">Resepsionis Nurse</option>
                                    <option value="Runer Nurse">Runer Nurse</option>
                                    <option value="Instrumen">Instrumen</option>
                </select>
            </td>
          

           
            <td>
                <button type="button" class="btn btn-danger btnhapusform"><i class="fa fa-trash"></i></button>
            </td>
        </tr>


            `);
        });

        $(document)
            .on('input', $('.form-tambah'), function() {
                auto_tambah();
            })

        function auto_tambah() {
            $(".form-tambah").autocomplete({
                source: "<?php echo base_url('EdukasiBedah/ajax_pelayanan'); ?>"


            });
        }


        $('.btnkembali').click(function(e) {
            e.preventDefault();

            datatim();

        });
    });

    $(document).on('click', '.btnhapusform', function(e) {
        e.preventDefault();
        $(this).parents('tr').remove();

    });
</script>



<!-- <script type="text/javascript">
    $(document).ready(function() {


        $("#nama").autocomplete({
            source: "<?php echo base_url('EdukasiBedah/ajax_pelayanan'); ?>",
            select: function(event, ui) {
                $('#nama').val(ui.item.value);
                $('#jabatan2').val(ui.item.jabatan);


            }
        });
    });
</script> -->