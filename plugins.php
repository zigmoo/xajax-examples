<?php

require (__DIR__ . '/vendor/autoload.php');

use Xajax\Xajax;
use Xajax\Response\Response;

$xajax = new Xajax();

// $xajax->configure('debug', true);
$xajax->configure('wrapperPrefix', 'Xajax');

/*
 * Sets the following options on the Toastr library
 * - toastr.options.closeButton = true;
 * - toastr.options.closeMethod = 'fadeOut';
 * - toastr.options.closeDuration = 300;
 * - toastr.options.closeEasing = 'swing';
 */
$xajax->plugin('toastr')->setOptions(array(
		'closeButton' => true,
		'closeMethod' => 'fadeOut',
		'closeDuration' => 300,
		'closeEasing' => 'swing',
));

/*
 * Sets the following options on the PgwModal
 * - closeOnEscape = true;
 * - closeOnBackgroundClick = true;
 * - maxWidth = 300;
*/
$xajax->plugin('pgwModal')->setOptions(array(
		'closeOnEscape' => true,
		'closeOnBackgroundClick' => true,
		'maxWidth' => 600,
));
// $xajax->plugin('pgwModal')->setInclude(false);

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
		$xResponse->toastr->success("div2 text is now $text");

		return $xResponse;
	}

	public function setColor($sColor)
	{
		$xResponse = new Response();
		$xResponse->assign('div2', 'style.color', $sColor);
		$xResponse->toastr->success("div2 color is now $sColor");
		
		return $xResponse;
	}

	public function showPgwDialog()
	{
		$xResponse = new Response();
		$buttons = array(array('title' => 'Close', 'class' => 'btn', 'click' => 'close'));
		$options = array('maxWidth' => 400);
		$xResponse->pgwModal->show("Modal Dialog", "This modal dialog is powered by PgwModal!!", $buttons, $options);
		
		return $xResponse;
	}

	public function showTbDialog()
	{
		$xResponse = new Response();
		$buttons = array(array('title' => 'Close', 'class' => 'btn', 'click' => 'close'));
		$width = 300;
		$xResponse->bootstrap->show("Modal Dialog", "This modal dialog is powered by Twitter Bootstrap!!", $buttons, $width);
		
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

	<div id="div3">&#160;</div>
	<div>
		<button onclick="XajaxHelloWorld.showPgwDialog(); return false;" >Show PgwModal Dialog</button>
	</div>

	<div id="div4">&#160;</div>
	<div>
		<button onclick="XajaxHelloWorld.showTbDialog(); return false;" >Show Twitter Bootstrap Dialog</button>
	</div>

</body>
</html>