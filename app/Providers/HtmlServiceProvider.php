<?php
namespace Teachme\providers;

use Collective\Html\HtmlServiceProvider as CollectiveHtmlServiceProvider;
use TeachMe\Components\HtmlBuilder;

class HtmlServiceProvider extends CollectiveHtmlServiceProvider
{
	protected function registerHtmlBuilder()
	{
		$this->app->bindShared('html', function($app){
			return new HtmlBuilder($app['config'], $app['view'], $app['url']);
		});
	}

	
}