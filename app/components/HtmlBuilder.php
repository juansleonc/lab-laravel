<?php

namespace TeachMe\components;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\View\Factory as View;
use Collective\Html\htmlBuilder as CollectiveHtmlBuilder;
use Illuminate\Routing\UrlGenerator;

class HtmlBuilder extends CollectiveHtmlBuilder
{
    private $config;
    private $view;

    public function __construct(Config $config, View $view, UrlGenerator $url)
    {
        $this->config = $config;
        $this->view = $view;
        $this->url = $url;
    }
    public function menu($items)
    {
        if (!is_array($items)) {
            $items = $this->config->get($items);
        }

        return $this->view->make('partials.menu', compact('items'));
    }
    public function classes(array $classes)
    {
        $html = '';
        foreach ($classes as $name => $bool) {
            if (is_int($name)) {
                $name = $bool;
                $bool = true;
            }
            if ($bool) {
                $html .= $name.' ';
            }
        }

        return (!empty($html)) ? ' class="'.trim($html).'"' : '';
    }
}
