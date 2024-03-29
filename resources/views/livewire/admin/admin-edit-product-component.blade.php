<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Edit Product
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.products')}}" class="btn btn-success pull-right">All Products</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                        @endif
                        <form  class="form-horizontal" enctype="multipart/form-data" wire:submit.prevent="updateProduct">
                            <div class="form-group">
                                <label for="" class="class col-md-4 control-label">Product Name</label>
                                <div class="class col-md-4">
                                    <input type="text" class="form-control input-md" placeholder="Product Name" wire:model="name" wire:keyup="generateSlug">
                                    @error('name') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="class col-md-4 control-label">Product Slug</label>
                                <div class="class col-md-4">
                                    <input type="text" class="form-control input-md" placeholder="Product Slug" wire:model="slug">
                                    @error('slug') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="class col-md-4 control-label">Short Description</label>
                                <div class="class col-md-4" wire:ignore>
                                    <textarea class="form-control" id="short_description" placeholder="Short Description" wire:model="short_description"></textarea>
                                    @error('short_description') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="class col-md-4 control-label">Description</label>
                                <div class="class col-md-4" wire:ignore>
                                    <textarea class="form-control" id="description" placeholder="Description" wire:model="description"></textarea>
                                    @error('description') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="class col-md-4 control-label">Regular Price</label>
                                <div class="class col-md-4">
                                    <input type="text" class="form-control input-md" placeholder="Regular Price" wire:model="regular_price">
                                    @error('regular_price') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="class col-md-4 control-label">Sale Price</label>
                                <div class="class col-md-4">
                                    <input type="text" class="form-control input-md" placeholder="Sale Price" wire:model="sale_price">
                                    @error('sale_price') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="class col-md-4 control-label">SKU</label>
                                <div class="class col-md-4">
                                    <input type="text" class="form-control input-md" placeholder="SKU" wire:model="SKU">
                                    @error('SKU') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="class col-md-4 control-label">Stock</label>
                                <div class="class col-md-4">
                                    <select class="form-control" wire:model="stock_status">
                                        <option value="instock">In stock</option>
                                        <option value="outofstock">Out of stock</option>
                                    </select>
                                    @error('stock_status') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="class col-md-4 control-label">Featured</label>
                                <div class="class col-md-4">
                                    <select class="form-control" wire:model="featured">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="class col-md-4 control-label">Quantity</label>
                                <div class="class col-md-4">
                                    <input type="text" class="form-control input-md" placeholder="Quantity" wire:model="quantity">
                                    @error('quantity') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="class col-md-4 control-label">Product Image</label>
                                <div class="class col-md-4">
                                    <input type="file" class="input-file" wire:model="newImage">
                                    @if($newImage)
                                        <img src="{{$newImage->temporaryUrl()}}" width="120"/>
                                    @else
                                        <img src="{{asset('assets/images/products')}}/{{$image}}" width="120"/>
                                    @endif
                                    @error('newImage') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="class col-md-4 control-label">Category</label>
                                <div class="class col-md-4">
                                    <select class="form-control" wire:model="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id') <p class="text-danger">{{$message}}</p> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="class col-md-4 control-label"></label>
                                <div class="class col-md-4">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')

    <script>
        $(function (){
            tinymce.init({
                selector:'#short_description',
                setup:function (editor){
                    editor.on('Change',function (e){
                        tinyMCE.triggerSave();
                        var sd_data=$('#short_description').val();
                    @this.set('short_description',sd_data);
                    });
                }
            });

            tinymce.init({
                selector:'#description',
                setup:function (editor){
                    editor.on('Change',function (e){
                        tinyMCE.triggerSave();
                        var d_data=$('#description').val();
                    @this.set('description',d_data);
                    });
                }
            });
        });
    </script>

@endpush

