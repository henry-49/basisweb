@extends('admin.admin_master')

<!--  Setting the  ID as section admin  -->
@section('admin')


    <div class="py-12">
 
       <div class="container">
           <div class="row">

            <div class="col-md-8">
            <div class="card-header">Multi Image</div>
                <div class="card-group">
             
                    @foreach($images as $image)
                    <div class="col-md-4 mt-4">
                        <div class="card">
                            <img src="{{ asset($image->image) }}" alt="">
                        </div>
                        <a href="{{ url('multi/delete/'.$image->id)}}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger">X</a>
                    </div>
                    @endforeach
     

         </div>
            </div>



            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Add Multi Image</div>
            <div class="card-body">

                    <form action="{{ route('store.image') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">Multi Image</label>
                            <input type="file" name="image[]" class="form-control" 
                            id="exampleInputEmail1" aria-describedby="emailHelp" multiple="">

                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div>
                       
                        <button type="submit" class="btn btn-primary">Add Image</button>
                    </form>
                    </div>
                </div>
            </div>

           </div>
       </div>



    </div>

@endsection