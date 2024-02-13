<div class="table-responsive">
    <table id="dataHistoryTNO" class="table w-100">
        <thead class="bg-primary text-white">
            <tr>
                <th>#</th>
                <th>Tarif</th>
                <th>Dokter/Advisor</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tampildata as $no => $row) : ?>
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?= $row['name'] ?>" id="defaultCheck<?= $row['id'] ;?>">
                            <label class="form-check-label" for="defaultCheck<?= $row['id'] ;?>">
                                <span class="badge badge-<?= $row['pelaksana'] == "Paramedis" ? "warning" : "info" ;?>"><?= $row['name'] ?></span>
                            </label>
                        </div>
                    </td>
                    <td><?= number_format($row['subtotal'], 2, ",", ".") ?></td>
                    <td><?= $row['doktername'] ?></td>
                    <td><?= $row['documentdate'] ?></td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#dataHistoryTNO').DataTable({
            scrollX: true
        });
    });

    $('#dataHistoryTNO input[type="checkbox"]').change(function(){
        if ($(this).is(":checked")) {
            var value = $('#planning1').data("wysihtml5").editor.getValue();
            var text = '<li>' + $(this).val() + '</li>';
            $('#planning1').data("wysihtml5").editor.setValue(value + text, true);
        }else{
            var value = $('#planning1').data("wysihtml5").editor.getValue();
            var text = '<li>' + $(this).val() + '</li>';
            $('#planning1').data("wysihtml5").editor.setValue(value - text, true);
        }
    })
</script>
