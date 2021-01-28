<?php
$calculations = array('add', 'subtract', 'divide', 'multiply');

$json = json_decode(file_get_contents("php://input"));

if (count($json) > 0) {
	print calculate($json->calculation, $json->a, $json->b);
} else {
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
			$a = (float)$_POST["a"];
		}
		if ((!isset($_POST["b"])) OR (!is_numeric($_POST["b"]))) {
			print_help();
		} else {
			$b = (float)$_POST["b"];
		}
		print calculate($calculation, $a, $b);
	}
}

function calculate($operation, $a, $b) {
	$output = 0;
	switch ($operation) {
	case "add":
		$output =  $a + $b;
		break;
	case "subtract":
		$output =  $a - $b;
		break;
	case "divide":
		$output =  $a / $b;
		break;
	case "multiply":
		$output =  $a * $b;
		break;
	}

	return $output;
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
	<p>All input is expected by POST method and the output is a numeric string. You may
	send either form-data or JSON</p>
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
	<p>Example Python 3 code using form-data:</p>
	<pre class=\"prettyprint lang-py\">
import requests

url = \"http://gblon-l-pvd01.hcch.com/api/calc.php\"
headers = {}
payload={
  'calculation': 'multiply',
  'a': '2222.2',
  'b': '3'}
files=[]

response = requests.request(\"POST\", url, headers=headers, data=payload, files=files)

print(response.text)
	</pre>
	<p>Example Python 3 code using JSON:</p>
	<pre class=\"prettyprint lang-py\">
import requests

url = \"http://gblon-l-pvd01.hcch.com/api/calc.php\"
headers = {
  'Content-Type': 'application/json'
}
payload=\"{\\\"calculation\\\": \\\"multiply\\\", \\\"a\\\": \\\"2222.2\\\", \\\"b\\\": \\\"3\\\"}\"

response = requests.request(\"POST\", url, headers=headers, data=payload)

print(response.text)
	</pre>
</body>
</html>";
	print $output;
	exit();
}

?>
