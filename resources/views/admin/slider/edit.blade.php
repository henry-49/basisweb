    <!-- veiw/admin/.. -->
    @extends('admin.admin_master')

    <!--  Setting the  ID as section admin  -->
    @section('admin')

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

    <div class="py-12">
        <div class="container">
            <div class="row">   
        <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Slider</div>
                    <div class="card-body">
                        <form action="{{ url('update/slider/'.$sliders->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Old Image -->
                            <input type="hidden" name="old_image" value="{{ $sliders->image }}" class="form-control">

                            <div class="form-group">
                                <label for="sliderTitle">Update Slider Title</label>
                                <input type="text" name="title" class="form-control" 
                                id="sliderTitle" aria-describedby="emailHelp" value="{{ $sliders->title }}">

                                <!--Using Query Build in function for error message -->
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                 <label for="exampleFormControlTextarea1">Slider Description</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">
                            {{ $sliders->description }}
                            </textarea>
                         </div>

                            <div class="form-group">
                                <label for="sliderImage">Update Slider Image</label>
                                <input type="file" name="image" class="form-control" 
                                id="sliderImage" aria-describedby="emailHelp" value="{{ $sliders->image }}">

                                <!--Using Query Build in function for error message -->
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                            
                            <!-- Make Image visiable on Edit -->
                            <div class="form-group">
                            <img src="{{ asset($sliders->image) }}" alt="Image" style="height:200px; width:400px;">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Slider</button>
                            <a href="{{ url('home/slider') }}" class="btn btn-info">Back</a>
                        </form>
                    </div>
               </div>      
        </div>


    </div>      
        </div>
    </div>

@endsection