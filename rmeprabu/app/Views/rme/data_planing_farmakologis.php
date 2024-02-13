<table id="datariwayatPelayananMedisResep" class="w-100 table" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black;">
    <thead class="bg-primary text-white">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Pelayanan</th>
            <th>Resep</th>
        </tr>
    </thead>
    <tbody>

        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++;
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $row['documentdate'] ?></td>
                <td><?= $row['poliklinikname'] ?>
                    </br><?= $row['doktername']; ?>
                    </br><?= $row['journalnumber']; ?>
                </td>

                <td style="width: 60%;">
                    <?php foreach ($row['listResep'] as $key => $resep) : ?>
                        <?php $index = ++$key ;?>
                        <div class="form-check border-bottom py-1">
                            <input class="form-check-input" type="checkbox" value="<?= $resep['name'] . '['.$resep['signa1']. 'x' . $resep['signa2'] . ']' . '(' . abs($resep['qty']) . ')' ?>" id="defaultCheck<?= $index ;?>">
                            <label class="form-check-label" for="defaultCheck<?= $index ;?>">
                                <span style="font-size: 12px;">
                                    <?= $resep['name']; ?>[<?= $resep['signa1'] ?> x <?= $resep['signa2']; ?>](<?= ABS($resep['qty']); ?>)
                                </span>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </td>
            </tr>

        <?php endforeach; ?>

    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#datariwayatPelayananMedisResep').DataTable({
            scrollX: true
        });
    });
</script>

<script>
    $('#datariwayatPelayananMedisResep input[type="checkbox"]').change(function(){
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