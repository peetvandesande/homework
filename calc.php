<?php
$calculations = array('add', 'subtract', 'divide', 'multiply');

if (sizeof($_GET)> 0) {
	print_help();
} elseif (sizeof($_POST) < 1) {
	print_help();
} else {
	// Get to work
	if ((!isset($_POST["calculation"])) OR (!in_array($_POST["calculation"], $calculations))) {
		print_help();
	} else {
		$calculation = $_POST["calculation"];
	}
	if ((!isset($_POST["a"])) OR (!is_numeric($_POST["a"]))) {
		print_help();
	} else {
		$int_a = $_POST["a"];
	}
	if ((!isset($_POST["b"])) OR (!is_numeric($_POST["b"]))) {
		print_help();
	} else {
		$int_b = (int)$_POST["b"];
	}

	switch ($calculation) {
	case "add":
		print $int_a + $int_b;
		break;
	case "subtract":
		print $int_a - $int_b;
		break;
	case "divide":
		print $int_a / $int_b;
		break;
	case "multiply":
		print $int_a * $int_b;
		break;
	}
}

function print_help() {
	$output  = "<html>
<head>
	<title>Calculator API</title>
	<script src=\"https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js\"></script>
	<style>
		dt {font-weight: bold;}
	</style>
</head>
<body>
	<h1><center>calc.php</center></h1>
	<br>
	<p>This API performs simple calculations with 2 numbers and returns the output.</p>
	<p>All input is expected by POST method and the output is a numeric string.</p>
	<p>The following variables are required:</p>
	<dl>
		<dt>calculation</dt>
		<dd>Choose from:<br>
			<ul>
				<li>add (+)</li>
				<li>subtract (&minus;)</li>
				<li>divide (&divide;)</li>
				<li>multiply (&times;)</li>
			</ul>
		</dd>
		<dt>a</dt>
		<dd>First input number</dd>
		<dt>b</dt>
		<dd>Second input number</dd>
	</dl>
	<p>Example code:</p>
	<pre class=\"prettyprint lang-py\">
import requests

url = \"http://gblon-l-pvd01.hcch.com/api/calc.php\"

payload={
  'calculation': 'multiply',
  'a': '2222.2',
  'b': '3'}
files=[]
headers = {}

response = requests.request(\"POST\", url, headers=headers, data=payload, files=files)

print(response.text)
	</pre>
</body>
</html>";
	print $output;
	exit();
}

?>
