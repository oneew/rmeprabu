<table id="datariwayatCPPT" class="table display <?= (count($tampildata) > 1) ? "table-striped" : "" ?> no-wrap" style="font-family: Verdana, Geneva, Tahoma, sans-serif; font-size:small; color:black; width:100%">
    <thead class="bg-primary text-white">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Perawat</th>
            <th>Hasil Asesmen Pasien dan Tatalaksana</th>
            <th>Intruksi</th>
            <th>Validasi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        foreach ($tampildata as $row) :
            $no++; ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?php
                    $tanggal = $row['createddate'];
                    echo date('d F Y', strtotime($tanggal)); ?></td>
                <td><?= $row['paramedicName']  ?></td>
                <td class="align-top" style="white-space: normal;"><b>
                        <h6>Subyektif
                    </b></h6>
                    <br>Keluhan Utama : <?= $row['keluhanUtama']; ?>

                    </br>
                    <br><b>
                        <h6>Obyektif
                    </b></h6>
                    <br>BB : <?= $row['tb']; ?>
                    <br>TB : <?= $row['bb']; ?>
                    <br>Sistolik : <?= $row['tdSistolik']; ?>
                    <br>Diastolik : <?= $row['tdDiastolik']; ?>
                    <br>Frekuensi Nadi : <?= $row['frekuensiNadi']; ?>
                    <br>Suhu : <?= $row['suhu']; ?>
                    <br>Frekuensi Nafas : <?= $row['frekuensiNafas']; ?>
                    <br>Skala Nyeri : <?= $row['skalaNyeri']; ?>
                    </br>
                    <br><b>
                        <h6>Asesmen
                    </b></h6>
                    <br>Diagnosa Keperawatan : <?= $row['DiagnosaAskep']; ?>
                    </br>
                    <br><b>
                        <h6>Planning
                    </b></h6>
                    <br>Kolaborasi dengan PPA/Medis
                    </br>
                    <?= $row['uraianAskep']; ?>

                </td>
                <td> Catatan :
                    <br> <?= $row['sasaranRencana']; ?>
                </td>
                <td>
                    <?php if ($row['verifikasiDPJP'] == 0) { ?>
                        <button id="print" class="btn btn-info btn-outline btn btnbatalperiksa" type="button" onclick="Verifikasi('<?= $row['id'] ?>')"> Selesai Verifikasi <span><i class="fas fa-question"></i></span> </button>
                    <?php } ?>
                    <?php if ($row['verifikasiDPJP'] == 1) { ?>
                        Diverifikasi Oleh : <?= $row['verifikator']; ?>
                        </br>Pada Tanggal : <?= $row['tanggalJamVerifikasi']; ?>
                        </br>
                        <button id="print" class="btn btn-danger btn-outline btn btnupdatesep" type="button" onclick="batalVerifikasi('<?= $row['id'] ?>')"> Batal Verifikasi<span><i class="fas fa-question"></i></span> </button>
                    <?php } ?>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>




<script>
    $(document).ready(function() {
        $('#dataresumepenunjang').DataTable({
            responsive: true,
            scrollX: true,
            scrollY: "50vh"
        });
    });
</script>



<script>
    function Verifikasi(id) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan Verifikasi CPPT ini Selesai ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('PelayananRawatJalanRME/VerifikasiCPPTPerawatSelesai'); ?>",
                    data: {
                        id: id,
                        modifiedby: $('#createdby').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            }).then((result) => {
                                if (result.value) {
                                    dataresumeCPPTPerawat();

                                }
                            });
                        }
                    }

                });


            }
        })

    }
</script>


<script>
    function batalVerifikasi(id) {
        Swal.fire({
            title: 'Batal',
            text: "Apakah anda yakin akan Membatalkan Verifikasi CPPT ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: "Tidak",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url('PelayananRawatJalanRME/BatalkanVerifikasiCPPTPerawat'); ?>",
                    data: {
                        id: id,
                        modifiedby: $('#createdby').val()
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,

                            }).then((result) => {
                                if (result.value) {
                                    dataresumeCPPTPerawat();

                                }
                            });
                        }
                    }

                });


            }
        })

    }
</script>