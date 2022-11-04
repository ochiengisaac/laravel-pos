@extends('layouts.app')



@section('content')

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Users</h5>
                    <div style="text-align:right;">

                        <a class="btn btn-success" href="{{ route('user.create') }}"> Create New User</a>

                    </div>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#!"><?= isset($title) ? $title : "Users List"; ?></a></li>
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
                <h5>Users</h5>
            </div>
            <div class="card-body">



                @if ($message = Session::get('success'))

                <div class="alert alert-success">

                    <p>{{ $message }}</p>

                </div>

                @endif



                <table class="table table-bordered datatable">
                    <thead>
                    <tr>

                        <th>No</th>

                        <th>Role</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Phone</th>

                        <th width="280px">Action</th>

                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($users as $user)

                    <tr>

                        <td>{{ ++$i }}</td>

                        <td>{{ $user->role }}</td>

                        <td>{{ $user->name }}</td>

                        <td>{{ $user->email }}</td>

                        <td>{{ $user->phone }}</td>

                        <td>

                            <form action="{{ route('user.destroy',$user->id) }}" method="POST">



                                <!--<a class="btn btn-info" href="{{ route('user.show',$user->id) }}">Show</a>-->



                                <a class="btn btn-primary" href="{{ route('user.edit',$user->id) }}">Edit</a>



                                @csrf

                                @method('DELETE')



                                <button type="submit" class="btn btn-danger">Delete</button>

                            </form>

                        </td>

                    </tr>

                    @endforeach
                </tbody>

                </table>
                {!! $users->links() !!}

            </div>
        </div>
    </div>


</div>







@endsection