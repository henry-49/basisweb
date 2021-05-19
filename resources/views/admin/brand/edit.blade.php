<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

           Hi.. <b></b>
        </h2>
    </x-slot>

    <div class="py-12">
 
       <div class="container">
           <div class="row">

           

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Edit Brand</div>
            <div class="card-body">

                    <form action="{{ url('brand/update/'.$brands->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Update Category Name</label>
                            <input type="text" name="category_name" class="form-control" 
                            id="exampleInputEmail1" aria-describedby="emailHelp"
                            value="{{ $brands->brand_name }}">

                            @error('brand_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror   
                        </div>

                        <div class="form-group">
                                <label for="brandImage">Update Brand Image</label>
                                <input type="file" name="brand_image" class="form-control" 
                                id="brandImage" aria-describedby="emailHelp" value="{{ $brands->brand_image }}">

                                <!--Using Query Build in function for error message -->
                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>
                            
                            <!-- Make Image visiable on Edit -->
                            <div class="form-group">
                            <img src="{{ asset($brands->brand_image) }}" alt="Image" style="height:200px; width:400px;">
                            </div>

                        <button type="submit" class="btn btn-primary">Update Brand</button>
                        <a href="{{ route('all.brand') }}"  class="btn btn-info">Cancle</a>
                    </form>
                    </div>
                </div>
            </div>

           </div>
       </div>
    </div>
</x-app-layout>
