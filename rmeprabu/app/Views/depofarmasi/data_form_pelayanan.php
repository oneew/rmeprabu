<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<div class="table-responsive">
    <table id="dataradiologi" class="table color-table success-table">
        <thead>
            <tr>
                <th>#</th>
                <th>No</th>
                <th>R/</th>
                <th>Kode</th>
                <th>Uraian</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>No Batch</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Aturan</th>
                <th>Aturan Pakai</th>
                <th>Pagi</th>
                <th>Siang</th>
                <th>Sore</th>
                <th>Malam</th>
                <th>Set</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($DetailObat as $row) :
                $no++; ?>
                <tr>
                    <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm" onclick="hapusresep('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button></td>
                    <td><?= $no ?></td>
                    <td><?= $row['r']  ?></td>
                    <td><?= $row['code']  ?></td>
                    <td><?= $row['name']  ?></td>
                    <td><?= abs($row['qty'])  ?></td>
                    <td><?= $row['uom']  ?></td>
                    <td><?= $row['batchnumber']  ?></td>
                    <td><?= number_format($row['price'], 2, ",", ".");  ?></td>
                    <td><?= abs($row['subtotal']) ?></td>
                    <td><?= $row['signa1'] ?> x <?= $row['signa2'] ?> </td>
                    <td>
                        <select name="aturanpakai" id="aturanpakai" class="select2" style="width: 100%">
                            <option value="-">-</option>
                            <?php foreach ($aturanpakai as $ap) : ?>
                                <option value="<?= $ap['name']; ?>" <?php if ($ap['name'] == $row['eticket_aturan']) { ?> selected="selected" <?php } ?>><?= $ap['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <select name="carapakai" id="carapakai" class="select2" style="width: 100%">
                            <option value="-">-</option>
                            <?php foreach ($carapakai as $cara) : ?>
                                <option value="<?= $cara['name']; ?>" <?php if ($cara['name'] == $row['eticket_carapakai']) { ?> selected="selected" <?php } ?>><?= $cara['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <br>
                        <select name="carapetunjuk" id="carapetunjuk" class="select2" style="width: 100%">
                            <option value="-">-</option>
                            <?php foreach ($carapetunjuk as $capet) : ?>
                                <option value="<?= $capet['name']; ?>" <?php if ($capet['name'] == $row['eticket_petunjuk']) { ?> selected="selected" <?php } ?>><?= $capet['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <div class="switch">
                            <label>T
                                <input type="checkbox" value="1" name="pagi"><span class="lever"></span>Y</label>
                        </div>
                    </td>
                    <td>
                        <div class="switch">
                            <label>T
                                <input type="checkbox" value="1" name="siang"><span class="lever"></span>Y</label>
                        </div>
                    </td>
                    <td>
                        <div class="switch">
                            <label>T
                                <input type="checkbox" value="1" name="sore"><span class="lever"></span>Y</label>
                        </div>
                    </td>
                    <td>
                        <div class="switch">
                            <label>T
                                <input type="checkbox" value="1" name="malam"><span class="lever"></span>Y</label>
                        </div>
                    </td>
                    <td><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm" onclick="setpakai('<?= $row['id']; ?>')"> <i class="fas fa-pencil-alt"></i></button></td>
                    <?php $Total[] = $row['subtotal']; ?>
                </tr>

            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <?php $check_Total = isset($Total) ? array_sum($Total) : 0;
            $grandtotal = $check_Total;
            $totalbiaya = abs($grandtotal);
            ?>
            <tr>
                <td colspan="15" class="text-center">
                    <h4>Grand Total : Rp.<?= number_format($totalbiaya, 2, ",", "."); ?></h4>
                </td>
            </tr>
            <tr>
                <td colspan="15" class="text-center">
                    <button id="print" class="btn btn-info btnprint" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Bukti Resep</button>
                    <input type="hidden" id="nomorjournal" autocomplete="off" name="nomorjournal" class="form-control" value="<?= $kodejournal; ?>">
                </td>
            </tr>
            <tr>
                <td colspan="15" class="text-center">
                    <?php if ($validasilunas == "0.00") { ?>
                        <button id="validasi" class="btn btn-danger btn-outline btn btnvalidasi" type="button" onclick="Validasi('<?= $kodejournal ?>')"> <span><i class="fas fa-shekel-sign"></i></span> Validasi Lunas ?</button>
                    <?php } ?>
                    <?php if ($validasilunas == "1.00") { ?>
                        <button id="batalvalidasi" class="btn btn-warning btn-outline btn btnvalidasi" type="button" onclick="BatalValidasi('<?= $kodejournal ?>')"> <span><i class="fas fa-shekel-sign"></i></span> Batalkan Validasi Lunas ?</button>
                    <?php } ?>
                    <input type="hidden" id="validationby" name="validationby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                </td>
            </tr>
            <tr>
                <td colspan="15" class="text-center">
                    <?php if ($luarpaketinacbg == "0") { ?>
                        <button id="validasipaket" class="btn btn-danger btn-outline btn btnvalidasiLuarPaket" type="button" onclick="ValidasiLuarPaket('<?= $kodejournal ?>')"> <span><i class="fas fa-shekel-sign"></i></span> Validasi Luar Paket Ina Cbg ?</button>
                    <?php } ?>
                    <?php if ($luarpaketinacbg == "1") { ?>
                        <button id="batalvalidasipaket" class="btn btn-warning btn-outline btn btnvalidasiLuarPaket" type="button" onclick="BatalValidasiLuarPaket('<?= $kodejournal ?>')"> <span><i class="fas fa-shekel-sign"></i></span> Batalkan Validasi Luar Paket Ina Cbg ?</button>
                    <?php } ?>
                </td>
            </tr>
        </tfoot>
    </table>
</div>


<script>
    function hapusresep(id) {

        Swal.fire({
            title: 'Hapus',
            text: "Apakah anda yakin akan menghapus data ini ?",
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
                    url: "<?php echo base_url('FarmasiPelayananRanap/hapus_detail_resep'); ?>",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            });
                            detail();

                        }
                    }

                });


            }
        })

    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprint').on('click', function() {

            let id = $('#nomorjournal').val();
            window.open("<?php echo base_url('FarmasiPelayananRanap/printpenjualan') ?>?page=" + id, "_blank");

        })
    });
</script>


<script>
    function Validasi(kodejournal) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan melakukan Validasi Lunas Pada Transaksi ini ?",
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
                    url: "<?php echo base_url('FarmasiPelayananRanap/ValidasiLunas'); ?>",
                    data: {
                        kodejournal: kodejournal,
                        validationby: $('#validationby').val()
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
                                    detail();

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
    function BatalValidasi(kodejournal) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan melakukan Validasi Lunas Pada Transaksi ini ?",
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
                    url: "<?php echo base_url('FarmasiPelayananRanap/BatalValidasiLunas'); ?>",
                    data: {
                        kodejournal: kodejournal,
                        validationby: $('#validationby').val()
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
                                    detail();

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
    function ValidasiLuarPaket(kodejournal) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan melakukan Validasi Luar Paket Ina CBG Pada Transaksi ini ?",
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
                    url: "<?php echo base_url('FarmasiPelayananRanap/ValidasiLuarPaket'); ?>",
                    data: {
                        kodejournal: kodejournal,
                        validationby: $('#validationby').val()
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
                                    detail();

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
    function BatalValidasiLuarPaket(kodejournal) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan melakukan Membatalkan Validasi Luar Paket Ina CBG Pada Transaksi ini ?",
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
                    url: "<?php echo base_url('FarmasiPelayananRanap/BatalValidasiLuarPaket'); ?>",
                    data: {
                        kodejournal: kodejournal,
                        validationby: $('#validationby').val()
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
                                    detail();

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
    $(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();

        $('.selectpicker').selectpicker();



        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // 
                        page: params.page
                    };
                },
                processResults: function(data, params) {

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
            },
            minimumInputLength: 1,

        });
    });
</script>

<script>
    function setpakai(id) {

        Swal.fire({
            title: 'Aturan Pakai',
            text: "Apakah Aturan Pakai Sudah Benar ?",
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
                    url: "<?php echo base_url('FarmasiPelayananRanap/Update_cara_pakai'); ?>",
                    data: {
                        id: id,
                        aturanpakai: $('#aturanpakai').val(),
                        carapakai: $('#carapakai').val(),
                        carapetunjuk: $('#carapetunjuk').val(),
                        pagi: $('#pagi').val(),
                        siang: $('#siang').val(),
                        sore: $('#sore').val(),
                        malam: $('#malam').val(),

                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            });
                            detail();

                        }
                    }

                });


            }
        })

    }
</script>