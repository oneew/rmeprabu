<div class="row">
    <div class="col-lg-12">
        <div class="card card-outline-info">
            <div class="card-header">
                <h4 class="mb-0 text-white">Form Clinical Pathway</h4>
            </div>
            <div class="card-body">
                <form action="#">
                    <div class="form-body">
                        <div class="row pt-3">

                            <!--/span-->
                        </div>
                    </div>
                </form>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success btnsimpan"> <i class="fa fa-check"></i>
                        Save</button>
                    <button type="button" class="btn btn-inverse">Cancel</button>
                    <input type="hidden" id="createdBy" name="createdBy" class="form-control" value="<?= session()->get('firstname'); ?>" readonly>
                </div>
            </div>


        </div>
    </div>
</div>
</div>