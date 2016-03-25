<?php

require (__DIR__ . '/vendor/autoload.php');

use Xajax\Xajax;
use Xajax\Response\Response;

$xajax = new Xajax();

// $xajax->configure('debug', true);
$xajax->configure('wrapperPrefix', '');

$xajax->plugin('toastr')->setOption('closeButton', true);

// Add class dirs
$xajax->addClassDir(__DIR__ . '/classes/simple/app');
$xajax->addClassDir(__DIR__ . '/classes/simple/ext');

// Register objects
$xajax->registerClasses();

/*
	Section: processRequest
	
	This will detect an incoming xajax request, process it and exit.  If this is
	not a xajax request, then it is a request to load the initial contents of the page
	(HTML).
	
	Everything prior to this statement will be executed upon each request (whether it
	is for the initial page load or a xajax request.  Everything after this statement
	will be executed only when the page is first loaded.
*/
$xajax->processRequest();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<title>xajax example</title>
<script src="//code.jquery.com/jquery-1.10.1.min.js"></script>
<!-- Twitter Bootstrap -->
<link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/js/bootstrap.min.js" type="text/javascript"></script>
<?php
	echo $xajax->getCssInclude();
	echo $xajax->getJsInclude();
	echo $xajax->getJavascript();
?>
<script type='text/javascript'>
	/* <![CDATA[ */
	window.onload = function() {
		// call the helloWorld function to populate the div on load
		Test.App.sayHello(0);
		// call the setColor function on load
		Test.App.setColor(xajax.$('colorselect1').value);
		// Call the HelloWorld class to populate the 2nd div
		Test.Ext.sayHello(0);
		// call the HelloWorld->setColor() method on load
		Test.Ext.setColor(xajax.$('colorselect2').value);
	}
	/* ]]> */
</script>
</head>
<body style="text-align:center;">

	<div id="div1">&#160;</div>
	<div>
		<button onclick='Test.App.sayHello(0); return false;' >Click Me</button>
		<button onclick='Test.App.sayHello(1); return false;' >CLICK ME</button>
		<select id="colorselect1" name="colorselect1"
			onchange="Test.App.setColor(xajax.$('colorselect1').value); return false;">
			<option value="black" selected="selected">Black</option>
			<option value="red">Red</option>
			<option value="green">Green</option>
			<option value="blue">Blue</option>
		</select>
	</div>

	<div id="div2">&#160;</div>
	<div>
		<button onclick="Test.Ext.sayHello(0); return false;" >Click Me</button>
		<button onclick="Test.Ext.sayHello(1); return false;" >CLICK ME</button>
		<select id="colorselect2" name="colorselect2"
			onchange="Test.Ext.setColor(xajax.$('colorselect2').value); return false;">
			<option value="black" selected="selected">Black</option>
			<option value="red">Red</option>
			<option value="green">Green</option>
			<option value="blue">Blue</option>
		</select>
	</div>

	<div id="div3">&#160;</div>
	<div>
		<button onclick="Test.App.showDialog(); return false;" >Show PgwModal Dialog</button>
	</div>

	<div id="div4">&#160;</div>
	<div>
		<button onclick="Test.Ext.showDialog(); return false;" >Show Twitter Bootstrap Dialog</button>
	</div>

</body>
</html>