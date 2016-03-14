<?php

require (__DIR__ . '/vendor/autoload.php');

use Xajax\Xajax;
use Xajax\Response\Response;

/*
	File: helloworld.php

	Test / example page demonstrating the basic xajax implementation.
	
	Title: Hello world sample page.
	
	Please see <copyright.inc.php> for a detailed description, copyright
	and license information.
*/

/*
	@package xajax
	@version $Id: helloworld.php 362 2007-05-29 15:32:24Z calltoconstruct $
	@copyright Copyright (c) 2005-2006 by Jared White & J. Max Wilson
	@license http://www.xajaxproject.org/bsd_license.txt BSD License
*/

/*
	Section: Standard xajax startup
	
	- include <xajax.inc.php>
	- instantiate main <xajax> object
*/
$xajax = new Xajax();

/*
	- enable deubgging if desired
	- set the javascript uri (location of xajax js files)
*/
//$xajax->configure('debug', true);
$xajax->configure('javascript URI', '/test/xajax/js');
$xajax->configure('deferScriptGeneration', false);

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
		
	$objResponse = new Response();
	$objResponse->assign('div1', 'innerHTML', $text);
	
	return $objResponse;
}

/*
	Function: setColor
	
	Modify the style.color of div1
*/
function setColor($sColor)
{
	$objResponse = new Response();
	$objResponse->assign('div1', 'style.color', $sColor);
	
	return $objResponse;
}

class HelloWorld
{
	public function sayHello($isCaps)
	{
		if ($isCaps)
			$text = 'HELLO WORLD!';
		else
			$text = 'Hello World!';

		$objResponse = new Response();
		$objResponse->assign('div2', 'innerHTML', $text);

		return $objResponse;
	}

	public function setColor($sColor)
	{
		$objResponse = new Response();
		$objResponse->assign('div2', 'style.color', $sColor);
		
		return $objResponse;
	}
}

/*
	Section:  Register functions
	
	- <helloWorld>
	- <setColor>
*/
$reqHelloWorldMixed = $xajax->register(XAJAX_FUNCTION, 'helloWorld');
$reqHelloWorldMixed->useSingleQuote();
$reqHelloWorldMixed->setParameter(0, XAJAX_JS_VALUE, 0);

$reqHelloWorldAllCaps = $xajax->register(XAJAX_FUNCTION, 'helloWorld');
$reqHelloWorldAllCaps->useSingleQuote();
$reqHelloWorldAllCaps->setParameter(0, XAJAX_JS_VALUE, 1);

$reqSetColor = $xajax->register(XAJAX_FUNCTION, 'setColor');
$reqSetColor->useSingleQuote();
$reqSetColor->setParameter(0, XAJAX_INPUT_VALUE, 'colorselect1');

$clsHelloWorld = $xajax->register(XAJAX_CALLABLE_OBJECT, new HelloWorld());

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

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>xajax example</title>
<?php
	// output the xajax javascript. This must be called between the head tags
	$xajax->printJavascript();
?>
	<script type='text/javascript'>
		/* <![CDATA[ */
		window.onload = function() {
			// call the helloWorld function to populate the div on load
			<?php $reqHelloWorldMixed->printScript(); ?>;
			// call the setColor function on load
			<?php $reqSetColor->printScript(); ?>;
			// Call the HelloWorld class to populate the 2nd div
			xajax_HelloWorld.sayHello(0);
			// call the HelloWorld->setColor() method on load
			xajax_HelloWorld.setColor(xajax.$('colorselect2').value);
		}
		/* ]]> */
	</script>
</head>
<body style="text-align:center;">

	<div id="div1">&#160;</div>
	<div>
		<button onclick='<?php $reqHelloWorldMixed->printScript(); ?>' >Click Me</button>
		<button onclick='<?php $reqHelloWorldAllCaps->printScript(); ?>' >CLICK ME</button>
		<select id="colorselect1" name="colorselect1"
			onchange="<?php $reqSetColor->printScript(); ?>;">
			<option value="black" selected="selected">Black</option>
			<option value="red">Red</option>
			<option value="green">Green</option>
			<option value="blue">Blue</option>
		</select>
	</div>

	<div id="div2">&#160;</div>
	<div>
		<button onclick="xajax_HelloWorld.sayHello(0); return false;" >Click Me</button>
		<button onclick="xajax_HelloWorld.sayHello(1); return false;" >CLICK ME</button>
		<select id="colorselect2" name="colorselect2"
			onchange="xajax_HelloWorld.setColor(xajax.$('colorselect2').value); return false;">
			<option value="black" selected="selected">Black</option>
			<option value="red">Red</option>
			<option value="green">Green</option>
			<option value="blue">Blue</option>
		</select>
	</div>

</body>
</html>