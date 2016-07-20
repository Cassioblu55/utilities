<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Utilities Testing Sandbox</title>
</head>
<body>

<?php include_once "../php/errorDisplay.php"; ?>


<header role="banner">
	<h1>Create Popup Error Message</h1>
	<h2>Easily create error message on any page</h2>

	<p>Include file and add "error=Message" to url param and display a popup message that will fade away. Alerting a user of error. For example incorrectly submiting a form with an error that only the server can find.</p>

	<p>Can be used at {projectHome}/php/errorDisplay.php</p>
</header>


<main role="main">

	<a href="errorDisplay.php?error=This Is an error.">Show error message</a>
	<br>
	<a href="errorDisplay.php?error=This Is another error message.">Show another error message</a>

</main>

</body>

<footer style="padding-top: 10px;">
	<a href="../index.php">Back</a>


</footer>

