<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartComponent extends Component
{
    public function increaseQuantity($rowId)
    {

        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId, $qty);
        $this->emitTo('cart-count-component','refreshComponent');
    }

    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->emitTo('cart-count-component','refreshComponent');
    }

    public function deleteItem($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('cart-count-component','refreshComponent');
        session()->flash('success_message', 'Item has been delete');
    }

    public function destroyAll()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-count-component','refreshComponent');
        session()->flash('success_message', 'All item are Delete');
    }

    public function switchToSaveForLater($rowId){
       $item=Cart::instance('cart')->get($rowId);
       Cart::instance('cart')->remove($rowId);
       Cart::instance('saveForLater')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
       $this->emitTo('cart-count-component','refreshComponent');
       session()->flash('s_success_message','Item has been saved for later');
    }

    public function moveToCart($rowId){
        $item=Cart::instance('saveForLater')->get($rowId);
        Cart::instance('saveForLater')->remove($rowId);
        Cart::instance('cart')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Product');
        $this->emitTo('cart-count-component','refreshComponent');
        session()->flash('s_success_message','Item has been saved for later');
    }

    public function deleteSave($rowId){
        Cart::instance('saveForLater')->remove($rowId);
        session()->flash('s_success_message','Item has been removed form save for later');
    }

    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }
}
