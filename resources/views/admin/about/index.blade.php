
    @extends('admin.admin_master')

<!--  Setting the  ID as section admin  -->
@section('admin')

<div class="py-12">
    <div class="container">
        <div class="row">

        <h2 class="mr-3">Home About</h2>   
        <a href="{{ route('add.about') }}"><button class="btn btn-info mb-2">Add About</button></a>

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
                    <div class="card-header">All About</div>
                
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" width="5%">Sl No</th>
                        <th scope="col" width="15%">Home Title</th>
                        <th scope="col" width="25%">Short Description</th>
                        <th scope="col" width="25%">Long Description</th>
                        <th scope="col" width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach($homeabout as $about)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{$about->title}}</td>
                        <td>{{$about->short_des}}</td>
                        <td>{{$about->long_des}}</td>
                        
                        <td>
                        <a href="{{ url('edit/about/'.$about->id) }}" class="btn btn-info">Edit</a>
                        <a href="{{ url('delete/about/'.$about->id) }}" class="btn btn-danger" 
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

