@extends('app')
@section('content')
        <div class="row justify-content-center">
            <div class="col-md-8" style="padding-top:50px">
                    <div class="card" >
                        <div class="card-header"><h2 style="text-align:center" >Edit Customer</h2></div>
                        @if(session('success'))
            <h1 class="alert alert-success">{{session('success')}}</h1>
            @endif
                        <div class="card-body">
                            <form name="my-form" action="{{ route('updateCustomer',$user->id) }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ $user->id }}" name="id">
                                <div class="form-group row">
                                    <label for="full_name" class="col-md-4 col-form-label text-md-right">Full Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="full_name" class="form-control" name="name" value="{{ $user->name }}">
                                        @if($errors->has('name'))
                                        <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                  
                                </div>

                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                                    <div class="col-md-6">
                                        <input type="text" id="email_address" class="form-control" name="email" value="{{ $user->email }}">
                                        @if($errors->has('email'))
                                        <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phone_number" class="col-md-4 col-form-label text-md-right">Mobile Number</label>
                                    <div class="col-md-6">
                                        <input type="text" id="phone_number" class="form-control" name="mobile" value="{{ $user->mobile }}">
                                        @if($errors->has('mobile'))
                                        <div class="alert alert-danger">{{ $errors->first('mobile') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="present_address" class="col-md-4 col-form-label text-md-right">Address</label>
                                    <div class="col-md-6">
                                        <textarea type="text" id="present_address" class="form-control" name="address" > {{ $user->name }}</textarea>
                                        @if($errors->has('address'))
                                        <div class="alert alert-danger">{{ $errors->first('address') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="permanent_address" class="col-md-4 col-form-label text-md-right">City</label>
                                    <div class="col-md-6">
                                        <input type="text" id="permanent_address" class="form-control" name="city" value="{{ $user->city }}">
                                        @if($errors->has('city'))
                                        <div class="alert alert-danger">{{ $errors->first('city') }}</div>
                                        @endif
                                    </div>
                                </div>
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                        Edit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>

@endsection