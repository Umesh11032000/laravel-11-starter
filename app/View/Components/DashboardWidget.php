<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardWidget extends Component
{
    public $icon;
    public $title;
    public $value;
    public $bgColor;

    /**
     * Create a new component instance.
     */
    public function __construct($icon, $title, $value, $bgColor = 'primary')
    {
        $this->icon = $icon;
        $this->title = $title;
        $this->value = $value;
        $this->bgColor = $bgColor;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-widget');
    }
}
