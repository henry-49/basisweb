@extends('admin.admin_master')

<!--  Setting the  ID as section admin  -->
@section('admin')

<div class="col-lg-12">
    <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Create Contact</h2>
            </div>
            <div class="card-body">
                 <form action="{{ route('store.contact') }}" method="POST"> 
                        @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Contact Email</label>
                        <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Enter Email">
                         <!--Using Build in function for error message -->
                         @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Contact Phone</label>
                        <input type="text" name="phone" class="form-control" id="exampleFormControlInput1" placeholder="Enter Phone">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Contact Address</label>
                        <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                   
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Add Contact</button>  
                        <a href="{{ url('admin/contact') }}" class="btn btn-info">Cancel</a>  
                    </div>
                </form>
            </div>
        </div>
</div>

@endsection