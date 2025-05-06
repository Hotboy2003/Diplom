<?php

namespace Core;

use Core\Database\Migration\Migrator;

class Application
{
	public function run(): void
	{
		session_start();

		$migration = new Migrator();
		$migration->migrate();

		$route = Routing\Router::find($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

		if ($route)
		{
			$action = $route->action;
			$action(...$route->getVariables());
		}
	}
}