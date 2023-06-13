@extends('app')
@section('content')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<div class="col-md-12" style="padding-top:50px">
    @if(session('success'))
            <h1 class="alert alert-success">{{session('success')}}</h1>
            @endif
        <h2 style="text-align:center">Customer List</h2>
        <a  class="btn btn-primary" href="{{ route('addCustomer') }}" style="text-align:right">Add Customer</a>
        <div class="table-responsive">

                
              <table id="mytable" class="table table-bordred table-striped">
                   <thead>
                   
                   <th>S.NO</th>
                   <th> Name</th>
                   <th>Email</th>
                    <th>Mobile</th>
                     <th>Address</th>
                     <th>City</th>
                      <th>Action</th>
                   </thead>
    <tbody>
    
    <tr>
    @foreach($users as $key => $user)    
    <td>{{ $key+1 }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->mobile }}</td>
    <td>{{ $user->address }}</td>
    <td>{{ $user->city }}</td>
    <td><a class="btn btn-primary btn-xs" href="{{ route('editCustomer',$user->id) }}" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>
    <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#exampleModal" onclick="deleteCustomer('{{ $user->id }}')"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
    </tr>
    @endforeach

    </tbody>
        
</table>
        </div>
        </div>
    
    
  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('deleteCustomer') }}" method="post">
        @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Customer Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="customer_id">
        <h3>Are You Sure Delete This User</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
      </div>
    </div>
    </form>
  </div>
</div>
<script>
    function deleteCustomer($id){
        document.getElementById("customer_id").value = $id;
    }
</script>
@endsection