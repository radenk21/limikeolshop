<?php

namespace App\View\Components;

use Closure;
use App\Models\Slider;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class sliders extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $sliders = Slider::where('status','0')->get();

        return view('components.sliders', compact('sliders'));
    }
}
