<!DOCTYPE html>
<html>

<head>
	<title>Tanpa layout</title>
	<!-- You can change the theme colors from here -->
	<link rel="stylesheet" type="text/css" href="../assets/plugins/bootstrap/css/bootstrap.css">
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../assets/plugins/bootstrap/js/bootstrap.js"></script>

</head>

<body>
	<div class="custom-control custom-switch">
		<input type="checkbox" class="custom-control-input" id="customSwitch1">
		<label class="custom-control-label" for="customSwitch1">Toggle this switch element</label>
	</div>


	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap2/bootstrap-switch.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>

	<div class="margin-bottom-10">
		<input type="checkbox" class="make-switch" id="price_check" name="pricing" data-on-color="primary" data-off-color="info" value="true">
		<label for="price_check" class="btn btn-primary">
			Switch
		</label>
	</div>



	<script type="text/javascript">
		$('#customSwitch1').on('input', function() {
			alert($("#customSwitch1").length);
		})

		$('.make-switch').bootstrapSwitch('state');
		$('.make-switch').on('switchChange.bootstrapSwitch', function() {
			var check = $('.bootstrap-switch-on');
			if (check.length > 0) {
				console.log('ON')
			} else {
				console.log('OFF')
			}
		});

		$(".btn-toggle").click(function(e) {
			e.preventDefault();

			$(".btn-toggle").removeClass("btn-primary");
			$(this).addClass("btn-primary");
			var id = $(this).data('id');

			$("input[name='btn-toggle-val']").val(id);
			alert($("input[name='btn-toggle-val']").val());
		});
	</script>
</body>

</html>