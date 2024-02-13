    <div class="table-responsive">
        <font size="3">
            <table id="pemeriksaan" class="table color-table success-table text-dark">
                <thead>
                    <!-- <tr>
                <th colspan="6">
                    <hr style="margin-bottom: 2; margin-top: 2">
                </th>
            </tr> -->
                    <tr>
                        <th style="text-align: left; width: 10%">#</th>
                        <th style="text-align: left; width: 10%">Tanggal</th>
                        <th style="text-align: left; width: 25%">Keterangan</th>
                        <th style="text-align: left; width: 27%">Dokter</th>
                        <th style="text-align: right; width: 13%">Harga</th>
                        <!-- <th style="text-align: right; width: 5%">Qty</th> -->
                        <th style="text-align: right; width: 15%">Total</th>
                    </tr>
                    <!-- <tr>
                <th colspan="6">
                    <hr style="margin-bottom: 2; margin-top: 2">
                </th>
            </tr> -->
                </thead>

                <tbody>

                    <!-- menghitung jumlah pemeriksaan -->
                    <?php
                    $no = 1;
                    foreach ($PEMERIKSAAN as $row) :
                    ?>
                        <tr>
                            <td>
                                <?php
                                $attr_pem = $row['verifikasi'] == 1 ? 'checked' : '';
                                ?>
                                <div class="switch">
                                    <?= $no++; ?>
                                    <input type="checkbox" <?= $attr_pem ?> class="js-switch" data-color="#2df6b0" data-size="small" />
                                </div>
                            </td>
                            <td style="text-align: left;"><?= date('d-m-Y', strtotime($row['documentdate'])) ?></td>
                            <td style="text-align: left;"><?= $row['description'] ?> [<?= number_format(1, 2, ",", ".") ?>]</td>
                            <td style="text-align: left;"><?= $row['doktername'] ?></td>
                            <td style="text-align: right;"><?= number_format($row['price'], 2, ",", ".")  ?></td>
                            <td style="text-align: right;"><?= number_format($row['price'], 2, ",", ".") ?></td>
                            <?php $TotPemeriksaan[] = $row['price'];  ?>

                        </tr>
                    <?php endforeach; ?>
                    <?php
                    $check_TotPem = isset($TotPemeriksaan) ? array_sum($TotPemeriksaan) : 0;
                    $TotalPemeriksaan = $check_TotPem; ?>

                    <?php
                    $no = 1;
                    if ($TotalPemeriksaan > 0) { ?>
                        <!-- <tr>
                    <td></td>
                    <td></td>
                    <td></td>

                    <td style="text-align: right;" colspan="3">
                        <hr style="margin-bottom: 2; margin-top: 2">
                    </td>
                </tr> -->

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td style="text-align: right;" colspan="2"><b>Sub Total Pemeriksaan</b></td>
                            <td style="text-align: right;">
                                <b>
                                    <?= number_format($TotalPemeriksaan, 2, ",", "."); ?>
                                </b>
                            </td>
                        </tr>

                    <?php } ?>

                    <!-- menghitung tindakan non operatif -->
                    <?php
                    foreach ($TNO as $rowTNO) :
                    ?>
                        <tr>
                            <td>
                                <?php
                                $attr_tno = $row['verifikasi'] == 1 ? 'checked' : '';
                                ?>
                                <div class="switch">
                                    <?= $no++; ?>
                                    <input type="checkbox" <?= $attr_tno ?> class="js-switch" data-color="#2df6b0" data-size="small" />
                                </div>
                            </td>
                            <td><?= date('d-m-Y', strtotime($rowTNO['documentdate'])) ?></td>
                            <td>
                                <?= $rowTNO['name'] ?>[<?= $rowTNO['qty'] ?>]
                            </td>
                            <td><?= $rowTNO['doktername'] ?></td>
                            <td style="text-align: right;"><?= number_format($rowTNO['price'], 2, ",", ".") ?></td>
                            <td style="text-align: right;"><?= number_format($rowTNO['subtotal'], 2, ",", ".") ?></td>
                            <?php $TotTNO[] = $rowTNO['subtotal'];  ?>

                        </tr>
                    <?php endforeach; ?>
                    <?php
                    $check_TotTNO = isset($TotTNO) ? array_sum($TotTNO) : 0;
                    $TotalTNO = $check_TotTNO;
                    ?>

                    <?php
                    $no = 1;
                    if ($TotalTNO > 0) { ?>
                        <!-- <tr>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td style="text-align: right;" colspan="3">
                            <hr style="margin-bottom: 2; margin-top: 2">
                        </td>
                    </tr> -->

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td style="text-align: right;" colspan="2"><b>Sub Total Tindakan Non Operatig</b></td>
                            <td style="text-align: right;">
                                <b>
                                    <?= number_format($TotalTNO, 2, ",", "."); ?>
                                </b>
                            </td>
                        </tr>

                    <?php } ?>

                    <!-- menghitung penunjang -->
                    <?php
                    foreach ($PENUNJANG as $P) :


                    ?>
                        <tr>
                            <?php if ($P['groups'] == "RAD") {
                                $deskripsi = 'Radiologi';
                            }
                            if ($P['groups'] == "LPK") {
                                $deskripsi = 'Lab Patologi Klinik';
                            }
                            if ($P['groups'] == "LPA") {
                                $deskripsi = 'Lab Patologi Anatomi';
                            }
                            if ($P['groups'] == "BD") {
                                $deskripsi = 'Bank Darah';
                            }
                            ?>
                            <td>
                                <?php
                                $attr_pnj = $P['verifikasi'] == 1 ? 'checked' : '';
                                ?>
                                <div class="switch">
                                    <?= $no++; ?>
                                    <input type="checkbox" <?= $attr_pnj ?> class="js-switch" data-color="#2df6b0" data-size="small" />
                                </div>
                            </td>
                            <td><?= date('d-m-Y', strtotime($P['documentdate'])) ?></td>
                            <td><?= $P['types'] ?> | <?= $P['name']; ?> [<?= number_format($P['qty'], 2, ",", ".") ?>]</td>
                            <td><?= $P['doktername'] ?></td>
                            <td style="text-align: right;"><?= number_format($P['price'], 2, ",", ".") ?></td>
                            <td style="text-align: right;"><?= number_format($P['subtotal'], 2, ",", ".") ?></td>
                            <?php $TotPENUNJANG[] = $P['subtotal'];  ?>
                        </tr>
                    <?php endforeach; ?>
                    <?php
                    $check_TotPenunjang = isset($TotPENUNJANG) ? array_sum($TotPENUNJANG) : 0;
                    $TotalPenunjang = $check_TotPenunjang;
                    ?>

                    <?php
                    $no = 1;
                    if ($TotalPenunjang > 0) { ?>
                        <!-- <tr>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td style="text-align: right;" colspan="3">
                            <hr style="margin-bottom: 2; margin-top: 2">
                        </td>
                    </tr> -->

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td style="text-align: right;" colspan="2"><b>Sub Total Penunjang</b></td>
                            <td style="text-align: right;">
                                <b>
                                    <?= number_format($TotalPenunjang, 2, ",", "."); ?>
                                </b>
                            </td>
                        </tr>

                    <?php } ?>

                    <!-- Menghitung Farmasi -->
                    <?php
                    foreach ($FARMASI as $F) :
                    ?>
                        <tr>
                            <td>
                                <?php
                                $attr_far = abs($F['price']) != 1 ? 'checked' : '';
                                ?>
                                <div class="switch">
                                    <?= $no++; ?>
                                    <input type="checkbox" <?= $attr_far ?> class="js-switch" data-color="#2df6b0" data-size="small" />
                                </div>
                            </td>
                            <td><?= date('d-m-Y', strtotime($F['documentdate'])) ?></td>
                            <td><?= $F['name'] ?> [<?= number_format(abs($F['qty']), 2, ",", ".") ?>]</td>
                            <td><?= $F['doktername']  ?></td>
                            <td style="text-align: right;"><?= number_format(abs($F['price']), 2, ",", ".") ?></td>
                            <td style="text-align: right;"><?php $awal = abs($F['subtotal']);
                                                            $far = $awal + $F['embalase'];
                                                            $deni = ceil($far);
                                                            echo number_format($deni, 2, ",", ".") ?></td>
                            <?php $TotFAR[] = $deni;  ?>
                        </tr>
                    <?php endforeach; ?>

                    <?php
                    $check_TotFar = isset($TotFAR) ? array_sum($TotFAR) : 0;
                    $TotalFarmasi = $check_TotFar;
                    ?>
                    <?php
                    $no = 1;
                    if ($TotalFarmasi > 0) { ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td style="text-align: right;" colspan="2"><b>Sub Total Farmasi</b></td>
                            <td style="text-align: right;">
                                <b>
                                    <?= number_format($TotalFarmasi, 2, ",", "."); ?>
                                </b>
                            </td>
                        </tr>

                    <?php } ?>

                    <!-- menghitung BHP -->
                    <?php
                    foreach ($BHP as $behape) :
                    ?>
                        <?php
                        if ($behape['totalbhp'] > 0) { ?>
                            <tr>

                                <td>
                                    <?php
                                    $attr_bhp = $behape['verifikasi'] == 1 ? 'checked' : '';
                                    ?>
                                    <div class="switch">
                                        <?= $no++; ?>
                                        <input type="checkbox" <?= $attr_bhp ?> class="js-switch" data-color="#2df6b0" data-size="small" />
                                    </div>
                                </td>
                                <td><?= $behape['documentdate'] ?></td>
                                <td>BHP <?= $behape['types'] ?> | <?= $behape['name'] ?> [<?= number_format($behape['qty'], 2, ",", ".") ?>]</td>
                                <td><?= $behape['doktername'] ?></td>
                                <td><?= number_format($behape['totalbhp'], 2, ",", ".") ?></td>
                                <td><?= number_format(($behape['totalbhp'] * $behape['qty']), 2, ",", ".")  ?></td>
                                <?php $TotBHP[] = $behape['totalbhp'];  ?>
                            </tr>
                        <?php } ?>
                    <?php endforeach; ?>

                    <?php
                    $check_TotBHP = isset($TotBHP) ? array_sum($TotBHP) : 0;
                    $TotalBHP = $check_TotBHP;
                    ?>
                    <?php
                    $no = 1;
                    if ($TotalBHP > 0) { ?>
                        <!-- <tr>
                        <td></td>
                        <td></td>
                        <td></td>

                        <td style="text-align: right;" colspan="3">
                            <hr style="margin-bottom: 2; margin-top: 2">
                        </td>
                    </tr> -->

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td style="text-align: right;" colspan="2"><b>Sub Total Penunjang</b></td>
                            <td style="text-align: right;">
                                <b>
                                    <?= number_format($TotalBHP, 2, ",", "."); ?>
                                </b>
                            </td>
                        </tr>

                    <?php } ?>

                    <!-- menghitung operasi -->
                    <?php
                    foreach ($OPERASI as $OP) :
                    ?>
                        <tr>
                            <td>
                                <?php
                                $attr_op = $OP['verifikasi'] == 1 ? 'checked' : '';
                                ?>
                                <div class="switch">
                                    <?= $no++; ?>
                                    <input type="checkbox" <?= $attr_op ?> class="js-switch" data-color="#2df6b0" data-size="small" />
                                </div>
                            </td>
                            <td><?= date('d-m-Y', strtotime($OP['documentdate'])) ?></td>
                            <td><?= $OP['name'] ?> [<?= number_format($OP['qty'], 2, ",", "."); ?></td>
                            <td><?= $OP['doktername'] ?></td>
                            <td style="text-align: right;"><?= number_format($OP['price'], 2, ",", ".")  ?></td>
                            <td style="text-align: right;"><?= number_format($OP['totaltarif'], 2, ",", ".") ?></td>
                            <?php $TotOPERASI[] = $OP['totaltarif'];  ?>
                        </tr>
                    <?php endforeach; ?>

                    <?php
                    $check_TotOperasi = isset($TotOPERASI) ? array_sum($TotOPERASI) : 0;
                    $TotalOperasi = $check_TotOperasi;
                    ?>
                    <?php
                    $no = 1;
                    if ($TotalOperasi > 0) { ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td style="text-align: right;" colspan="2"><b>Sub Total Operasi</b></td>
                            <td style="text-align: right;">
                                <b>
                                    <?= number_format($TotalOperasi, 2, ",", "."); ?>
                                </b>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>

                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="3">
                            <br style="margin-bottom: 2; margin-top: 10">
                        </td>
                    </tr>

                    <!-- menghitung total biaya dan total bayar -->
                    <?php
                    $totalbiaya = abs($TotalPemeriksaan) + abs($TotalTNO) +
                        abs($TotalPenunjang) + abs($TotalFarmasi) + abs($TotalBHP) + abs($TotalOperasi);
                    $totalbayarawal = $TotalKasirApotek_RJ + $TotalKasirPnj_RJ + $TotalKasir_RJ + $TotalKasir_Tindakan;
                    ?>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="text-align: right;"><b>TOTAL BIAYA</b></td>
                        <td style="text-align: right;">
                            <b><?= number_format($totalbiaya, 2, ",", ".") ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="text-align: right;">DEFOSIT</td>
                        <td style="text-align: right;">
                            <?= number_format($totalbayarawal, 2, ",", ".") ?>
                        </td>
                    </tr>

                    <?php

                    // menghitung jumlah total biaya tagihan
                    $totaltagihanbiaya = $totalbiaya - $totalbayarawal;
                    ?>

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="text-align: right;"><b>TOTAL TAGIHAN BIAYA</b></td>
                        <td style="text-align: right;">
                            <b><?= number_format($totaltagihanbiaya, 2, ",", ".") ?></b>
                        </td>
                    </tr>

                </tfoot>
            </table>
        </font>
    </div>


    <br>
    <div class="text-right">
        <input type="hidden" id="idfverifikasi" name="idfverifikasi" class="form-control" value="<?= $idverifikasi; ?>">
        <input type="hidden" id="verifikasi" name="verifikasi" class="form-control" value="<?= $verifikasi; ?>">
        <input type="hidden" id="batalverifikasi" name="batalverifikasi" class="form-control" value="<?= $verifikasi; ?>">
        <input type="hidden" id="tanggalverifikasi" name="tanggalverifikasi" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
        <input type="hidden" id="petugasverifikasi" name="petugasverifikasi" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
        <?php if ($verifikasi == 0) { ?>
            <button id="button" class="btn btn-danger btnverifikasi" type="submit" onclick="VerifikasiSelesai('<?= $idverifikasi ?>')"> <span class="mr-1"><i class="fas fa-toggle-on"></i></span> Selesai Verifikasi ?</button>
        <?php } ?>
        <?php if ($verifikasi == 1) { ?>
            <button id="button" class="btn btn-warning btnbatalverifikasi" type="submit" onclick="VerifikasiBatal('<?= $idverifikasi ?>')"> <span class="mr-1"><i class="fas fa-toggle-off"></i></span> Batal Verifikasi </button>
        <?php } ?>
        <button id="print" class="btn btn-success btnprintdetail" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print Detail</button>
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
        function VerifikasiSelesai(id) {
            Swal.fire({
                title: 'Batal',
                text: "Apakah Yakin Rincian Pasien Ini Sudah Selesai Anda verifikasi ?",
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
                        url: "<?php echo base_url('PelayananRawatJalan/VerifikasiSelesai'); ?>",
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
        function VerifikasiBatal(id) {
            Swal.fire({
                title: 'Batal',
                text: "Apakah Yakin Akan Membatalkan Status Verifikasi Rincian Ini ?",
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
                        url: "<?php echo base_url('PelayananRawatJalan/VerifikasiBatal'); ?>",
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
                // window.open("?php echo base_url('KasirIGD/printdetailkwitansiVerifikasi') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=200, height=150");
                window.open("<?php echo base_url('KasirIGD/printdetailkwitansiVerifikasi') ?>?page=" + id, "_blank");

            })
            $('.btnprintBP').on('click', function() {

                let id = $('#referencenumber').val();
                window.open("<?php echo base_url('KasirRJ/printbuktipembayaran') ?>?page=" + id, "_blank");

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