<div>

    <div class="container" style="padding: 30px 0;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            All slides
                        </div>
                        <div class="col-md-6">
                            <a href="{{route('admin.addhomeslider')}}" class="btn btn-success pull-right">Add new Slider</a>
                        </div>
                    </div>
                </div>
                @if(\Illuminate\Support\Facades\Session::has('message'))
                    <div class="alert alert-success" role="alert">{{\Illuminate\Support\Facades\Session::get('message')}}</div>
                @endif
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>SubTitle</th>
                            <th>Price</th>
                            <th>Link</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $slider)
                            <tr>
                                <td>{{$slider->id}}</td>
                                <td><img src="{{asset('assets/images/sliders')}}/{{$slider->image}}" width="70" alt=""></td>
                                <td>{{$slider->title}}</td>
                                <td>{{$slider->subtitle}}</td>
                                <td>{{$slider->price}}</td>
                                <td>{{$slider->link}}</td>
                                <td>{{$slider->status==1?'Active':'Inactive'}}</td>
                                <td>{{$slider->created_at}}</td>
                                <td>
                                    <a href="{{route('admin.edithomeslider',['slide_id'=>$slider->id])}}"><i class="fa fa-edit fa-2x"></i></a>
                                    <a href="#" wire:click.prevent="deleteSlide({{$slider->id}}) " style="margin-left: 10px;"><i class="fa fa-times fa-2x text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>

</div>
