<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.ico">
    <title>Expertise Patologi Anatomi</title>
    <style type="text/css">
        hr {
            border-top: 3px double #8c8b8b;
        }

        td {
            padding-left: 5px;
            padding-right: 5px;
        }

        .row {
            display: flex;
            width: 100%;
            font-size: 12px;
        }

        .col {
            width: 100%;
            font-size: 12px;
        }

        p {
            margin: 0;
            font-size: 12px;
        }

        .text-capitalize {
            text-transform: capitalize;
        }
    </style>
</head>

<body>

    <table style="border-collapse: collapse; width: 100%; border-collapse: collapse;">
        <tr>
            <td style="width: 10.3333%; text-align: center;" rowspan="4">
                <div class="img">
                    <img style="height: 40px;" src="<?= base_url('assets/images/gallery/muaraenim.png'); ?>" width="40" class="dark-logo" />
                </div>
            </td>
            <td style="width: 53.3333%; text-align: center;">
                <h3 style="margin: 0;"><b class="text-info"><?= $kop['header1']; ?></b></h3>
                <h3 style="margin: 0;"><b><?= $kop['header2']; ?></b></h3>
                <?= $kop['alamat']; ?>
            </td>
            <td style="width: 10.3333%; text-align: center;" rowspan="4">
                <div class="img">
                    <img style="height: 40px;" src="<?= base_url('assets/images/gallery/logo_puskesmas.png'); ?>" width="40" class="dark-logo" />
                </div>
            </td>
        </tr>
    </table>
    <hr>
    <h4 style="text-align: center;">LEMBAR JAWABAN</h4>
    <table style="border: 1px solid #000; border-collapse: collapse; width: 100%; font-size: 10px; margin-bottom: 10px;">
        <tr>
            <td style="border: 1px solid #000; width: 10%;">No. Reg</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= $data['journalnumber']; ?></td>
            <td style="border: 1px solid #000; width: 15%;">Dokter Pengirim</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= $data['doktername']; ?></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 10%;">No. RM</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= $data['code']; ?></td>
            <td style="border: 1px solid #000; width: 15%;">No Telp/HP Pasien</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= $data['mobilephone'] == '' ? '-' : $data['mobilephone']; ?></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 10%;">Nama</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= $data['name']; ?></td>
            <td style="border: 1px solid #000; width: 15%;">Tgl Pengiriman</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= tgl_indo_helper($data['documentdate']); ?></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 10%;">Umur/Tgl Lahir</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= hitung_usia_by_doc($data['dateofbirth'], $data['documentdate'], 1); ?></td>
            <td style="border: 1px solid #000; width: 15%;">Tgl Penyelesaian</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= tgl_indo_helper($data['created_at']); ?></td>
        </tr>
        <tr>
            <td style="border: 1px solid #000; width: 10%;">Jenis Kelamin</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= $data['gender']; ?></td>
            <td style="border: 1px solid #000; width: 15%;">Metode Pembayaran</td>
            <td style="border: 1px solid #000; text-align:center;">:</td>
            <td style="border: 1px solid #000;"><?= $data['paymentmethodname']; ?></td>
        </tr>
    </table>

    <div class="row">
        <div class="col">
            <p>Klasifikasi kelainan sitologis:</p>
            <div class="row">
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="negatif" id="negatif" name="kelainan_sitologis" <?= $data['kelainan_sitologis'] == 'negatif' ? 'checked' : null; ?>>
                    <label class="form-check-label" for="negatif">
                        Negatif
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="inkonklusif" id="inkonklusif" name="kelainan_sitologis" <?= $data['kelainan_sitologis'] == 'inkonklusif' ? 'checked' : null; ?>>
                    <label class="form-check-label" for="inkonklusif">
                        Inkonklusif
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="atypik" id="atypik" name="kelainan_sitologis" <?= $data['kelainan_sitologis'] == 'atypik' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="atypik">
                        atypik
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="displasia" id="displasia" name="kelainan_sitologis" <?= $data['kelainan_sitologis'] == 'displasia' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="displasia">
                        displasia
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="positif" id="positif" name="kelainan_sitologis" <?= $data['kelainan_sitologis'] == 'positif' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="positif">
                        positif
                    </label>
                </div>
            </div>

            <div class="row">
                <p>Kualitas Smear:</p>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="adekwat" id="adekwat" name="kualitas_smear" <?= $data['kualitas_smear'] == 'adekwat' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="adekwat">
                        adekwat
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="no_adekwat" id="no_adekwat" name="kualitas_smear" <?= $data['kualitas_smear'] == 'no_adekwat' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="no_adekwat">
                        tidak adekwat (Tdk ada sel endoservik/sel sedikit/kotor/banyak darah)
                    </label>
                </div>
            </div>

            <p>INTERPRETASI:</p>
            <div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="tidak tampak sel ganas" id="sel_ganas" name="interpretasi" <?= $data['interpretasi'] == 'tidak tampak sel ganas' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="sel_ganas">
                        tidak tampak sel ganas
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="tidak tampak sel-sel ganas residue" id="sel_ganas_residue" name="interpretasi" <?= $data['interpretasi'] == 'tidak tampak sel-sel ganas residue' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="sel_ganas_residue">
                        tidak tampak sel-sel ganas residue
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="tampak sel-sel endoservik" id="sel_ganas_residue" name="interpretasi" <?= $data['interpretasi'] == 'tampak sel-sel endoservik' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="sel_ganas_residue">
                        tampak sel-sel endoservik/Tak tampak sel-sel
                    </label>
                </div>
            </div>

            <p>endocervix:</p>
            <div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="sel_superficial" id="sel_superficial" name="endocervix" <?= $data['endocervix'] == 'sel_superficial' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="sel_superficial">
                        Sel Superficial/Intermediate/Parabasal
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="sel_endometrial" id="sel_endometrial" name="endocervix" <?= $data['endocervix'] == 'sel_endometrial' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="sel_endometrial">
                        sel-sel endometrial
                    </label>
                </div>
            </div>

            <p>PERUBAHAN REAKTIF</p>
            <div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="sel_metaplasia" id="sel_metaplasia" name="reaktif" <?= $data['reaktif'] == 'sel_metaplasia' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="sel_metaplasia">
                        Sel-sel metaplasia
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="sel_degeneratif" id="sel_degeneratif" name="reaktif" <?= $data['reaktif'] == 'sel_degeneratif' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="sel_degeneratif">
                        Sel-sel degeneratif/Regeneratif/Repair
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="cytolysis" id="cytolysis" name="reaktif" <?= $data['reaktif'] == 'cytolysis' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="cytolysis">
                        cytolysis
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="radiasi" id="radiasi" name="reaktif" <?= $data['reaktif'] == 'radiasi' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="radiasi">
                        radiasi
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="efek_kemoterapi" id="efek_kemoterapi" name="reaktif" <?= $data['reaktif'] == 'efek_kemoterapi' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="efek_kemoterapi">
                        efek kemotrapi
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="perubahan_hormonal" id="perubahan_hormonal" name="reaktif" <?= $data['reaktif'] == 'perubahan_hormonal' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="perubahan_hormonal">
                        perubahan hormonal
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="radang" id="radang" name="reaktif" <?= $data['reaktif'] == 'radang' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="radang">
                        Radang ringan/sedang/berat
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="sel_endoservik" id="sel_endoservik" name="reaktif" <?= $data['reaktif'] == 'sel_endoservik' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="sel_endoservik">
                        Sel endoservik
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="atrophy" id="atrophy" name="reaktif" <?= $data['reaktif'] == 'atrophy' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="atrophy">
                        atrophy
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="efek_iud" id="efek_iud" name="reaktif" <?= $data['reaktif'] == 'efek_iud' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="efek_iud">
                        efek IUD
                    </label>
                </div>
            </div>

            <p>INFEKSI</p>
            <div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="doderlein" id="doderlein" name="infeksi" <?= $data['infeksi'] == 'doderlein' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="doderlein">
                        doderlein bacillus
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="coccus" id="coccus" name="infeksi" <?= $data['infeksi'] == 'coccus' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="coccus">
                        coccus
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="jamur" id="jamur" name="infeksi" <?= $data['infeksi'] == 'jamur' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="jamur">
                        jamur
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="trichomonas" id="trichomonas" name="infeksi" <?= $data['infeksi'] == 'trichomonas' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="trichomonas">
                        trichomonas vaginalis
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="gardnerella" id="gardnerella" name="infeksi" <?= $data['infeksi'] == 'gardnerella' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="gardnerella">
                        gardnerella vaginalis / coccobacil
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="leptothrix" id="leptothrix" name="infeksi" <?= $data['infeksi'] == 'leptothrix' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="leptothrix">
                        leptothrix
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="virus" id="virus" name="infeksi" <?= $data['infeksi'] == 'virus' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="virus">
                        virus
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="h_vaginalis" id="h_vaginalis" name="infeksi" <?= $data['infeksi'] == 'h_vaginalis' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="h_vaginalis">
                        h vaginalis
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="actinomyces" id="actinomyces" name="infeksi" <?= $data['infeksi'] == 'actinomyces' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="actinomyces">
                        actinomyces
                    </label>
                </div>
            </div>

            <p>EVALUASI HORMONAL (Apusan Vaginal)</p>
            <div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="hormonal_sesuai" id="hormonal_sesuai" name="evaluasi" <?= $data['evaluasi'] == 'hormonal_sesuai' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="hormonal_sesuai">
                        Pola hormonal sesuai umur & riwayat
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="hormonal_tidak_sesuai" id="hormonal_tidak_sesuai" name="evaluasi" <?= $data['evaluasi'] == 'hormonal_tidak_sesuai' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="hormonal_tidak_sesuai">
                        Pola hormonal tidak sesuai umur & riwayat
                    </label>
                </div>
            </div>
            <p>ABNORMALITAS SEL EPITHEL<br>SEL SKUAMOSA</p>

            <p>Sel Skuamosa Atipik/Atypical Squamous Cell (ASC):</p>
            <div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="asc_us" id="asc_us" name="asc_data" <?= $data['asc_data'] == 'asc_us' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="asc_us">
                        ASC-US (ringan/sedang/berat)
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="asc_h" id="asc_h" name="asc_data" <?= $data['asc_data'] == 'asc_h' ? 'checked' : null; ?>>
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
                    <input disabled class="form-check-input" type="radio" value="lg_sil" id="lg_sil" name="lis" <?= $data['lis'] == 'lg_sil' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="lg_sil">
                        LG-SIL
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="hg_sil" id="hg_sil" name="lis" <?= $data['lis'] == 'hg_sil' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="hg_sil">
                        HG-SIL
                    </label>
                </div>
            </div>

            <p>Karsinoma Sel Skuamosa (SSC)</p>
            <div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="keratinizing" id="keratinizing" name="ssc" <?= $data['ssc'] == 'keratinizing' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="keratinizing">
                        keratinizing
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="non_keratinizing" id="non_keratinizing" name="ssc" <?= $data['ssc'] == 'non_keratinizing' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="non_keratinizing">
                        non keratinizing
                    </label>
                </div>
            </div>

            <p>SEL GLANDULAR <br> Sel glandular atipik (AGC):</p>
            <div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="checkbox" value="endoserviks" id="endoserviks" name="nos" <?= in_array($data['nos'], ['endoserviks', 'endometrium']) ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="endoserviks">
                        Atipik (NOS):
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="endoserviks" id="endoserviks" name="nos" <?= $data['nos'] == 'endoserviks' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="endoserviks">
                        endoserviks
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="endometrium" id="endometrium" name="nos" <?= $data['nos'] == 'endometrium' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="endometrium">
                        endometrium
                    </label>
                </div>
            </div>
            <div class="form-check">
                <input disabled class="form-check-input" type="checkbox" value="atipik" id="atipik" name="atipik" <?= $data['atipik'] == 'atipik' ? 'checked' : null; ?>>
                <label class="form-check-label text-capitalize" for="atipik">
                    atipik (favor neoplastic)
                </label>
            </div>
            <div class="form-check">
                <input disabled class="form-check-input" type="checkbox" value="ais" id="ais" name="ais" <?= $data['ais'] == 'ais' ? 'checked' : null; ?>>
                <label class="form-check-label text-capitalize" for="ais">
                    Adenocarcinoma insitu serviks (AIS)
                </label>
            </div>

            <p>Adenocarcinoma</p>
            <div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="endoserviks" id="adenocarcinoma_endoserviks" name="adenocarcinoma" <?= $data['adenocarcinoma'] == 'endoserviks' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="adenocarcinoma_endoserviks">
                        endoserviks
                    </label>
                </div>
                <div class="form-check">
                    <input disabled class="form-check-input" type="radio" value="endometrium" id="adenocarcinoma_endometrium" name="adenocarcinoma" <?= $data['adenocarcinoma'] == 'endometrium' ? 'checked' : null; ?>>
                    <label class="form-check-label text-capitalize" for="adenocarcinoma_endometrium">
                        endometrium
                    </label>
                </div>
            </div>

            <div>
                <label><b>KESIMPULAN</b></label>
                <div><?= $data['kesimpulan']; ?></div>
            </div>
            <div>
                <label><b>SARAN</b></label>
                <div><?= $data['saran']; ?></div>
            </div>

            <table style="border-collapse: collapse; width: 100%; margin-top: 20px; font-size: 10px;">
                <tr>
                    <td>
                        Muara Enim, <?= tgl_indo_helper($data['created_at']); ?>
                        <br>
                        <?= barcode_helper($data['journalnumber'] . ' ' . $data['employeename']); ?>
                        <br>
                        <u><?= $data['employeename']; ?></u>
                        <br>
                        <strong><?= cari_nip_dokter($data['employeename']) == null ? 'SIP. ' . cari_sip_dokter($data['employeename']) : 'NIP. ' . cari_nip_dokter($data['employeename']); ?></strong>
                    </td>
                </tr>
            </table>
        </div>
    </div>


    <script>
        window.print();
    </script>
</body>

</html>