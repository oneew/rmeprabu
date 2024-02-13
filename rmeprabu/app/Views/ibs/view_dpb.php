<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<?php
$attr_1 = $book['edukasibedah'] == 1 ? 'checked' : '';
$attr_2 = $book['status'] == 1 ? 'checked' : '';
$attr_3 = $book['konsultasidpjplain'] == 1 ? 'checked' : '';
$attr_4 = $book['persetujuanoperasi'] == 1 ? 'checked' : '';
$attr_5 = $book['edukasidarah'] == 1 ? 'checked' : '';
$attr_6 = $book['persetujuandarah'] == 1 ? 'checked' : '';
$attr_7 = $book['dokumensitemarking'] == 1 ? 'checked' : '';
$attr_8 = $book['assessmentulang'] == 1 ? 'checked' : '';
$attr_9 = $book['tindaklanjut'] == 1 ? 'checked' : '';
$attr_10 = $book['assessmentpraanestesi'] == 1 ? 'checked' : '';
$attr_11 = $book['edukasianestesi'] == 1 ? 'checked' : '';
$attr_12 = $book['suratijinanestesi'] == 1 ? 'checked' : '';

?>


<div class="container-fluid">
    <div class="row">
        <!-- switch 1 edukasi bedah -->
        <div class="px-4 col-6 mt-4 d-flex justify-content-between">
            <label class="label-toggle">
                Edukasi bedah
            </label>
            <input type="checkbox" <?= $attr_1; ?> data-switch="<?= $book['edukasibedah']; ?>" data-field="edukasibedah" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="edukasibedah-<?= $book['id']; ?>" name="edukasibedah" data-toggle="toggle" data-on="Ya" data-off="tidak">
        </div>

        <!-- switch 2 status -->
        <div class="px-4 col-6 mt-4 d-flex justify-content-between">
            <label class="label-toggle">
                Status
            </label>
            <input type="checkbox" <?= $attr_2; ?> data-switch="<?= $book['status']; ?>" data-field="status" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="status-<?= $book['id']; ?>" name="status" data-toggle="toggle" data-on="S" data-off="B">
        </div>

        <!-- switch 3 konsultasidpjplain -->
        <div class="px-4 col-6 mt-4 d-flex justify-content-between">
            <label class="label-toggle">
                Konsultasi Ke DPJP Lain
            </label>
            <input type="checkbox" <?= $attr_3; ?> data-switch="<?= $book['konsultasidpjplain']; ?>" data-field="konsultasidpjplain" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="konsultasidpjplain-<?= $book['id']; ?>" name="konsultasidpjplain" data-toggle="toggle" data-on="Ya" data-off="tidak">
        </div>

        <!-- switch 4 persetujuanoperasi -->
        <div class="px-4 col-6 mt-4 d-flex justify-content-between">
            <label class="label-toggle">
                Persetujuan operasi
            </label>
            <input type="checkbox" <?= $attr_4; ?> data-switch="<?= $book['persetujuanoperasi']; ?>" data-field="persetujuanoperasi" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="persetujuanoperasi-<?= $book['id']; ?>" name="persetujuanoperasi" data-toggle="toggle" data-on="Ya" data-off="tidak">
        </div>

        <!-- switch 5 edukasidarah -->
        <div class="px-4 col-6 mt-4 d-flex justify-content-between">
            <label class="label-toggle">
                Edukasi darah
            </label>
            <input type="checkbox" <?= $attr_5; ?> data-switch="<?= $book['edukasidarah']; ?>" data-field="edukasidarah" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="edukasidarah-<?= $book['id']; ?>" name="edukasidarah" data-toggle="toggle" data-on="Ya" data-off="tidak">
        </div>

        <!-- switch 6 persetujuandarah -->
        <div class="px-4 col-6 mt-4 d-flex justify-content-between">
            <label class="label-toggle">
                Persetujuan darah
            </label>
            <input type="checkbox" <?= $attr_6; ?> data-switch="<?= $book['persetujuandarah']; ?>" data-field="persetujuandarah" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="persetujuandarah-<?= $book['id']; ?>" name="persetujuandarah" data-toggle="toggle" data-on="Ya" data-off="tidak">
        </div>

        <!-- switch 7 dokumensitemarking -->
        <div class="px-4 col-6 mt-4 d-flex justify-content-between">
            <label class="label-toggle">
                Dokumen site marking
            </label>
            <input type="checkbox" <?= $attr_7; ?> data-switch="<?= $book['dokumensitemarking']; ?>" data-field="dokumensitemarking" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="dokumensitemarking-<?= $book['id']; ?>" name="dokumensitemarking" data-toggle="toggle" data-on="Ya" data-off="tidak">
        </div>

        <!-- switch 8 assessmentulang -->
        <div class="px-4 col-6 mt-4 d-flex justify-content-between">
            <label class="label-toggle">
                Assessmen ulang
            </label>
            <input type="checkbox" <?= $attr_8; ?> data-switch="<?= $book['assessmentulang']; ?>" data-field="assessmentulang" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="assessmentulang-<?= $book['id']; ?>" name="assessmentulang" data-toggle="toggle" data-on="Ya" data-off="tidak">
        </div>

        <!-- switch 9 tindaklanjut -->
        <div class="px-4 col-6 mt-4 d-flex justify-content-between">
            <label class="label-toggle">
                Rencana Tindak lanjut Operasi
            </label>
            <input type="checkbox" <?= $attr_9; ?> data-switch="<?= $book['tindaklanjut']; ?>" data-field="tindaklanjut" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="tindaklanjut-<?= $book['id']; ?>" name="tindaklanjut" data-toggle="toggle" data-on="Ya" data-off="Pending">
        </div>

        <!-- switch 10 assessmentpraanestesi -->
        <div class="px-4 col-6 mt-4 d-flex justify-content-between">
            <label class="label-toggle">
                Assessment pra anestesi
            </label>
            <input type="checkbox" <?= $attr_10; ?> data-switch="<?= $book['assessmentpraanestesi']; ?>" data-field="assessmentpraanestesi" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="assessmentpraanestesi-<?= $book['id']; ?>" name="assessmentpraanestesi" data-toggle="toggle" data-on="Ya" data-off="tidak">
        </div>

        <!-- switch 11 edukasianestesi -->
        <div class="px-4 col-6 mt-4 d-flex justify-content-between">
            <label class="label-toggle">
                Edukasi anestesi
            </label>
            <input type="checkbox" <?= $attr_11; ?> data-switch="<?= $book['edukasianestesi']; ?>" data-field="edukasianestesi" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="edukasianestesi-<?= $book['id']; ?>" name="edukasianestesi" data-toggle="toggle" data-on="Ya" data-off="tidak">
        </div>

        <!-- switch 12 suratijinanestesi -->
        <div class="px-4 col-6 mt-4 d-flex justify-content-between">
            <label class="label-toggle">
                Surat ijin anestesi
            </label>
            <input type="checkbox" <?= $attr_12; ?> data-switch="<?= $book['suratijinanestesi']; ?>" data-field="suratijinanestesi" data-id="<?= $book['id']; ?>" class="make-switch switch-large" id="suratijinanestesi-<?= $book['id']; ?>" name="suratijinanestesi" data-toggle="toggle" data-on="Ya" data-off="tidak">
        </div>

    </div>
</div>

<script type="text/javascript">
    $('.label-toggle').on('click', function() {
        $('#' + $(this).attr('for')).bootstrapToggle('toggle');
    })

    $('.make-switch').change(function() {
        // ngecek nilainya atribut data-switch 
        if ($(this).data('switch') == 0) {
            //alert(1);
            // merubah atribut data switch 1 berarti on 0 berarti off
            $(this).data('switch', 1);
            // data-switch nilai dari field yang terpilih, data-field nama fieldnya, id untuk query where pada model
            ajax_switch($(this).data('field'), $(this).data('switch'), $(this).data('id'));

        } else {
            //alert(0);
            $(this).data('switch', 0);
            ajax_switch($(this).data('field'), $(this).data('switch'), $(this).data('id'));

        }
    });

    function ajax_switch(field, value, id) {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('EdukasiBedah/ajax_switch') ?>',
            data: {
                field: field,
                value: value,
                id: id
            },
            success: function(response) {
                //alert(response);
            }
        })
    }
</script>