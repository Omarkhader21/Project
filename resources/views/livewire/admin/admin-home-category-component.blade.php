<div>
    <div class="container" style="padding: 30px 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Manage Home categories
                    </div>
                    <div class="panel-body">
                        @if(\Illuminate\Support\Facades\Session::has('message'))
                            <div class="alert alert-success"
                                 role="alert">{{\Illuminate\Support\Facades\Session::get('message')}}</div>
                        @endif

                        <form class="form-horizontal" wire:submit.prevent="updateHomeCategory">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Choose Category</label>
                                <div class="col-md-4" wire:ignore>
                                    <select name="categories[]" class="sel_categories form-control" multiple="multiple" wire:model="selected_categories">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Number of products</label>
                                <div class="col-md-4" >
                                    <input type="text" class="form-control input-md" wire:model="numberofProducts">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-4" >
                                    <button type="submit" class="btn btn-primary">Save</button>
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
        $(document).ready(function (){
            $('.sel_categories').select2();
            $('.sel_categories').on('change',function (e) {
                var data=$('.sel_categories').select2("val");
                @this.set('selected_categories',data);
            });
        });
    </script>
@endpush


