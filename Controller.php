<?php

namespace yassersoliman\phpmvc;
use yassersoliman\phpmvc\Application;
use yassersoliman\phpmvc\middlewares\BaseMiddleware;

class Controller
{
	public string $layout = 'main';
	public string $action = '';
	/**
	 * @var \yassersoliman\phpmvc\middlewares\BaseMiddleware[] 
	 */
	protected array $middlewares = [];

	public function setLayout($layout)
	{
		$this->layout = $layout;		
	}

	public function render($view, $params = [])
	{
		return Application::$app->view->renderView($view, $params);

	}

	public function registerMiddleware(BaseMiddleware $middleware)
	{
		$this->middlewares[] = $middleware;
	}

	public function getMiddlewares(): array
	{
		return $this->middlewares;		
	}
}

?>
