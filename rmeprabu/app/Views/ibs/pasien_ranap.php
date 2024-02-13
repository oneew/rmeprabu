<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">


            <div class="row">
                <h4 class="card-title">Data Pasien Raawat Inap</h4>
                <h6 class="card-subtitle"></h6>
            </div>
            <div class="col-lg-3">
                <form action="" method="post">

                    <div class="input-group mb-3">
                        <input type="text" name="norm" class="form-control" placeholder="Norm Pasien..." aria-label="Recipient's username" aria-describedby="button-addon2">

                        <div class="input-group-append">
                            <button class="btn btn-info" type="Submit" name="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive mt-4">
                <table id="myTable" class="table display table-bordered table-striped no-wrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>ReferenceNumber</th>
                            <th>PasienID</th>
                            <th>Nama Pasien</th>
                            <th>Cara Bayar</th>
                            <th>SMF</th>
                            <th>Dokter</th>
                            <th>Kelas</th>
                            <th>Ruangan</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($tampildata as $row) :
                            $no++; ?>
                            <tr>

                                <td> <button type="button" class="btn btn-info btn-sm" onclick="daftarkan('<?= $row['id'] ?>')"> <i class="fa fa-tags"></i></button></td>
                                <td><?= $no ?></td>
                                <td><?= $row['documentdate'] ?></td>
                                <td><?= $row['referencenumber'] ?></td>
                                <td><?= $row['pasienid']  ?></td>
                                <td><?= $row['pasienname'] ?></td>
                                <td><?= $row['paymentmethodname'] ?></td>
                                <td><?= $row['smfname'] ?></td>
                                <td><?= $row['doktername'] ?></td>
                                <td><?= $row['classroomname'] ?></td>
                                <td><?= $row['roomname'] ?></td>

                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="viewmodal" style="display:none;"></div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();


    });
</script>





<?= $this->endSection(); ?>