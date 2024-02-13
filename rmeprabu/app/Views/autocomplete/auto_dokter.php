<!-- <?php

		foreach ($list as $dokter) { ?>
	<li class="list-group-item  fill-dokter" data-id="<?= $dokter['id']; ?>"><?= $dokter['name']; ?></li>
<?php } ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('.fill-dokter').on('click', function() {
			$.ajax({
				'type': "POST",
				//'url':"http://localhost/simrs/public/index.php/autocomplete/fill_dokter",
				'url': "<?php echo base_url('autocomplete/fill_dokter') ?>",
				'data': {
					key: $(this).data('id')
				},
				'success': function(response) {
					let data = JSON.parse(response);
					$('#input-name').val(data.name);
					$('#input-code').val(data.code);
					$('#input-memo').val(data.memo);
					$('#autocomplete-dokter').html('');
				}
			})
		})
	})
</script> -->