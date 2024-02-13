<!DOCTYPE html>
<html>

<head>
	<title>text to speech</title>
</head>

<body>

	<div class="container">

		<div class="row">
			<div class="input-field col s12">
				<!-- Text yang diolah -->
				<textarea id="message"></textarea>
				<label>Write message</label>
			</div>
		</div>

		<!-- Button text to speech -->
		<a href="#" id="speak" class="waves-effect waves-light btn">Speak</a>
		</form>
	</div>


	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript">
		$(function() {
			// mengecek browser support atau tidak
			if ('speechSynthesis' in window) {


				// event untuk button/text to speech
				$('#speak').click(function() {
					var text = $('#message').val();
					var msg = new SpeechSynthesisUtterance();
					var voices = window.speechSynthesis.getVoices();

					msg.voice = voices[6];

					msg.rate = 1;

					msg.pitch = 1;
					msg.text = text;

					speechSynthesis.speak(msg);
				})
			} else {
				alert('Browser yang digunakan tidak support speechSynthesis');
			}
		});
	</script>
</body>

</html>