<?php

declare(strict_types=1);

namespace App\Core;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;
		$router->addRoute('<presenter>/<action>[/<id>]', 'Sign:signIn');
		$router->addRoute('homepage', 'Homepage:default');
		$router->addRoute('borrow', 'Borrow:default');
		$router->addRoute('return', 'Return:default');
		$router->addRoute('manage', 'Manage:default');
	 

 
		return $router;
	}
}
 