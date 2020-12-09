@extends('layout');
@section('title','Attendance')
@section('content')
    <div class="m-3 p-3 shadow">
        <h3 class="p-0 m-0">Add User</h3>
        <hr>
        <form action="{{route('users.add')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" required class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required class="form-control" placeholder="Email Address">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required class="form-control" placeholder="Password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="center">Branch</label>
                        <input type="text" name="center" id="center" required class="form-control" placeholder="Branch Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">--</label>
                        <br>
                        <input type="submit" value="Add User" class="btn btn-primary" >
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="m-3 p-3 mt-5 shadow">
        <table class="table"> 
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Email
                </th>
                <th>
                    Branch
                </th>
                <th>
                    Action
                </th>
            </tr>
            @foreach ($users as $user)
                <form action="{{route('users.edit',['user'=>$user->id])}}" id="form-{{$user->id}}" method="post">
                    @csrf
                </form>
                <tr>
                    <td>
                        <input type="text" name="name" id="name-{{$user->id}}" required class="form-control" placeholder="Name" value="{{$user->name}}" form="form-{{$user->id}}"> 
                    </td>
                    <td>
                        <input type="email" name="email" id="email-{{$user->id}}" required class="form-control" placeholder="Email Address" value="{{$user->email}}" form="form-{{$user->id}}"> 
                    </td>
                    <td>
                        <input type="text" name="center" id="center-{{$user->id}}" required class="form-control" placeholder="Branch" value="{{$user->center}}" form="form-{{$user->id}}"> 

                    </td>
                    <td>
                        <input type="submit" value="Update" class="btn btn-primary btn-sm" form="form-{{$user->id}}">
                    <button class="btn btn-success btn-sm" onclick="showedit({{$user->id}})">Change Password</button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>


    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Password</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="#" id="edit-form">
                  @csrf
                  <input type="hidden" id="eid" name="id" value="">
                  <label for="password">New Password</label>

                  <input type="password" name="password" id="epassword" class="form-control">
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="changePass()">Save changes</button>
            </div>
          </div>
        </div>
      </div>

@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        var url="{{route('users.pass')}}";
        function showedit(id){
            $("#eid").val(id);
            $('#edit-modal').modal('show');
            
        }

        function changePass(){
            if($('#epassword').val()==""){
                alert("Please Enter Password");
                return ;
            }

            var data=new FormData(document.getElementById('edit-form'));

            axios.post(url,data)
            .then(function(reponse){
                $('#edit-modal').modal('hide');
                showNotification('bg-success', 'Password updated successfully!');
                document.getElementById('edit-form').reset();
            })
            .catch(function(err){
                $('#edit-modal').modal('hide');
                showNotification('bg-success', 'Password cannot be updated');
                document.getElementById('edit-form').reset();
            })

        }
    </script>
@endsection