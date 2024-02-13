<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap2/bootstrap-switch.css" rel="stylesheet" />



<div class="container">
	<div class="row">

		<?php foreach ($list as $data) { ?>

			<!-- atribut checked -->
			<?php
			$attr_eb = $data['edukasibedah'] == 1 ? 'checked' : '';
			$attr_po = $data['persetujuanoperasi'] == 1 ? 'checked' : '';
			$attr_kd = $data['konsultasidpjplain'] == 1 ? 'checked' : '';
			?>

			<div class="col-6">
				<input type="text" class="form-control" readonly name="" value="<?= $data['pasienname']; ?>">

				<div class="mt-4 d-flex justify-content-between">
					<label for="edukasibedah-<?= $data['id']; ?>">
						Edukasi bedah
					</label>

					<input type="checkbox" <?= $attr_eb; ?> data-switch="<?= $data['edukasibedah']; ?>" data-field="edukasibedah" data-id="<?= $data['id']; ?>" class="make-switch" id="edukasibedah-<?= $data['id']; ?>" name="edukasibedah" data-on-color="success" data-off-color="danger" value="true">
				</div>

				<div class="mt-4 d-flex justify-content-between">
					<label for="edukasibedah-<?= $data['id']; ?>">
						Persetujuan operasi
					</label>
					<input type="checkbox" <?= $attr_po; ?> data-switch="<?= $data['persetujuanoperasi']; ?>" data-field="persetujuanoperasi" data-id="<?= $data['id']; ?>" class="make-switch" id="persetujuanoperasi-<?= $data['id']; ?>" name="persetujuanoperasi" data-on-color="success" data-off-color="danger" value="true">
				</div>

				<div class="mt-4 d-flex justify-content-between">
					<label for="edukasibedah-<?= $data['id']; ?>">
						Konsultasi Dpjplain
					</label>
					<input type="checkbox" <?= $attr_kd; ?> data-switch="<?= $data['konsultasidpjplain']; ?>" data-field="konsultasidpjplain" data-id="<?= $data['id']; ?>" class="make-switch" id="konsultasidpjplain-<?= $data['id']; ?>" name="konsultasidpjplain" data-on-color="success" data-off-color="danger" value="true">
				</div>


			</div>

		<?php } ?>

	</div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
		// ini saya nemu di stackoverflow sih kode saya mulai if
		$('.make-switch').bootstrapSwitch('state');

		$('.make-switch').on('switchChange.bootstrapSwitch', function() {
			// ngecek nilainya atribut data-switch 
			if ($(this).data('switch') == 0) {
				//alert(1);
				// merubah atribut data switch 1 berarti on 0 berarti off
				$(this).data('switch', 1);
				// data-switch nilai dari field yang terpilih, data-field nama fieldnya, id untuk query where pada model
				ajax_switch($(this).data('field'), $(this).data('switch'), $(this).data('id'));

			} else {
				//alert(0);
				$(this).data('switch', 0);
				ajax_switch($(this).data('field'), $(this).data('switch'), $(this).data('id'));

			}

		});

		function ajax_switch(field, value, id) {
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url('Book_operasi/ajax_switch'); ?>',
				data: {
					field: field,
					value: value,
					id: id
				},
				success: function(response) {
					//alert(response);
				}
			})
		}
	})
</script>

<!-- Taruh di layout/footer paling bawah -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>

<?= $this->endSection(); ?>