<?php

foreach ($list as $pelayanan) { ?>
	<li class="list-group-item  fill-pelayanan" data-id="<?= $pelayanan['id']; ?>"><?= $pelayanan['name']; ?></li>
<?php } ?>

<!-- saya tulis scriptnya disini karena ada kendala jika dituliskan di file index -->
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.fill-pelayanan').on('click', function() {
			$.ajax({
				'type': "POST",
				//'url':"http://localhost/simrs/public/index.php/autocomplete/fill_pelayanan",
				'url': "<?php echo base_url('autocomplete/ajax_pelayanan') ?>",
				'data': {
					key: $(this).data('id')
				},
				'success': function(response) {
					let data = JSON.parse(response);
					$('#pelayanan-name').val(data.name);
					$('#pelayanan-code').val(data.code);
					$('#pelayanan-groupname').val(data.groupname);
					$('#pelayanan-price').val(data.price);
					$('#autocomplete-pelayanan').html('');
				}
			})
		})
	})
</script>