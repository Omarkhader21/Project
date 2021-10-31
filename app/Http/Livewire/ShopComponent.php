<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
{
    use WithPagination;

    public $sorting = "default";
    public $pageSize = 6;

    protected $paginationTheme = 'bootstrap';


    public function mount()
    {
        $this->sorting = "default";
        $this->pageSize = 6;

    }

    public function store($product_id, $product_name, $product_price)
    {

        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', ' Item added in Cart');
        return redirect()->route('product.cart');
    }


    public function render(): Factory|View|Application
    {

        if ($this->sorting == 'date') {
            $products = Product::orderBy('created_at', 'DESC')->paginate($this->pageSize);
        } else if ($this->sorting == "price") {
            $products = Product::orderBy('regular_price', 'ASC')->paginate($this->pageSize);
        } else if ($this->sorting == "price_desc") {
            $products = Product::orderBy('regular_price', 'DESC')->paginate($this->pageSize);
        } else {
            $products = Product::paginate(6);
        }


        $categories = Category::all();


        return view('livewire.shop-component' ,
            [
                'products' => $products,
                'categories' => $categories
            ]

        )->layout("layouts.base" );
    }
}


