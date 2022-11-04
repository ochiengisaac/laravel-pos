@extends('layouts.app')



@section('content')

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">User Creation</h5>
                    <div style="text-align:right;">

                        <a class="btn btn-primary" href="{{ route('user.index') }}"> Back</a>

                    </div>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!">Create User</a></li>
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
                <h5>User Create</h5>
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



                <form action="{{ route('user.store') }}" method="POST">

                    @csrf




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
                                        "verifier" => "Verifier",
                                        "approver" => "Approver",
                                        "publisher" => "Publisher",
                                    ] as $role_k => $role_v) : ?>
                                    <option value="<?= $role_k; ?>">
                                        <?= $role_v; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-12 col-md-6">

                            <div class="form-group">

                                <strong>Name :</strong>

                                <input type="text" id="name" required name="name" class="form-control"
                                    placeholder="Name">

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6">

                            <div class="form-group">

                                <strong>Email :</strong>

                                <input id="email" type="text" required name="email" class="form-control"
                                    placeholder="Email">

                            </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6">

                            <div class="form-group">

                                <strong>Phone :</strong>

                                <input id="phone" type="text" required name="phone" class="form-control"
                                    placeholder="Phone">

                            </div>

                        </div>

                        <!--<div class="col-xs-12 col-sm-12 col-md-6">

                                    <div class="form-group">

                                        <strong>Logo :</strong>

                                        <input type="file" name="logo" class="form-control" placeholder="Logo">

                                    </div>

                                </div>-->

                        <div class="col-xs-12 col-sm-12 col-md-6">

                            <div class="form-group">

                                <strong>Account Password :</strong>

                                <input id="password" autocomplete="off" type="password" required name="password"
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