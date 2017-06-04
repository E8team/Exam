<?php
namespace App\Tools;

use Illuminate\Pagination\LengthAwarePaginator as BaseLengthAwarePaginator;
use Illuminate\Pagination\UrlWindow;

class LengthAwarePaginator extends BaseLengthAwarePaginator
{

    protected $onEachSide = 3;
    public function elements()
    {
        $window = UrlWindow::make($this, $this->onEachSide);
        return array_filter([
            $window['first'],
            is_array($window['slider']) ? '...' : null,
            $window['slider'],
            is_array($window['last']) ? '...' : null,
            $window['last'],
        ]);
    }

    public function setOnEachSide($onEachSide)
    {
        $this->onEachSide = $onEachSide;
        return $this;
    }

}