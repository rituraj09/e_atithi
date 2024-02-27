<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $prev;

    public function __construct($title, $prev = NULL)
    {
        $this->title = $title;
        $this->prev = $prev;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.page-header');
    }
}
