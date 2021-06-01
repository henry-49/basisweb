  <!-- veiw/admin/.. -->
  @extends('admin.admin_master')

<!--  Setting the  ID as section admin  -->
@section('admin')

<div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Update User Profile</h2>
        </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

        <div class="card-body">
            <form class="form-pill" method="POST" action="{{ route('update.user.profile') }}">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput3">User Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user['name'] }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exampleFormControlInput3">User Email</label>
                    <input type="text" name="email" class="form-control" value="{{ $user['email'] }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-default">Update</button>
                <a href="{{ url('/dashboard') }}" class="btn btn-info">Back</a>
            </form>
        </div>
    </div>

@endsection