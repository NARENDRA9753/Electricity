@extends('app')
@section('content')
        <div class="row justify-content-center">
            <div class="col-md-8" style="padding-top:50px">
                    <div class="card">
                        @if(session('success'))
                        <h1 class="alert alert-success">{{session('success')}}</h1>
                        @endif
                        <div class="card-header"><h1 style="text-align:center"> Bill </h1></div>
                        <div class="card-body">
                            <form name="my-form" action="{{ route('saveBill') }}" method="post">
                                @csrf
                                <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">Customer</label>
                                    <div class="col-md-6">
                                    <select class="form-control" aria-label="Default select example" name="customer">
  <option selected value="">Select Customer</option>
  @foreach($customers as $customer)
  <option value="{{ $customer->id }}">{{ $customer->name }}</option>
  @endforeach
</select>
@if($errors->has('customer'))
                                        <div class="alert alert-danger">{{ $errors->first('customer') }}</div>
                                        @endif
                                    </div>
                                  
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Month</label>
                                    <div class="col-md-6">
                                    <select class="form-control" aria-label="Default select example" name="month">
  <option selected value="">Select Month</option>
  <option value='janaury'>Janaury</option>
    <option value='february'>February</option>
    <option value='march'>March</option>
    <option value='april'>April</option>
    <option value='may'>May</option>
    <option value='june'>June</option>
    <option value='july'>July</option>
    <option value='august'>August</option>
    <option value='september'>September</option>
    <option value='october'>October</option>
    <option value='november'>November</option>
    <option value='december'>December</option>
</select>
                                        @if($errors->has('month'))
                                        <div class="alert alert-danger">{{ $errors->first('month') }}</div>
                                        @endif

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">No. of Unit</label>
                                    <div class="col-md-6">
                                        <input type="text" id="phone_number" class="form-control" name="unit" value="{{ old('mobile') }}">
                                        @if($errors->has('unit'))
                                        <div class="alert alert-danger">{{ $errors->first('unit') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                        Generate
                                        </button>
                                        <a href="{{ route('usersBill')  }}" class="btn btn-primary">
                                        Back
                                        </a>
                                    </div>
                                </div>
                               
                            </form>
                        </div>
                    </div>
            </div>
        </div>

@endsection