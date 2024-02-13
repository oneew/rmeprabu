<!DOCTYPE html>
<html>
<head>
	<title>Speech to text Converter</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		body{
			font-family: Open Sans;
		}
		#result{
			height: 200px;
			border: 1px solid #ccc;
			padding: 10px;
			box-shadow: 0 0 10px 0 #bbb;
			margin-bottom: 30px;
			font-size: 14px;
			line-height: 25px;
		}
		button{
			font-size: 20px;
			position: absolute;
			top: 240px;
			left: 50%;
		}
	</style>
</head>
<body>

	<h3 align="center">Speech to text converter JavaScript</h3>
	<div id="result"></div>
	<button class="button-mic"><i class="fa fa-microphone btn btn-danger" aria-hidden="true"></i></button>
	<textarea id="result2"></textarea>

	

	

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$('.button-mic').on('click',function(){
				//alert('alhamdulillah');
				if('webkitSpeechRecognition' in window) {
					var speechRecognizer = new webkitSpeechRecognition();
					speechRecognizer.continuous = true;
					speechRecognizer.interimResults = true;
					speechRecognizer.lang = 'id';
					speechRecognizer.start();

					var finalTranscripts = '';

					speechRecognizer.onresult = function(event) {
						var interimTranscripts = '';
						for(var i = event.resultIndex; i < event.results.length; i++){
							var transcript = event.results[i][0].transcript;
							transcript.replace("\n", "<br>");
							if(event.results[i].isFinal) {
								finalTranscripts += transcript;
							}else{
								interimTranscripts += transcript;
							}
						}
						// var result=finalTranscripts + '<span style="color: #999">' + interimTranscripts + '</span>';
						$('#result').html(finalTranscripts);
						$('#result2').val(finalTranscripts);
					};
					speechRecognizer.onerror = function (event) {

					};
				}else {
					$('#result').html('Your browser is not supported. Please download Google chrome or Update your Google chrome!!');
				}
			})
  
		})
	</script>
</body>
</html>