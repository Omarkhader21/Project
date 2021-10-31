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

class SearchComponent extends Component
{
    use WithPagination;

    public $sorting = "default";
    public $pageSize = 6;
    public $search;
    public $product_cat;
    public $product_cat_id;

    protected $paginationTheme = 'bootstrap';


    public function mount()
    {
        $this->sorting = "default";
        $this->pageSize = 6;
        $this->fill(request()->only('search','product_cat','product_cat_id'));

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
            $products = Product::where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('created_at', 'DESC')->paginate($this->pageSize);
        } else if ($this->sorting == "price") {
            $products = Product::where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('regular_price', 'ASC')->paginate($this->pageSize);
        } else if ($this->sorting == "price_desc") {
            $products = Product::where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('regular_price', 'DESC')->paginate($this->pageSize);
        } else {
            $products = Product::where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->paginate(6);
        }


        $categories = Category::all();


        return view('livewire.search-component' ,
            [
                'products' => $products,
                'categories' => $categories
            ]

        )->layout("layouts.base" );
    }
}


