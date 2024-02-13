<div class="table-responsive">
    <table id="pemeriksaan" class="table color-table success-table">
        <thead>
            <tr>
                <th>No.Transaksi</th>
                <th>Poliklinik</th>
                <th>Dokter</th>
                <th>Tarif Pemeriksaan</th>
                <th>TotalTarif</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($PEMERIKSAAN as $pem) :
            ?>
                <tr>
                    <td><?= $pem['journalnumber'] ?></td>
                    <td><?= $pem['poliklinikname'] ?></td>
                    <td><?= $pem['doktername'] ?></td>
                    <td><?php echo number_format($pem['price'], 2, ",", "."); ?></td>
                    <td><?php echo number_format($pem['price'], 2, ",", "."); ?></td>
                    <?php $TotPem[] = $pem['price'];  ?>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <h6 class="card-title">Total Biaya Pemeriksaan:</h6>
                </td>
                <td><b><?php
                        $check_TotPem = isset($TotPem) ? array_sum($TotPem) : 0;
                        $TotalPem = $check_TotPem;
                        echo number_format($TotalPem, 2, ",", "."); ?></b>
                </td>
            </tr>
        </tbody>
    </table>

    <table id="dataGabung" class="table color-table success-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>JournalNumber</th>
                <th>Pelayanan</th>
                <th>Dokter</th>
                <th>Tarif</th>

            </tr>
        </thead>
        <tbody>


            <?php
            foreach ($TNO as $row) :
            ?>
                <tr>
                    <td><?= $row['types'] ?></td>
                    <td><?= $row['documentdate'] ?></td>
                    <td><?= $row['journalnumber'] ?></td>
                    <td><?= $row['name']  ?>
                        <br><span class="badge badge-info"><?= $row['paramedicName']; ?></span>
                    </td>
                    <td><?= $row['doktername'] ?></td>
                    <td><?= number_format($row['subtotal'], 2, ",", ".") ?></td>
                    <?php $TotTNO[] = $row['subtotal'];  ?>

                </tr>
            <?php endforeach; ?>
            <?php
            $check_TotTNO = isset($TotTNO) ? array_sum($TotTNO) : 0;
            $TotalTNO = $check_TotTNO;
            if ($TotalTNO > 0) { ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 class="card-title">TotalBiaya Tindakan :</h6>
                    </td>
                    <td><b><?php

                            echo number_format($TotalTNO, 2, ",", "."); ?></b>
                    </td>

                </tr>
            <?php } ?>
            <?php
            foreach ($GIZI as $GZ) :
            ?>
                <tr>
                    <td>
                    </td>
                    <td><?= $GZ['documentdate'] ?></td>
                    <td><?= $GZ['journalnumber'] ?></td>
                    <td><?= $GZ['name']  ?></td>
                    <td><?= $GZ['doktername'] ?></td>
                    <td><?= number_format($GZ['subtotal'], 2, ",", ".") ?></td>
                    <?php $TotGIZI[] = $GZ['subtotal'];  ?>
                </tr>

            <?php endforeach; ?>
            <?php
            $check_TotGIZI = isset($TotGIZI) ? array_sum($TotGIZI) : 0;
            $TotalGIZI = $check_TotGIZI;
            if ($TotalGIZI > 0) { ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 class="card-title">TotalBiaya Gizi :</h6>
                    </td>
                    <td><b><?php

                            echo number_format($TotalGIZI, 2, ",", "."); ?></b>
                    </td>
                </tr>
            <?php } ?>
            <?php
            foreach ($OPERASI as $OP) :
            ?>
                <tr>
                    <td><?= $OP['types'] ?></td>
                    <td><?= $OP['documentdate'] ?></td>
                    <td><?= $OP['journalnumber'] ?></td>
                    <td><?= $OP['name']  ?></td>
                    <td><?= $OP['doktername'] ?></td>
                    <td><?= number_format($OP['totaltarif'], 2, ",", ".") ?></td>
                    <?php $TotOPERASI[] = $OP['totaltarif'];  ?>
                </tr>
            <?php endforeach; ?>
            <?php
            $check_TotOPERASI = isset($TotOPERASI) ? array_sum($TotOPERASI) : 0;
            $TotalOPERASI = $check_TotOPERASI;
            if ($TotalOPERASI > 0) { ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 class="card-title">TotalBiaya Operasi :</h6>
                    </td>
                    <td><b><?php

                            echo number_format($TotalOPERASI, 2, ",", "."); ?></b>
                    </td>
                </tr>
            <?php } ?>
            <?php
            foreach ($PENUNJANG as $P) :
            ?>
                <tr>
                    <td>
                    </td>
                    <td><?= $P['documentdate'] ?></td>
                    <td><?= $P['journalnumber'] ?></td>
                    <td><?= $P['name']  ?></td>
                    <td><?= $P['employeename'] ?></td>
                    <td><?php $totPnj = $P['price'] * $P['qty'];
                        echo number_format($totPnj, 2, ",", ".") ?></td>
                    <?php $TotPENUNJANG[] = $totPnj;  ?>
                </tr>
            <?php endforeach; ?>
            <?php
            $check_TotPENUNJANG = isset($TotPENUNJANG) ? array_sum($TotPENUNJANG) : 0;
            $TotalPENUNJANG = $check_TotPENUNJANG;
            if ($TotalPENUNJANG > 0) { ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 class="card-title">TotalBiaya Penunjang :</h6>
                    </td>
                    <td><b><?php

                            echo number_format($TotalPENUNJANG, 2, ",", "."); ?></b>
                    </td>
                </tr>
            <?php } ?>
            <?php
            foreach ($FARMASI as $F) :
            ?>
                <tr>
                    <td>FAR</td>
                    <td><?= $F['documentdate'] ?></td>
                    <td><?= $F['journalnumber'] ?></td>
                    <td><?= $F['poliklinikname']  ?></td>
                    <td><?= $F['doktername']  ?></td>
                    <td><?php $awal = abs($F['price']);
                        $far = $awal + $F['embalase'];
                        $deni = ceil($far);
                        echo number_format($deni, 2, ",", ".") ?></td>
                    <?php $TotFAR[] = $deni;  ?>
                </tr>
            <?php endforeach; ?>
            <?php
            $check_TotFAR = isset($TotFAR) ? array_sum($TotFAR) : 0;
            $TotalFAR = $check_TotFAR;
            if ($TotalFAR > 0) { ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 class="card-title">TotalBiaya Farmasi :</h6>
                    </td>
                    <td><b><?php

                            echo number_format($TotalFAR, 2, ",", "."); ?></b>
                    </td>
                </tr>
            <?php } ?>
            <?php
            foreach ($BHP as $behape) :
            ?>
                <?php
                if ($behape['totalbhp'] > 0) { ?>
                    <tr>
                        <td><?= $behape['types'] ?></td>
                        <td><?= $behape['documentdate'] ?></td>
                        <td><?= $behape['journalnumber'] ?></td>
                        <td>BHP Penunjang : <?= $behape['name']  ?></td>
                        <td>Opt : <?= $behape['createdby'] ?></td>
                        <td><?= number_format($behape['totalbhp'], 2, ",", ".") ?></td>
                        <?php $TotBHP[] = $behape['totalbhp'];  ?>
                    </tr>
                <?php } ?>
            <?php endforeach; ?>
            <?php
            $check_TotBHP = isset($TotBHP) ? array_sum($TotBHP) : 0;
            $TotalBHP = $check_TotBHP;
            if ($TotalBHP > 0) { ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <h6 class="card-title">TotalBiaya BHP :</h6>
                    </td>
                    <td><b><?php

                            echo number_format($TotalBHP, 2, ",", "."); ?></b>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <h6 class="card-title">TotalBiaya Rawat Jalan :</h6>
                </td>
                <td><b><?php

                        $TOTALRANAP = $TotalPENUNJANG + $TotalOPERASI + $TotalGIZI + $TotalTNO + $TotalFAR + $TotalBHP + $TotalPem;
                        echo number_format($TOTALRANAP, 2, ",", "."); ?></b>
                </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <h6 class="card-title">TotalBiaya Seluruh :</h6>
                </td>
                <td><b><?php

                        $TOTAL = $TotalPENUNJANG + $TotalOPERASI + $TotalGIZI +  $TotalTNO + $TotalFAR + $TotalBHP + $TotalPem;
                        echo number_format($TOTAL, 2, ",", "."); ?></b>
                </td>
            </tr>
        </tbody>
    </table>


</div>
<hr>

</div>
<br>
<div class="text-right">
    <input type="hidden" id="idfverifikasi" name="idfverifikasi" class="form-control" value="<?= $idverifikasi; ?>">
    <input type="hidden" id="verifikasi" name="verifikasi" class="form-control" value="<?= $verifikasi; ?>">
    <input type="hidden" id="batalverifikasi" name="batalverifikasi" class="form-control" value="<?= $verifikasi; ?>">
    <input type="hidden" id="tanggalverifikasi" name="tanggalverifikasi" class="form-control" value="<?= date('Y-m-d G:i:s'); ?>" readonly>
    <input type="hidden" id="petugasverifikasi" name="petugasverifikasi" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
    <input type="hidden" id="referencenumber" name="referencenumber" class="form-control" value="<?= $journalnumber; ?>">
    <?php if ($klaim == 0) { ?>
        <button id="button" class="btn btn-danger btnverifikasi" type="submit" onclick="KlaimSelesai('<?= $idverifikasi ?>')"> <span class="mr-1"><i class="fas fa-toggle-on"></i></span> Selesai Klaim ?</button>
    <?php } ?>
    <?php if ($klaim == 1) { ?>
        <button id="button" class="btn btn-warning btnbatalverifikasi" type="submit" onclick="KlaimBatal('<?= $idverifikasi ?>')"> <span class="mr-1"><i class="fas fa-toggle-off"></i></span> Batal Klaim </button>
    <?php } ?>
    <button id="print" class="btn btn-success btnprintdetail" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print Detail Klaim</button>
    <button id="print" class="btn btn-info btnprintdetailrealcost" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print Detail Realcost</button>
    <button id="print" class="btn btn-warning btn-outline btn btnprintbukti" type="button"> <span><i class="fa fa-print"></i></span> Bukti Resep </button>
    <button id="print" class="btn btn-dark btn-outline btn btnprintbuktikronis" type="button"> <span><i class="fa fa-print"></i></span> Bukti Resep Kronis</button>
    <button id="print" class="btn btn-success btn-outline btn btnprintbuktinonkronis" type="button"> <span><i class="fa fa-print"></i></span> Bukti Resep Non Kronis</button>
</div>

<script src="<?= base_url(); ?>/js/jquery.slimscroll.js"></script>
<script src="<?= base_url(); ?>/js/custom.min.js"></script>
<script type="text/javascript">
    $('#slimtest4').slimScroll({
        color: '#00f',
        size: '10px',
        height: '1000px',
        railVisible: true,
        alwaysVisible: true
    });
</script>


<script>
    function KlaimSelesai(id) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah Yakin Rincian Pasien Ini Sudah Siap Posting Klaim ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('KlaimRawatJalan/KlaimSelesai'); ?>",
                    data: {
                        id: id,
                        petugasverifikasi: $('#petugasverifikasi').val(),
                        tanggalverifikasi: $('#tanggalverifikasi').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            }).then((result) => {
                                if (result.value) {
                                    dataresume();
                                }
                            });
                        }
                    }

                });


            }
        })

    }
</script>


<script>
    function KlaimBatal(id) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah Yakin Akan Membatalkan Status Klaim Rincian Ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('KlaimRawatJalan/KlaimBatal'); ?>",
                    data: {
                        id: id,
                        petugasverifikasi: $('#petugasverifikasi').val(),
                        tanggalverifikasi: $('#tanggalverifikasi').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            }).then((result) => {
                                if (result.value) {
                                    dataresume();
                                }
                            });
                        }
                    }

                });


            }
        })

    }
</script>

</div>



<script>
    var rupiah = document.getElementById('paymentamount');
    rupiah.addEventListener('keyup', function(e) {
        rupiah.value = formatRupiah(this.value);

    });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);


        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>


<script src="../assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script>
    $(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();
        $(".select3").select2();
        $('.selectpicker').selectpicker();
        //Bootstrap-TouchSpin
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        var vspinTrue = $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        }
        $("input[name='tch1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
        $("input[name='tch2']").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='tch3']").TouchSpin();
        $("input[name='tch3_22']").TouchSpin({
            initval: 40
        });
        $("input[name='tch5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });
        // For multiselect
        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
        $('#public-methods').multiSelect();
        $('#select-all').click(function() {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function() {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function() {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });
        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            //templateResult: formatRepo, // omitted for brevity, see the source of this page
            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $('#doktername').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('autocomplete/fill_dokter') ?>",
                'data': {
                    key: $('#doktername option:selected').data('id')
                },
                'success': function(response) {
                    //mengisi value input nama dan lainnya
                    let data = JSON.parse(response);
                    $('#doktername').val(data.name);
                    $('#dokter').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

    });
</script>


<script>
    $(document).ready(function() {
        $('.formvalidasibayar').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnvalidasi').attr('disable', 'disabled');
                    $('.btnvalidasi').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnvalidasi').removeAttr('disable');
                    $('.btnvalidasi').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.doktername) {
                            $('#doktername').addClass('form-control-danger');
                            $('.errordoktername').html(response.error.doktername);
                        } else {
                            $('#doktername').removeClass('form-control-danger');
                            $('.errordoktername').html('');
                        }

                        if (response.error.paymentamount) {
                            $('#paymentamount').addClass('form-control-danger');
                            $('.errorpaymentamount').html(response.error.paymentamount);
                        } else {
                            $('#paymentamount').removeClass('form-control-danger');
                            $('.errorpaymentamount').html('');
                        }

                        if (response.error.statuspasien) {
                            $('#statuspasien').addClass('form-control-danger');
                            $('.errorstatuspasien').html(response.error.statuspasien);
                        } else {
                            $('#statuspasien').removeClass('form-control-danger');
                            $('.errorstatuspasien').html('');
                        }



                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                dataresume();
                                $('#paymentamount').val(response.paymentamount);
                                $('#nominaldebet').val(response.nominaldebet);
                                $('#payersname').val(response.payersname);

                            }
                        });

                    }
                }


            });
            return false;
        });
    });
</script>



<script type="text/javascript">
    $(document).ready(function() {

        $("#rujuk").autocomplete({
            source: "<?php echo base_url('PelayananRanap/ajax_rujuk'); ?>",
            select: function(event, ui) {
                $('#name').val(ui.item.value);
                $('#code_rujuk').val(ui.item.code);
                $('#address_rujuk').val(ui.item.address);

            }
        });
    });

    $('#metodepembayaran').on('change', function() {
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('PendaftaranRanap/metode_pembayaran_kasir') ?>",
            data: {
                metodepembayaran: $(this).val()
            },
            success: function(response) {
                let data = JSON.parse(response);
                $('#daftarbank').empty();

                if (data[0] == null) {

                    $('#daftarbank').append("<option>-</option>");
                    $('#daftarbank').attr('disabled', 'disabled');
                    $('#referensibank').attr('disabled', 'disabled');
                    $('#nominaldebet').attr('disabled', 'disabled');
                } else {

                    data.forEach(appendRoomName);

                    function appendRoomName(item) {
                        $('#daftarbank').append("<option value='" + item.namabank + "' data-room='" + item.namabank + "'>" + item.namabank + "</option>");
                    }
                    $('#referensibank').removeAttr('disabled');
                    $('#daftarbank').removeAttr('disabled');
                    $('#nominaldebet').removeAttr('disabled');

                }

                $('#metodepembayaran').val($('#metodepembayaran option:selected').data('name'));

            }
        })
    });
</script>


<script>
    function signature(journalnumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRJ/SignatureKasir'); ?>",
            data: {
                journalnumber: journalnumber
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalsignature').modal('show');

                }
            }

        });


    }
</script>

<script>
    function cetakkwitansikasir(journalnumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRJ/cetakkwitansikasir'); ?>",
            data: {
                journalnumber: journalnumber
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalprintkwitansi').modal('show');

                }
            }

        });


    }
</script>

<script>
    function emailkwitansi(journalnumber) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirRJ/emailkwitansikasir'); ?>",
            data: {
                journalnumber: journalnumber
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Email Berhasil Dikirim',


                    })

                }
            }

        });


    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintdetail').on('click', function() {

            let id = $('#referencenumber').val();
            window.open("<?php echo base_url('KlaimRawatJalan/printdetailkwitansiKlaim') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=200, height=150");

        })
        $('.btnprintBP').on('click', function() {

            let id = $('#referencenumber').val();
            window.open("<?php echo base_url('KasirRJ/printbuktipembayaran') ?>?page=" + id, "_blank");

        })
        $('.btnprintdetailrealcost').on('click', function() {

            let id = $('#referencenumber').val();
            window.open("<?php echo base_url('KlaimRawatJalan/printdetailkwitansiVerifikasi') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=200, height=150");

        })
    });
</script>


<script src="<?= base_url(); ?>/assets/plugins/switchery/dist/switchery.min.js"></script>

<script>
    $(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2


    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintbukti').on('click', function() {
            let id = $('#referencenumber').val();
            window.open("<?php echo base_url('KlaimRawatJalan/printpenjualanKonvesional') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=700, height=700");
        })
        $('.btnprintbuktikronis').on('click', function() {
            let id = $('#referencenumber').val();
            window.open("<?php echo base_url('KlaimRawatJalan/printpenjualanKonvesionalKronis') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=700, height=700");
        })
        $('.btnprintbuktinonkronis').on('click', function() {
            let id = $('#referencenumber').val();
            window.open("<?php echo base_url('KlaimRawatJalan/printpenjualanKonvesionalNonKronis') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=700, height=700");
        })
    });
</script>