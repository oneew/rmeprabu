<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container">
	<div class="row">
		<div class="col-4">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dokterModal">Modal Dokter</button>
		</div>
		<div class="col-4">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pelayananModal">Modal Pelayanan</button>
		</div>
		<div class="col-4">
			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#formtambahModal">Form tambah</button>
		</div>
	</div>
</div>

<!-- Modal buat input dokter -->
<div class="modal fade" id="dokterModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="dokterModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Dokter</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="input-nama" class="col-form-label">Nama dokter:</label>
						<select class="form-control" id="input-name">
							<option>Pilih dokter</option>
							<?php foreach ($list as $dokter) { ?>
								<option data-id="<?= $dokter['id']; ?>" class="select-dokter"><?= $dokter['name']; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="input-code" class="col-form-label">Code dokter</label>
						<input type="text" class="form-control" id="input-code" readonly="readonly">
					</div>
					<div class="form-group">
						<label for="input-memo" class="col-form-label">Memo</label>
						<textarea class="form-control" id="input-memo" readonly="readonly"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal buat input pelayanan -->
<div class="modal fade" id="pelayananModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="pelayananModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Pelayanan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="pelayanan-name" class="col-form-label">Nama Tindakan</label>
						<input type="text" class="form-control" id="pelayanan-name">
						<input type="hidden" class="form-control" id="kelas" name="kelas" value="VIP1">
					</div>
					<div class="form-group">
						<label for="pelayanan-code" class="col-form-label">Code pelayanan</label>
						<input type="text" class="form-control" id="pelayanan-code" readonly="readonly">
					</div>
					<div class="form-group">
						<label for="pelayanan-groupname" class="col-form-label">Group name</label>
						<input type="text" class="form-control" id="pelayanan-groupname" readonly="readonly">
					</div>
					<div class="form-group">
						<label for="pelayanan-price" class="col-form-label">Price</label>
						<input type="text" class="form-control" id="pelayanan-price" readonly="readonly">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<!-- Modal input yang bisa tambah form input -->
<div class="modal fade" id="formtambahModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="formtambahModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form tambah</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="div-form-tambah">
					<div class="form-group">
						<label for="pelayanan-name" class="col-form-label">Nama Tindakan</label>
						<input type="text" class="form-control form-tambah" id="nama">
						<a class="btn btn-danger" id="btn-tambah-form">Tambah</a>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<input type="text" id="tags" name="">

<script type="text/javascript">
	$(document).ready(function() {

		var kelas = document.getElementById("kelas").value;

		// fungsi tambah start
		// button untuk menambah input/append input
		$("#btn-tambah-form").on('click', function() {
			$('#div-form-tambah').append('<div class="form-group"><label for="pelayanan-name" class="col-form-label">Nama Tindakan</label><input type="text" class="form-control form-tambah"><input type="text" class="form-control form-tambah" id="kelas" name="kelas" value="VIP1" class="form-control form-tambah"></div>');
		});

		// ketika terjadi input pada element dengan class form-tambah maka menjalankan fungsi di dalamnya
		$('#div-form-tambah')
			.on('input', $('.nama'), function() {
				auto_tambah();
			})

		// autocomplete yang dimasukkan kedalam fungsi
		function auto_tambah() {
			$(".nama").autocomplete({
				source: "<?php echo base_url('autocomplete/ajax_pelayanan'); ?>?kelas=" + kelas

			});
		}
		// end of fungsi tambah


		// Fungsi autocomplete pelayanan yang baru menggunakan jquery ui
		// $("#pelayanan-name").autocomplete({
		// 	source: "<?php echo base_url('autocomplete/ajax_pelayanan'); ?>?kelas=" + kelas,
		// 	select: function(event, ui) {
		// 		$('#pelayanan-name').val(ui.item.value);
		// 		$('#pelayanan-code').val(ui.item.code);
		// 		$('#pelayanan-groupname').val(ui.item.groupname);
		// 		$('#pelayanan-price').val(ui.item.price);
		// 	}
		// });

		// ketika select nama dokter maka akan menjalankan fungsi dibawah
		$('#input-name').on('change', function() {
			$.ajax({
				'type': "POST",
				'url': "<?php echo base_url('autocomplete/fill_dokter'); ?>",
				'data': {
					key: $('#input-name option:selected').data('id')
				},
				'success': function(response) {
					//mengisi value input nama dan lainnya
					let data = JSON.parse(response);
					$('#input-name').val(data.name);
					$('#input-code').val(data.code);
					$('#input-memo').val(data.memo);
					$('#autocomplete-dokter').html('');
				}
			})
		})



	});
</script>
<?= $this->endSection(); ?>