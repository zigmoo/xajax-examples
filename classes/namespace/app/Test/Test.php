<?php

namespace App\Test;

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
		$xResponse->assign('div1', 'innerHTML', $text);
		$xResponse->toastr->success("div1 text is now $text");
	
		return $xResponse;
	}
	
	public function setColor($sColor)
	{
		$xResponse = new Response();
		$xResponse->assign('div1', 'style.color', $sColor);
		$xResponse->toastr->success("div1 color is now $sColor");
	
		return $xResponse;
	}
	
	public function showDialog()
	{
		$xResponse = new Response();
		$buttons = array(array('title' => 'Close', 'class' => 'btn', 'click' => 'close'));
		$options = array('maxWidth' => 400);
		$xResponse->pgwModal->show("Modal Dialog", "This modal dialog is powered by PgwModal!!", $buttons, $options);
	
		return $xResponse;
	}
}
