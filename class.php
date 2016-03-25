<?php

require (__DIR__ . '/vendor/autoload.php');

use Xajax\Xajax;
use Xajax\Response\Response;

$xajax = new Xajax();

// $xajax->configure('debug', true);
$xajax->configure('wrapperPrefix', 'Xajax');

class HelloWorld
{
	public function sayHello($isCaps)
	{
		if ($isCaps)
			$text = 'HELLO WORLD!';
		else
			$text = 'Hello World!';

		$xResponse = new Response();
		$xResponse->assign('div2', 'innerHTML', $text);

		return $xResponse;
	}

	public function setColor($sColor)
	{
		$xResponse = new Response();
		$xResponse->assign('div2', 'style.color', $sColor);
		
		return $xResponse;
	}
}

// Register object
$xajax->register(XAJAX_CALLABLE_OBJECT, new HelloWorld());

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
<?php
	echo $xajax->getCssInclude();
	echo $xajax->getJsInclude();
	echo $xajax->getJavascript();
?>
<script type='text/javascript'>
	/* <![CDATA[ */
	window.onload = function() {
		// Call the HelloWorld class to populate the 2nd div
		XajaxHelloWorld.sayHello(0);
		// call the HelloWorld->setColor() method on load
		XajaxHelloWorld.setColor(xajax.$('colorselect2').value);
	}
	/* ]]> */
</script>
</head>
<body style="text-align:center;">

	<div id="div2">&#160;</div>
	<div>
		<button onclick="XajaxHelloWorld.sayHello(0); return false;" >Click Me</button>
		<button onclick="XajaxHelloWorld.sayHello(1); return false;" >CLICK ME</button>
		<select id="colorselect2" name="colorselect2"
			onchange="XajaxHelloWorld.setColor(xajax.$('colorselect2').value); return false;">
			<option value="black" selected="selected">Black</option>
			<option value="red">Red</option>
			<option value="green">Green</option>
			<option value="blue">Blue</option>
		</select>
	</div>

</body>
</html>