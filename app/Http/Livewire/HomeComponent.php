<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSlider;
use App\Models\Product;
use App\Models\Sale;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;

class HomeComponent extends Component
{

    #[NoReturn] public function render()
    {
        $sliders = HomeSlider::where('status', 1)->get();
        $lproducts = Product::orderBy('created_at', 'DESC')->get()->take(8);
        $category = HomeCategory::find(1);
        $cats = explode(',', $category->sel_category);
        $categories = Category::whereIn('id', $cats)->get();
        $sproducts=Product::where('sale_price','>',0)->inRandomOrder()->get()->take(8);
        $no_of_products = $category->no_of_products;
        $sale=Sale::find(1);



        return view('livewire.home-component', ['sliders' => $sliders, 'lproducts' => $lproducts, 'categories' => $categories, 'no_of_products' => $no_of_products,'sproducts'=>$sproducts,'sale'=>$sale])->layout('layouts.base');
    }
}
