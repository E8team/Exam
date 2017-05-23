<?php

namespace App\Widgets;


class BaseWidget implements InterfaceWidget
{
    public $viewName = '';

    public function setViewName($viewName)
    {
        $this->viewName  = $viewName;
        return $this;
    }

    public function getViewName()
    {
        return $this->viewName ?: 'widgets.'.lcfirst(substr(strrchr(get_called_class(),'\\'),1));
    }

    public function getData(){
        return [];
    }

    public function render()
    {
        return view($this->getViewName(), $this->getData())->render();
    }

    public function __toString()
    {
        return $this->render();
    }
}