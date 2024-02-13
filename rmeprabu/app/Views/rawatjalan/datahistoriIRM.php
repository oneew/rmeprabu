<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>TglPelayanan</th>
            <th>NomorRekamMedis</th>
            <th>NamaPasien</th>
            <th>JenisKelamin</th>
            <th>MetodePembayaran</th>
            <th>Poliklinik</th>
            <th>Dokter</th>
            <th>Alamat</th>
        </tr>
    </thead>
    <tbody>
        <form id="div-form-tambah" method="post">
            <?php $no = 0;
            foreach ($tampildata as $row) :
                $no++; ?>
                <tr>

                    <td><?= $no ?></td>
                    <td><?= $row['documentdate'] ?>
                        <br><span class="<?php if ($row['perjanjian'] == 1) {
                                                echo "badge badge-danger";
                                                $periksa = "Perjanjian";
                                            } else {
                                                echo "badge badge-success";
                                                $periksa = "Reguler";
                                            }  ?>"><?= $periksa; ?></span>
                        <br><?= $row['createddate']; ?>
                        <br><?= $row['createdby']; ?>
                    </td>
                    <td><?= $row['pasienid'] ?></td>
                    <td><?= $row['pasienname'] ?></td>
                    <td><?= $row['pasiengender'] ?></td>
                    <td><?= $row['paymentmethodname'] ?>
                        <br><span class="<?php if ($row['paymentcardnumber'] <> '') {
                                                echo "badge badge-info";
                                                $kartu = $row['paymentcardnumber'];
                                            } else {

                                                $kartu = '';
                                            }  ?>"><?= $kartu; ?></span>
                        <br><span class="badge badge-success"><?= $row['bpjs_sep']; ?></span>
                    </td>
                    <td><?= $row['poliklinikname'] ?></td>
                    <td><?= $row['doktername'] ?></td>
                    <td><?= $row['pasienaddress'] ?>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>