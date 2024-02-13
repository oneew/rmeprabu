<table id="datakontrol" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>No</th>
            <th>NoSuratKontrol</th>
            <th>tglRencanaKontrol</th>
            <th>tglTerbitKontrol</th>
            <th>PoliTujuan & NamaDokter</th>
            <th>Nama</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        $list = $response['list'];
        foreach ($list as $row) :
            $no++; ?>
            <tr>
                <td><?= $no ?></td>
                <td><span class="badge badge-info"><?= $row['noSuratKontrol']; ?></span>
                    <br><?= $row['jnsPelayanan']; ?>
                    <br><span class="<?php if ($row['namaJnsKontrol'] == "Surat Kontrol") {
                                            echo "badge badge-danger";
                                            $kata = "Ranap";
                                        } else {
                                            echo "badge badge-success";
                                            $kata = "Igd/Rajal";
                                        }  ?>"><?= $row['namaJnsKontrol']; ?></span>
                </td>
                <td><?= $row['tglRencanaKontrol']; ?></td>
                <td><?= $row['tglTerbitKontrol']; ?>
                    <br>Tgl Sep: <?= $row['tglSEP']; ?>
                    <br>Sep <?= $kata; ?>: <span class="badge badge-success"><?= $row['noSepAsalKontrol']; ?></span>

                </td>
                <td><b><?= $row['namaPoliTujuan']; ?>
                        <br><?= $row['namaDokter']; ?>[<?= $row['kodeDokter']; ?>]</b>
                </td>
                <td><b><?= $row['nama']; ?></b>
                    <b><br><?= $row['noKartu']; ?><b>
                            <?php if ($kata == "Ranap") { ?>
                                <br><button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-success btn-sm" onclick="AmbilSuratKontrol('<?= $row['noSuratKontrol']; ?>','<?= $row['noSepAsalKontrol']; ?>','<?= $row['tglTerbitKontrol']; ?>')"> <i class="ti-pin-alt"></i></button>
                            <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<script>
    $(document).ready(function() {
        $('#datakontrol').DataTable(); {
            responsive: true
        }
    });
</script>


<script>
    function AmbilSuratKontrol(noSuratKontrol, noSepAsalKontrol, tglSuratKontrol) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('VclaimAntrean/DetailKontrol'); ?>",
            data: {
                noSuratKontrol: noSuratKontrol,
                noSepAsalKontrol: noSepAsalKontrol,
                tglSuratKontrol: tglSuratKontrol
            },
            dataType: "json",
            success: function(response) {
                $('#noSuratKontrol').val(response.noSuratKontrol);
                $('#noSepAsalKontrol').val(response.noSepAsalKontrol);
                $('#tglSuratKontrol').val(response.tglSuratKontrol);
                $('#modaldaftarkontrol').modal('hide');

            }
        });
    }
</script>