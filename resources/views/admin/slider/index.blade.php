
    @extends('admin.admin_master')

<!--  Setting the  ID as section admin  -->
@section('admin')

<div class="py-12">
    <div class="container">
        <div class="row">

        <h2 class="mr-3">Home Slider</h2>   
        <a href="{{ route('add.slider') }}"><button class="btn btn-info mb-2">Add Slider</button></a>

            <div class="col-md-12">
                <div class="card">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card-header">All Slider</div>
                
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" width="5%">Sl No</th>
                        <th scope="col" width="15%">Slider Title</th>
                        <th scope="col" width="25%">Description</th>
                        <th scope="col" width="15%">Image</th>
                        <th scope="col" width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach($sliders as $slider)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{$slider->title}}</td>
                        <td>{{$slider->description}}</td>
                        <!-- asset  means root project directory in laravel -->
                        <td><img src="{{ asset($slider->image) }}" alt="Image" style="height:40px; width:70px;"></td>
                        
                        <td>
                        <a href="{{ url('edit/slider/'.$slider->id) }}" class="btn btn-info">Edit</a>
                        <a href="{{ url('delete/slider/'.$slider->id) }}" class="btn btn-danger" 
                            onclick="return confirm('Are you sure you want to delete ?');">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            
        </div>
    </div>   
   


</div>      
    </div>



</div>

@endsection

