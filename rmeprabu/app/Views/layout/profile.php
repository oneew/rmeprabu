<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="col-lg-12 col-md-12">


    <div class="row">
        <div class="login-box card">
            <div class="card-body">
                <?php if (session()->get('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->get('success') ?>
                    </div>
                <?php endif; ?>

                <h3 class="p-2 rounded-title mb-3">Profil <?= $user['firstname'] . ' ' . $user['lastname']; ?></h3>


                <form class="form-horizontal form-material" id="loginform" method="post" action="<?= base_url(); ?>/profile">

                    <?= csrf_field(); ?>

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="firstname" id="firstname" value="<?= set_value('firstname', $user['firstname']) ?>" placeholder="nama depan">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="lastname" id="lastname" value="<?= set_value('lastname', $user['lastname']) ?>" placeholder="nama belakang ">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" readonly name="email" id="email" value="<?= $user['email'] ?>" placeholder="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" id="password" value="" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password_confirm" id="password_confirm" value="" placeholder="Confirm Password">
                        </div>
                    </div>
                    <?php if (isset($validation)) : ?>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="alert alert-danger" role="alert">
                                    <?= $validation->listErrors() ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="form-group text-center mt-3">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Ubah Data</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>