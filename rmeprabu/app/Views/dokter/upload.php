<!-- Button trigger modal -->
<button type="button" class="d-none btn btn-primary" id="btn-modal-upload" data-toggle="modal" data-target="#exampleModal">
	Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Upload Foto Dokter</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="" method="post" enctype="multipart/form-data">
					<input id="file-foto" type="file" name="file-foto">
					<input id="code" type="hidden" name="code" value="<?= $info['code']; ?>">
					<input id="foto" type="hidden" name="foto" value="<?= $info['foto']; ?>">
					<input type="submit" name="" value="upload" id="btn-upload">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" id="btn-close-modal" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		// menampilkan modal
		$('#btn-modal-upload').trigger('click');


		$('#btn-upload').on('click', function(e) {
			// mencegah fungsi default/pindah atau refresh halaman
			e.preventDefault();
			// mengisi variable data yang akan dikirimkan dengan ajax
			let data = new FormData();
			let file = $('#file-foto')[0].files[0];
			let code = $('#code').val();
			let foto = $('#foto').val();
			data.append('file', file);
			data.append('code', code);
			data.append('foto', foto);


			$.ajax({
				type: 'POST',
				url: "<?php echo base_url('doktergallery/do_upload') ?>",

				data: data,
				contentType: false,
				processData: false,
				success: function(response) {
					// menutup modal
					$('#btn-close-modal').trigger('click');
					let pesan = JSON.parse(response);

					if (pesan.pesan) {
						Swal.fire({
							icon: 'success',
							title: 'Berhasil',
							text: 'Upload Foto Dokter Berhasil',

						})
					}

					if (pesan.pesangagal) {
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Pilih file foto yang akan diupload',

						})
					}

					$('#foto-' + pesan.code).attr('src', pesan.url);

				}
			})
		})
	})
</script>