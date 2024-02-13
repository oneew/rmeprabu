<?php helper('form') ?>
<?= form_open('PelayananLPK/simpanpemeriksaan', ['class' => 'formsimpanbanyak']); ?>
<?= csrf_field(); ?>
<div class="modal fade" id="modalinputLPK" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Input Pemeriksaan Patologi Klinik</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">


                <table class="table display table-bordered table-striped no-wrap">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tarif</th>
                            <th>Qty</th>
                        </tr>
                    </thead>
                    <tbody class="formtambah">
                        <tr>
                            <form id="div-form-tambah">
                                <td>
                                    <?php if ($classroom == 'IRJ') {
                                        $asal = $registernumber_rawatjalan;
                                    } else {
                                        if ($classroom == 'IGD') {
                                            $asal = $registernumber_rawatjalan;
                                        } else {
                                            $asal = $registernumber_rawatinap;
                                        }
                                    } ?>
                                    <input type="text" name="name[]" id="name-1" data-id="1" class="form-control form-tambah" autocomplete="off">
                                    <input type="hidden" name="types[]" id="types" class="form-control" value="<?= $groups; ?>">
                                    <input type="hidden" name="journalnumber[]" id="journalnumber" class="form-control" value="<?= $journalnumber; ?>">
                                    <input type="hidden" name="documentdate[]" id="documentdate" class="form-control" value="<?= $documentdate; ?>">
                                    <input type="hidden" name="relation[]" id="relation" class="form-control" value="<?= $pasienid; ?>">
                                    <input type="hidden" name="relationname[]" id="relationname" class="form-control" value="<?= $pasienname; ?>">
                                    <input type="hidden" name="paymentmethod[]" id="paymentmethod" class="form-control" value="<?= $paymentmethod; ?>">
                                    <input type="hidden" name="paymentmethodname[]" id="paymentmethodname" class="form-control" value="<?= $paymentmethod; ?>">
                                    <input type="hidden" name="classroom[]" id="classroom" class="form-control" value="<?= $classroom; ?>">
                                    <input type="hidden" name="classroomname[]" id="classroom" class="form-control" value="<?= $classroomname; ?>">
                                    <input type="hidden" name="room[]" id="room" class="form-control" value="<?= $room; ?>">
                                    <input type="hidden" name="roomname[]" id="roomname" class="form-control" value="<?= $roomname; ?>">
                                    <input type="hidden" name="smf[]" id="smf" class="form-control" value="<?= $smf; ?>">
                                    <input type="hidden" name="smfname[]" id="smfname" class="form-control" value="<?= $smfname; ?>">
                                    <input type="hidden" name="dokter[]" id="dokter" class="form-control" value="<?= $dokter; ?>">
                                    <input type="hidden" name="doktername[]" id="doktername" class="form-control" value="<?= $doktername; ?>">
                                    <input type="hidden" name="employee[]" id="employee" class="form-control" value="<?= $employee; ?>">
                                    <input type="hidden" name="employeename[]" id="employeename" class="form-control" value="<?= $employeename; ?>">
                                    <input type="hidden" name="registernumber[]" id="registernumber" class="form-control" value="<?= $asal; ?>">
                                    <input type="hidden" name="referencenumber[]" id="referencenumber" class="form-control" value="<?= $referencenumber; ?>">
                                    <input type="hidden" name="referencenumberparent[]" id="referencenumberparent" class="form-control" value="<?= $referencenumberparent; ?>">
                                    <input type="hidden" name="locationcode[]" id="locationcode" class="form-control" value="<?= $locationcode; ?>">
                                    <input type="hidden" name="code[]" id="code-1" class="form-control">
                                    <input type="hidden" name="expertisegroup[]" id="expertisegroup-1" class="form-control">
                                    <input type="hidden" name="groups[]" id="groups-1" class="form-control">
                                    <input type="hidden" name="groupname[]" id="groupname-1" class="form-control">
                                    <input type="hidden" name="category[]" id="category-1" class="form-control">
                                    <input type="hidden" name="categoryname[]" id="categoryname-1" class="form-control">
                                    <input type="hidden" name="bhp[]" id="bhp-1" class="form-control">
                                    <input type="hidden" name="disc[]" id="disc" value="1.00" class="form-control">
                                    <input type="hidden" name="share1[]" id="share1-1" class="form-control">
                                    <input type="hidden" name="share2[]" id="share2-1" class="form-control">
                                    <input type="hidden" name="expertisegroup[]" id="expertisegroup" class="form-control">
                                    <input type="hidden" name="memo[]" id="memo" value="PELAYANAN DAN TINDAKAN PENUNJANG MEDIS" class="form-control">
                                    <input type="hidden" name="createdby[]" id="createdby" class="form-control" value="<?= session()->get('email'); ?>">
                                    <input type="hidden" name="createddate[]" id="createddate" class="form-control" value="<?= date('Y-m-d h:m:s'); ?>">
                                </td>
                                <td>
                                    <input type="text" name="price[]" id="price-1" class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="qty[]" id="qty" value="1.00" class="form-control">
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
                                //$('#modalinputLPA').modal('hide');
                                dataresume();
                                historiradiologi();
                                resumeexpertise();
                                $('#name').val('');
                                $('#price').val('');

                            }
                        });


                    }
                }
            });
            return false;
        });

        $('.btnaddform').click(function(e) {
            e.preventDefault();
            /* DATA ID BERDASARKAN VARIABLE DATA ID*/
            let dataid = 2;
            $('.formtambah').append(`
                            <tr>
            
                                <td>
                                    <input type="text" name="name[]" id="name-${dataid}" data-id="${dataid}" class="form-control form-tambah" autocomplete="off">
                                    <input type="hidden" name="types[]" id="types" class="form-control" value="<?= $groups; ?>">
                                    <input type="hidden" name="journalnumber[]" id="journalnumber" class="form-control" value="<?= $journalnumber; ?>">
                                    <input type="hidden" name="documentdate[]" id="documentdate" class="form-control" value="<?= $documentdate; ?>">
                                    <input type="hidden" name="relation[]" id="relation" class="form-control" value="<?= $pasienid; ?>">
                                    <input type="hidden" name="relationname[]" id="relationname" class="form-control" value="<?= $pasienname; ?>">
                                    <input type="hidden" name="paymentmethod[]" id="paymentmethod" class="form-control" value="<?= $paymentmethod; ?>">
                                    <input type="hidden" name="paymentmethodname[]" id="paymentmethodname" class="form-control" value="<?= $paymentmethod; ?>">
                                    <input type="hidden" name="classroom[]" id="classroom" class="form-control" value="<?= $classroom; ?>">
                                    <input type="hidden" name="classroomname[]" id="classroom" class="form-control" value="<?= $classroomname; ?>">
                                    <input type="hidden" name="room[]" id="room" class="form-control" value="<?= $room; ?>">
                                    <input type="hidden" name="roomname[]" id="roomname" class="form-control" value="<?= $roomname; ?>">
                                    <input type="hidden" name="smf[]" id="smf" class="form-control" value="<?= $smf; ?>">
                                    <input type="hidden" name="smfname[]" id="smfname" class="form-control" value="<?= $smfname; ?>">
                                    <input type="hidden" name="dokter[]" id="dokter" class="form-control" value="<?= $dokter; ?>">
                                    <input type="hidden" name="doktername[]" id="doktername" class="form-control" value="<?= $doktername; ?>">
                                    <input type="hidden" name="employee[]" id="employee" class="form-control" value="<?= $employee; ?>">
                                    <input type="hidden" name="employeename[]" id="employeename" class="form-control" value="<?= $employeename; ?>">
                                    <input type="hidden" name="registernumber[]" id="registernumber" class="form-control" value="<?= $asal; ?>">
                                    <input type="hidden" name="referencenumber[]" id="referencenumber" class="form-control" value="<?= $referencenumber; ?>">
                                    <input type="hidden" name="referencenumberparent[]" id="referencenumberparent" class="form-control" value="<?= $referencenumberparent; ?>">
                                    <input type="hidden" name="locationcode[]" id="locationcode" class="form-control" value="<?= $locationcode; ?>">
                                    <input type="hidden" name="code[]" id="code-${dataid}" class="form-control">
                                    <input type="hidden" name="expertise[]" id="expertise" class="form-control">
                                    <input type="hidden" name="groups[]" id="groups-${dataid}" class="form-control">
                                    <input type="hidden" name="groupname[]" id="groupname-${dataid}" class="form-control">
                                    <input type="hidden" name="category[]" id="category-${dataid}" class="form-control">
                                    <input type="hidden" name="categoryname[]" id="categoryname-${dataid}" class="form-control">
                                    <input type="hidden" name="bhp[]" id="bhp-${dataid}" class="form-control">
                                    <input type="hidden" name="disc[]" id="disc" value="1.00" class="form-control">
                                    <input type="hidden" name="share1[]" id="share1-${dataid}" class="form-control">
                                    <input type="hidden" name="share2[]" id="share2-${dataid}" class="form-control">
                                    <input type="hidden" name="expertisegroup[]" id="expertisegroup-${dataid}" class="form-control">
                                    <input type="hidden" name="memo[]" id="memo" value="PELAYANAN DAN TINDAKAN PENUNJANG MEDIS" class="form-control">
                                    <input type="hidden" name="createdby[]" id="createdby" class="form-control" value="<?= session()->get('email'); ?>">
                                    <input type="hidden" name="createddate[]" id="createddate" class="form-control" value="<?= date('Y-m-d h:m:s'); ?>">
                               
                                </td>
                                <td>
                                    <input type="text" name="price[]" id="price-${dataid}" class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="qty[]" id="qty" value="1.00" class="form-control">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btnhapusform"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>


            `);
            /*MENAMBAHKAN NILAI DATA ID TIAP PENCET TOMBOL*/
            dataid++;
        });

        /* SAYA TAMBAHKAN PARAMETER ID*/
        $(document)
            .on('input', $('.form-tambah'), function() {
                let id = $(this).data('id');
                auto_tambah(id);
            })

        /*SAYA RUBAH IDNYA MENJADI DINAMIS BERDASARKAN DATA ID*/
        function auto_tambah(id) {
            var kelas = document.getElementById("classroom").value;
            $(".form-tambah").autocomplete({
                source: "<?php echo base_url('PelayananLPK/ajax_pemeriksaan'); ?>?kelas=" + kelas,

                select: function(event, ui) {
                    $('#name-' + id).val(ui.item.value);
                    $('#price-' + id).val(ui.item.price);
                    $('#code-' + id).val(ui.item.code);
                    $('#share1-' + id).val(ui.item.share1);
                    $('#share2-' + id).val(ui.item.share2);
                    $('#groups-' + id).val(ui.item.groups);
                    $('#groupname-' + id).val(ui.item.groupname);
                    $('#category-' + id).val(ui.item.category);
                    $('#categoryname-' + id).val(ui.item.categoryname);
                    $('#bhp-' + id).val(ui.item.bhp);
                    $('#expertisegroup-' + id).val(ui.item.expertisegroup);
                    //alert(JSON.stringify(ui));
                }

            });
            $('#price-' + id).val(price);

        }


        $('.btnkembali').click(function(e) {
            e.preventDefault();
            dataresume();
            historiradiologi();
            resumeexpertise();
        });
    });

    $(document).on('click', '.btnhapusform', function(e) {
        e.preventDefault();
        $(this).parents('tr').remove();

    });
</script>