    <table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>No</th>
                <th>TglPelayanan</th>
                <th>NomorRekamMedis</th>
                <th>MetodePembayaran</th>
                <th>Poliklinik</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            <form id="div-form-tambah" method="post">
                <?php $no = 0;
                foreach ($tampildata as $row) :
                    $no++; ?>
                    <tr>

                        <td class="text-center">
                            <?php
                            $encrypter = \Config\Services::encrypter();
                            $nama = $row['id'];
                            $idx = $encrypter->encrypt($nama);
                            ?>
                            <input type="hidden" name="id" id="id" value="<?= $row['id']; ?>">
                            <input type="hidden" name="pasiencard" id="pasiencard" value="<?= $row['pasienid']; ?>">
                            <input type="hidden" name="registerdate" id="registerdate" value="<?= $row['documentdate']; ?>">
                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm btnprintsep" onclick="UbahCabarRajal('<?= $row['id']; ?>')"> <i class="fas fa-compress"></i></button>
                        </td>
                        <td><?= $no ?></td>
                        <td><?= $row['documentdate'] ?></td>
                        <td><?= $row['pasienid'] ?>
                            <br>
                            <?= $row['pasienname'] ?>[<?= $row['pasiengender'] ?>]
                            <br>
                            <b><?= $row['advicedokter']; ?></b>
                            <br>
                            <?= $row['journalnumber']; ?>
                        </td>
                        <td><?= $row['paymentmethodname'] ?></td>
                        <td><?= $row['poliklinikname'] ?>
                            <br> <?= $row['doktername'] ?>
                        </td>
                        <td><?= $row['pasienaddress'] ?>
                    </tr>

                <?php endforeach; ?>
            </form>
        </tbody>
    </table>


    <script>
        function UbahCabarRajal(id) {
            $.ajax({
                type: "post",
                url: "<?php echo base_url('KasirIGD/LihatUbahCabarIGD'); ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.suksesbayar) {
                        $('.viewmodal').html(response.suksesbayar).show();
                        $('#modalubahcabarigd').modal('show');

                    }
                }

            });


        }
    </script>