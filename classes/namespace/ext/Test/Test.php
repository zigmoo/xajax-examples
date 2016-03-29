<?php

namespace Ext\Test;

use Xajax\Response\Response;

class Test
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
	
	public function showDialog()
	{
		$xResponse = new Response();
		$buttons = array(array('title' => 'Close', 'class' => 'btn', 'click' => 'close'));
		$width = 300;
		$xResponse->twbs->show("Modal Dialog", "This modal dialog is powered by Twitter Bootstrap!!", $buttons, $width);
	
		return $xResponse;
	}
}
