<table id="registerranap" class="tablesaw table-bordered table-hover table no-wrap">
    <thead>
        <tr>
            <th>#</th>
            <th>#</th>
            <th>No</th>
            <th>Keterangan</th>
            <th>StatusRawat</th>
            <th>TglMasuk</th>
            <th>TglKeluar</th>
            <th>NamaPasien</th>
            <th>MetodePembayaran</th>
            <th>Ruangan</th>
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
                    <td>
                        <?php if (session()->get('hn') == 1) { ?>
                            <button type="button" class="btn btn-success btn-sm" onclick="CatatDactSusulan('<?= $row['id'] ?>')"> <i class="fas fa-bed"></i></button>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        $encrypter = \Config\Services::encrypter();
                        $nama = $row['id'];
                        $idx = $encrypter->encrypt($nama);
                        ?>
                        <input type="hidden" name="id" id="id" value="<?= $row['id']; ?>">
                        <input type="hidden" name="pasiencard" id="pasiencard" value="<?= $row['pasienid']; ?>">
                        <input type="hidden" name="registerdate" id="registerdate" value="<?= $row['documentdate']; ?>">

                        <button type="button" id="btn-card" class="btn waves-effect waves-light btn-rounded  btn-outline-secondary btn-sm btn-card" data-pasiencard="<?= $row['paymentcardnumber']; ?>" data-registerdate="<?= $row['documentdate']; ?>"><span class="mr-1"><i class="fa fa-check"></i></span>Cek</button>
                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-outline-info btn-sm btnprintsep" onclick="CetakRanap('<?= $row['id']; ?>')"> <i class="ti-printer"></i></button>
                    </td>
                    <td><?= $no ?></td>
                    <td><span class="<?php if ($row['types'] == "BARU") {
                                            echo "badge badge-danger";
                                        } else {
                                            echo "badge badge-warning";
                                        }  ?>"><?= $row['types'] ?></span></td>
                    <td><span class="<?php if ($row['statusrawatinap'] == "PULANG") {
                                            echo "badge badge-success";
                                        } else if ($row['statusrawatinap'] == "RAWAT") {
                                            echo "badge badge-info";
                                        } else {
                                            echo "badge badge-warning";
                                        }  ?>"><?= $row['statusrawatinap'] ?></span></td>
                    <td><?= $row['datetimein'] ?></td>
                    <td><?php if ($row['statusrawatinap'] == "RAWAT") {
                            $tglpulang = '';
                        } else {
                            $tglpulang = $row['datetimeout'];
                        } ?><?= $tglpulang ?></td>

                    <td><?= $row['pasienid'] ?>
                        <br><b><?= $row['pasienname'] ?></b> [<?= $row['pasiengender'] ?>]
                    </td>
                    <td><?= $row['paymentmethodname'] ?>

                        <br><span class="badge badge-info"><?= $row['paymentcardnumber']; ?></span>
                        <br><span class="badge badge-success"><?= $row['bpjs_sep']; ?></span>
                    </td>
                    <td><b><?= $row['roomname'] ?></b>
                        <br><?= $row['classroomname'] ?>
                    </td>
                    <td><?= $row['doktername'] ?></td>
                    <td><?= $row['pasienaddress'] ?>
                </tr>

            <?php endforeach; ?>
        </form>
    </tbody>
</table>

<script type="text/javascript">
    $(document).ready(function() {
        $('.btnprint').on('click', function() {

            let id = $(this).data('id');
            window.open("<?php echo base_url('DPMRI/printkarcis') ?>?page=" + id, "_blank");

        })
    });
</script>

<script type="text/javascript">
    $('.btnprint2').on('click', function() {
        let id = $(this).data('id');
        $.ajax({
            type: 'post',
            url: "<?php echo base_url('RawatJalan/printkarcis'); ?>",
            data: {
                id: id
            },
        })
    })
</script>

<script type="text/javascript">
    $(document).ready(function() {

    });


    $('.btn-card').on('click', function() {

        if ($('#pasiencard').val() == '' || $('#registerdate').val == '') {
            Swal.fire({
                type: 'error',
                title: 'Error',
                text: 'Tidak Boleh Kosong'

            })
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('Bpjs/check_card') ?>",
                data: {
                    card: $(this).data('pasiencard'),
                    date: $(this).data('registerdate')
                },
                success: function(response) {
                    let parseResponse = JSON.parse(response);
                    if (parseResponse.metaData.code == 200) {

                        Swal.fire({
                            html: 'Nama: ' + parseResponse.response.peserta.nama + '<br>No.Kartu: ' + parseResponse.response.peserta.noKartu + '<br>Jenis Kelamin: ' + parseResponse.response.peserta.sex + '<br>Tanggal Lahir: ' + parseResponse.response.peserta.tglLahir +
                                '<br>Hak Kelas: ' + parseResponse.response.peserta.pisa + '<br>Status: ' + parseResponse.response.peserta.statusPeserta.keterangan + '<br>Pekerjaan: ' + parseResponse.response.peserta.jenisPeserta.keterangan +
                                '<br>Kode Faskes 1: ' + parseResponse.response.peserta.provUmum.kdProvider + '<br>Nama Faskes 1: ' + parseResponse.response.peserta.provUmum.nmProvider + '<br>TMT Kepesertaan: ' + parseResponse.response.peserta.tglTMT + '<br>NIK: ' + parseResponse.response.peserta.nik,

                            icon: 'success',
                            text: parseResponse.metaData.message,
                        });
                        $('#faskesname').val(parseResponse.response.peserta.provUmum.nmProvider);
                        $('#faskes').val(parseResponse.response.peserta.provUmum.kdProvider);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            //title: 'Error',
                            text: parseResponse.metaData.message

                        });
                    }
                }
            })
        }
    })
</script>


<script>
    function CetakRanap(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('DPMRI/Cetak'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalprintregisterranap').modal('show');
                }
            }
        });
    }
</script>


<script>
    $(document).ready(function() {
        $('#dataperawat').DataTable({
            responsive: true
        });
    });

    function CatatDactSusulan(id) {
        $.ajax({
            type: "post",
            url: "<?php echo base_url('PasienRanap/entriDact'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaldactranap').modal('show');
                }
            }
        });

    }
</script>