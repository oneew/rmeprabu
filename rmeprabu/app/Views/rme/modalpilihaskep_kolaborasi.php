<div id="modalpilihaskep_kolaborasi" class="modal fade" id="bs-example-modal-lg" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Data Rencana Kolaborasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <?php helper('form') ?>
            <?= form_open('PelayananRawatJalanRME/simpanpilihAskepKolaborasi', ['class' => 'formsimpanbanyak']); ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div id="form-filter-atas">
                    <table id="datapaketLab" class="tablesaw table-bordered table-hover table no-wrap" width="100%" style="font-size: larger;">
                        <thead class="text-white bg-success">
                            <tr>
                                <th>No#</th>
                                <th>#</th>
                                <th>Terapeutik</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;
                            foreach ($list_askep as $row) :
                                $no++; ?>
                                <tr>

                                    <td><?= $no ?></td>
                                    <td><input type="checkbox" id="tandai" name="tandai[]" value="<?= $row['rencana']; ?>|<?= $row['diagnosa']; ?>" /></td>
                                    <td><?= $row['rencana'] ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btnsimpanbanyak">Simpan</button>
                </div>
            </div>

            <?= form_close(); ?>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(e) {
        $('.formsimpanbanyak').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpanbanyak').attr('disable', 'disabled');
                    $('.btnsimpanbanyak').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnsimpanbanyak').removeAttr('disable');
                    $('.btnsimpanbanyak').html('Simpan');
                },
                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            html: `${response.sukses}`,

                        }).then((result) => {
                            if (result.value) {
                                // dataresume();
                                // historiradiologi();
                                // resumeexpertise();
                                $('#modalpilihaskep_kolaborasi').modal('hide');
                                $('#kolaborasi').html(response.kolaborasi);
                                //var jsonData = response.rencana_askep;
                                //$('#uraianAskep2').val(JSON.stringify(response.jsonData));

                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Perhatian',
                            html: `${response.gagal}`,

                        })
                    }
                }
            });
            return false;
        });
    });
</script>