<?php
	if(!empty($_GET['error'])){
		sendErrorMessage($_GET['error']);
	};

	function sendErrorMessage($message){
		echo '<div id="error-box" class="error-box">'.$message.'</div>';
	}
?>

<style>
	.error-box{
		margin:40%;

		padding:15px;

		white-space: nowrap;

		opacity: 1;
		background: rgb(255, 0, 0);
		position: fixed;

		border-radius: 25px;

		color: white;
		text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
		font-size: large;
		font-weight: bold;

		background: rgb(200, 14, 39);
		margin-top: 2%;
		margin-bottom: 5px;

		-moz-transition: opacity 1.5s;
		-webkit-transition: opacity 1.5s;
		-o-transition: opacity 1.5s;
		transition: opacity 2.5s;
		transition-delay: 3s;

		z-index: 100;
	}

	.fade-out-error-box{
		opacity: 0;
	}
</style>

<script>
	window.onload = function(){
		var errorBox = document.getElementById('error-box');
		if(errorBox){
			errorBox.className = errorBox.className +" fade-out-error-box";
		}
	}
</script>