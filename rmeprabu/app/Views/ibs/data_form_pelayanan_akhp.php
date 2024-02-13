<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<div class="table-responsive">
    <table id="dataresumeakhp" class="tablesaw table-bordered table-hover table no-wrap" width="100%">
        <thead class="text-white bg-success">
            <tr>
                <th>#</th>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kode</th>
                <th>Jumlah</th>
                <th>Batch</th>
                <th>Harga</th>
                <th>Total</th>


            </tr>
        </thead>
        <tbody>
            <?php $no = 0;
            foreach ($DetailObat as $row) :
                $no++; ?>
                <tr>
                    <td>
                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-danger btn-sm" onclick="hapusresep('<?= $row['id']; ?>')"> <i class="fa fa-trash"></i></button>
                    </td>

                    <td><?= $no ?></td>
                    <td><?= $row['documentdate']  ?></td>
                    <td>[<?= $row['code']  ?>] <b><?= $row['name']  ?></b>
                        <br><?= $row['uom']  ?> # <b><?= $row['locationcode']; ?></b>
                    </td>
                    <td><?= ABS($row['qtypaket']) ?></td>
                    <td><?= $row['batchnumber']  ?></td>
                    <td><?= number_format($row['price'], 2, ",", ".");  ?></td>
                    <td><?= abs($row['subtotal']) ?></td>


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
                <td colspan="11" class="text-center">
                    <h4>Grand Total : Rp.<?= number_format($totalbiaya, 2, ",", "."); ?></h4>
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
            window.open("<?php echo base_url('FarmasiPelayananRajal/printpenjualan') ?>?page=" + id, "_blank");
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
                        malam: $('#malam').val()

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
        $('.btnprintbukti').on('click', function() {
            let id = $('#nomorjournal').val();
            window.open("<?php echo base_url('FarmasiPelayananRajal/printpenjualanKonvesional') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=700, height=700");
        })
        $('.btnprintbuktikronis').on('click', function() {
            let id = $('#nomorjournal').val();
            window.open("<?php echo base_url('FarmasiPelayananRajal/printpenjualanKonvesionalKronis') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=700, height=700");
        })
        $('.btnprintbuktinonkronis').on('click', function() {
            let id = $('#nomorjournal').val();
            window.open("<?php echo base_url('FarmasiPelayananRajal/printpenjualanKonvesionalNonKronis') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=700, height=700");
        })
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprintetiket').on('click', function() {
            let id = $(this).data('id');
            window.open("<?php echo base_url('FarmasiPelayananRajal/printetiket') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=500, height=400");
        })
    });
</script>


<script>
    function Etiket(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('FarmasiPelayananRajal/Etiket'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalsetetiket').modal('show');

                }
            }

        });
    }
</script>



<script>
    function UpdateAntrean(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('WsAntrean/UpdateTaskIDFarmasi'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.suksesmodalsep) {
                    $('.viewmodal').html(response.suksesmodalsep).show();
                    $('#modaltaskidrajal').modal();
                }
            }
        });
    }

    function TaskID(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('WsAntrean/TaskIDFarmasi'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                Swal.fire({
                    html: 'Pesan: ' + response.pesan,
                    icon: 'success',
                    timer: 5000
                });
            }
        });
    }
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprinteticketsemua').on('click', function() {
            let id = $('#nomorjournal').val();
            window.open("<?php echo base_url('FarmasiPelayananRajal/printetiketSemua') ?>?page=" + id, "_blank", "toolbar=no, scrollbars=yes, resizable=yes, top=100, left=100, width=500, height=400");
        })
    });
</script>


<script>
    $(document).ready(function() {
        $('#dataresumeakhp').DataTable({
            responsive: true,
            paging: false,
            scrollX: true,
            scrollY: "50vh"
        });
    });
</script>