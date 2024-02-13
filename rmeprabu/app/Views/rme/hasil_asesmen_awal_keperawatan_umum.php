<link rel="stylesheet" href="<?= base_url('assets/plugins/html5-editor/bootstrap-wysihtml5.css'); ?>" />
<div class="col-lg-12 col-md-12 px-0">
    <div class="modal-body px-0">
        <div class="form-body">
            <form action="<?= base_url('PelayananRawatJalanRME/simpanAsesmenPerawat'); ?>" method="POST" class="formasesmen">
                <?= csrf_field(); ?>
                <?php $no = 0;
                foreach ($tampilasesmen as $row) :
                    $no++;
                    $psikologisTak = $row['psikologisTak'] == 1 ? 'checked' : 0;
                    $psikologisTakut = $row['psikologisTakut'] == 1 ? 'checked' : 0;
                    $psikologisSedih = $row['psikologisSedih'] == 1 ? 'checked' : 0;
                    $psikologisRendahDiri = $row['psikologisRendahDiri'] == 1 ? 'checked' : 0;
                    $psikologisMarah = $row['psikologisMarah'] == 1 ? 'checked' : 0;
                    $psikologisMudahTersinggung = $row['psikologisMudahTersinggung'] == 1 ? 'checked' : 0;
                    $sosiologisTak = $row['sosiologisTak'] == 1 ? 'checked' : 0;
                    $sosiologisIsolasi = $row['sosiologisIsolasi'] == 1 ? 'checked' : 0;
                    $sosiologisLain = $row['sosiologisLain'] == 1 ? 'checked' : 0;
                    $spritualTak = $row['spritualTak'] == 1 ? 'checked' : 0;
                    $spiritualPerluDibantu = $row['spiritualPerluDibantu'] == 1 ? 'checked' : 0;
                    $spiritualAgama = $row['spiritualAgama'] == 1 ? 'checked' : 0;
                    $Alergi = $row['Alergi'] == 1 ? 'checked' : 0;
                    $nutrisiTurunBb = $row['nutrisiTurunBb'] == 1 ? 'checked' : 0;
                    $nutrisiKurus = $row['nutrisiKurus'] == 1 ? 'checked' : 0;
                    $nutrisiMuntahDiare = $row['nutrisiMuntahDiare'] == 1 ? 'checked' : 0;
                    $nutrisiKondisiKhusus = $row['nutrisiKondisiKhusus'] == 1 ? 'checked' : 0;
                    $rujukAhliGizi = $row['rujukAhliGizi'] == 1 ? 'checked' : 0;
                    $fungsionalAlatBantu = $row['fungsionalAlatBantu'] == 1 ? 'checked' : 0;
                    $fungsionalProthesis = $row['fungsionalProthesis'] == 1 ? 'checked' : 0;
                    $fungsionalCacatTubuh = $row['fungsionalCacatTubuh'] == 1 ? 'checked' : 0;
                    $fungsionalAdl = $row['fungsionalAdl'] == 1 ? 'checked' : 0;
                    $fungsionalRiwayatJatuh = $row['fungsionalRiwayatJatuh'] == 1 ? 'checked' : 0;
                    $caraBerjalan = $row['caraBerjalan'] == 1 ? 'checked' : 0;
                    $dudukMenopang = $row['dudukMenopang'] == 1 ? 'checked' : 0;


                ?>
                    <div class="form-row">
                        <div class="col-md-2 mb-3">
                            <label>BB</label>
                            <input type="text" class="form-control" id="bb" name="bb" required value="<?= $row['bb']; ?>">
                            <input type="hidden" class="form-control" id="id" name="id" required value="<?= $row['id']; ?>">
                            <small class="form-control-feedback">Kg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TB</label>
                            <input type="text" class="form-control" id="tb" name="tb" required value="<?= $row['tb']; ?>">
                            <small class="form-control-feedback">Cm</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Frekuensi Nadi</label>
                            <input type="text" class="form-control" id="frekuensiNadi" name="frekuensiNadi" required value="<?= $row['frekuensiNadi']; ?>">
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TD Sistolik</label>
                            <input type="text" class="form-control" id="tdSistolik" name="tdSistolik" required value="<?= $row['tdSistolik']; ?>">
                            <small class="form-control-feedback">mmHg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>TD Diastolik</label>
                            <input type="text" class="form-control" id="tdDiastolik" name="tdDiastolik" required value="<?= $row['tdDiastolik']; ?>">
                            <small class="form-control-feedback">mmHg</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Suhu</label>
                            <input type="text" class="form-control" id="suhu" name="suhu" required value="<?= $row['suhu']; ?>">
                            <small class="form-control-feedback">oC</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Frekuensi Nafas</label>
                            <input type="text" class="form-control" id="frekuensiNafas" name="frekuensiNafas" required value="<?= $row['frekuensiNafas']; ?>">
                            <small class="form-control-feedback">x/menit</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Skala Nyeri</label>
                            <select name="skalaNyeri" id="skalaNyeri" class="select2" style="width: 100%">
                                <?php foreach ($skala_nyeri as $skala) : ?>
                                    <option value="<?php echo $skala['code']; ?>" <?php if ($skala['code'] == $row['skalaNyeri']) { ?> selected="selected" <?php } ?>><?php echo $skala['name']; ?> [<?php echo $skala['code']; ?> ]</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Psikologis</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Tidak Ada kelainan
                                    <input name="psikologisTak" id="psikologisTak" value="1" type="checkbox" <?= $psikologisTak; ?>>
                                    <span class="lever switch-col-blue"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Psikologis</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Takut<input name="psikologisTakut" id="psikologisTakut" value="1" type="checkbox" <?= $psikologisTakut; ?>><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Psikologis</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Sedih<input name="psikologisSedih" id="psikologisSedih" value="1" type="checkbox" <?= $psikologisSedih; ?>><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Psikologis</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Rendah Diri<input name="psikologisRendahDiri" id="psikologisRendahDiri" value="1" type="checkbox" <?= $psikologisRendahDiri; ?>><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Psikologis</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Marah<input name="psikologisMarah" id="psikologisMarah" value="1" type="checkbox" <?= $psikologisMarah; ?>><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Psikologis</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Mudah Tersinggung<input name="psikologisMudahTersinggung" id="psikologisMudahTersinggung" value="1" type="checkbox" <?= $psikologisMudahTersinggung; ?>><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Sosiologis</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Tidak Ada Kelainan<input name="sosiologisTak" id="sosiologisTak" value="1" type="checkbox" <?= $sosiologisTak; ?>><span class="lever switch-col-orange"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Sosiologis</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Isolasi Sosial<input name="sosiologisIsolasi" id="sosiologisIsolasi" value="1" type="checkbox" <?= $sosiologisIsolasi; ?>><span class="lever switch-col-orange"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Sosiologis</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Lain<input name="sosiologisLain" id="sosiologisLain" value="1" type="checkbox" <?= $sosiologisLain; ?>><span class="lever switch-col-orange"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Spiritual</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Tidak Ada Kelainan<input name="spritualTak" id="spritualTak" value="1" type="checkbox" <?= $spritualTak; ?>><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Spiritual</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Perlu Dibantu Ibadah<input name="spiritualPerluDibantu" id="spiritualPerluDibantu" value="1" type="checkbox" <?= $spiritualPerluDibantu; ?>><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Spiritual</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Agama<input name="spiritualAgama" id="spiritualAgama" value="1" type="checkbox" <?= $spiritualAgama; ?>><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Alergi</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    <input name="isialergi" id="isialergi" value="1" type="checkbox" <?= $Alergi; ?>><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Uraian Alergi</label>
                            <input type="text" class="form-control" id="uraianAlergi" name="uraianAlergi" value=<?= $row['uraianAlergi']; ?>>
                            <input type="hidden" class="form-control" id="alergi" name="alergi">
                            <small class="form-control-feedback">Ditulis Jika Ada Alergi</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Nutrisi</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Penurunan berat badan tanpa direncanakan<input name="nutrisiTurunBb" id="nutrisiTurunBb" value="1" type="checkbox" <?= $nutrisiTurunBb; ?>><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Nutrisi</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Tampak Kurus<input name="nutrisiKurus" id="nutrisiKurus" value="1" type="checkbox" <?= $nutrisiKurus; ?>><span class="lever switch-col-blue"></span></label>
                            </div>
                            <small class="form-control-feedback text-danger">Jika Pasien Anak</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Nutrisi</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Nafsu makan berkurang atau anak muntah > 3 kali atau diare > 5 kali<input name="nutrisiMuntahDiare" id="nutrisiMuntahDiare" value="1" type="checkbox" <?= $nutrisiMuntahDiare; ?>><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Nutrisi</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Kondisi Khusus Pasien ?<input name="isinutrisiKondisiKhusus" id="isinutrisiKondisiKhusus" value="1" type="checkbox" <?= $nutrisiKondisiKhusus; ?>><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Uraian Kondisi Khusus</label>
                            <input type="text" class="form-control" id="uraianKondisiKhusus" name="uraianKondisiKhusus" value=<?= $row['uraianKondisiKhusus']; ?>>
                            <input type="hidden" class="form-control" id="nutrisiKondisiKhusus" name="nutrisiKondisiKhusus">
                            <small class="form-control-feedback">Ditulis Jika Kondisi Khusus</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Nutrisi</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Dirujuk Ke Ahli Gizi<input name="rujukAhliGizi" id="rujukAhliGizi" value="1" type="checkbox" <?= $rujukAhliGizi; ?>><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Fungsional</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Perlu Alat Bantu<input name="isifungsionalAlatBantu" id="isifungsionalAlatBantu" value="1" type="checkbox" <?= $fungsionalAlatBantu; ?>><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Uraian Alat Bantu</label>
                            <input type="text" class="form-control" id="fungsionalNamaAlatBantu" name="fungsionalNamaAlatBantu" value=<?= $row['fungsionalNamaAlatBantu']; ?>>
                            <input type="hidden" class="form-control" id="fungsionalAlatBantu" name="fungsionalAlatBantu">
                            <small class="form-control-feedback">Ditulis Jika Perlu ALat Bantu</small>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Fungsional</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Prothesis<input name="fungsionalProthesis" id="fungsionalProthesis" value="1" type="checkbox" <?= $fungsionalProthesis; ?>><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>Fungsional</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Cacat Tubuh<input name="fungsionalCacatTubuh" id="fungsionalCacatTubuh" value="1" type="checkbox" <?= $fungsionalCacatTubuh; ?>><span class="lever switch-col-blue"></span></label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label>ADL</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Dibantu ?<input name="fungsionalAdl" id="fungsionalAdl" value="1" type="checkbox" <?= $fungsionalAdl; ?>><span class="lever switch-col-red"></span></label>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="paramedicName" name="paramedicName" required value="<?= session()->get('firstname'); ?>">
                        <input type="hidden" class="form-control" id="createdBy" name="createdBy" required value="<?= session()->get('firstname'); ?>">
                        <input type="hidden" class="form-control" id="createddate" name="createddate" required value="<?= date('Y-m-d G:i:s'); ?>">
                        <div class="col-md-3 mb-3">
                            <label>Riwayat Jatuh</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Riwayat Jatuh Dalam 3 Bulan terkahir<input name="fungsionalRiwayatJatuh" id="fungsionalRiwayatJatuh" value="1" type="checkbox" <?= $fungsionalRiwayatJatuh; ?>><span class="lever switch-col-red"></span></label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Cara Berjalan</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Sempoyongan ?<input name="caraBerjalan" id="caraBerjalan" value="1" type="checkbox" <?= $caraBerjalan; ?>><span class="lever switch-col-red"></span></label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Posisi Duduk</label>
                            <div class="switch">
                                <label class="d-flex flex-column flex-sm-row">
                                    Menopang Saat Duduk ?<input name="dudukMenopang" id="dudukMenopang" value="1" type="checkbox" <?= $dudukMenopang; ?>><span class="lever switch-col-red"></span></label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Skoring Jatuh</label>
                            <div class="input-group">
                                <select name="skoringJatuh" id="skoringJatuh" class="select2" style="width: 100%">
                                    <option value="Tidak Beresiko">Tidak Beresiko</option>
                                    <option value="Resiko Rendah">Resiko Rendah</option>
                                    <option value="Resiko Tinggi">Resiko Tinggi</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="nomorreferensi" name="nomorreferensi" required value="<?= $nomorreferensi; ?>">
                        <input type="hidden" class="form-control" id="poliklinikname" name="poliklinikname" required value="<?= $poliklinikname; ?>">
                        <input type="hidden" class="form-control" id="pasienid" name="pasienid" required value="<?= $pasienid; ?>">
                        <input type="hidden" class="form-control" id="pasienname" name="pasienname" required value="<?= $pasienname; ?>">
                        <input type="hidden" class="form-control" id="paymentmethodname" name="paymentmethodname" required value="<?= $paymentmethodname; ?>">
                        <input type="hidden" class="form-control" id="admissionDate" name="admissionDate" required value="<?= $admissionDate; ?>">
                        <input type="hidden" class="form-control" id="doktername" name="doktername" required value="<?= $doktername; ?>">

                        <div class="col-md-4 mb-3">
                            <label>Keluhan Utama</label>
                            <input type="text" class="form-control" id="keluhanUtama" name="keluhanUtama" required value="<?= $row['keluhanUtama']; ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Kesadaran</label>
                            <select name="kesadaran" id="kesadaran" class="select2" style="width: 100%">
                                <?php foreach ($kesadaran as $kes) : ?>
                                    <option value="<?php echo $kes['name']; ?>" <?php if ($kes['name'] == $row['kesadaran']) { ?> selected="selected" <?php } ?>><?php echo $kes['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Diagnosa Keperawatan</label>
                            <div class="input-group">
                                <select name="DiagnosaAskep" id="DiagnosaAskep" class="select2" style="width: 100%">
                                    <?php foreach ($diagnosa_perawat as $diagnosa) : ?>
                                        <option value="<?php echo $diagnosa['diagnosa']; ?>" <?php if ($diagnosa['diagnosa'] == $row['DiagnosaAskep']) { ?> selected="selected" <?php } ?>><?php echo $diagnosa['diagnosa']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                        </div>
                        <div class="col-md-8 mb-3">
                            <div class="input-group-append">
                                <!--    <button class="btn btn-info" id="cariaskep2" type="button"><i class="fas fa-search"></i> Lihat Rencana Keperawatan</button> -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Rencana Keperawatan</label>
                            <textarea id="mymce2" name="uraianAskep" class="form-control"><?= $row['uraianAskep']; ?></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Sasaran Rencana Asuhan</label>
                            <textarea id="mymce3" name="sasaranRencana" class="form-control" rows="2"><?= $row['sasaranRencana']; ?></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <button type="submit" class="btn btn-success btnsimpanhasil"><i class="fas fa-plus"></i> Ubah</button>
                        </div>
                    </div>
            </form>
        <?php endforeach; ?>
        </div>

    </div>
</div>


<script src="<?= base_url(); ?>/assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

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

        });
    });
</script>

<script src="<?= base_url(); ?>/assets/plugins/tinymce/tinymce.min.js"></script>
<script>
    $(document).ready(function() {

        if ($("#mymce").length > 0) {
            tinymce.init({
                selector: "textarea#mymce",
                theme: "modern",
                height: 100,
                plugins: [
                    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

            });
        }
    });
</script>




<script type="text/javascript">
    $(document).ready(function() {
        var poliklinikname = document.getElementById("poliklinikname").value;
        $("#paramedicName").autocomplete({

            source: "<?php echo base_url('PelayananRawatJalanRME/ajax_paramedicName'); ?>?poliklinikname=" + poliklinikname,
            select: function(event, ui) {
                $('#paramedicName').val(ui.item.value);

            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.formasesmen').submit(function(e) {
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
                        Swal.fire({
                            icon: 'warning',
                            title: 'Gagal',
                            text: response.error,
                        })

                    } else if (response.error) {
                        if (response.error.doktername) {
                            $('#doktername').addClass('form-control-danger');
                            $('.errordoktername').html(response.error.doktername);
                        } else {
                            $('#doktername').removeClass('form-control-danger');
                            $('.erroroktername').html('');
                        }

                        if (response.error.name) {
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
                        })

                        $('#form-filter-atas').css('display', 'none');
                        $('#form-filter-bawah').css('display', 'block');
                        $('#journalnumber').val(response.JN);
                        $('#kode').val(response.JN);
                        $('#dokter').val(response.dokter);
                        $('#doktername').val(response.doktername);
                        $('#documentdate').val(response.tanggalpelayanan);
                        dataCPPT();

                    }
                }


            });
            return false;
        });
    });
</script>


<script>
    $('#cariaskep2').click(function(e) {
        e.preventDefault();
        let diagnosakeperawatan = $('#DiagnosaAskep').val();
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PelayananRawatJalanRME/cariAskep'); ?>",

            data: {
                diagnosakeperawatan: diagnosakeperawatan
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalaskep').html(response.sukses).show();
                    $('#modalpilihaskep').modal('show');

                }
            }

        })


    })
</script>