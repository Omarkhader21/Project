<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\HomeCategory;
use Livewire\Component;

class AdminHomeCategoryComponent extends Component
{

    public $selected_categories=[];
    public $numberofProducts;

    public function mount(){
        $category=HomeCategory::find(1);
        $this->selected_categories=explode(',',$category->sel_category);
        $this->numberofProducts=$category->no_of_products;
    }

    public function updateHomeCategory(){
        $category=HomeCategory::find(1);
        $category->sel_category=implode(',',$this->selected_categories);
        $category->no_of_products=$this->numberofProducts;
        $category->save();
        session()->flash('message','HomeCategory has been updated successfully!');
    }


    public function render()
    {
        $categories=Category::all();

        return view('livewire.admin.admin-home-category-component',['categories'=>$categories])->layout('layouts.base');
    }
}
