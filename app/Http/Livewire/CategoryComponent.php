<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\WithPagination;
use App\Models\Category;

class CategoryComponent extends Component
{

    public $sorting;
    public $pageSize;
    public $category_slug;


    public function mount($category_slug){
        $this->sorting ="default";
        $this->pageSize=12;
        $this->category_slug=$category_slug;
    }

    public function store($product_id,$product_name,$product_price){

        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_message',' Item added in Cart');
        return redirect()->route('product.cart');
    }

    use WithPagination;
    public function render(): Factory|View|Application
    {

        $category=Category::where('slug',$this->category_slug)->first();
        $category_id=$category->id;
        $category_name=$category->name;

        if($this->sorting=='date'){
            $products=Product::where('category_id',$category_id)->orderBy('created_at','DESC')->paginate($this->pageSize);
        }else if($this->sorting=="price"){
            $products=Product::where('category_id',$category_id)->orderBy('regular_price','ASC')->paginate($this->pageSize);
        }else if($this->sorting=="price_desc"){
            $products=Product::where('category_id',$category_id)->orderBy('regular_price','DESC')->paginate($this->pageSize);
        }else{
            $products=Product::where('category_id',$category_id)->paginate($this->pageSize);
        }

        $categories=Category::all();


        return view('livewire.category-component',['products'=>$products,'categories'=>$categories,'category_name'=>$category_name])
            ->layout("layouts.base");
    }
}


