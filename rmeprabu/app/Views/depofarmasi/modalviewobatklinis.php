<link href="<?= base_url(); ?>/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

<div id="modalviewobatklinis" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fullWidthModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="fullWidthModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="#">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-outline-info">
                                    <div class="card-header">
                                        <?php
                                        foreach ($dataobatklinis as $row) :
                                        ?>

                                            <h4 class="mb-0 text-white">Uraian Obat [ <?= $row['name']; ?> ]</h4>
                                    </div>
                                    <div class="card-body">
                                        <form class="form-horizontal" role="form">
                                            <div class="form-body">

                                                <hr class="mt-0 mb-5">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Catatan:</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"> <?= $row['memo']; ?> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Produksi:</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $row['production']; ?> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Pabrik:</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"> <?= $row['manufacturename']; ?> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Nama Dagang :</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"> <?= $row['tradename']; ?> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Nama Original :</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"> <?= $row['originalname']; ?> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Kategori :</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"> <?= $row['category']; ?> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->
                                                <h3 class="p-2 rounded-title">Komposisi</h3>
                                                <hr class="mt-0 mb-5">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-md-6">Komposisi :</label>
                                                            <div class="col-lg-9 col-md-6">
                                                                <p class="form-control-static"> <?= $row['composition']; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Jenis :</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"><?= $row['groups']; ?> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Level Sakit :</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"> <?= $row['sicklevel']; ?> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Resiko Pada Ibu Hamil :</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"> <?= $row['pregnantriskname']; ?> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Obat Terapi :</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"> <?= $row['classteraphyname']; ?> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Obat Sub Terapi :</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"> <?= $row['subclassteraphyname']; ?> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Efek Hati :</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"> <?= $row['heartindication']; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h3 class="p-2 rounded-title">Aturan Pakai</h3>
                                                <hr class="mt-0 mb-5">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Aturan Sebelum Makan :</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"> <?= $row['ac']; ?> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Aturan Ketika Makan :</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"> <?= $row['dc']; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Aturan Sesudah Makan :</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"> <?= $row['pc']; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group row">
                                                            <label class="control-label text-lg-right col-lg-3 col-6">Etiket :</label>
                                                            <div class="col-lg-9 col-6">
                                                                <p class="form-control-static"> <?= $row['eticket']; ?> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php endforeach; ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->