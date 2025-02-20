<?php

namespace App\View\Components\Core;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PageHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public $header;

    public $breadcrums;

    public function __construct(string $header="",array $breadcrums = [])
    {
        $this->header = $header;
        $this->breadcrums = $breadcrums;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.core.page-header');
    }
}
