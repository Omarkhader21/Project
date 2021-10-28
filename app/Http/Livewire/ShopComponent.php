<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination;
    public function render(): Factory|View|Application
    {
        $products=Product::paginate(5);

        return view('livewire.shop-component',['products'=>$products])
            ->layout("layouts.base");
    }
}
