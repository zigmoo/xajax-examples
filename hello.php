<?php

require (__DIR__ . '/vendor/autoload.php');

use Xajax\Xajax;
use Xajax\Response\Response;

$xajax = new Xajax();

// $xajax->configure('debug', true);
$xajax->configure('wrapperPrefix', 'xajax_');

/*
	Function: helloWorld
	
	Modify the innerHTML of div1.
*/
function helloWorld($isCaps)
{
	if ($isCaps)
		$text = 'HELLO WORLD!';
	else
		$text = 'Hello World!';
		
	$xResponse = new Response();
	$xResponse->assign('div1', 'innerHTML', $text);
	
	return $xResponse;
}

/*
	Function: setColor
	
	Modify the style.color of div1
*/
function setColor($sColor)
{
	$xResponse = new Response();
	$xResponse->assign('div1', 'style.color', $sColor);
	
	return $xResponse;
}

// Register functions
$reqHelloWorld = $xajax->register(XAJAX_FUNCTION, 'helloWorld');
$reqHelloWorld->useSingleQuote();

$reqSetColor = $xajax->register(XAJAX_FUNCTION, 'setColor');
$reqSetColor->useSingleQuote();
$reqSetColor->setParameter(0, XAJAX_INPUT_VALUE, 'colorselect1');

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
		// call the helloWorld function to populate the div on load
		<?php $reqHelloWorld->setParameter(0, XAJAX_JS_VALUE, 0); $reqHelloWorld->printScript(); ?>;
		// call the setColor function on load
		<?php $reqSetColor->printScript(); ?>;
	}
	/* ]]> */
</script>
</head>
<body style="text-align:center;">

	<div id="div1">&#160;</div>
	<div>
		<button onclick="<?php $reqHelloWorld->setParameter(0, XAJAX_JS_VALUE, 0); $reqHelloWorld->printScript(); ?>; return false;" >Click Me</button>
		<button onclick="<?php $reqHelloWorld->setParameter(0, XAJAX_JS_VALUE, 1); $reqHelloWorld->printScript(); ?>; return false;" >CLICK ME</button>
		<select id="colorselect1" name="colorselect1"
			onchange="<?php $reqSetColor->printScript(); ?>; return false;">
			<option value="black" selected="selected">Black</option>
			<option value="red">Red</option>
			<option value="green">Green</option>
			<option value="blue">Blue</option>
		</select>
	</div>

</body>
</html>