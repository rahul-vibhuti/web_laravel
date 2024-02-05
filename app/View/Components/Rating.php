<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Rating extends Component
{
    public $ratingId;
    public $rating;
    /**
     * Create a new component instance.
     */
    public function __construct($rating,$ratingId)
    {
        $this->rating = $rating;
        $this->ratingId = $ratingId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.rating', ['rating' => $this->rating,'ratingId' => $this->ratingId]);
    }
}
