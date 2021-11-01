<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">
                                Edit Products
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('admin.products')}}" class="btn btn-success pull-right">All product</a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if(Session::has('message'))
                            <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                        @endif
                        <form  class="form-horizontal" wire:submit.prevent="updateProduct" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="" class="class col-md-4 control-label">Product Name</label>
                                <div class="class col-md-4">
                                    <input type="text" class="form-control input-md" placeholder="Product Name" wire:model="name" wire:keyup="generateslug()">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="class col-md-4 control-label">Product Slug</label>
                                <div class="class col-md-4">
                                    <input type="text" class="form-control input-md" placeholder="Product Slug" wire:model="slug">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>