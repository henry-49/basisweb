
    @extends('admin.admin_master')

<!--  Setting the  ID as section admin  -->
@section('admin')

<div class="py-12">
    <div class="container">
    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
        <div class="row">
        
        <h2 class="mr-3">Admin Message</h2>   
                    <div class="card-header">All Message</div>
                
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" width="5%">#</th>
                        <th scope="col" width="15%">Name</th>
                        <th scope="col" width="25%">Email</th>
                        <th scope="col" width="25%">Subject</th>
                        <th scope="col" width="25%">Message</th>
                        <th scope="col" width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i = 1)
                    @foreach($messages as $message)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{$message->name}}</td>
                        <td>{{$message->email}}</td>
                        <td>{{$message->subject}}</td>
                        <td>{{$message->message}}</td>
                        
                        <td>
                        <a href="{{ url('delete/message/'.$message->id) }}" class="btn btn-danger" 
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

