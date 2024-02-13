<?php helper('form') ?>
<?= form_open('PelayananABL/simpanpemeriksaan', ['class' => 'formsimpanbanyak']); ?>
<?= csrf_field(); ?>
<div class="modal fade" id="modalinputABL" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Input Pelayanan Ambulance</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">


                <table class="table display table-bordered table-striped no-wrap">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Km</th>
                            <th>Tarif</th>

                        </tr>
                    </thead>
                    <tbody class="formtambah">
                        <tr>
                            <form id="div-form-tambah">
                                <td width="400px">
                                    <?php if ($classroom == 'IRJ') {
                                        $asal = $registernumber_rawatjalan;
                                    } else {
                                        if ($classroom == 'IGD') {
                                            $asal = $registernumber_rawatjalan;
                                        } else {
                                            $asal = $registernumber_rawatinap;
                                        }
                                    } ?>
                                    <input type="text" name="name[]" id="name" class="form-control form-tambah" autocomplete="off">
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
                                    <input type="hidden" name="employee[]" id="employee" class="form-control" value="ABL_00001">
                                    <input type="hidden" name="employeename[]" id="employeename" class="form-control" value="PETUGAS AMBULANCE">
                                    <input type="hidden" name="registernumber[]" id="registernumber" class="form-control" value="<?= $asal; ?>">
                                    <input type="hidden" name="referencenumber[]" id="referencenumber" class="form-control" value="<?= $referencenumber; ?>">
                                    <input type="hidden" name="referencenumberparent[]" id="referencenumberparent" class="form-control" value="<?= $referencenumberparent; ?>">
                                    <input type="hidden" name="locationcode[]" id="locationcode" class="form-control" value="<?= $locationcode; ?>">

                                    <input type="hidden" name="expertisegroup[]" id="expertisegroup" class="form-control">
                                    <input type="hidden" name="groups[]" id="groups" class="form-control">
                                    <input type="hidden" name="groupname[]" id="groupname" class="form-control">
                                    <input type="hidden" name="category[]" id="category" class="form-control">
                                    <input type="hidden" name="categoryname[]" id="categoryname" class="form-control">
                                    <input type="hidden" name="bhp[]" id="bhp" class="form-control">
                                    <input type="hidden" name="disc[]" id="disc" value="1.00" class="form-control">
                                    <input type="hidden" name="share1[]" id="share1" class="form-control">
                                    <input type="hidden" name="share2[]" id="share2" class="form-control">
                                    <input type="hidden" name="expertisegroup[]" id="expertisegroup" class="form-control">
                                    <input type="hidden" name="memo[]" id="memo" value="PELAYANAN DAN TINDAKAN PENUNJANG MEDIS" class="form-control">
                                    <input type="hidden" name="createdby[]" id="createdby" class="form-control" value="<?= session()->get('email'); ?>">
                                    <input type="hidden" name="createddate[]" id="createddate" class="form-control" value="<?= date('Y-m-d h:m:s'); ?>">


                                </td>
                                <td>
                                    <input type="text" name="qty[]" id="qty" value="1" class="form-control">
                                </td>
                                <td>
                                    <input type="hidden" name="code[]" id="code2" class="form-control">
                                    <input type="text" name="price[]" id="price" class="form-control" style="text-align: right;">
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
                                dataresume();
                                historiradiologi();
                                dataadmission();
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
            $('.formtambah').append(`
                            <tr>
            
                                <td>
                                    <input type="text" name="name[]" id="name" class="form-control form-tambah" autocomplete="off">
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
                                    <input type="hidden" name="employee[]" id="employee" class="form-control" value="ABL_00001">
                                    <input type="hidden" name="employeename[]" id="employeename" class="form-control" value="PETUGAS AMBULANCE">
                                    <input type="hidden" name="registernumber[]" id="registernumber" class="form-control" value="<?= $asal; ?>">
                                    <input type="hidden" name="referencenumber[]" id="referencenumber" class="form-control" value="<?= $referencenumber; ?>">
                                    <input type="hidden" name="referencenumberparent[]" id="referencenumberparent" class="form-control" value="<?= $referencenumberparent; ?>">
                                    <input type="hidden" name="locationcode[]" id="locationcode" class="form-control" value="<?= $locationcode; ?>">
                                    <input type="hidden" name="code[]" id="code2" class="form-control">
                                    <input type="hidden" name="expertisegroup[]" id="expertisegroup" class="form-control">
                                    <input type="hidden" name="groups[]" id="groups" class="form-control">
                                    <input type="hidden" name="groupname[]" id="groupname" class="form-control">
                                    <input type="hidden" name="category[]" id="category" class="form-control">
                                    <input type="hidden" name="categoryname[]" id="categoryname" class="form-control">
                                    <input type="hidden" name="bhp[]" id="bhp" class="form-control">
                                    <input type="hidden" name="disc[]" id="disc" value="1.00" class="form-control">
                                    <input type="hidden" name="share1[]" id="share1" class="form-control">
                                    <input type="hidden" name="share2[]" id="share2" class="form-control">
                                    <input type="hidden" name="expertisegroup[]" id="expertisegroup" class="form-control">
                                    <input type="hidden" name="memo[]" id="memo" value="PELAYANAN DAN TINDAKAN PENUNJANG MEDIS" class="form-control">
                                    <input type="hidden" name="createdby[]" id="createdby" class="form-control" value="<?= session()->get('email'); ?>">
                                    <input type="hidden" name="createddate[]" id="createddate" class="form-control" value="<?= date('Y-m-d h:m:s'); ?>">
                                    
                                    <input type="hidden" name="qty[]" id="qty" value="1.00" class="form-control">
                               
                                </td>
                                <td>
                                <input type="text" name="price[]" id="price" class="form-control">
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
            var kelas = document.getElementById("classroom").value;
            $(".form-tambah").autocomplete({
                source: "<?php echo base_url('PelayananABL/ajax_pemeriksaan'); ?>",

                select: function(event, ui) {
                    $('#name').val(ui.item.value);
                    $('#price').val(ui.item.price);
                    $('#code2').val(ui.item.code);
                    $('#share1').val(ui.item.share1);
                    $('#share2').val(ui.item.share2);
                    $('#groups').val(ui.item.groups);
                    $('#groupname').val(ui.item.groupname);
                    $('#category').val(ui.item.category);
                    $('#categoryname').val(ui.item.categoryname);
                    $('#bhp').val(ui.item.bhp);
                    $('#expertisegroup').val(ui.item.expertisegroup);
                }

            });
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