<?php

namespace App\View\Components\Homepage;

use Closure;
use Illuminate\Contracts\View\View;
use App\Models\Gallery;
use Illuminate\View\Component;

class GallerySection extends Component
{
    public $galleries;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->galleries = Gallery::Latest()->Take(6)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.homepage.gallery-section');
    }
}
