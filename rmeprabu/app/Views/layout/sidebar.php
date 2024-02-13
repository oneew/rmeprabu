<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile" style="background: url(<?= base_url(); ?>/assets/images/background/user-info.jpg) no-repeat;">
            <!-- User profile image -->
            <div class="profile-img"> <img src="<?= base_url(); ?>/assets/images/prabu.ico" alt="user" /> </div>
            <!-- User profile text-->
            <div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?= session()->get('locationname'); ?></a>
                <div class="dropdown-menu animated flipInY"> <a href="#" class="dropdown-item"><i class="ti-user"></i>
                        Profile Saya</a> <a href="#" class="dropdown-item"><i class="ti-wallet"></i> Kinerja Saya</a>
                    <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                    <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"><i class="ti-settings"></i>
                        Pengaturan Akun</a>
                    <div class="dropdown-divider"></div> <a href="<?= base_url(); ?>/logout" class="dropdown-item"><i class="fa fa-power-off"></i>
                        Logout</a>
                </div>
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 3)  or (session()->get('level') == 12)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="<?= base_url(); ?>/SimrsHome/HomeSimrs" aria-expanded="false"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Dashboard</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/SimrsHome/HomeSimrs">Dashboard</a></li>
                            <!-- <li><a href="<?= base_url(); ?>/MonitoringKlaim">Monitoring Klaim</a></li>
                            <li><a href="<?= base_url(); ?>/MonitoringKlaim/JasaRaharja">MonKla JasaRaharja</a></li>
                            <li><a href="<?= base_url(); ?>/LapRealisasi/Ranap">Realisasi Ranap Non TMO</a></li>
                            <li><a href="<?= base_url(); ?>/LapRealisasi/Rajal">Realisasi Rajal</a></li>
                            <li><a href="<?= base_url(); ?>/LapRealisasi/RanapTMO">Realisasi Ranap TMO</a></li> -->
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or  (session()->get('level') == 3)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-all-inclusive"></i><span class="hide-menu">Data Master </span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/TarifPelayananRajal">Tarif Pelayanan Rajal</a></li>
                            <li><a href="<?= base_url(); ?>/TarifPelayananIGD">Tarif Pelayanan IGD</a></li>
                            <li><a href="<?= base_url(); ?>/pelayanan">Tarif Pelayanan Ranap</a></li>
                            <li><a href="<?= base_url(); ?>/TarifPelayananVisite">Tarif Pelayanan Visite</a></li>
                            <li><a href="<?= base_url(); ?>/TarifPelayananPenunjang">Tarif Pelayanan Penunjang</a></li>
                            <li><a href="<?= base_url(); ?>/dokter">Data Dokter</a></li>
                            <li><a href="<?= base_url(); ?>/Doktergallery">Gallery Dokter</a></li>
                            <li><a href="<?= base_url(); ?>/perawat">Paramedis</a></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (session()->get('level') == 0) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-vector-combine"></i><span class="hide-menu">Konfigurasi </span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/UsersAkun/register">Tambah Akun Pengguna</a></li>
                            <li><a href="<?= base_url(); ?>/UsersAkun/SettingLokasi">Atur Lokasi Pengguna</a></li>
                            <li><a href="<?= base_url(); ?>/UsersAkun/DataLog">Data Log Pengguna</a></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 31)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-fan"></i><span class="hide-menu">Aplicares </span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/Aplicares">Referensi Kamar</a></li>
                            <li><a href="<?= base_url(); ?>/Aplicares/MasterKamar">Tambah Hapus Kamar</a></li>
                            <li><a href="<?= base_url(); ?>/Aplicares/UpdateKetersediaan">Update Ketersediaan</a></li>
                            <li><a href="<?= base_url(); ?>/Aplicares/Ketersediaan">Ketersediaan Kamar</a></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 31)) { ?>
                    <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-kodi"></i><span class="hide-menu">Vclaim Referensi</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/Member">Peserta</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/Hfis">Referensi Dokter HFIS</a></li>
                            <!-- <li><a href="#">Jadwal Dokter HFIS</a></li> -->
                            <li><a href="<?= base_url(); ?>/Aplicares/MasterKamar">Update Jadwal HFIS</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/Poli">Referensi Poli</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/Faskes">Data Faskes</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/Diagnosa">Referensi Diagnosa</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/Dokter">Referensi DPJP</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/DiagnosaPRB">Diagnosa PRB</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/ObatGenerikPRB">Obat Generik PRB</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/ProcedureLPK">Procedure LPK</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/KelasRawatLPK">Kelas Rawat LPK</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/DokterLPK">Dokter LPK</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/SpesialistikLPK">Spesialistik LPK</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/RuangRawatLPK">Ruang Rawat LPK</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/CaraKeluarLPK">Cara Keluar LPK</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/PascaPulangLPK">Pasca Pulang LPK</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/Propinsi">Propinsi</a></li>

                        </ul>
                    </li>
                <?php } ?>
                <?php if (session()->get('level') == 0) { ?>
                    <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-google-pages"></i><span class="hide-menu">Vclaim Monitoring</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/MonitoringKunjungan">Data Kunjungan</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/MonitoringKlaim">Monitoring Klaim</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/MonitoringKlaimJasaRaharja">Monitoring Jasa Raharja</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/HistoriPelayananSep">Histori Pelayanan</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/SuplesiJR">Suplesi JasaRaharja</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/IndukKecelakaan">Data Induk Kecelakaan</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/Rujukan">Surat Rujukan</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/Kontrol">Surat Kontrol</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/SEP">SEP</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/SepInternal">SEP Internal</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/FingerPrint">Finger Print</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/Spesialistik">Jadwal Spesialistik</a></li>
                            <li><a href="#" class="has-arrow">Rujukan Khusus<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/VclaimAntrean/addRujukanKhusus">Tambah Rujukan</a></li>
                                    <li><a href="<?= base_url(); ?>/VclaimAntrean/ListPerpanjanganKhusus">List</a></li>
                                </ul>
                            </li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/ListPRB">Data List PRB</a></li>
                            <li><a href="<?= base_url(); ?>/VclaimAntrean/ListNoPRB">Data No SRB</a></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (session()->get('level') == 0) { ?>
                    <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-google-circles-extended"></i><span class="hide-menu">WS Antrean</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/WsAntrean/referensiPoli">Referensi Poli</a></li>
                            <li><a href="<?= base_url(); ?>/WsAntrean/referensiDokter">Referensi Dokter</a></li>
                            <li><a href="<?= base_url(); ?>/WsAntrean/ReferensiJadwalDokter">Jadwal Dokter HFIS</a></li>
                            <li><a href="#">Dashboard Harian</a></li>
                            <li><a href="#">Dashboard Bulanan</a></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 111) or (session()->get('level') == 107) or (session()->get('level') == 108) or (session()->get('level') == 109) or (session()->get('level') == 110)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-credit-card-multiple"></i><span class="hide-menu">RME</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/ReferensiRME">Template SOAP<span class="badge badge-success badge-pill"></span></a></li>
                            <li><a href="<?= base_url('TempletEResep/index'); ?>">Template E Resep<span class="badge badge-success badge-pill"></span></a></li>
                            <li><a href="<?= base_url('TempletLapOk/index'); ?>">Template Lap Ok<span class="badge badge-success badge-pill"></span></a></li>
                            <li><a href="#" class="has-arrow">Rawat Jalan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME">Asesmen Perawat</a></li>
                                    <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/Medis">Asesmen Medis</a></li>
                                    <!-- <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/WLP">Work Load Perawat</a></li>
                                    <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/WLMDRajal">Work Load Medis</a></li> -->
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">IGD<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/IGD">Triase</a></li>
                                    <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/AsesmenPerawatIGD">Asesmen Perawat</a></li>
                                    <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/MedisIGD">Asesmen Medis</a></li>
                                    <!-- <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/WLPIGD">Work Load Perawat</a></li>
                                    <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/WLMDIGD">Work Load Medis</a></li> -->

                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Rawat Inap<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/AsesmenPerawatRanap">Asesmen Perawat</a></li>
                                    <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/MedisRanap">Asesmen Medis</a></li>
                                    <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/MedisRanapPulang">Pasien Pulang</a></li>
                                    <!-- <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/WLPRanap">Work Load Perawat</a></li>
                                    <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/WLMDRanap">Work Load CPPT Medis</a></li>
                                    <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/WLResumeMedis">Work Load </br>Resume Medis</a></li> -->
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">IBS<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/Prabedah">Pra Bedah</a></li>
                                    <li><a href="#">Intra Bedah</a></li>
                                    <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/PascaBedah">Pasca Bedah</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Penunjang<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/Radiologi">Radiologi</a></li>
                                    <li><a href="#">Patologi Klinik</a></li>
                                    <li><a href="#">Patologi Anatomi</a></li>
                                </ul>
                            </li>

                        </ul>
                    </li>
                <?php } ?>

                <?php if ((session()->get('level') == 0) or (session()->get('level') == 0) or (session()->get('level') == 89)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-cash-multiple"></i><span class="hide-menu">Mobilisasi Dana</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="#" class="has-arrow">Rawat Jalan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/MobilisasiDanaRajal">Arsip Digital</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedPasienMasuk">Data RM Rajal</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">IGD<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/MobilisasiDanaIGD">Arsip Digital</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedPasienMasuk/PasienMasukIGD">Data RM IGD</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Rawat Inap<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/MobilisasiDanaRanap">Arsip Digital</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedDaKuRanap">Data RM Ranap</a></li>

                                </ul>
                            </li>
                            <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-store"></i><span class="hide-menu">Amprah Barang</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/AmprahFarmasiRuangan">Barang Farmasi</a></li>
                                    <li><a href="<?= base_url(); ?>/AmprahFarmasiRuangan/DSP">Data Amprah</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if ((session()->get('level') == 0) or (session()->get('level') == 1) or (session()->get('level') == 110) or (session()->get('level') == 2)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-medical-bag"></i><span class="hide-menu">IGD</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/IGD">Pendaftaran</a></li>
                            <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/AsesmenPerawatIGD">Asesmen Perawat</a></li>
                            <li><a href="<?= base_url(); ?>/PelayananIGD">Pelayanan</a></li>
                            <li><a href="<?= base_url(); ?>/PelayananIGD/RencanaOperasi">Rencana Operasi</a></li>
                            <li><a href="<?= base_url(); ?>/IGD/Batal">Batal Pelayanan</a></li>
                            <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/MobilisasiDanaIGD">Dokumen Klaim Pasien</a></li>
                            <li><a href="<?= base_url(); ?>/KasirIGD/PindahCabar">Pindah Cara Bayar</a></li>
                            <li><a href="#" class="has-arrow">Laporan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RekMedDaKuIGD">Data Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedSepuluh/SepuluhIGD">10 Besar Penyakit</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedPasienMasuk/PasienMasukIGD">Pasien Masuk</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedPasienKeluar/PasienKeluarIGD">Pasien Pulang</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKu/RekapKunjunganIGD">Rekap Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKCB/RekapCabarIGD">Rekap Cara Bayar</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKWilayah/RekapWilayahIGD">Rekap Wilayah</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKGender/RekapGenderIGD">Rekap Jenis Kelamin</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKCaraPulang/RekapCaraPulangIGD">Rekap Cara Pulang</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedPasienMati/PasienMatiIGD">Laporan Kematian</a></li>
                                    <li><a href="<?= base_url(); ?>/PelayananBedInfo">Bed Info</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 2) or (session()->get('level') == 14) or (session()->get('level') == 107)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-hospital-building"></i><span class="hide-menu">Rawat Jalan</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/RawatJalan">Pendaftaran</a></li>
                            <li><a href="<?= base_url(); ?>/RawatJalan/MobileJkn">Mobile JKN</a></li>
                            <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME">Asesmen Perawat</a></li>
                            <li><a href="<?= base_url(); ?>/PelayananRawatJalan">Pelayanan</a></li>
                            <li><a href="<?= base_url(); ?>/PelayananRawatJalan/RegisterPerjanjian">Pasien Perjanjian</a></li>
                            <li><a href="<?= base_url(); ?>/RawatJalan/Batal">Batal Pelayanan</a></li>
                            <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/MobilisasiDanaRajal">Berkas Klaim Pasien</a></li>
                            <li><a href="<?= base_url(); ?>/KasirRJ/PindahCabar">Pindah Cara Bayar</a></li>
                            <li><a href="#" class="has-arrow">Laporan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RekMedDaKuRajal">Data Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedSepuluh">10 Besar Penyakit</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedPasienMasuk">Pasien Masuk</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedPasienKeluar">Pasien Pulang</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKu">Rekap Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKCB">Rekap Cara Bayar</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKWilayah">Rekap Wilayah</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKGender">Rekap Jenis Kelamin</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKCaraPulang">Rekap Cara Pulang</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 3) or (session()->get('level') == 1) or (session()->get('level') == 2) or (session()->get('level') == 87) or (session()->get('level') == 89) or (session()->get('level') == 109)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-hotel"></i><span class="hide-menu">Rawat Inap</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/PendaftaranRanap">Pendaftaran</a></li>
                            <li><a href="<?= base_url(); ?>/DPMRI">Data Pasien Masuk</a></li>
                            <li><a href="<?= base_url(); ?>/ValidasiDaftarRanap">Validasi Pasien Masuk</a></li>
                            <li><a href="<?= base_url(); ?>/ValidasiDaftarRanap/ValidasiPindah">Validasi Pasien Pindah</a></li>
                            <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/AsesmenPerawatRanap">Asesmen Perawat</a></li>
                            <li><a href="<?= base_url(); ?>/PasienRanap/Dact">Pelayanan Ranap</a></li>
                            <li><a href="<?= base_url(); ?>/PelayananRanap/PasienPulang">Daftar Pasien Pulang</a></li>
                            <li><a href="<?= base_url(); ?>/PelayananRawatJalanRME/MobilisasiDanaRanap">Berkas Klaim Pasien</a></li>
                            <li><a href="<?= base_url(); ?>/KasirRanap/PaymentChange">Pindah Cara Bayar</a></li>
                            <li><a href="#" class="has-arrow">Aksi Lain<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/PelayananRanap/PasienPindah">Pindah Kamar</a></li>
                                    <li><a href="#">Pindah Cara Bayar</a></li>
                                    <li><a href="<?= base_url(); ?>/VclaimAntrean/MonitoringKunjungan">Data SEP Terbit</a></li>
                                    <li><a href="<?= base_url(); ?>/PasienRanap/Jendela">Jendela Informasi</a></li>
                                    <li><a href="<?= base_url(); ?>/PelayananBedInfoRanap">Bed Info</a></li>
                                </ul>
                            <li><a href="#" class="has-arrow">Farmasi<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganRanap">Amprah Farmasi</a></li>
                                    <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganRanap/DSP">Data Amprah</a></li>
                                    <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganRanap/Distribusi">Penerimaan Distribusi</a></li>
                                    <li><a href="<?= base_url(); ?>/PasienRanapAKHP/Akhp">Pemakaian AKHP/BHP</a></li>

                                    <li><a href="<?= base_url(); ?>/StockOpnameRuangan">Stock Opname</a></li>
                                    <li><a href="<?= base_url(); ?>/StockOpnameRuangan/DSO">Data Stock Opname</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanFarmasiRuangan">Data Stok Terkini</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanFarmasiRuangan/RekapRatingObat">Rating Pemakaian AKHP BHP</a></li>
                                    <li><a href="<?= base_url(); ?>/PasienRanapAKHP/PasienPindah">AKHP/BHP Pasien Pindah</a></li>
                                    <li><a href="<?= base_url(); ?>/PasienRanapAKHP/PasienPulang">AKHP/BHP Pasien Pulang</a></li>
                                </ul>


                            <li><a href="#" class="has-arrow">Laporan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RekMedDaKuRanap">Data Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedCodingRanap">Coding Diagnosa</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedCodingRanap/LapCoding">Laporan Coding</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedSepuluh/SepuluhRanap">10 Besar Penyakit</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedPasienMasuk/PasienMasukRanap">Pasien Masuk</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedPasienKeluar/PasienKeluarRanap">Pasien Pulang</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKu/RekapKunjunganRanap">Rekap Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKCB/RekapCabarRanap">Rekap Cara Bayar</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKWilayah/RekapWilayahRanap">Rekap Wilayah</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKGender/RekapGenderRanap">Rekap Jenis Kelamin</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKCaraPulang/RekapCaraPulangRanap">Rekap Cara Pulang</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedPasienMati/PasienMatiRanap">Laporan Kematian</a></li>
                                    <li><a href="<?= base_url(); ?>/PelayananRanap/PasienPulangSensus">Sensus Pasien Pulang</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 4) or (session()->get('level') == 16)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-timetable"></i><span class="hide-menu">Bedah Sentral</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/AbuyaUci">Input Jadwal Manual</a></li>
                            <li><a href="<?= base_url(); ?>/JadwalIBS">Data Jadwal</a></li>
                            <li><a href="<?= base_url(); ?>/rawatinap/PendaftaranIBSRajal">Pendaftaran Rajal</a></li>
                            <li><a href="<?= base_url(); ?>/rawatinap/PendaftaranIBSIGD">Pendaftaran IGD</a></li>
                            <li><a href="<?= base_url(); ?>/rawatinap">Pendaftaran Ranap</a></li>
                            <li><a href="<?= base_url(); ?>/icd">Pelayanan</a></li>
                            <li><a href="<?= base_url(); ?>/EdukasiBedah">Pra Bedah</a></li>
                            <li><a href="<?= base_url(); ?>/PascaBedah">Intra Bedah</a></li>
                            <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganIBS">Amprah Barang Farmasi</a></li>
                            <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganIBS/DSP">Data Amprah</a></li>
                            <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganIBS/Distribusi">Penerimaan Distribusi</a></li>
                            <li><a href="<?= base_url(); ?>/icdAKHP">Pemakaian AKHP/BHP</a></li>
                            <li><a href="<?= base_url(); ?>/StockOpnameIBS">Stock Opname</a></li>
                            <li><a href="<?= base_url(); ?>/StockOpnameIBS/DSO">Data Stock Opname</a></li>
                            <li><a href="#" class="has-arrow">Laporan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RekMedIBS">Detail Operasi</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKnj">Rekap Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKnjWilayah">Rekap Wilayah</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKelas">Rekap Per Kelas</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKelas/JnsOp">Rekap Jenis Operasi</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKelas/JnsCabar">Rekap Cara Bayar</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKnjWilayah/JenKel">Rekap Jenis Kelamin</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKelas/JenisSMF">Rekap SMF</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKelas/DokterOperator">Rekap Dokter Operator</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKelas/DokterAnestesi">Rekap Dokter Anestesi</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 4) or (session()->get('level') == 76)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-kodi"></i><span class="hide-menu">Cathlab</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/rawatinapCathLab/PendaftaranIBSRajal">Pendaftaran Rajal</a></li>
                            <li><a href="<?= base_url(); ?>/rawatinapCathLab/PendaftaranIBSIGD">Pendaftaran IGD</a></li>
                            <li><a href="<?= base_url(); ?>/rawatinapCathLab">Pendaftaran Ranap</a></li>
                            <li><a href="<?= base_url(); ?>/PelayananRegisterCathLab">Pelayanan</a></li>
                            <li><a href="<?= base_url(); ?>/EdukasiBedah">Pra Bedah</a></li>
                            <li><a href="<?= base_url(); ?>/PascaBedah">Intra Bedah</a></li>
                            <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganIBS">Amprah Barang Farmasi</a></li>
                            <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganIBS/DSP">Data Amprah</a></li>
                            <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganIBS/Distribusi">Penerimaan Distribusi</a></li>
                            <li><a href="<?= base_url(); ?>/icdAKHPCL">Pemakaian AKHP/BHP</a></li>
                            <li><a href="<?= base_url(); ?>/StockOpnameIBS">Stock Opname</a></li>
                            <li><a href="<?= base_url(); ?>/StockOpnameIBS/DSO">Data Stock Opname</a></li>
                            <li><a href="<?= base_url(); ?>/LaporanFarmasiCL">Data Stok Terkini</a></li>
                            <li><a href="#" class="has-arrow">Laporan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RekMedIBS">Detail Operasi</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKnj">Rekap Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKnjWilayah">Rekap Wilayah</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKelas">Rekap Per Kelas</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKelas/JnsOp">Rekap Jenis Operasi</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKelas/JnsCabar">Rekap Cara Bayar</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKnjWilayah/JenKel">Rekap Jenis Kelamin</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKelas/JenisSMF">Rekap SMF</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKelas/DokterOperator">Rekap Dokter Operator</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKelas/DokterAnestesi">Rekap Dokter Anestesi</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 5) or (session()->get('level') == 2)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-ticket"></i><span class="hide-menu">Laboratorium</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/RegisterLPK">Pendaftaran</a></li>
                            <li><a href="<?= base_url(); ?>/PelayananRegisterLPK">Pelayanan</a></li>
                            <li><a href="#" class="has-arrow">Bridging Lis<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/SentLis">Data Sent LIS</a></li>
                                    <li><a href="<?= base_url(); ?>/FeedLis">Data Feedbcak LIS</a></li>
                                </ul>
                            </li>
                            <li><a href="<?= base_url(); ?>/PasienLPK/Expertise">Data Expertise</a></li>
                            <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganPK">Amprah</a></li>
                            <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganPK/DSP">Data Amprah</a></li>
                            <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganPK/Distribusi">Data Penerimaan Dist</a></li>
                            <li><a href="#" class="has-arrow">Laporan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RekMedLPK">Detail Pemeriksaan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekCBLPK">Rekap Cara Bayar</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekWilayahPenunjang/LPK">Rekap Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekWilayahPNJPem/LPK">Rekap Wilayah</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekGenderPNJPem/LPK">Rekap Jenis Kelamin</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 6)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-developer-board"></i><span class="hide-menu">Patologi Anatomi</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/RegisterLPA">Pendaftaran</a></li>
                            <li><a href="<?= base_url(); ?>/PelayananRegisterLPA">Pelayanan</a></li>
                            <li><a href="<?= base_url(); ?>/PasienLPA/Expertise">Data Expertise</a></li>
                            <li><a href="<?= base_url(); ?>/PasienLPK/Expertise">Data Expertise</a></li>
                            <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganPA">Amprah</a></li>
                            <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganPA/DSP">Data Amprah</a></li>
                            <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganPA/Distribusi">Data Penerimaan Dist</a></li>
                            <li><a href="#" class="has-arrow">Laporan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RekMedLPA">Detail Pemeriksaan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekCBLPA">Rekap Cara Bayar</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekWilayahPenunjang/LPA">Rekap Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekWilayahPNJPem/LPA">Rekap Wilayah</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekGenderPNJPem/LPA">Rekap Jenis Kelamin</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 7) or (session()->get('level') == 2)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-table"></i><span class="hide-menu">Radiologi</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/RegisterRAD">Pendaftaran</a></li>
                            <li><a href="<?= base_url(); ?>/PasienRadiologi">Pelayanan</a></li>
                            <li><a href="<?= base_url(); ?>/PasienRadiologi/Expertise">Data Expertise</a></li>
                            <li><a href="#" class="has-arrow">Laporan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RekMedRAD">Detail Pemeriksaan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekCBRAD">Rekap Cara Bayar</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekWilayahPenunjang">Rekap Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekWilayahPNJPem">Rekap Wilayah</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekGenderPNJPem">Rekap Jenis Kelamin</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 8)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-yelp"></i><span class="hide-menu">Bank Darah</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/RegisterBD">Pendaftaran</a></li>
                            <li><a href="<?= base_url(); ?>/PelayananRegisterBD">Pelayanan</a></li>
                            <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganBD">Amprah</a></li>
                            <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganBD/DSP">Data Amprah</a></li>
                            <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganBD/Distribusi">Data Penerimaan Dist</a></li>
                            <li><a href="#" class="has-arrow">Laporan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RekMedBD">Detail Pemeriksaan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekCBBD">Rekap Cara Bayar</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekWilayahPenunjang/BD">Rekap Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekWilayahPNJPem/BD">Rekap Wilayah</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekGenderPNJPem/BD">Rekap Jenis Kelamin</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 9) or (session()->get('level') == 88)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-pharmacy"></i><span class="hide-menu">Instalasi Farmasi</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="#" class="has-arrow">Master Data<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/PenelaahResep">Petugas Resep</a></li>
                                    <li><a href="#">Aturan eTicket</a></li>
                                    <li><a href="#">Cara Pakai eTicket</a></li>
                                    <li><a href="#">Petunjuk eTicket</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Transaksi Masuk<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/StockOpnameDepo">Stok Opname</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanGudangFarmasi/Distribusi">Distribusi</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Permintaan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/AmprahFarmasi">Amprah Barang</a></li>
                                    <li><a href="#">Retur Barang</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Penjualan Rajal<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/FarmasiPelayananRajal">Pelayanan Resep</a></li>
                                    <li><a href="<?= base_url(); ?>/FarmasiPelayananRajal/DFPR">Data Pelayanan</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Penjualan IGD<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/FarmasiPelayananIGD">Pelayanan Resep</a></li>
                                    <li><a href="<?= base_url(); ?>/FarmasiPelayananIGD/DFPR">Data Pelayanan</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Penjualan Ranap<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/FarmasiPelayananRanap">Pelayanan Resep</a></li>
                                    <li><a href="<?= base_url(); ?>/FarmasiPelayananRanap/DFPR">Data Pelayanan</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Penjualan IBS<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/FarmasiPelayananOK">Pelayanan Resep</a></li>
                                    <li><a href="<?= base_url(); ?>/FarmasiPelayananOK/DFPR">Data Pelayanan</a></li>

                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Penjualan Non RM<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/FarmasiPelayananNonRM">Pelayanan Resep</a></li>
                                    <li><a href="<?= base_url(); ?>/FarmasiPelayananNonRM/DFPR">Data Pelayanan</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Pelaporan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="#">Stok Barang</a></li>
                                    <li><a href="#">Kartu Stok</a></li>
                                    <li><a href="#">Kartu Stok No Batch</a></li>
                                    <li><a href="#">In Dari Gudang</a></li>
                                    <li><a href="#">In Antar Depo</a></li>
                                    <li><a href="#">Distribusi Antar Depo</a></li>
                                    <li><a href="#">Retur Ke Gudang</a></li>
                                    <li><a href="#">Rekap Pelayanan</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 9) or (session()->get('level') == 73) or (session()->get('level') == 74) or (session()->get('level') == 88)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-chemical-weapon"></i><span class="hide-menu">Gudang Farmasi</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="#" class="has-arrow">Master Data<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/MasterObat">Data Obat</a></li>
                                    <li><a href="<?= base_url(); ?>/AKHP">Data AKHP</a></li>
                                    <li><a href="<?= base_url(); ?>/BHP">Data BHP</a></li>
                                    <li><a href="<?= base_url(); ?>/GASMEDIS">Data Gas Medis</a></li>
                                    <li><a href="<?= base_url(); ?>/Supplier">Supplier(PBF)</a></li>
                                    <li><a href="<?= base_url(); ?>/Satuan">Satuan</a></li>
                                    <li><a href="<?= base_url(); ?>/MasterObat/BatchNumber">BatchNumber</a></li>
                                    <li><a href="<?= base_url(); ?>/MasterObat/Inactive">Data Obat Inactive</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Transaksi Masuk<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/ObatMasukGudang">Penerimaan PBF</a></li>
                                    <li><a href="<?= base_url(); ?>/ObatMasukGudang/NPBF">Penerimaan Non PBF</a></li>
                                    <li><a href="#">Retur Depo</a></li>
                                    <li><a href="<?= base_url(); ?>/StockOpnameGudang">Stok Opname</a></li>
                                    <li><a href="<?= base_url(); ?>/StockOpnameGudang/KoreksiBatch">Koreksi Batch</a></li>

                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Transaksi Keluar<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/DataDistribusiAmprahFarmasi/DSP">Notifikasi Amprah</a></li>
                                    <li><a href="<?= base_url(); ?>/DataDistribusiAmprahFarmasi/DSPNonACC">Amprah Belum ACC</a></li>
                                    <li><a href="<?= base_url(); ?>/DistribusiAmprahFarmasi">Distribusi Amprah</a></li>
                                    <li><a href="<?= base_url(); ?>/DataDistribusiAmprahFarmasi/DDB">Data Distribusi</a></li>
                                    <li><a href="<?= base_url(); ?>/DistribusiAmprahFarmasi/Vitual">Distribusi Vitual</a></li>
                                    <li><a href="<?= base_url(); ?>/DistribusiAmprahFarmasiBaksos">Baksos</a></li>
                                    <li><a href="<?= base_url(); ?>/ObatKeluarGudang">Retur Barang Ke PBF</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow" style="display: none;">Konsinyasi<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/ObatMasukGudangKonsinyasiReal">Penerimaan</a></li>
                                    <li><a href="<?= base_url(); ?>/DataDistribusiAmprahFarmasiKonsinyasiReal/DSP">Notifikasi Amprah</a></li>
                                    <li><a href="<?= base_url(); ?>/DistribusiAmprahFarmasiKonsinyasiReal">Distribusi Amprah</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Hibah<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/ObatMasukGudang/Hibah">Penerimaan Hibah</a></li>
                                    <li><a href="<?= base_url(); ?>/DataDistribusiAmprahFarmasi/DSPHibah">Notifikasi Amprah</a></li>
                                    <li><a href="<?= base_url(); ?>/DistribusiAmprahFarmasi/Hibah">Distribusi Hibah</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Surat Pesanan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/AmprahFarmasi/DSPesanan">Buat Surat Pesanan</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Laporan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/LaporanGudangFarmasi/KartuStock">Kartu Stok</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanGudangFarmasi/InPBF">Penerimaan Dari PBF</a></li>
                                    <li><a href="#">Retur Ke PBF</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanGudangFarmasi/Distribusi">Distribusi</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanPersediaanGudangFarmasi/Distribusi">Persediaan</a></li>
                                    <li><a href="<?= base_url(); ?>/TelusurMasterObat">Telusur Data Obat</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanGudangFarmasi/DistribusiDetail">Distribusi Tidak Penuh</a></li>
                                </ul>
                            </li>


                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 73) or (session()->get('level') == 74) or (session()->get('level') == 9)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-chemical-weapon"></i><span class="hide-menu">Laporan Gudang</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="#" class="has-arrow">Laporan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/LaporanGudangFarmasi">Stok Barang</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanGudangFarmasi/KartuStock">Kartu Stok</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanGudangFarmasi/InPBF">Penerimaan Dari PBF</a></li>
                                    <li><a href="#">Retur Ke PBF</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanGudangFarmasi/Distribusi">Distribusi</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanPersediaanGudangFarmasi/Distribusi">Persediaan</a></li>
                                    <li><a href="<?= base_url(); ?>/TelusurMasterObat">Telusur Data Obat</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanGudangFarmasi/DistribusiDetail">Distribusi Tidak Penuh</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanGudangFarmasi/PengeluaranDepo">Pengeluaran Depo</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanGudangFarmasi/RekapResepPenelaah">Penelaah Resep</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanGudangFarmasi/RekapResepEntri">Operator Entri</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanGudangFarmasi/RekapResepNarkotik">Pemakaian Narkotika</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanGudangFarmasi/RekapResepPsiko">Pemakaian Psikotropika</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 11)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-ambulance"></i><span class="hide-menu">Ambulan &Forensik</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="#" class="has-arrow">Ambulance<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RegisterABL">Pendaftaran</a></li>
                                    <li><a href="<?= base_url(); ?>/PasienABL">Pelayanan</a></li>
                                    <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganABL">Amprah</a></li>
                                    <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganABL/DSP">Data Amprah</a></li>
                                    <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganABL/Distribusi">Data Penerimaan Dist</a></li>
                                    <li><a href="#" class="has-arrow">Laporan<span class="badge badge-success badge-pill"></span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="<?= base_url(); ?>/RekMedABL">Detail Pelayanan</a></li>
                                            <li><a href="<?= base_url(); ?>/RekMedRekCBABL">Rekap Cara Bayar</a></li>
                                            <li><a href="<?= base_url(); ?>/RekMedRekWilayahPenunjang/ABL">Rekap Kunjungan</a></li>
                                            <li><a href="<?= base_url(); ?>/RekMedRekWilayahPNJPem/ABL">Rekap Wilayah</a></li>
                                            <li><a href="<?= base_url(); ?>/RekMedRekGenderPNJPem/ABL">Rekap Jenis Kelamin</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Forensik<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RegisterFRS">Pendaftaran</a></li>
                                    <li><a href="<?= base_url(); ?>/PasienFRS">Pelayanan</a></li>
                                    <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganFRS">Amprah</a></li>
                                    <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganFRS/DSP">Data Amprah</a></li>
                                    <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganFRS/Distribusi">Data Penerimaan Dist</a></li>
                                    <li><a href="#" class="has-arrow">Laporan<span class="badge badge-success badge-pill"></span></a>
                                        <ul aria-expanded="false" class="collapse">
                                            <li><a href="<?= base_url(); ?>/RekMedFRS">Detail Pelayanan</a></li>
                                            <li><a href="<?= base_url(); ?>/RekMedRekCBFRS">Rekap Cara Bayar</a></li>
                                            <li><a href="<?= base_url(); ?>/RekMedRekWilayahPenunjang/FRS">Rekap Kunjungan</a></li>
                                            <li><a href="<?= base_url(); ?>/RekMedRekWilayahPNJPem/FRS">Rekap Wilayah</a></li>
                                            <li><a href="<?= base_url(); ?>/RekMedRekGenderPNJPem/FRS">Rekap Jenis Kelamin</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if ((session()->get('level') == 0) or (session()->get('level') == 17) or (session()->get('level') == 14)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-dribbble-box"></i><span class="hide-menu">Hemodialisa</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/RegisterHD">Pendaftaran</a></li>
                            <li><a href="<?= base_url(); ?>/PasienHD">Pelayanan</a></li>
                            <li><a href="#" class="has-arrow">Laporan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="#">Detail Pemeriksaan</a></li>
                                    <li><a href="#">Rekap Cara Bayar</a></li>
                                    <li><a href="#">Rekap Kunjungan</a></li>
                                    <li><a href="#">Rekap Wilayah</a></li>
                                    <li><a href="#">Rekap Jenis Kelamin</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 15)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-google-physical-web"></i><span class="hide-menu">Rehab Medik</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/RegisterRHM">Pendaftaran</a></li>
                            <li><a href="<?= base_url(); ?>/PelayananRegisterRHM">Pelayanan</a></li>
                            <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganRHM">Amprah</a></li>
                            <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganRHM/DSP">Data Amprah</a></li>
                            <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganRHM/Distribusi">Data Penerimaan Dist</a></li>
                            <li><a href="#" class="has-arrow">Laporan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="#">Detail Pemeriksaan</a></li>
                                    <li><a href="#">Rekap Cara Bayar</a></li>
                                    <li><a href="#">Rekap Kunjungan</a></li>
                                    <li><a href="#">Rekap Wilayah</a></li>
                                    <li><a href="#">Rekap Jenis Kelamin</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 12)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-cash-multiple"></i><span class="hide-menu">Kasir&Verifikasi</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="#" class="has-arrow">Rawat Jalan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/PelayananRawatJalan/VerifikasiRincian">Verifikasi Rincian</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRJ/Validasi">Pembayaran</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRJ/ValidasiTindakan">Pembayaran Tindakan</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRJ/AfterValidasi">Data Validasi</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRJ/BeritaAcara">Berita Acara</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRJ/BeritaAcaraKarcis">BA Validasi Karcis</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRJ/BeritaAcaraTindakan">BA Validasi Tindakan</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRJ/PindahCabar">Pindah Cara Bayar</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">IGD<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/PelayananIGD/VerifikasiRincian">Verifikasi Rincian</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirIGD/Validasi">Pembayaran</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirIGD/AfterValidasi">Data Validasi</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirIGD/BeritaAcara">Berita Acara</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirIGD/PindahCabar">Pindah Cara Bayar</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Rawat Inap<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/PelayananRanap/VerifikasiRincian">Verifikasi Rincian</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRanap/Validasi">Pembayaran</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRanap/AfterValidasi">Data Validasi</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRanap/BeritaAcara">Berita Acara</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRanap/UangMuka">Uang Muka</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRanap/PaymentChange">Pindah Cara Bayar</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRanap/ClassroomChange">Pindah Hak kelas</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Penunjang<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/KasirRAD/Validasi">Validasi Pembayaran</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRAD/AfterValidasi">Data Validasi</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRAD/BeritaAcara">Berita Acara</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Farmasi<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/KasirFAR/Validasi">Validasi Pembayaran</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirFAR/AfterValidasi">Data Validasi</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirFAR/BeritaAcara">Berita Acara</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Laporan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/KasirRJ/LogBatalValidasi">Log Batal Validasi</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRanap/LaporanPenerimaan">Penerimaan Kasir</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRanap/LaporanPiutang">Data Piutang</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRanap/LaporanValidasiDetail">Data Validasi Detail</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRJ/LaporanKarcisRajal">Karcis Rajal</a></li>
                                    <li><a href="<?= base_url(); ?>/KasirRJ/LaporanRekapPendapatan">Rekap Pendapatan</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 13)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-database"></i><span class="hide-menu">Rekam Medis</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="#" class="has-arrow">Rawat Jalan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RawatJalan/TracertRajal">Tracert Rawat Jalan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedDaKuRajal">Data Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedCodingRajal">Coding Diagnosa</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedCodingRajal/LapCoding">Laporan Coding</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedSepuluh">10 Besar Penyakit</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedPasienMasuk">Pasien Masuk</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedPasienKeluar">Pasien Pulang</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKu">Rekap Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKCB">Rekap Cara Bayar</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKWilayah">Rekap Wilayah</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKGender">Rekap Jenis Kelamin</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKCaraPulang">Rekap Cara Pulang</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">IGD<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RekMedDaKuIGD">Data Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedCodingIGD">Coding Diagnosa</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedCodingIGD/LapCoding">Laporan Coding</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedSepuluh/SepuluhIGD">10 Besar Penyakit</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedPasienMasuk/PasienMasukIGD">Pasien Masuk</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedPasienKeluar/PasienKeluarIGD">Pasien Pulang</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKu/RekapKunjunganIGD">Rekap Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKCB/RekapCabarIGD">Rekap Cara Bayar</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKWilayah/RekapWilayahIGD">Rekap Wilayah</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKGender/RekapGenderIGD">Rekap Jenis Kelamin</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKCaraPulang/RekapCaraPulangIGD">Rekap Cara Pulang</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedPasienMati/PasienMatiIGD">Laporan Kematian</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Rawat Inap<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RekMedDaKuRanap">Data Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedCodingRanap">Coding Diagnosa</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedCodingRanap/LapCoding">Laporan Coding</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedSepuluh/SepuluhRanap">10 Besar Penyakit</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedPasienMasuk/PasienMasukRanap">Pasien Masuk</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedPasienKeluar/PasienKeluarRanap">Pasien Pulang</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKu/RekapKunjunganRanap">Rekap Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKCB/RekapCabarRanap">Rekap Cara Bayar</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKWilayah/RekapWilayahRanap">Rekap Wilayah</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKGender/RekapGenderRanap">Rekap Jenis Kelamin</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedReKCaraPulang/RekapCaraPulangRanap">Rekap Cara Pulang</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedPasienMati/PasienMatiRanap">Laporan Kematian</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Radiologi<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RekMedRAD">Detail Pemeriksaan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekCBRAD">Rekap Cara Bayar</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekWilayahPenunjang">Rekap Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekWilayahPNJPem">Rekap Wilayah</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekGenderPNJPem">Rekap Jenis Kelamin</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Patologi Klinik<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RekMedLPK">Detail Pemeriksaan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekCBLPK">Rekap Cara Bayar</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekWilayahPenunjang/LPK">Rekap Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekWilayahPNJPem/LPK">Rekap Wilayah</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekGenderPNJPem/LPK">Rekap Jenis Kelamin</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Patologi Anatomi<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RekMedLPA">Detail Pemeriksaan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekCBLPA">Rekap Cara Bayar</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekWilayahPenunjang/LPA">Rekap Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekWilayahPNJPem/LPA">Rekap Wilayah</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekGenderPNJPem/LPA">Rekap Jenis Kelamin</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Bank Darah<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RekMedBD">Detail Pemeriksaan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekCBBD">Rekap Cara Bayar</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekWilayahPenunjang/BD">Rekap Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekWilayahPNJPem/BD">Rekap Wilayah</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedRekGenderPNJPem/BD">Rekap Jenis Kelamin</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Bedah Sentral<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RekMedIBS">Detail Operasi</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKnj">Rekap Kunjungan</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKnjWilayah">Rekap Wilayah</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKelas">Rekap Per Kelas</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKelas/JnsOp">Rekap Jenis Operasi</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKelas/JnsCabar">Rekap Cara Bayar</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKnjWilayah/JenKel">Rekap Jenis Kelamin</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKelas/JenisSMF">Rekap SMF</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKelas/DokterOperator">Rekap Dokter Operator</a></li>
                                    <li><a href="<?= base_url(); ?>/RekMedIBSKelas/DokterAnestesi">Rekap Dokter Anestesi</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Rekap Laporan(RL)<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/RL/RL31">3.1 Rawat Inap</a></li>
                                    <li><a href="<?= base_url(); ?>/RL">3.3 Gigi Mulut</a></li>
                                    <li><a href="<?= base_url(); ?>/RL/RL36">3.6 Pembedahan</a></li>
                                    <li><a href="<?= base_url(); ?>/RL/RL37">3.7 Radiologi</a></li>
                                    <li><a href="<?= base_url(); ?>/RL/RL38">3.8 Laboratorium</a></li>
                                    <li><a href="<?= base_url(); ?>/RL/RL39">3.9 Rehab Medik</a></li>
                                    <li><a href="<?= base_url(); ?>/RL/RL310">3.10 PelKhusus</a></li>
                                    <li><a href="<?= base_url(); ?>/RL/RL311Rajal">3.11 Jiwa(Rajal)</a></li>
                                    <li><a href="<?= base_url(); ?>/RL/RL311Ranap">3.11 Jiwa(Ranap)</a></li>
                                    <li><a href="#">3.12 KB</a></li>
                                    <li><a href="#">3.13 Obat & Resep</a></li>
                                    <li><a href="<?= base_url(); ?>/RL/RL314">3.14 Rujukan Rajal</a></li>
                                    <li><a href="<?= base_url(); ?>/RL/RL314IGD">3.14 Rujukan IGD</a></li>
                                    <li><a href="<?= base_url(); ?>/RL/RL314Ranap">3.14 Rujukan Ranap</a></li>
                                    <li><a href="<?= base_url(); ?>/RL/RL4A">4A Morbiditas Ranap</a></li>
                                    <li><a href="<?= base_url(); ?>/RL/RL4B">4B Morbiditas Rajal</a></li>
                                    <li><a href="<?= base_url(); ?>/RL/RL51">5.1 Lama Baru</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Master Data<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/MDP">Pasien</a></li>
                                    <li><a href="<?= base_url(); ?>/Diagnosa">Diagnosa</a></li>
                                    <li><a href="<?= base_url(); ?>/Prosedur">Prosedur</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 12)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-credit-card-scan"></i><span class="hide-menu">Klaim</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="#" class="has-arrow">Rawat Jalan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/KlaimRawatJalan/Klaim">Posting Klaim</a></li>
                                    <li><a href="<?= base_url(); ?>/KlaimRawatJalan/AfterKlaimRajal">Data Posting</a></li>

                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">IGD<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/KlaimIGD/Klaim">Posting Klaim</a></li>
                                    <li><a href="<?= base_url(); ?>/KlaimIGD/AfterKlaimIgd">Data Posting</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Rawat Inap<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/KlaimRanap/Klaim">Posting Klaim</a></li>
                                    <li><a href="<?= base_url(); ?>/KlaimRanap/AfterKlaimRanap">Data Posting</a></li>
                                </ul>
                            </li>

                            <li><a href="#" class="has-arrow">Laporan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="#">Klaim Rawat Jalan</a></li>
                                    <li><a href="#">Klaim IGD</a></li>
                                    <li><a href="#">Klaim Rawat Inap</a></li>

                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if ((session()->get('level') == 0) or (session()->get('level') == 70) or (session()->get('level') == 71)) { ?>
                    <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-kodi"></i><span class="hide-menu">Asisten Dokter</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="#" class="has-arrow">Rawat Jalan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/AsistenDokter">Kegiatan Hari Ini</a></li>
                                    <li><a href="<?= base_url(); ?>/AsistenDokter/RiwayatTindakan">Riwayat Tindakan</a></li>
                                    <li><a href="<?= base_url(); ?>/AsistenDokter/FKRajal">FeedBack Klaim</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">IGD<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/AsistenDokter/IGD">Kegiatan Hari Ini</a></li>
                                    <li><a href="<?= base_url(); ?>/AsistenDokter/RiwayatTindakanIGD">Riwayat Tindakan</a></li>
                                    <li><a href="<?= base_url(); ?>/AsistenDokter/FKIGD">FeedBack Klaim</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Rawat Inap<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/AsistenDokter/DPJP">Pelayanan DPJP</a></li>
                                    <li><a href="<?= base_url(); ?>/AsistenDokter/RiwayatVisite">Riwayat Visite</a></li>
                                    <li><a href="<?= base_url(); ?>/AsistenDokter/RiwayatTindakanRanap">Riwayat Tindakan</a></li>
                                    <li><a href="<?= base_url(); ?>/AsistenDokter/FKRanap">FeedBack Klaim</a></li>
                                    <li><a href="<?= base_url(); ?>/AsistenDokterClinicalPathway/Ranap">ClinicalPathway</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Bedah Sentral<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/AsistenDokter/JadwalBS">Jadwal Operasi</a></li>
                                    <li><a href="<?= base_url(); ?>/AsistenDokter/BS">Kegiatan Bedah</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Penunjang<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/AsistenDokter/Penunjang">Pemeriksaan</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Resep Farmasi<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/AsistenDokter/Resep">Riwayat Resep</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 72) or (session()->get('level') == 73) or (session()->get('level') == 9)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-credit-card-scan"></i><span class="hide-menu">Unit N-Pelayanan</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="#" class="has-arrow">Amprah Farmasi<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganNonPel">Amprah</a></li>
                                    <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganNonPel/DSP">Data Amprah</a></li>
                                    <li><a href="<?= base_url(); ?>/AmprahFarmasiRuanganNonPel/Distribusi">Data Penerimaan Dist</a></li>
                                    <li><a href="<?= base_url(); ?>/StockOpnameRuangan">Stock Opname</a></li>
                                    <li><a href="<?= base_url(); ?>/StockOpnameRuangan/DSO">Data Stock Opname</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanFarmasiRuanganNonPel">Data Stok Terkini</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanFarmasiRuangan/RekapRatingObat">Rating Pemakaian AKHP BHP</a></li>
                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Penggunaan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="#">Input Pengunaan</a></li>
                                    <li><a href="#">Data Penggunaan</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

                <?php if ((session()->get('level') == 0) or (session()->get('level') == 75)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-credit-card-scan"></i><span class="hide-menu">GAS CENTRAL</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="#" class="has-arrow">Amprah Farmasi<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/AmprahFarmasiGasCentral">Amprah</a></li>
                                    <li><a href="<?= base_url(); ?>/AmprahFarmasiGasCentral/DSP">Data Amprah</a></li>
                                    <li><a href="<?= base_url(); ?>/AmprahFarmasiGasCentral/Distribusi">Data Penerimaan Dist</a></li>

                                </ul>
                            </li>
                            <li><a href="#" class="has-arrow">Distribusi<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/DataDistribusiAmprahFarmasiGasCentral/DSP">Notifikasi Amprah</a></li>
                                    <li><a href="<?= base_url(); ?>/DistribusiAmprahFarmasiGC">Input Distribusi</a></li>
                                    <li><a href="<?= base_url(); ?>/DataDistribusiAmprahFarmasiGasCentral/DDB">Data Distribusi</a></li>
                                </ul>
                            </li>

                            <li><a href="#" class="has-arrow">Laporan<span class="badge badge-success badge-pill"></span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="<?= base_url(); ?>/LaporanGudangFarmasiGC">Stok Barang</a></li>
                                    <li><a href="<?= base_url(); ?>/LaporanGudangFarmasiGC/KartuStock">Kartu Stok</a></li>

                                </ul>
                            </li>


                        </ul>
                    </li>
                <?php } ?>
                <?php if ((session()->get('level') == 0) or (session()->get('level') == 8) or (session()->get('level') == 5) or (session()->get('level') == 6) or (session()->get('level') == 15) or (session()->get('level') == 72) or (session()->get('level') == 75)) { ?>
                    <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-yelp"></i><span class="hide-menu">SO Penunjang</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="<?= base_url(); ?>/StockOpnameRuanganPenunjang">Stock Opname</a></li>
                            <li><a href="<?= base_url(); ?>/StockOpnameRuanganPenunjang/DSO">Data SO</a></li>

                        </ul>
                    </li>
                <?php } ?>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    <div class="sidebar-footer">
        <!-- item--><a href="#" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
        <!-- item--><a href="#" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
        <!-- item--><a href="<?= base_url(); ?>/logout" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
    </div>
    <!-- End Bottom points-->
</aside>