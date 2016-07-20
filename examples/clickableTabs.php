<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Utilities Testing Sandbox</title>
</head>
<body>

<header role="banner">
	<h1>Clickable Tabs Creator</h1>
	<h2>Create clickable tabs easily and quickly</h2>

	<p>Taking a string prefix clickable tabs will create clickable tabs from any DOM element.</p>

	<p>Can be used at {projectHome}/js/clickableTabs.js</p>
</header>


<main role="main">

	<h3>Tabs</h3>
		<h4>Syntax is {tabPrefix}_tab_{number}</h4>
			<p>Number must start at 0 and cannot be skipped</p>

	<h3>Content</h3>
		<h4>Syntax is {tabPrefix}_content_{number}</h4>
			<p>Number must start at 0 and cannot be skipped</p>

	<h3>Example</h3>

	<ul>
		<li id="test_tab_0">Tab One</li>
		<li id="test_tab_1">Tab Two</li>
		<li id="test_tab_2">Tab Three</li>
	</ul>

	<p id="test_content_0">Tab content one</p>
	<p id="test_content_1">Tab content two</p>
	<p id="test_content_2">Tab content three</p>

</main>


<script src="../js/clickableTabs.js"></script>

<script type="text/javascript">
	createClickableTabs("test");
</script>


</body>

<footer>
	<a href="../index.php">Back</a>


</footer>

</html>