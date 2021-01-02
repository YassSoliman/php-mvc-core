<?php

namespace yassersoliman\phpmvc;

class Response
{
	public function setStatusCode(int $code)
	{
		http_response_code($code);
	}

	public function redirect(string $url)
	{
		header('Location: '.'/'.basename(dirname(dirname(dirname(__DIR__)))).$url);
	}
}

?>
