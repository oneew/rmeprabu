<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="mb-0 text-white">Form Clinical Pathway</h4>
            </div>
            <div class="card-body">
                <form action="#">
                    <div class="form-body">
                        <div class="row pt-1">

                            <div class="col-12 table-responsive">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th><b>Diagnosa</b></th>
                                            <th colspan="<?= $max_column; ?>" class="text-center">Length Of Stay (LOS)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pilihan_cp as $row) { ?>
                                            <tr>
                                                <td><b>
                                                        <strong><?= $row['diagnosa']; ?> [<?= $row['icd']; ?>]</strong>
                                                    </b></td>
                                                <?php for ($x = 1; $x <= $row['los']; $x++) { ?>
                                                    <td><b>Hari ke <?= $x; ?></b></td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                        <th><span class="badge badge-warning">Penunjang<span></th>
                                        <?php foreach ($penunjang_cp as $row_penunjang) { ?>
                                            <tr>
                                                <td><b><i><?= $row_penunjang['penunjang']; ?></i></b></td>
                                                <?php for ($x = 1; $x <= $row_penunjang['los']; $x++) { ?>
                                                    <td> <?php $x;  ?>
                                                        <div class="switch">
                                                            <label>
                                                                <input type="checkbox" class="js-switch" data-size="small" data-penunjang="<?= $row_penunjang['penunjang']; ?>" data-hari="<?= $x; ?>" value="0" data-color="#009efb" />
                                                            </label>
                                                        </div>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                        <th><span class="badge badge-info">Tindakan<span></th>
                                        <?php foreach ($tindakan_cp as $row_tindakan) { ?>
                                            <tr>
                                                <td><b><i><?= $row_tindakan['tindakan']; ?></i></b></td>
                                                <?php for ($x = 1; $x <= $row_tindakan['los']; $x++) { ?>
                                                    <td> <?php $x; ?>
                                                        <div class="switch tindakan">
                                                            <label>
                                                                <input type="checkbox" class="js-switch tindakan" data-size="small" data-tindakan="<?= $row_tindakan['tindakan']; ?>" data-hari="<?= $x; ?>" value="0" data-color="#009efb" />
                                                            </label>
                                                        </div>
                                                    </td>
                                                <?php } ?>

                                            </tr>
                                        <?php } ?>

                                        <th><span class="badge badge-danger">Obat<span></th>
                                        <?php foreach ($obat_cp as $row_obat) { ?>
                                            <tr>
                                                <td><b><i><?= $row_obat['obat']; ?></i></b></td>
                                                <?php for ($x = 1; $x <= $row_obat['los']; $x++) { ?>
                                                    <td> <?php $x; ?>
                                                        <div class="switch">
                                                            <label>
                                                                <input type="checkbox"><span class="lever switch-col-danger"></span></label>
                                                        </div>
                                                    </td>
                                                <?php } ?>

                                            </tr>
                                        <?php } ?>

                                        <th><span class="badge badge-success">Nutrisi<span></th>
                                        <?php foreach ($nutrisi_cp as $row_nutrisi) { ?>
                                            <tr>
                                                <td><b><i><?= $row_nutrisi['nutrisi']; ?></i></b></td>
                                                <?php for ($x = 1; $x <= $row_nutrisi['los']; $x++) { ?>
                                                    <td> <?php $x; ?>
                                                        <div class="switch">
                                                            <label>
                                                                <input type="checkbox"><span class="lever switch-col-danger"></span></label>
                                                        </div>
                                                    </td>
                                                <?php } ?>

                                            </tr>
                                        <?php } ?>

                                        <th><span class="badge badge-info">Mobilisasi<span></th>
                                        <?php foreach ($mobilisasi_cp as $row_mobilisasi) { ?>
                                            <tr>
                                                <td><b><i><?= $row_mobilisasi['mobilisasi']; ?></i></b></td>
                                                <?php for ($x = 1; $x <= $row_mobilisasi['los']; $x++) { ?>
                                                    <td> <?php $x; ?>
                                                        <div class="switch">
                                                            <label>
                                                                <input type="checkbox"><span class="lever switch-col-danger"></span></label>
                                                        </div>
                                                    </td>
                                                <?php } ?>

                                            </tr>
                                        <?php } ?>
                                        <th><span class="badge badge-dark">Hasil (Outcome)<span></th>
                                        <?php foreach ($hasil_cp as $row_hasil) { ?>
                                            <tr>
                                                <td><b><i><?= $row_hasil['hasil']; ?></i></b></td>
                                                <?php for ($x = 1; $x <= $row_hasil['los']; $x++) { ?>
                                                    <td> <?php $x; ?>
                                                        <div class="switch">
                                                            <label>
                                                                <input type="checkbox"><span class="lever switch-col-danger"></span></label>
                                                        </div>
                                                    </td>
                                                <?php } ?>

                                            </tr>
                                        <?php } ?>
                                        <th><span class="badge badge-dark">Pendidikan / Rencana Pemulangan<span></th>
                                        <?php foreach ($rencana_cp as $row_rencana) { ?>
                                            <tr>
                                                <td><b><i><?= $row_rencana['rencana']; ?></i></b></td>
                                                <?php for ($x = 1; $x <= $row_rencana['los']; $x++) { ?>
                                                    <td> <?php $x; ?>
                                                        <div class="switch">
                                                            <label>
                                                                <input type="checkbox"><span class="lever switch-col-danger"></span></label>
                                                        </div>
                                                    </td>
                                                <?php } ?>

                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>

                            <!--/span-->
                        </div>
                    </div>
                </form>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success btnsimpan"> <i class="fa fa-check"></i>
                        Save</button>
                    <button type="button" class="btn btn-inverse">Cancel</button>
                    <input type="hidden" id="createdBy" name="createdBy" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                </div>
            </div>


        </div>
    </div>
</div>
</div>
<script src="<?= base_url(); ?>/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<script src="<?= base_url(); ?>/assets/plugins/switchery/dist/switchery.min.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

<script>
    $(document).ready(function() {
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        $('.js-switch').on('change', function() {
            let aksi = '';
            if ($(this).val() == 1) {
                $(this).val(0);
                aksi = 'hapus';
            } else {
                $(this).val(1);
                aksi = 'tambah';
            }
            let penunjang = $(this).data('penunjang');
            let hari = $(this).data('hari');
            alert('Penunjang : ' + penunjang + '. ' + hari + '. aksi : ' + aksi);
        })
    });
</script>