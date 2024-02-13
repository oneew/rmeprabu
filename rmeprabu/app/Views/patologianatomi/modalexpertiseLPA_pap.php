<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.css" />

<div id="modalexpertiseLPA" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel">Patologi Anantomi Expertise Pap Smear</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <h6>Data Pasien</h6>
                <div class="row">
                    <div class="col-md-3 col-xs-6 border-right"> <strong>NoRm</strong>
                        <br>
                        <p class="text-muted"><?= $data_pasien['relation']; ?> | <?= $data_pasien['documentdate']; ?> | <?= $data_pasien['paymentmethod']; ?> </p>
                    </div>
                    <div class="col-md-3 col-xs-6 border-right"> <strong>Nama</strong>
                        <br>
                        <p class="text-muted"><?= $data_pasien['relationname']; ?> | <?= $data_pasien['roomname']; ?> | <?= $data_pasien['journalnumber']; ?> </p>
                    </div>
                    <div class="col-md-3 col-xs-6 border-right"> <strong>Dokter Pemohon</strong>
                        <br>
                        <p class="text-muted"><?= $data_pasien['doktername']; ?></p>
                    </div>
                    <div class="col-md-3 col-xs-6"> <strong>Pemeriksaan</strong>
                        <br>
                        <p class="text-dark"><b><?= $data_pasien['name']; ?></b> (No.Expertise :<?= $data_pasien['expertiseid']; ?>)</p>
                    </div>
                </div>
                <hr>

                <h6>Isi Expertise Pemeriksaan</h6>

                <form method="POST" action="<?= base_url('PelayananLPA/simpanExpertisePap'); ?>" class="formexpertise">
                    <?= csrf_field(); ?>
                    <input type="hidden" id="id_detail" name="id_detail" class="form-control" value="<?= $data_pasien['id']; ?>">
                    <input type="hidden" id="groups" name="groups" class="form-control" value="PAP">
                    <div class="row">
                        <div class="col">
                            <p>Klasifikasi kelainan sitologis:</p>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="negatif" id="negatif" name="kelainan_sitologis" <?= $kelainan_sitologis == 'negatif' ? 'checked' : null ;?> >
                                    <label class="form-check-label" for="negatif">
                                        Negatif
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="inkonklusif" id="inkonklusif" name="kelainan_sitologis" <?= $kelainan_sitologis == 'inkonklusif' ? 'checked' : null ;?>>
                                    <label class="form-check-label" for="inkonklusif">
                                        Inkonklusif
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="atypik" id="atypik" name="kelainan_sitologis" <?= $kelainan_sitologis == 'atypik' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="atypik">
                                        atypik
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="displasia" id="displasia" name="kelainan_sitologis" <?= $kelainan_sitologis == 'displasia' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="displasia">
                                        displasia
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="positif" id="positif" name="kelainan_sitologis" <?= $kelainan_sitologis == 'positif' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="positif">
                                        positif
                                    </label>
                                </div>
                            </div>

                            <p>Kualitas Smear:</p>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="adekwat" id="adekwat" name="kualitas_smear" <?= $kualitas_smear == 'adekwat' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="adekwat">
                                        adekwat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="no_adekwat" id="no_adekwat" name="kualitas_smear" <?= $kualitas_smear == 'no_adekwat' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="no_adekwat">
                                        tidak adekwat
                                    </label>
                                </div>
                            </div>

                            <p>INTERPRETASI:</p>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="tidak tampak sel ganas" id="sel_ganas" name="interpretasi" <?= $interpretasi == 'tidak tampak sel ganas' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="sel_ganas">
                                        tidak tampak sel ganas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="tidak tampak sel-sel ganas residue" id="sel_ganas_residue" name="interpretasi" <?= $interpretasi == 'tidak tampak sel-sel ganas residue' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="sel_ganas_residue">
                                        tidak tampak sel-sel ganas residue
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="tampak sel-sel endoservik" id="sel_ganas_residue" name="interpretasi" <?= $interpretasi == 'tampak sel-sel endoservik' ? 'checked' : null; ?>>
                                    <label class="form-check-label text-capitalize" for="sel_ganas_residue">
                                        tampak sel-sel endoservik/Tak tampak sel-sel
                                    </label>
                                </div>
                            </div>

                            <p>endocervix:</p>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="sel_superficial" id="sel_superficial" name="endocervix" <?= $endocervix == 'sel_superficial' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="sel_superficial">
                                        Sel Superficial/Intermediate/Parabasal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="sel_endometrial" id="sel_endometrial" name="endocervix" <?= $endocervix == 'sel_endometrial' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="sel_endometrial">
                                        sel-sel endometrial
                                    </label>
                                </div>
                            </div>

                            <p>PERUBAHAN REAKTIF</p>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="sel_metaplasia" id="sel_metaplasia" name="reaktif" <?= $reaktif == 'sel_metaplasia' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="sel_metaplasia">
                                        Sel-sel metaplasia
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="sel_degeneratif" id="sel_degeneratif" name="reaktif" <?= $reaktif == 'sel_degeneratif' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="sel_degeneratif">
                                        Sel-sel degeneratif/Regeneratif/Repair
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="cytolysis" id="cytolysis" name="reaktif" <?= $reaktif == 'cytolysis' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="cytolysis">
                                        cytolysis
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="radiasi" id="radiasi" name="reaktif" <?= $reaktif == 'radiasi' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="radiasi">
                                        radiasi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="efek_kemoterapi" id="efek_kemoterapi" name="reaktif" <?= $reaktif == 'efek_kemoterapi' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="efek_kemoterapi">
                                        efek kemotrapi
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="perubahan_hormonal" id="perubahan_hormonal" name="reaktif" <?= $reaktif == 'perubahan_hormonal' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="perubahan_hormonal">
                                        perubahan hormonal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="radang" id="radang" name="reaktif" <?= $reaktif == 'radang' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="radang">
                                        Radang ringan/sedang/berat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="sel_endoservik" id="sel_endoservik" name="reaktif" <?= $reaktif == 'sel_endoservik' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="sel_endoservik">
                                        Sel endoservik
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="atrophy" id="atrophy" name="reaktif" <?= $reaktif == 'atrophy' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="atrophy">
                                        atrophy
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="efek_iud" id="efek_iud" name="reaktif" <?= $reaktif == 'efek_iud' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="efek_iud">
                                        efek IUD
                                    </label>
                                </div>
                            </div>

                            <p>INFEKSI</p>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="doderlein" id="doderlein" name="infeksi" <?= $infeksi == 'doderlein' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="doderlein">
                                        doderlein bacillus
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="coccus" id="coccus" name="infeksi" <?= $infeksi == 'coccus' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="coccus">
                                        coccus
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="jamur" id="jamur" name="infeksi" <?= $infeksi == 'jamur' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="jamur">
                                        jamur
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="trichomonas" id="trichomonas" name="infeksi" <?= $infeksi == 'trichomonas' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="trichomonas">
                                        trichomonas vaginalis
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="gardnerella" id="gardnerella" name="infeksi" <?= $infeksi == 'gardnerella' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="gardnerella">
                                        gardnerella vaginalis / coccobacil
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="leptothrix" id="leptothrix" name="infeksi" <?= $infeksi == 'leptothrix' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="leptothrix">
                                        leptothrix
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="virus" id="virus" name="infeksi" <?= $infeksi == 'virus' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="virus">
                                        virus
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="h_vaginalis" id="h_vaginalis" name="infeksi" <?= $infeksi == 'h_vaginalis' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="h_vaginalis">
                                        h vaginalis
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="actinomyces" id="actinomyces" name="infeksi" <?= $infeksi == 'actinomyces' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="actinomyces">
                                        actinomyces
                                    </label>
                                </div>
                            </div>

                            <p>EVALUASI HORMONAL (Apusan Vaginal)</p>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="hormonal_sesuai" id="hormonal_sesuai" name="evaluasi" <?= $evaluasi == 'hormonal_sesuai' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="hormonal_sesuai">
                                        Pola hormonal sesuai umur & riwayat
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="hormonal_tidak_sesuai" id="hormonal_tidak_sesuai" name="evaluasi" <?= $evaluasi == 'hormonal_tidak_sesuai' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="hormonal_tidak_sesuai">
                                        Pola hormonal tidak sesuai umur & riwayat
                                    </label>
                                </div>
                            </div>

                            <p>Sel Skuamosa Atipik/Atypical Squamous Cell (ASC)</p>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="asc_us" id="asc_us" name="asc_data" <?= $asc_data == 'asc_us' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="asc_us">
                                        ASC-US (ringan/sedang/berat)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="asc_h" id="asc_h" name="asc_data" <?= $asc_data == 'asc_h' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="asc_h">
                                        ASC-H
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <p>Intra Epithelial Lession (LIS)</p>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="lg_sil" id="lg_sil" name="lis" <?= $lis == 'lg_sil' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="lg_sil">
                                        LG-SIL
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="hg_sil" id="hg_sil" name="lis" <?= $lis == 'hg_sil' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="hg_sil">
                                        HG-SIL
                                    </label>
                                </div>
                            </div>

                            <p>Karsinoma Sel Skuamosa (SSC)</p>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="keratinizing" id="keratinizing" name="ssc" <?= $ssc == 'keratinizing' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="keratinizing">
                                        keratinizing
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="non_keratinizing" id="non_keratinizing" name="ssc" <?= $ssc == 'non_keratinizing' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="non_keratinizing">
                                        non keratinizing
                                    </label>
                                </div>
                            </div>

                            <p>SEL GLANDULAR <br> Sel glandular atipik (AGC):</p>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="endoserviks" id="endoserviks" name="nos" <?= $nos == 'endoserviks' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="endoserviks">
                                        endoserviks
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="endometrium" id="endometrium" name="nos" <?= $nos == 'endometrium' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="endometrium">
                                        endometrium
                                    </label>
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="atipik" id="atipik" name="atipik" <?= $atipik == 'atipik' ? 'checked' : null ;?>>
                                <label class="form-check-label text-capitalize" for="atipik">
                                    atipik (favor neoplastic)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="ais" id="ais" name="ais" <?= $ais == 'ais' ? 'checked' : null ;?>>
                                <label class="form-check-label text-capitalize" for="ais">
                                    Adenocarcinoma insitu serviks (AIS)
                                </label>
                            </div>

                            <p>Adenocarcinoma</p>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="endoserviks" id="adenocarcinoma_endoserviks" name="adenocarcinoma" <?= $adenocarcinoma == 'endoserviks' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="adenocarcinoma_endoserviks">
                                        endoserviks
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="endometrium" id="adenocarcinoma_endometrium" name="adenocarcinoma" <?= $adenocarcinoma == 'endometrium' ? 'checked' : null ;?>>
                                    <label class="form-check-label text-capitalize" for="adenocarcinoma_endometrium">
                                        endometrium
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label><b>KESIMPULAN</b></label>
                                <textarea id="kesimpulan" name="kesimpulan" class="textarea_editor form-control" rows="15" placeholder="Enter text ..."><?= $kesimpulan ;?></textarea>
                            </div>
                            <div>
                                <label><b>SARAN</b></label>
                                <textarea id="saran" name="saran" class="textarea_editor form-control" rows="15" placeholder="Enter text ..."><?= $saran ;?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3 col-12 col-sm-6 px-0">
                        <label for="exampleFormControlSelect1">Dokter Pemeriksa</label>
                        <select class="form-control" name="employee" id="employee" required>
                            <option value="">Pilih dokter</option>
                            <?php foreach ($list as $item) : ?>
                                <option value="<?= $item['code'] . '|' . $item['name'] ;?>" <?= $employee == $item['code'] ? 'selected' : null; ?>><?= $item['name'] ;?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success btnsimpanExpertise"> <i class="fa fa-check"></i> Simpan</button>
                        <button type="button" class="btn btn-inverse" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>

            <div class="modal-footer">

                <div id="form-filter-bawah" style="display: block;">
                    <div class="text-right">
                        <button id="print" class="btn btn-success btn-print-exp-pap" type="button"> <span><i class="fa fa-print"></i></span> </button>
                    </div>
                </div>
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal-upload"></div>

<script src="<?= base_url(); ?>/assets/plugins/html5-editor/wysihtml5-0.3.0.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/html5-editor/bootstrap-wysihtml5.js"></script>
<script>
    $(document).ready(function() {
        $('.textarea_editor').each(function() {
            $(this).wysihtml5();
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.formexpertise').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpanExpertise').attr('disable', 'disabled');
                    $('.btnsimpanExpertise').html('<i class="fa fa-spin fa-spinner "></i>');
                },
                complete: function() {
                    $('.btnsimpanExpertise').removeAttr('disable');
                    $('.btnsimpanExpertise').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal !!!',
                            text: response.error,
                        })

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        })
                    }
                }
            });
            return false;
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-print-exp-pap').on('click', function() {

            let id = $('#pacsnumber').val();
            window.open("<?= base_url('PelayananLPA/print_expertise_pap'); ?>?page=" + <?= $data_pasien['id']; ?>, "_blank");

        })
    });
</script>