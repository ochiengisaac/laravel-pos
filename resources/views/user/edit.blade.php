@extends('layouts.app')



@section('content')

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">User</h5>
                    <div style="text-align:right;">

                        <a class="btn btn-primary" href="{{ route('user.index') }}"> Back</a>

                    </div>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Edit User</a></li>
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
                <h5>User Edit</h5>
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

                @endif



                <form action="{{ route('user.update',$user->id) }}" method="POST">

                    @csrf

                    @method('PUT')



                    <div class="row">


                        <div class="col-xs-12 col-sm-12 col-md-6">
                            <div>
                                <label class="form-label" for="role"><b>Role * </b><small
                                        style="font-size:12px;"></small> </label>
                            </div>
                            <div>
                                <select id="role" required name="role" class="form-control">
                                    <option value="">-Select Role-</option>
                                    <?php foreach ([
                                        //"contact" => "Contact",
                                        "verifier" => "Verifier",
                                        "approver" => "Approver",
                                        "publisher" => "Publisher",
                                    ] as $role_k => $role_v) : ?>
                                    <option value="<?= $role_k; ?>" <?= $user->role == $role_k ? "selected" : ""; ?>>
                                        <?= $role_v; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6">

                            <div class="form-group">

                                <strong>Name:</strong>

                                <input id="name" required type="text" name="name" value="{{ $user->name }}"
                                    class="form-control" placeholder="Name">

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6">

                            <div class="form-group">

                                <strong>Email:</strong>

                                <input id="email" required type="text" name="email" value="{{ $user->email }}"
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