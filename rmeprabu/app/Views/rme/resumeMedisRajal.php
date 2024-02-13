<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">RESUME MEDIS RAWAT JALAN</h4>

                <div class="form-material mt-4">
                    <div class="form-group">
                        <label><span class="help"> No. Rekam Medis</span></label>
                        <div class="border-bottom">
                            <?= $norm; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-email"><span class="help">Nama Pasien</span></label>
                        <div class="border-bottom">
                            <?= $nama; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <div class="border-bottom">
                            <?= date('d F Y', strtotime($dob)) ;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pemeriksaan</label>
                        <div class="border-bottom">
                            <?= date('d F Y', strtotime($tanggalperiksa)) ;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Dokter</label>
                        <div class="border-bottom">
                            <?= $namaDokter; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Anamnesa</label>
                        <div class="border-bottom">
                            <?= $anamnesa; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Diagnosa</label>
                        <div class="border-bottom">
                            <?= $diagnosis; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Terapi</label>
                        <div class="w-100 border-bottom"><?= htmlspecialchars_decode($terapi); ?></d>
                    </div>
                </form>
                <br>
                <button id="print" class="btn btn-info btnprintResumeMedis" type="button"> <span class="mr-1"><i class="fa fa-print"></i></span> Print Resume Medis</button>
            </div>
        </div>
    </div>
</div>