<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Primary Table</h4>
                <h6 class="card-subtitle">Add class <code>.color-bordered-table .primary-bordered-table</code></h6>
                <div class="table-responsive">
                    <table class="table color-bordered-table primary-bordered-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Nigam</td>
                                <td>Eichmann</td>
                                <td>@Sonu</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Deshmukh</td>
                                <td>Prohaska</td>
                                <td>@Genelia</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Roshan</td>
                                <td>Rogahn</td>
                                <td>@Hritik</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Success Table</h4>
                <h6 class="card-subtitle">Add class <code>.color-bordered-table .success-bordered-table</code></h6>
                <div class="table-responsive">

                    <?= $pasienid; ?>
                    <table class="table color-bordered-table success-bordered-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Nigam</td>
                                <td>Eichmann</td>
                                <td>@Sonu</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Deshmukh</td>
                                <td>Prohaska</td>
                                <td>@Genelia</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Roshan</td>
                                <td>Rogahn</td>
                                <td>@Hritik</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection(); ?>