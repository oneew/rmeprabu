<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Body Content -->
<div class="container">


	<div class="row">
		<div class="col-12">
			<h3>Complete Example</h3>
			<p>Sign Below:</p>
			<div class="js-signature" data-width="600" data-height="200" data-border="1px solid black" data-line-color="#bc0000" data-auto-fit="true"></div>
			<p><button id="clearBtn" class="btn btn-default">Clear Canvas</button>&nbsp;<button id="saveBtn" class="btn btn-default" disabled>Save Signature</button></p>
			<div id="signature">
				<p><em>Your signature will appear here when you click "Save Signature"</em></p>
			</div>
		</div>
	</div>

	<br>
	<hr><br>

	<div class="row list-sign">
		<?php foreach ($list as $signature) { ?>
			<div class="col-4">
				<img src="<?= $signature['signature']; ?>" class="img-fluid">
			</div>
		<?php } ?>
	</div>

	<br><br>
</div>
<!-- Scripts -->
<!-- <script src="jquery.js"></script>
<script src="jq-signature.js"></script> -->

<script>
	$(document).ready(function() {
		if ($('.js-signature').length) {
			$('.js-signature').jqSignature();
		}

		$('#clearBtn').on('click', function() {
			$('.js-signature').eq(0).jqSignature('clearCanvas');
			$('#saveBtn').attr('disabled', true);
			//alert($('.js-signature').html());
		});

		$('#saveBtn').on('click', function() {
			let save = $('.js-signature').eq(0).jqSignature('getDataURL');
			$.ajax({
				type: 'post',
				url: "<?php echo base_url('Signature/insert_sign') ?>",
				data: {
					signature: save
				},
				success: function(response) {
					$('.list-sign').append(response);
				}
			});
			// alert(save);
		});

		$('.js-signature').eq(0).on('jq.signature.changed', function() {
			$('#saveBtn').attr('disabled', false);
		});
	});
</script>

<?= $this->endSection(); ?>