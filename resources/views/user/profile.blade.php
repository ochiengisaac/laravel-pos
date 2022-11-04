@extends('layouts.app')



@section('content')

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Profile</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Profile Update</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Zero config table start -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Profile Edit</h5>
            </div>
            <div class="card-body">



                @if ($errors->any())

                <div class="alert alert-danger">

                    <strong>Whoops!</strong> There were some problems with your input.<br><br>

                    <ul>

                        @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

                @elseif ($message = Session::get('success'))

                <div class="alert alert-success">

                    <p>{{ $message }}</p>

                </div>

                @endif



                <form action="{{ route('updateProfile') }}" method="POST">

                    @csrf

                    @method('PUT')



                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-6">

                            <div class="form-group">

                                <strong>First Name:</strong>

                                <input id="first_name" required type="text" name="first_name" value="{{ $user->first_name }}"
                                    class="form-control" placeholder="First Name">

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6">

                            <div class="form-group">

                                <strong>Last Name:</strong>

                                <input id="last_name" required type="text" name="last_name" value="{{ $user->last_name }}"
                                    class="form-control" placeholder="Last Name">

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6">

                            <div class="form-group">

                                <strong>Email:</strong>

                                <input id="email" readonly required type="email" name="email" value="{{ $user->email }}"
                                    class="form-control" placeholder="Email">

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6">

                            <div class="form-group">

                                <strong>Phone:</strong>

                                <input id="phone" required type="text" name="phone" value="{{ $user->phone }}"
                                    class="form-control" placeholder="Phone">

                            </div>

                        </div>

                        <!--<div class="col-xs-12 col-sm-12 col-md-12">

                                    <div class="form-group">

                                        <strong>Logo:</strong>

                                        <input type="file" required name="logo" value="{{ $user->logo }}" class="form-control" placeholder="Logo">

                                    </div>

                                </div>-->

                        <div class="col-xs-12 col-sm-12 col-md-6">

                            <div class="form-group">

                                <strong>Account Password :</strong>

                                <input id="password" autocomplete="off" type="password" name="password"
                                    class="form-control" placeholder="Password">

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                            <button id="userSubmit" type="submit" class="btn btn-primary">Submit</button>

                        </div>

                    </div>



                </form>


            </div>
        </div>
    </div>


</div>

@endsection