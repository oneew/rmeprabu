<table id="registerpenunjang" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th class="text-center">#</th>
            <th>No</th>
            <th>Pelayanan</th>
            <th>TglPelayanan</th>
            <th>NomorRekamMedis</th>
            <th>Dokter</th>
            <th>Ruangan/Poli</th>
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
                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm btnprintsep" onclick="CetakFar('<?= $row['id']; ?>')"> <i class="fas fa-compress"></i></button>
                    </td>
                    <td><?= $no ?></td>
                    <td><span class="<?php if ($row['locationcode'] == 'DEPORAJAL') {
                                            $pelayanan = 'Depo Rawat Jalan';
                                            echo "badge badge-success";
                                        } else {
                                            if ($row['locationcode'] == 'DEPOIGD') {
                                                $pelayanan = 'Depo IGD';
                                                echo "badge badge-info";
                                            } else {
                                                if ($row['locationcode'] == 'DEPORINAP') {
                                                    $pelayanan = 'Depo Rawat Inap';
                                                    echo "badge badge-dark";
                                                } else {
                                                    if ($row['locationcode'] == 'DEPOOK') {
                                                        $pelayanan = 'Depo OK';
                                                        echo "badge badge-danger";
                                                    } else {
                                                        if ($row['locationcode'] == 'DEPOJIWA') {
                                                            $pelayanan = 'Depo Jiwa';
                                                            echo "badge badge-warning";
                                                        } else {
                                                            $pelayanan = '';
                                                        }
                                                    }
                                                }
                                            }
                                        }  ?>"><?= $pelayanan ?></span>


                    </td>
                    <td><?= $row['documentdate'] ?>
                        <br><?= $row['journalnumber'] ?>
                    </td>
                    <td><?= $row['pasienid'] ?>
                        <br><?= $row['pasienname']; ?>[<?= $row['pasiengender']; ?>]
                        <br><?= $row['paymentmethodname'] ?>
                    </td>
                    <td><?= $row['doktername'] ?>
                        <br><?= $row['poliklinik']; ?>|<?= $row['poliklinikname']; ?>
                    </td>

                    <td><?= $row['pasienaddress'] ?>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>

<script>
    function CetakFar(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('KasirFAR/lihatrincianFarmasi'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukseslihat) {
                    $('.viewmodal').html(response.sukseslihat).show();
                    $('#modalpembayaranfarmasi').modal('show');
                }
            }

        });


    }
</script>