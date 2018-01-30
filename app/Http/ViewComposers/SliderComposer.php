<?php
/**
 * Created by PhpStorm.
 * User: Ihor
 * Date: 29.01.2018
 * Time: 18:37
 */

namespace AutoKit\Http\ViewComposers;

use AutoKit\Slider;
use Illuminate\View\View;

class SliderComposer
{
    protected $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function compose(View $view)
    {
        $view->with('carousel', $this->slider->getCarousel());
    }
}