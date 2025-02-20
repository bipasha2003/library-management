<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideBar extends Component
{
    /**
     * Create a new component instance.
     */
    public User $loggedUser;
    public function __construct()
    {
        $this->loggedUser = auth()->user();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side-bar');
    }
}
