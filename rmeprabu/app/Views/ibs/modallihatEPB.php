<div id="modallihatEPB" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body">

                <form class="form-horizontal form-material" id="formEPB" method="post" action="<?= base_url(); ?>/rawatinap/GeneratePDF">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-outline-info">
                                    <div class="card-header">
                                        <h4 class="mb-0 text-white">Dokumentasi Edukasi PraBedah</h4>
                                    </div>
                                    <div class="card-body">
                                        <form class="form-horizontal" role="form" method="post">
                                            <div class="form-body">
                                                <h5 class="p-2 rounded-title">Data Admisi</h5>
                                                <hr class="mt-0 mb-1">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">No.Rekam Medis</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"> <?= $pasienid; ?></p>
                                                                <input type="hidden" name="idbaris" id="idbaris" value="<?= $id_tproh; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Nama Pasien</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $pasienname; ?> (<?= $pasiendateofbirth; ?>)</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">JournalNumber</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $journalnumber; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">ReferenceNumber</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $referencenumber; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Cara Bayar</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $paymentmethodname; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Ruangan</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $roomname; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->
                                                <h5 class="p-2 rounded-title">Isi Dokumentasi</h5>
                                                <hr class="mt-0 mb-1">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-md-6">Pemberi Informasi</label>
                                                            <div class="col-lg-9 col-md-6">
                                                                <p class="form-control-static"><?= $pemberiinformasi; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Penerima Informasi</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $penerimainformasi; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">DPJP</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $doktername; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">SMF</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $smfname; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Diagnosis</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $diagnosis; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Kondisi Pasien</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $kondisipasien; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Manfaat Tindakan</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $manfaattindakan; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Tata cara Uraian singkat prosedur</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $tatacara; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Risiko Tindakan</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $risikotindakan; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Komplikasi Tindakan</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $komplikasitindakan; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Dampak tindakan</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $dampaktindakan; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Prognosis Tindakan</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $prognosistindakan; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Alternatif Tindakan</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $alternatif; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Bila tidak dilakukan tindakan</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $bilatidakditindak; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group has-success">

                                                            <div class="card">
                                                                <div class="el-card-item">
                                                                    <div class="el-card-avatar el-overlay-1"> <img src="<?= $signature ?>" alt="user" />
                                                                        <div class="el-overlay">
                                                                            <ul class="el-info">

                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="el-card-content">
                                                                        <h5 class="mb-0"><?= $created_at; ?></h5>
                                                                        <h5 class="mb-0"><?= $doktername; ?></h5> <small><?= $smfname; ?></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-offset-3 col-md-9">
                                                                    <button type="submit" class="btn btn-info"> <i class="fa fa-pencil"></i> Generate PDF</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6"> </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fa fa-home"></i> Kembali</button>
                    </div>

                </form>
            </div>



        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->