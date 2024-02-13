<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />


<div id="modaladdobat" class="modal fade in" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Tambah Data Obat</h4>
            </div>

            <?= form_open('MasterObat/simpandata', ['class' => 'formperawat']); ?>
            <?= csrf_field(); ?>

            <div class="modal-body">
                <from class="form-horizontal form-material" id="form-filter" method="post">
                    <div class="form-body">
                        <div class="row pt-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Uraian</label>
                                    <input type="text" id="name" name="name" class="form-control" required onkeyup="this.value = this.value.toUpperCase()">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Keterangan</label>
                                    <input type="text" id="memo" name="memo" class="form-control" onkeyup="this.value = this.value.toUpperCase()">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Produksi</label>
                                    <select name="production" id="production" class="select2" style="width: 100%">
                                        <?php foreach ($production as $kl) : ?>
                                            <option data-id="<?= $kl['name']; ?>" class="select-smf"><?php echo $kl['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!--/span-->

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Isi Kemasan/Box</label>
                                    <input type="text" id="volume" value="1" name="volume" class="form-control" required onkeyup="this.value = this.value.toUpperCase()" onkeypress="return hanyaAngka(event)">
                                    <input type="hidden" id="fn" name="fn" class="form-control" value="NONE" onkeyup="this.value = this.value.toUpperCase()">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Satuan</label>
                                    <select name="uom" id="uom" class="select2" style="width: 100%">
                                        <?php foreach ($satuan as $satuan) : ?>
                                            <option data-id="<?= $satuan['name']; ?>" class="select-smf"><?php echo $satuan['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="row pt-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Pabrik</label>
                                    <select name="manufacturename" id="manufacturename" class="select2" style="width: 100%">
                                        <?php foreach ($pabrik as $pb) : ?>
                                            <option data-id="<?= $pb['id']; ?>" class="select-smf"><?php echo $pb['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" id="manufacturecode" name="manufacturecode" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">On Label</label>
                                    <input type="text" id="onlabel" name="onlabel" class="form-control" onkeyup="this.value = this.value.toUpperCase()">

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Off Label</label>
                                    <input type="text" id="offlabel" name="offlabel" class="form-control" onkeyup="this.value = this.value.toUpperCase()">

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Nama Dagang</label>
                                    <input type="text" id="tradename" name="tradename" class="form-control">

                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Nama Original</label>
                                    <input type="text" id="originalname" name="originalname" class="form-control">
                                    <input type="hidden" id="types" name="types" class="form-control" value="OBAT">
                                    <input type="hidden" id="regimen" name="regimen" class="form-control">
                                    <input type="hidden" id="indication" name="indication" class="form-control">
                                    <input type="hidden" id="usualdoze" name="usualdoze" class="form-control">
                                    <input type="hidden" id="pf_start" name="pf_start" class="form-control">
                                    <input type="hidden" id="pf_work" name="pf_work" class="form-control">
                                    <input type="hidden" id="pf_time" name="pf_time" class="form-control">
                                    <input type="hidden" id="off_label_used" name="off_label_used" class="form-control">
                                    <input type="hidden" id="drugefek" name="drugefek" class="form-control">
                                    <input type="hidden" id="foodinteraction" name="foodinteraction" class="form-control">
                                    <input type="hidden" id="createddate" name="createddate" class="form-control" value="<?= date('Y-m-d H:i:s'); ?>" readonly>
                                    <input type="hidden" id="createdby" name="createdby" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                                    <input type="hidden" id="stockupdate" name="stockupdate" class="form-control" value="LOKAL">
                                    <input type="hidden" id="locationcode" name="locationcode" class="form-control" value="NONE">
                                    <input type="hidden" id="locationname" name="locationname" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row pt-1">
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Margin</label>
                                    <input type="text" id="margin" name="margin" value="1.33" class="form-control" onchange="total()" style="text-align: right;" onkeypress="return hanyaAngka(event)">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Harga beli</label>
                                    <input type="text" id="purchaseprice" name="purchaseprice" class="form-control" onchange="total()" style="text-align: right;" onkeypress="return hanyaAngka(event)">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">HNA + Ppn 11%</label>
                                    <input type="text" id="taxprice" name="taxprice" class="form-control" style="text-align: right;" onkeypress="return hanyaAngka(event)" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Harga Jual</label>
                                    <input type="text" id="salesprice" name="salesprice" class="form-control" style="text-align: right;" onkeypress="return hanyaAngka(event)" readonly>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label class="control-label">Max Stok</label>
                                    <input type="text" id="maxstock" name="maxstock" class="form-control" value="0" onkeypress="return hanyaAngka(event)">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Min Stok</label>
                                    <input type="text" id="minstock" name="minstock" class="form-control" value="0" onkeypress="return hanyaAngka(event)">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Eticket</label>
                                    <select name="eticket" id="eticket" class="select2" style="width: 100%">
                                        <?php foreach ($eticket as $etc) : ?>
                                            <option data-id="<?= $etc['id']; ?>" class="select-smf"><?php echo $etc['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="row pt-1">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Kategori</label>
                                    <select name="category" id="category" class="select2" style="width: 100%">
                                        <?php foreach ($kategori as $p) : ?>
                                            <option data-id="<?= $p['id']; ?>" class="select-smf"><?php echo $p['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Jenis</label>
                                    <select name="groups" id="groups" class="select2" style="width: 100%">
                                        <?php foreach ($jenis as $l) : ?>
                                            <option data-id="<?= $l['id']; ?>" class="select-smf"><?php echo $l['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Komposisi</label>
                                    <input type="text" id="composition" name="composition" class="form-control" onkeyup="this.value = this.value.toUpperCase()">
                                </div>
                            </div>
                        </div>
                        <div class="row pt-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Level Sakit</label>
                                    <select name="sicklevel" id="sicklevel" class="select2" style="width: 100%">
                                        <?php foreach ($sicklevel as $sl) : ?>
                                            <option data-id="<?= $sl['id']; ?>" class="select-smf"><?php echo $sl['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Resiko Pada Ibu Hamil</label>
                                    <select name="pregnantriskname" id="pregnantriskname" class="select2" style="width: 100%">
                                        <option>Pilih Resiko</option>
                                        <?php foreach ($pregnan as $pre) : ?>
                                            <option data-id="<?= $pre['id']; ?>" class="select-smf"><?php echo $pre['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" id="pregnantriskcode" name="pregnantriskcode" class="form-control" onkeyup="this.value = this.value.toUpperCase()">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Obat Terapi</label>
                                    <select name="classteraphyname" id="classteraphyname" class="select2" style="width: 100%">
                                        <option>Pilih Kelas terapi</option>
                                        <?php foreach ($kelasterapi as $ter) : ?>
                                            <option data-id="<?= $ter['id']; ?>" class="select-smf"><?php echo $ter['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                    <input type="hidden" id="classteraphycode" name="classteraphycode" class="form-control">

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Obat Sub Terapi</label>
                                    <select name="subclassteraphyname" id="subclassteraphyname" class="select2" style="width: 100%">
                                        <option>Pilih Sub Kelas terapi</option>
                                        <?php foreach ($kelasterapi as $ter) : ?>
                                            <option data-id="<?= $ter['id']; ?>" class="select-smf"><?php echo $ter['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" id="subclassteraphycode" name="subclassteraphycode" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row pt-1">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Aturan Sebelum Makan</label>
                                    <select name="ac" id="ac" class="select2" style="width: 100%">
                                        <?php foreach ($sebelummakan as $sblm) : ?>
                                            <option data-id="<?= $sblm['id']; ?>" class="select-smf"><?php echo $sblm['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Aturan Ketika Makan</label>
                                    <select name="dc" id="dc" class="select2" style="width: 100%">
                                        <?php foreach ($bersamamakan as $mkn) : ?>
                                            <option data-id="<?= $mkn['id']; ?>" class="select-smf"><?php echo $mkn['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Aturan Sesudah Makan</label>
                                    <select name="pc" id="pc" class="select2" style="width: 100%">
                                        <?php foreach ($sesudahmakan as $smkn) : ?>
                                            <option data-id="<?= $smkn['id']; ?>" class="select-smf"><?php echo $smkn['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Efek Hati</label>
                                    <input type="text" id="heartindication" name="heartindication" class="form-control" onkeyup="this.value = this.value.toUpperCase()">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Keterangan</label>
                                    <select name="keterangan" id="keterangan" class="select2" style="width: 100%">
                                        <option value="-">-</option>
                                        <option value="BARANG APBD">BARANG APBD</option>
                                        <option value="BARANG BLUD">BARANG BLUD</option>
                                        <option value="BARANG DONASI">DONASI</option>
                                        <option value="BARANG HIBAH">BARANG HIBAH</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Sumber Barang</label>
                                    <input type="text" id="sumber" name="sumber" class="form-control" onkeyup="this.value = this.value.toUpperCase()">
                                </div>
                            </div>

                        </div>
                    </div>
                </from>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-check"></i> Simpan Data</button>
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal"> <i class="fa fa-home"></i> Kembali</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<script>
    $(document).ready(function() {
        $('.formperawat').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.ibsdoktername) {
                            $('#name').addClass('form-control-danger');
                            $('.errorname').html(response.error.name);
                        } else {
                            $('#name').removeClass('form-control-danger');
                            $('.errorname').html('');
                        }


                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,

                        }).then((result) => {
                            if (result.value) {
                                $('#modaladdobat').modal('hide');
                                dataobat();

                            }
                        });

                    }
                }


            });
            return false;
        });
    });
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
        $('#manufacturename').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_pabrik') ?>",
                'data': {
                    key: $('#manufacturename option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#manufacturename').val(data.name);
                    $('#manufacturecode').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

        $('#locationame').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_lokasi') ?>",
                'data': {
                    key: $('#locationame option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#locationame').val(data.name);
                    $('#locationcode').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

        $('#pregnantriskname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_pregnan') ?>",
                'data': {
                    key: $('#pregnantriskname option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#pregnantriskname').val(data.name);
                    $('#pregnantriskcode').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

        $('#classteraphyname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_kelasterapi') ?>",
                'data': {
                    key: $('#classteraphyname option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#classteraphyname').val(data.name);
                    $('#classteraphycode').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

        $('#subclassteraphyname').on('change', function() {
            $.ajax({
                'type': "POST",

                'url': "<?php echo base_url('Autocomplete/fill_subkelasterapi') ?>",
                'data': {
                    key: $('#subclassteraphyname option:selected').data('id')
                },
                'success': function(response) {

                    let data = JSON.parse(response);
                    $('#subclassteraphyname').val(data.name);
                    $('#subclassteraphycode').val(data.code);

                    $('#autocomplete-dokter').html('');
                }
            })
        })

    });
</script>

<script type="text/javascript">
    function total() {
        var hargabeli = document.getElementById('purchaseprice').value;
        var margin = document.getElementById('margin').value;
        var pajak = parseInt(hargabeli) * (11 / 100);

        var hna_pajak = pajak + parseInt(hargabeli);
        //var hja = hna_pajak * (33 / 100);

        //var hja = hna_pajak - ((hna_pajak / margin) * 100);
        var hja = hna_pajak * margin;
        // var total_hja = hna_pajak + hja;
        var total_hja = hja;

        document.getElementById('taxprice').value = hna_pajak;
        document.getElementById('salesprice').value = total_hja;

        document.getElementById('taxprice').value = hna_pajak;
        document.getElementById('salesprice').value = total_hja;
    }
</script>

<script>
    function hanyaAngka(event) {
        var angka = (event.which) ? event.which : event.keyCode
        if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
            return false;
        return true;
    }
</script>