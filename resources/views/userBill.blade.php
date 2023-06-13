@extends('app')
@section('content')

<!------ Include the above in your HEAD tag ---------->

        <div class="col-md-12" style="padding-top:50px">
            
            <h2 style="text-align:center">User Bill</h2>
        
            <a  class="btn btn-primary" href="{{ route('createBill') }}">Add Bill</a>
            
        <div class="table-responsive">

                
              <table id="mytable" class="table table-bordred table-striped">
                   <thead>
                   
                   <th>S.NO</th>
                   <th> Customer Name</th>
                   <th>Month</th>
                   <th>Unit</th>
                     <th>Price</th>
                </thead>
    <tbody>
    
    <tr>
    @foreach($user_bills as $key => $user_bill)    
    <td>{{ $key+1 }}</td>
    <td>{{ $user_bill->user->name }}</td>
    <td>{{ $user_bill->month }}</td>
    <td>{{ $user_bill->unit }}</td>
    <td>{{ $user_bill->total_price }}</td>
    </tr>
    @endforeach

    </tbody>
        
</table>

{{ $user_bills->links() }}

        </div>
        </div>

@endsection
    
    
  