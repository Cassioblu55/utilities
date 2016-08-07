<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Utilities Testing Sandbox</title>
	<script src="../js/showServerMessages/ssm_1_0_0.js"></script>
</head>
<body>

<header role="banner">
	<h1>Create Popup Error Message</h1>
	<h2>Easily create messages on any page</h2>

	<p>Include file and add "errorMessage=Message" to url param and display a popup message that will fade away. Alerting a user of error. For example incorrectly submiting a form with an error that only the server can find.</p>

	<p>Include file and add "successMessage=Message" to url param and display a popup message that will fade away. Alerting a user of a successful action. Like a database entry updating or deleting successfully.</p>

	<p>Include file and add "defaultMessage=Message" to url param and display a popup message that will fade away. Alerting a user of an general info you wish them to know.</p>

	<p>Can be used at {projectHome}/js/showServerMessages/ssm_{versionNumber}.js</p>
</header>


<main role="main">

	<a href="showMessages.php?errorMessage=This Is an error message.">Show error message</a>
	<br>
	<a href="showMessages.php?successMessage=This is a success message.">Show success message</a>
	<br>
	<a href="showMessages.php?defaultMessage=This is a default message.">Show default message</a>


</main>

</body>

<footer style="padding-top: 10px;">
	<a href="../index.php">Back</a>


</footer>