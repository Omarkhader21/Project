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

    public $min_price;
    public $max_price;

    protected $paginationTheme = 'bootstrap';


    public function mount()
    {
        $this->sorting = "default";
        $this->pageSize = 6;

        $this->min_price=1;
        $this->max_price=1000;
    }

    public function store($product_id, $product_name, $product_price)
    {

        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', ' Item added in Cart');
        return redirect()->route('product.cart');
    }

    public function addToWishList($product_id, $product_name, $product_price){
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->emitTo('wishlist-count-component','refreshComponent');
    }

    public function removeFromWishList($product_id){
        foreach (Cart::instance('wishlist')->content() as $witem){
            if($witem->id ==$product_id){
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wishlist-count-component','refreshComponent');
                return;
            }
        }
    }


    public function render(): Factory|View|Application
    {

        if ($this->sorting == 'date') {
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('created_at', 'DESC')->paginate($this->pageSize);
        } else if ($this->sorting == "price") {
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price', 'ASC')->paginate($this->pageSize);
        } else if ($this->sorting == "price_desc") {
            $products =whereBetween('regular_price',[$this->min_price,$this->max_price])->Product::orderBy('regular_price', 'DESC')->paginate($this->pageSize);
        } else {
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->paginate(6);
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


