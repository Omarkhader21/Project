<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
class AdminProductComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function deleteProduct($id){
        $product=Product::find($id);
        $product->delete();
        session()->flash('message','Product has been deleted succssfully!');
    }

    public function render()
    {
        $products=Product::paginate(5);
        return view('livewire.admin.admin-product-component',['products'=>$products])->layout('layouts.base');
    }
}
