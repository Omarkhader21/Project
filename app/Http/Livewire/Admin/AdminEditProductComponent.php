<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\Component;

class AdminEditProductComponent extends Component
{
    public $product_slug;
    public $product_id;
    public $name;
    public $slug;

    public function mount($product_slug){
        $this->product_slug=$product_slug;
        $product=Product::where('slug',$product_slug)->first();
        $this->product_id=$product->id;
        $this->name=$product->name;
        $this->slug=$product->slug;
    }

    public function generateslug(){
        $this->slug=Str::slug($this->name);
    }

    public function updateProduct(){
        $product=Product::find($this->product_id);
        $product->name=$this->name;
        $product->slug=$this->slug;
        $product->save();
        session()->flash('message','Product has been Updated successfully!');
    }


    public function render()
    {
        return view('livewire.admin.admin-edit-product-component')->layout('layouts.base');
    }
}
