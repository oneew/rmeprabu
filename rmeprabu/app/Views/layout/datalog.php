<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col-lg-12 col-md-12">


    <div class="row">
        <div class="card">
            <div class="card-body">
                <table id="datapaketLab" class="tablesaw table-bordered table-hover table no-wrap" width="100%">
                    <thead>
                        <tr>

                            <th>No</th>
                            <th>Tanggal Jam Login</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Kode Area</th>
                            <th>IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($tampildata as $row) :
                            $no++; ?>
                            <tr>

                                <td><?= $no ?></td>
                                <td><?= $row['datetimelogin']; ?></td>
                                <td><?= $row['firstname']; ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['locationcode'] ?></td>
                                <td><?= $row['ip'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
                <script>
                    $(document).ready(function() {
                        $('#datapaketLab2').DataTable({
                            responsive: true
                        });
                    });
                </script>

                <script>
                    $(document).ready(function() {
                        $('#datapaketLab').DataTable({
                            responsive: true,
                            paging: false,
                            scrollX: true,
                            scrollY: "60vh"
                        });
                    });
                </script>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>