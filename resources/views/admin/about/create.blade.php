@extends('admin.admin_master')

<!--  Setting the  ID as section admin  -->
@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Create About</h2>
            </div>
            <div class="card-body">
                 <form action="{{ route('store.about') }}" method="POST"> 
                        @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Home Title</label>
                        <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="Enter About Title">
                         <!--Using Build in function for error message -->
                         @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Short Description</label>
                        <textarea class="form-control" name="short_des" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Long Description</label>
                        <textarea class="form-control" name="long_des" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                   
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Add About</button>  
                        <a href="{{ url('home/about') }}" class="btn btn-info">Cancel</a>  
                    </div>
                </form>
            </div>
        </div>
</div>

@endsection